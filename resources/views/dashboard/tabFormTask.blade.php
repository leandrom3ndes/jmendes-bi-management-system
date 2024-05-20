
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">[[::modal_form.spec_data.propsform[0].ent_type.language[0].pivot.name]] - [[type]]</h3>
                                    </div>
                                    <div class="panel-body">
                                        <!--action templates form before-->
                                        <div ng-repeat="actionTemplateMessage in actionTemplates" ng-if="actionTemplateMessage.type==='form_before'" ng-bind-html="actionTemplateMessage.language[0].pivot.text"></div>

                                        <fieldset>
                                            <div ng-repeat="prop in ::modal_form.spec_data.propsform" ng-switch="prop.value_type" emit-last-repeater-element>
                                                <div class="form-group" ng-switch-when="text|double|int" ng-switch-when-separator="|" ng-switch="prop.form_field_type">
                                                    <label for="inputName" class="col-sm-3 control-label" ng-style="{color: prop.stateSave}">
                                                        [[prop.language[0].pivot.name]]
                                                        <button type="button" ng-show="prop.stateSave==='red'" ng-disabled="prop.stateSaveFlag===1"
                                                                class="btn btn-sm btn-light-green" ng-click="saveAsyncr(modal_form, false, prop.id, $index, 'spec_data')"
                                                                id="btn-save">Retry save</button>
                                                    </label>
                                                    <div class="col-sm-9" ng-switch-when="text|number" ng-switch-when-separator="|">
                                                        {{--<input type="text" uib-popover-template="dynamicPopover.templateUrl" popover-class="popover" popover-placement="top" popover-title="[[dynamicPopover.title]]" popover-trigger="'focus'" class="form-control" id="[[prop.language[0].pivot.form_field_name]]" name="[[prop.language[0].pivot.form_field_name]]" placeholder=""
                                                               ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" maxlength="[[prop.form_field_size]]" ng-required="prop.mandatory">
                                                        --}}<input id="[[prop.id]]" type="[[prop.form_field_type]]" class="form-control" id="[[prop.language[0].pivot.form_field_name]]" name="[[prop.language[0].pivot.form_field_name]]" placeholder=""
                                                               ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" maxlength="[[prop.form_field_size]]"
                                                                   ng-required="prop.mandatory" ng-blur="saveAsyncr(modal_form, false, prop.id, $index, 'spec_data')">[[prop.units.language[0].pivot.name]]
                                                        {{--ng-blur="saveAsyncr(modal_form)"--}}
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-9" ng-switch-when="textbox">
                                                        <textarea rows="4" cols="50" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]"
                                                                  maxlength="[[prop.form_field_size]]">

                                                        </textarea>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group" ng-switch-when="bool" ng-switch="prop.form_field_type">
                                                    <label for="inputName" class="col-sm-3 control-label" ng-style="{color: prop.stateSave}">[[prop.language[0].pivot.name]]</label>
                                                    <div class="col-sm-9" ng-switch-when="radio">
                                                        <label for="" class="radio-inline state">
                                                            <input type="radio" name="[[prop.language[0].pivot.form_field_name]]" value="1" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-required="prop.mandatory">{{trans("dashboard/tabFormTask.INPUT_BOOL_VAL1")}}
                                                        </label>
                                                        <label for="" class="radio-inline state">
                                                            <input type="radio" name="[[prop.language[0].pivot.form_field_name]]" value="0" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-required="prop.mandatory">{{trans("dashboard/tabFormTask.INPUT_BOOL_VAL2")}}
                                                        </label>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-9" ng-switch-when="selectbox">
                                                        <select class="form-control" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-options="item.id as item.language[0].pivot.name for item in prop.prop_allowed_values" ng-required="prop.mandatory"> <!--arranjar-->
                                                            <option value=""></option>
                                                        </select>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group" ng-switch-when="enum" ng-switch="prop.form_field_type">
                                                    <label for="inputName" class="col-sm-3 control-label" ng-style="{color: prop.stateSave}">
                                                        [[prop.language[0].pivot.name]]
                                                        <button type="button" ng-show="prop.stateSave==='red'" ng-disabled="prop.stateSaveFlag===1"
                                                                class="btn btn-sm btn-light-green" ng-click="saveAsyncr(modal_form, false, prop.id, $index, 'spec_data')"
                                                                id="btn-save">Retry save</button>
                                                    </label>
                                                    <div class="col-sm-9" ng-switch-when="radio">
                                                        <label for="" ng-repeat="p_a_v in prop.prop_allowed_values" class="radio-inline state">
                                                            <input type="[[prop.form_field_type]]" name="[[prop.language[0].pivot.form_field_name]]" value="[[p_a_v.id]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-required="prop.mandatory">[[p_a_v.language[0].pivot.name]]
                                                        </label>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-9" ng-switch-when="checkbox">
                                                        {{--[[prop.fields]]--}}
                                                        <label for="" ng-repeat="p_a_v in prop.prop_allowed_values" ng-if="prop.mandatory" class="radio-inline state">
                                                            {{--<input type="[[prop.form_field_type]]" name="[[prop.language[0].pivot.form_field_name]]" value="[[p_a_v.id]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id]" ng-click="updateQuestionValue(prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id, prop.id)" ng-checked="value.indexOf(prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id) > -1" ng-required="value.length == 0">[[p_a_v.language[0].pivot.name]]--}}
                                                            <input type="[[prop.form_field_type]]" name="[[prop.language[0].pivot.form_field_name]]" value="[[p_a_v.id]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id]" ng-click="updateValue(prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id, $parent.$parent.$index, indexTab)" ng-required="prop.fields === undefined">[[p_a_v.language[0].pivot.name]]
                                                        </label>
                                                        <label for="" ng-repeat="p_a_v in prop.prop_allowed_values" ng-if="!prop.mandatory" class="radio-inline state">
                                                            <input type="[[prop.form_field_type]]" name="[[prop.language[0].pivot.form_field_name]]" value="[[p_a_v.id]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id]">[[p_a_v.language[0].pivot.name]]
                                                        </label>
                                                        <br>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>

                                                    <div class="col-sm-9" ng-switch-when="selectbox">
                                                        {{--<select class="form-control" id="[[prop.id]]" ng-blur="saveAsyncr(modal_form, false, prop.id, $index, 'spec_data')" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-if="prop.rule_code===null" ng-options="item.id as item.language[0].pivot.name for item in prop.prop_allowed_values" ng-required="prop.mandatory">
                                                            <option value=""></option>
                                                        </select>
                                                        <select class="form-control" dynamic id="[[prop.id]]" ng-blur="saveAsyncr(modal_form, false, prop.id, $index, 'spec_data')" dados="[[prop.rule_code]]" example-function="exampleCallback()" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-if="prop.rule_code!==null" ng-options="item.id as item.language[0].pivot.name for item in prop.prop_allowed_values" ng-required="prop.mandatory">
                                                            <option value=""></option>
                                                        </select>--}}
                                                        <ui-select uis-open-close="saveAsyncr(modal_form, isOpen, prop.id, $index, 'spec_data')" id="[[prop.id]]" name="[[prop.language[0].pivot.form_field_name]]" ng-if="prop.rule_code===null" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" theme="bootstrap" ng-required="prop.mandatory">
                                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                                            <ui-select-choices repeat="item.id as item in prop.prop_allowed_values | filter: $select.search">
                                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                                            </ui-select-choices>
                                                        </ui-select>

                                                        <ui-select uis-open-close="saveAsyncr(modal_form, isOpen, prop.id, $index, 'spec_data')" dynamic dados="[[prop.rule_code]]" example-function="exampleCallback()" id="[[prop.id]]" name="[[prop.language[0].pivot.form_field_name]]" ng-if="prop.rule_code!==null" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" theme="bootstrap" ng-required="prop.mandatory">
                                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                                            <ui-select-choices repeat="item.id as item in prop.prop_allowed_values | filter: $select.search">
                                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                                            </ui-select-choices>
                                                        </ui-select>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group" ng-switch-when="prop_ref">
                                                    <label for="inputName" class="col-sm-3 control-label" ng-style="{color: prop.stateSave}">[[prop.language[0].pivot.name]]</label>
                                                    <div class="col-sm-9">
                                                        <ui-select uis-open-close="saveAsyncr(modal_form, isOpen, prop.id, $index, 'spec_data')" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" theme="bootstrap" ng-required="prop.mandatory">
                                                            <ui-select-match placeholder="">[[$select.selected.value]]</ui-select-match>
                                                            <ui-select-choices repeat="item.id as item in prop.fk_property.values | filter: $select.search">
                                                                <div ng-bind-html="item.value | highlight: $select.search"></div>
                                                            </ui-select-choices>
                                                        </ui-select>
                                                        <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- Inicio alterações Guilherme --}}
                                                <div class="form-group" ng-switch-when="file">
                                                    <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
                                                    <div class="col-sm-9" >
                                                        <input type="file" class="form-control" id="[[prop.language[0].pivot.form_field_name]]" ng-model="files[prop.language[0].pivot.form_field_name]" nv-file-select="" ng-disabled="files[prop.language[0].pivot.form_field_name]!=null" ng-required="prop.mandatory" uploader="uploader" valid-file />
                                                    </div>
                                                </div>

                                                {{-- Fim alterações Guilherme --}}
                                                <div class="row" ng-if="prop.PropertiesInfo!=null || prop.PropertiesInfoEntType!=null">
                                                    <div class="col-sm-9 col-centered">
                                                        <uib-accordion close-others="oneAtATime">
                                                            <div uib-accordion-group class="panel-default" is-open="status.open">
                                                                <uib-accordion-heading>
                                                                    Other transactions information <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': status.open, 'glyphicon-chevron-right': !status.open}"></i>
                                                                </uib-accordion-heading>
                                                                <div ng-include="dynamicPopover.templateUrl"></div>
                                                            </div>
                                                        </uib-accordion>
                                                    </div>
                                                </div>
                                            </div>
                                            </fieldset>

                                            <div ng-if="modal_formTab.tab[indexTab].showMessage">
                                                <div ng-include="templatePath"></div>
                                            </div>

                                        <br>
                                        <br>
                                        {{-- Inicio alterações Guilherme --}}
                                        {{--<div class="col-sm-9" style="margin-bottom: 40px" ng-if="fileExist">--}}
                                        <div class="col-sm-9 center-block" style="margin-bottom: 20px" ng-if="::modal_formTab.tab[indexTab].fileExist">

                                            <h3>{{trans("dashboard/tabFormTask.HEADER3")}}</h3>
                                            <p>{{trans("dashboard/tabFormTask.LENGTHSIZE")}}: [[ uploader.queue.length ]]</p>

                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th width="50%">{{trans("dashboard/tabFormTask.THEADERNAME")}}</th>
                                                    <th ng-show="uploader.isHTML5">{{trans("dashboard/tabFormTask.THEADERSIZE")}}</th>
                                                    <th ng-show="uploader.isHTML5">{{trans("dashboard/tabFormTask.THEADERPROGRESS")}}</th>
                                                    <th>{{trans("dashboard/tabFormTask.THEADERSTATUS")}}</th>
                                                    <th>{{trans("dashboard/tabFormTask.THEADERACTION")}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="item in uploader.queue">
                                                    <td><strong>[[ item.file.name ]]</strong></td>
                                                    <td ng-show="uploader.isHTML5" nowrap>[[ item.file.size/1024/1024|number:2 ]] MB</td>
                                                    <td ng-show="uploader.isHTML5">
                                                        <div class="progress" style="margin-bottom: 0;">
                                                            <div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
                                                        <span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
                                                        <span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
                                                    </td>
                                                    <td nowrap>
                                                        <button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
                                                            <span class="glyphicon glyphicon-trash"></span> {{trans("dashboard/tabFormTask.BTN_REMOVE")}}
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <div>
                                                <div>
                                                    {{trans("dashboard/tabFormTask.PPROGRESS")}}:
                                                    <div class="progress" style="">
                                                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Fim alterações Guilherme --}}

                                        <!--action templates form after-->
                                        <div ng-repeat="actionTemplateMessage in actionTemplates" ng-if="actionTemplateMessage.type==='form_after'" ng-bind-html="actionTemplateMessage.language[0].pivot.text"></div>
                                    </div>

                                    <div class="panel-footer text-right">
                                        <button type="button" ng-disabled="frmTaskForm.$invalid || counterSaveAsyncr > 0"
                                                class="btn btn-lg btn-light-green" ng-click="identifyModalToOpen(modal_form.transaction_type_id, modal_form.transaction_id, 1, null, modalInstance, modal_form)"
                                                id="btn-save" >{{trans("dashboard/modal.BTN_CONTINUE")}}</button>
                                    </div>
                                 </div>

