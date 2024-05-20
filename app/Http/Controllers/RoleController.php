<?php


namespace App\Http\Controllers;


use App\Actor;
use App\Delegation;
use App\Http\Resources\RoleResource;
use App\Http\Resources\TStateResource;
use App\Http\Traits\HTTPResponseTrait;
use App\Language;
use App\Role;
use App\RoleHasActor;
use App\RoleHasUser;
use App\RoleName;
use App\User;
use Illuminate\Http\Request;
use Config;
use DB;

class RoleController extends Controller
{

    use HTTPResponseTrait;

    private $user_id;
    private $lang_id;
    private $lang_id_fallback_locale;

    /*public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->lang_id = $this->auth_user_language_id;
            $this->user_id = $this->auth_user_id;

            return $next($request);
        });
    }*/

    public function index(Request $request/*, $id = null*/)
    {

        $this->lang_id = $request->user()->language_id;

        $fallback_locale = Config::get('app.fallback_locale');
        $this->lang_id_fallback_locale = Language::where('slug', '=', $fallback_locale)->first();

        /*if ($id == null) {*/
        $roles = DB::table('role')
            ->join('role_name', 'role.id', '=', 'role_name.role_id')
            ->join('language', 'role_name.language_id', '=', 'language.id')
            ->select('role_name.*', 'role.*')
            ->where('language.id', '=', $this->lang_id)->whereNull('role.deleted_at')
            ->get();

        return RoleResource::collection($roles);
        //return response()->json($roles);
        /*}else{
            return $this->getSpec($id);
        }*/
    }

    public function show($id)
    {
        $roles = Role::where('id', $id)->first();
        if (auth()->user()) {
            $langid = auth()->user()->language_id;
        } else {
            $langid = 1;
        }
        if ($roles->roleName) {
            if ($roles->roleName->where('language_id', $langid)->first() != null) {
                $roles->name = $roles->roleName->where('language_id', $langid)->first()->name;
            } else {
                $roles->name = $roles->roleName->first()->name;
            }
        }
        if (!$roles->name) {
            $roles->name = "Undefined";
        }

        return response()->json($roles);
    }

    public function store(Request $request)
    {
        $role = new Role;
        $role_name = new RoleName;

        DB::beginTransaction();
        try {
            $role->updated_by = $this->user_id;
            $role->save();

            $role_name->role_id = $role->id;
            $role_name->language_id = auth()->user()->language_id;
            $role_name->name = $request->input('name');
            $role_name->updated_by = auth()->user()->id;
            $role_name->save();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $this->lang_id = $request->user()->language_id;

        DB::beginTransaction();
        try {
            $role->update([
                'updated_by' => auth()->user()->id
            ]);

            $query = ['role_id' => $role->id, 'language_id' => $this->lang_id];
            $role_name = RoleName::where($query)->first();

            if ($role_name != null) {
                $role_name = RoleName::where($query);
                $role_name->update([
                    'name' => $request->input('name')
                ]);
                if (auth()->user()) {
                    $role_name->update([
                        'updated_by' => auth()->user()->id
                    ]);
                }
            } else {
                $role_name = new RoleName;

                $role_name->role_id = $role->id;
                $role_name->language_id = $this->lang_id;
                $role_name->name = $request->input('name');
                $role_name->updated_by = $this->user_id;
                $role_name->save();
            }

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function destroy(Request $request, $id)
    {
        $role = Role::find($id);

        $role_delete = Role::find($id)->delete();
    }

    public function getAllActors()
    {
        if (auth()->user()) {
            $langid = auth()->user()->language_id;
        } else {
            $langid = 1;
        }
        $aroles = collect();
        $actors = Actor::all();
        foreach ($actors as $actor) {
            if ($actor->actorName) {
                if ($actor->actorName->where('language_id', $langid)->first() != null) {
                    $actor->name = $actor->actorName->where('language_id', $langid)->first()->name;
                } else {
                    $actor->name = $actor->actorName->first()->name;
                }
            }
            if (!$actor->name) {
                $actor->name = "Undefined";
            }
            $sactor = array(
                "id" => $actor->id,
                "name" => $actor->name,
            );
            $aroles->push($sactor);
        }
        return response()->json($aroles);
    }

    public function getUsers()
    {
        $uroles = collect();
        $users = User::all();
        foreach ($users as $user) {
            $suser = array(
                "id" => $user->id,
                "name" => $user->name,
            );
            $uroles->push($suser);
        }
        return response()->json($uroles);
    }

    public function getSelActors($id)
    {
        if (auth()->user()) {
            $langid = auth()->user()->language_id;
        } else {
            $langid = 1;
        }
        $aroles = collect();
        $actors = Actor::has('actorRole')->get();
        foreach ($actors as $actor) {
            if ($actor->actorRole->where('role_id', $id)->first() != null) {
                if ($actor->actorName) {
                    if ($actor->actorName->where('language_id', $langid)->first() != null) {
                        $actor->name = $actor->actorName->where('language_id', $langid)->first()->name;
                    } else {
                        $actor->name = $actor->actorName->first()->name;
                    }
                }
                if (!$actor->name) {
                    $actor->name = "Undefined";
                }
                $aroles->push($actor);
            }
        }

        $ret = response()->json($aroles);
        return $ret;
    }

    public function getSelUsers($id)
    {
        $uroles = collect();
        $users = User::has('userRole')->select('id', 'name', 'updated_at')->get();
        foreach ($users as $user) {
            if ($user->userRole->where('role_id', $id)->first() != null) {
                $uroles->push($user);
            }
        }
        return response()->json($uroles);
    }

    public function getOnlyActors($id)
    {
        if (auth()->user()) {
            $langid = auth()->user()->language_id;
        } else {
            $langid = 1;
        }
        $aroles = collect();
        $actors = Actor::has('actorRole')->get();
        foreach ($actors as $actor) {
            if ($actor->actorRole->where('role_id', $id)->first() != null) {
                if ($actor->actorName) {
                    if ($actor->actorName->where('language_id', $langid)->first() != null) {
                        $actor->name = $actor->actorName->where('language_id', $langid)->first()->name;
                    } else {
                        $actor->name = $actor->actorName->first()->name;
                    }
                }
                if (!$actor->name) {
                    $actor->name = "Undefined";
                }
                $sactor = array(
                    "id" => $actor->id,
                    "name" => $actor->name,
                );
                $aroles->push($sactor);
            }
        }
        return response()->json($aroles);
    }

    public function getOnlyUsers($id)
    {
        $uroles = collect();
        $users = User::has('userRole')->get();
        foreach ($users as $user) {
            if ($user->userRole->where('role_id', $id)->first() != null) {
                $suser = array(
                    "id" => $user->id,
                    "name" => $user->name,
                );
                $uroles->push($suser);
            }
        }
        return response()->json($uroles);
    }

    public function updateActors(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('id', $id)->first();
            RoleHasActor::where('role_id', '=' ,$role->id)->delete();

            if($request->input('selectedActors')){
                foreach($request->input('selectedActors') as $selactor) {
                    foreach ($selactor as $key => $value) {
                        if ($key == "id") {
                            $actorid = $value;
                        }
                        $relation = $role->roleActor()->where('actor_id', $actorid)->first();
                        if (is_null($relation)) {
                            $roleactor = new RoleHasActor();
                            $roleactor->role_id = $request->input('role_id');
                            $roleactor->actor_id = $actorid;
                            $roleactor->updated_by = 1;
                            $roleactor->save();
                        }
                    }
                }
            }

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
        }

        if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function updateUsers(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::where('id', $id)->first();
            RoleHasUser::where('role_id', '=', $role->id)->delete();
            if ($request->input('selectedUsers')) {
                foreach ($request->input('selectedUsers') as $seluser) {
                    foreach ($seluser as $key => $value) {
                        if ($key == "id") {
                            $userid = $value;
                        }
                        $relation = $role->roleUser()->where('user_id', $userid)->first();
                        if (is_null($relation)) {
                            $roleuser = new RoleHasUser();
                            $roleuser->role_id = $request->input('role_id');
                            $roleuser->user_id = $userid;
                            $roleuser->updated_by = 1;
                            $roleuser->save();
                        }
                    }
                }
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            DB::rollback();
            $success = false;
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function removeActors(Request $request)
    {
        DB::beginTransaction();
        try {
            RoleHasActor::where('actor_id', '=', $request->input('actor_id'))->where('role_id', '=', $request->input('role_id'))->delete();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function removeUsers(Request $request)
    {
        DB::beginTransaction();
        try {
            $tuplodelete = RoleHasUser::where('user_id', '=', $request->input('user_id'))->where('role_id', '=', $request->input('role_id'));

            $tuplodelete->delete();
            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    //Functions added by Magno
    public function getDelegationsForRole($id)
    {
        $delegations = Delegation::with(['delegated_role.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }, 'delegates_role.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }, 't_state.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }])->whereHas('delegated_role.language', function ($query) {
            return $query->where('id', $this->lang_id);
        })->where('delegates_role_id', $id)
            ->get();

        /*$delegations->delegating_to->map(function ($valueDelegation, $keyDelegation) {
            $tstateid = $valueDelegation->pivot->t_state_id;
            $tstate = TState::with(['language' => function($query) {
                $query->where('id', $this->lang_id);
            }])->whereHas('language', function ($query) {
                return $query->where('id', $this->lang_id);
            })->find($tstateid);

            $valueDelegation->pivot['t_state_name'] = $tstate->language->first()->pivot->name;
        });*/

        return response()->json($delegations);
    }

    public function getSpecDelegation($id)
    {
        $delegation = Delegation::with(['delegated_role.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }, 'delegates_role.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }, 't_state.language' => function ($query) {
            $query->where('id', $this->lang_id);
        }])->whereHas('delegated_role.language', function ($query) {
            return $query->where('id', $this->lang_id);
        })->find($id);

        return response()->json($delegation);
    }

    public function insertDelegationForRole(Request $request)
    {
        $delegation = new Delegation;

        DB::beginTransaction();
        try {
            $delegation->delegates_role_id = $request->input('delegates_role_id');
            $delegation->delegated_role_id = $request->input('delegated_role_id');
            $delegation->start_time = $request->input('start_time');
            $delegation->end_time = $request->input('end_time', null);
            $delegation->t_state_id = $request->input('t_state_id');
            $delegation->state = $request->input('state');

            $delegation->updated_by = $this->user_id;

            $delegation->save();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function updateDelegationForRole(Request $request, $delegation_id)
    {
        $delegation_existent = Delegation::find($delegation_id);

        DB::beginTransaction();
        try {
            $delegation_existent->delegates_role_id = $request->input('delegates_role_id');
            $delegation_existent->delegated_role_id = $request->input('delegated_role_id');
            $delegation_existent->start_time = $request->input('start_time');
            $delegation_existent->end_time = $request->input('end_time', null);
            $delegation_existent->t_state_id = $request->input('t_state_id');
            $delegation_existent->state = $request->input('state');

            $delegation_existent->updated_by = $this->user_id;

            $delegation_existent->save();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function removeDelegation(Request $request)
    {
        $delegation_id = $request->input('delegation_id');
        $delegation_existent = Delegation::find($delegation_id);

        DB::beginTransaction();
        try {
            $delegation_existent->delete();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

}
