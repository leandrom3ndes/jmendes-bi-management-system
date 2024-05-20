<?php

use Illuminate\Database\Seeder;
use App\Template;
use App\TemplateText;

class TemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`action_template`
        $template = array(
            array('id' => '1','type' => 'modal','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('id' => '2','type' => 'modal','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:13:17','deleted_at' => NULL),
            array('id' => '3','type' => 'modal','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '4','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '5','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '6','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '7','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '8','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '9','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '10','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '11','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '12','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '13','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '14','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '15','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
            array('id' => '16','type' => 'validation_warning','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-10 16:45:28','deleted_at' => NULL),
        );

        $template_text = array(
            array('template_id' => '1','language_id' => '2','name'=>'nameA','text' => '<p style="text-align: center;">FORM BEFORE TEST ACTION TEMPLATE</p>
            <p style="text-align: center;">OL&Aacute; BEM VINDO</p>','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '2','language_id' => '2','name'=>'nameB','text' => '<h1 style="text-align: left;">FORM AFTER TEMPLATE TEST</h1>','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:13:17','deleted_at' => NULL),
            array('template_id' => '3','language_id' => '2','name'=>'nameC','text' => '<ol>
            <li style="text-align: center;"><strong>TESTE PRODU&Ccedil;&Atilde;O DE DOCUMENTO</strong></li>
            <li style="text-align: center;"><strong>TESTE PROD DOC</strong></li>
            <li style="text-align: center;"><strong>LINDO, FUNCIONA</strong></li>
            <li style="text-align: center;"><strong>FIM</strong></li>
            </ol>
            <p style="text-align: center;">&nbsp;</p>
            <p style="text-align: center;"><strong><span class="variable mceNonEditable">{Contracted Start Date}<span class="variable_value" style="display: none;">prop_id:1</span></span></strong></p>
            <p style="text-align: center;"><strong><span class="variable mceNonEditable">{Contracted End Date}<span class="variable_value" style="display: none;">prop_id:2</span></span></strong></p>
            <p style="text-align: center;"><strong><span class="variable mceNonEditable">{Contracted pick-up branch}<span class="variable_value" style="display: none;">prop_id:8</span></span></strong></p>
            <p style="text-align: center;"><strong><span class="variable mceNonEditable">{Contracted drop-off branch}<span class="variable_value" style="display: none;">prop_id:9</span></span></strong></p>
            <p style="text-align: center;"><strong><span class="variable mceNonEditable">{Car type}<span class="variable_value" style="display: none;">prop_id:11</span></span></strong></p>
            <p><img style="display: block; margin-left: auto; margin-right: auto;" src="https://i.gadgets360cdn.com/products/large/1529877080_635_xiaomi_redmi_6_pro.jpg" alt="" width="381" height="361" /></p>
            <table style="border-collapse: collapse; width: 52.1825%; height: 78px;" border="1">
            <tbody>
            <tr>
            <td style="width: 33.3333%;">coluna 1</td>
            <td style="width: 33.3333%;">coluna 2</td>
            <td style="width: 82.3129%;">coluna 3</td>
            </tr>
            <tr>
            <td style="width: 33.3333%;">linha 1</td>
            <td style="width: 33.3333%;">linha 1</td>
            <td style="width: 82.3129%;">linha 1</td>
            </tr>
            </tbody>
            </table>','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-01-10 16:45:28','updated_at' => '2019-01-15 16:25:22','deleted_at' => NULL),
            array('template_id' => '4','language_id' => '1','name'=>'nameD','text' => 'Este campo é obrigatório.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '5','language_id' => '1','name'=>'nameE','text' => 'Este campo precisa de ser um número.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '6','language_id' => '1','name'=>'nameF','text' => 'Este campo precisa de ser inteiro.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '7','language_id' => '1','name'=>'nameG','text' => 'Este campo precisa de possuir pelo menos 3 caracteres. ','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '8','language_id' => '1','name'=>'nameH','text' => 'Este campo só pode ter no máximo 6 caracteres.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '9','language_id' => '1','name'=>'nameI','text' => 'Este campo é obrigatório.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '10','language_id' => '1','name'=>'nameJ','text' => 'Este campo precisa de ser um número.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '11','language_id' => '1','name'=>'nameK','text' => 'Este campo precisa de pertencer ao seguinte intervalo ]6,9[.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '12','language_id' => '1','name'=>'nameL','text' => 'Este campo precisa de ser maior do que 2.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '13','language_id' => '1','name'=>'nameM','text' => 'Este campo campo precisa de ser menor do que 25.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '14','language_id' => '1','name'=>'nameN','text' => 'Este campo é obrigatório.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '15','language_id' => '1','name'=>'nameO','text' => 'Este campo é obrigatório.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '16','language_id' => '1','name'=>'nameP','text' => 'Este campo é obrigatório.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '4','language_id' => '2','name'=>'nameQ','text' => 'This field is mandatory.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '5','language_id' => '2','name'=>'nameR','text' => 'This field needs to be a number.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '6','language_id' => '2','name'=>'nameS','text' => 'This field need to be an integer.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '7','language_id' => '2','name'=>'nameT','text' => 'This field needs to have al least 3 characters.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '8','language_id' => '2','name'=>'nameU','text' => 'This field can only have a maximum of 6 characters.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '9','language_id' => '2','name'=>'nameV','text' => 'This field is mandatory.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '10','language_id' => '2','name'=>'nameW','text' => 'This field needs to be a number.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '11','language_id' => '2','name'=>'nameX','text' => 'This field needs to belong to the following range ]6,9[.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '12','language_id' => '2','name'=>'nameY','text' => 'This field needs to be higher than 2.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '13','language_id' => '2','name'=>'nameZ','text' => 'This field needs to be less than 25.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '14','language_id' => '2','name'=>'nameAA','text' => 'This field is mandatory.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '15','language_id' => '2','name'=>'nameAB','text' => 'This field is mandatory.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
            array('template_id' => '16','language_id' => '2','name'=>'nameAC','text' => 'This field is mandatory.','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-04 16:12:49','deleted_at' => NULL),
        );

        Template::insert($template);
        TemplateText::insert($template_text);
    }
}
