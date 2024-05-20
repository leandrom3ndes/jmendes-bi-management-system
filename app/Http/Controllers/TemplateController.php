<?php

namespace App\Http\Controllers;

use App\ActionHasTemplate;
use App\Http\Resources\TemplateResource;
use App\Http\Resources\TemplateModalResource;
use App\Http\Resources\TemplateToastResource;
use App\Template;
use App\TemplateText;
use App\TemplateModal;
use App\TemplateToast;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;

class TemplateController extends Controller
{
    use HTTPResponseTrait;

    public function index(Request $request)
    {
        $langId = $request->user()->language_id;

        $editableTemplates = DB::table('template')
            ->join('template_text', 'template.id', '=', 'template_text.template_id')
            ->join('language', 'language.id', '=', 'template_text.language_id')
            ->select('template.id', 'template.type',
                'template_text.language_id', 'template_text.name', 'template_text.text',
                'template.updated_by', 'template.deleted_by', 'template.updated_at', 'template.created_at')
            ->where('language.id', '=', $langId)
            ->whereIn('template.type', ['modal', 'toast'])
            ->whereNull('template.deleted_at')
            ->get();

        return TemplateResource::collection($editableTemplates);
    }

    public function show(Request $request, $templateId)
    {
        $langId = $request->user()->language_id;
        // Get the template record on the DB so we can see which type it has
        $template = Template::find($templateId);

        if ($template->type == 'modal') {

            $templateModal = DB::table('template')
                ->join('template_text', 'template.id', '=', 'template_text.template_id')
                ->join('template_modal', 'template.id', '=', 'template_modal.template_id')
                ->join('language', 'language.id', '=', 'template_text.language_id')
                ->select('template.id', 'template.type',
                    'template_text.name', 'template_text.text', 'template_text.language_id',
                    'template_modal.header_text','template_modal.button_text', 'template_modal.template_id',
                    'template.updated_by', 'template.deleted_by', 'template.updated_at', 'template.created_at')
                ->where([
                    ['language.id', '=', $langId],
                    ['template.id', '=', $templateId]
                ])
                ->whereNull('template.deleted_at')
                ->get();

            return TemplateModalResource::collection($templateModal);

        } else if ($template->type == 'toast') {

            $templateToast = DB::table('template')
                ->join('template_text', 'template.id', '=', 'template_text.template_id')
                ->join('template_toast', 'template.id', '=', 'template_toast.template_id')
                ->join('language', 'language.id', '=', 'template_text.language_id')
                ->select('template.id', 'template.type',
                    'template_text.name', 'template_text.text', 'template_text.language_id',
                    'template_toast.class','template_toast.colour', 'template_toast.title_text', 'template_toast.template_id',
                    'template.updated_by', 'template.deleted_by', 'template.updated_at', 'template.created_at')
                ->where([
                    ['language.id', '=', $langId],
                    ['template.id', '=', $templateId]
                ])
                ->whereNull('template.deleted_at')
                ->get();

            return TemplateToastResource::collection($templateToast);

        } else {
            // Never gets here
            return 'ERROR';
        }
    }

    public function store(Request $request)
    {
        // Get user id and language
        $langId = $request->user()->language_id;
        $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            $template = new Template;
            $template->type = $request->input('type');
            $template->updated_by = $userId;
            $template->save();

            $templateId = $template->id;

            $template_text = new TemplateText;
            $template_text->template_id = $templateId;
            $template_text->language_id = $langId;
            $template_text->name = $request->input('name');
            $template_text->text = $request->input('text');
            $template_text->updated_by = $userId;
            $template_text->save();

            if ($template->type == 'modal') {

                $template_modal = new TemplateModal;
                $template_modal->template_id = $templateId;
                $template_modal->language_id = $langId;
                $template_modal->header_text = $request->input('header');
                $template_modal->button_text = $request->input('button');
                $template_modal->updated_by = $userId;
                $template_modal->save();

            } else if ($template->type == 'toast') {

                $template_toast = new TemplateToast;
                $template_toast->template_id = $templateId;
                $template_toast->language_id = $langId;
                $template_toast->class = $request->input('class');

                if ($template_toast->class == 'custom') {

                    $template_toast->colour = $request->input('colour');
                    $template_toast->title_text = $request->input('title');

                }

                $template_toast->updated_by = $userId;
                $template_toast->save();

            }

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }
    }

    public function update(Request $request, $templateId)
    {
        $template = Template::find($templateId);

        $langId = $request->user()->language_id;
        $userId = $request->user()->id;

        // Compare type saved in the DB with the new type so we know if there's been a change
        $template_old_type = $template->type;
        $template_new_type = $request->input('type');
        $has_changed_type = $template_old_type != $template_new_type;

        DB::beginTransaction();
        try {
            // Updates in the template table
            $template->update([
                'type' => $template_new_type,
                'updated_by' => $userId
            ]);

            $query = ['template_id' => $template->id, 'language_id' => $langId];
            $template_text = TemplateText::where($query)->first();

            // Updates in the template_text table. If there isn't a record in this table for this template, one is created
            if ($template_text) {

                $template_text->update([
                    'name' => $request->input('name'),
                    'text' => $request->input('text'),
                    'updated_by' => $userId
                ]);

            } else {

                $template_text = new TemplateText;
                $template_text->template_id = $template->id;
                $template_text->language_id = $langId;
                $template_text->name = $request->input('name');
                $template_text->text = $request->input('text');
                $template_text->updated_by = $userId;
                $template_text->save();

            }

            // If user has changed the type when updating, delete the old record and create a new one
            if ($has_changed_type) {
                if ($template_old_type == 'modal') {

                    $old_template_modal = TemplateModal::where($query)->first();
                    // If there's an existing record with the old type, we delete it
                    if($old_template_modal) {
                        $old_template_modal->update([
                            'deleted_by' => $userId
                        ]);
                        $old_template_modal->delete();
                    }
                    // A new record is created with the new template type
                    $new_template_toast = new TemplateToast;
                    $new_template_toast->template_id = $templateId;
                    $new_template_toast->language_id = $langId;
                    $new_template_toast->class = $request->input('class');

                    if ($new_template_toast->class == 'custom') {
                        $new_template_toast->colour = $request->input('colour');
                        $new_template_toast->title_text = $request->input('title');
                    }

                    $new_template_toast->updated_by = $userId;
                    $new_template_toast->save();

                } else if ($template_old_type == 'toast') {

                    $old_template_toast = TemplateToast::where($query)->first();
                    // If there's an existing record with the old type, we delete it
                    if ($old_template_toast) {
                        $old_template_toast->update([
                            'deleted_by' => $userId
                        ]);
                        $old_template_toast->delete();
                    }
                    // A new record is created with the new template type
                    $new_template_modal = new TemplateModal;
                    $new_template_modal->template_id = $templateId;
                    $new_template_modal->language_id = $langId;
                    $new_template_modal->header_text = $request->input('header');
                    $new_template_modal->button_text = $request->input('button');
                    $new_template_modal->updated_by = $userId;
                    $new_template_modal->save();

                }

            // In case type hasn't changed - Update the record in the table corresponding to template type
            // If type hasn't changed and there isn't a record in the corresponding type table, one is created
            } else {

                if ($template->type == 'modal') {

                    $template_modal = TemplateModal::where($query)->first();
                    if ($template_modal) {

                        $template_modal->update([
                            'header_text' => $request->input('header'),
                            'button_text' => $request->input('button'),
                            'updated_by' => $userId
                        ]);

                    } else {

                        $new_template_modal = new TemplateModal;
                        $new_template_modal->template_id = $templateId;
                        $new_template_modal->language_id = $langId;
                        $new_template_modal->header_text = $request->input('header');
                        $new_template_modal->button_text = $request->input('button');
                        $new_template_modal->updated_by = $userId;
                        $new_template_modal->save();

                    }


                } else if ($template->type == 'toast') {

                    $template_toast = TemplateToast::where($query)->first();
                    if ($template_toast) {

                        $template_toast->update([
                            'class' => $request->input('class'),
                            'colour' => $request->input('colour'),
                            'title_text' => $request->input('title'),
                            'updated_by' => $userId
                        ]);

                    } else {

                        $new_template_toast = new TemplateToast;
                        $new_template_toast->template_id = $templateId;
                        $new_template_toast->language_id = $langId;
                        $new_template_toast->class = $request->input('class');
                        if ($new_template_toast->class == 'custom') {
                            $new_template_toast->colour = $request->input('colour');
                            $new_template_toast->title_text = $request->input('title');
                        }
                        $new_template_toast->updated_by = $userId;
                        $new_template_toast->save();

                    }

                }
            }

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function destroy(Request $request, $templateId)
    {
        $userId = $request->user()->id;

        // Get the template that has the id received
        $template = Template::find($templateId);

        $queryInfo = ['template_id' => $templateId];


        // If template is inside a current Action Rule, don't delete the template and warn the user
        $is_inside_AR = ActionHasTemplate::where($queryInfo)->whereNull('deleted_by')->get();
        if (count($is_inside_AR) != 0) {
            return response()->json([
                'belongsAR' => 'true'
            ]);
        }

        // If template doesn't belong to any AR
        // Get all occurrences of this template in all possible tables - template_text, template_modal || template_toast
        // - example: different languages defined for same template
        $template_text = TemplateText::where($queryInfo)->whereNull('deleted_by')->get();

        if ($template->type == 'modal') {
            $template_content = TemplateModal::where($queryInfo)->whereNull('deleted_by')->get();
        } else if ($template->type == 'toast') {
            $template_content = TemplateToast::where($queryInfo)->whereNull('deleted_by')->get();
        }

        // Delete all occurrences found
        DB::beginTransaction();
        try {
            $template->update([
                'deleted_by' => $userId
            ]);
            $template->delete();

            foreach ($template_text as $template_text_instance) {
                $template_text_instance->update([
                    'deleted_by' => $userId
                ]);
                $template_text_instance->delete();
            }

            foreach ($template_content as $template_content_instance) {
                $template_content_instance->update([
                    'deleted_by' => $userId
                ]);
                $template_content_instance->delete();
            }

            DB::commit();
            $success = true;
            return response()->json([
                'belongsAR' => 'false'
            ]);
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if (!$success) {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() . ' | all: ' . $e : null);
        }
    }

}
