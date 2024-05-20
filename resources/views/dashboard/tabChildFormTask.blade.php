
                            <div class="panel-heading">
                                <h3 class="panel-title" ng-if="modal_formTab.tab[indexTab].relTypeExist_==false">[[modal_formTab.tab[indexTab].propsform_[0].ent_type.language[0].pivot.name]] - [[type]]</h3>
                                <h3 class="panel-title" ng-if="modal_formTab.tab[indexTab].relTypeExist_==true">[[modal_formTab.tab[indexTab].propsform_[0].rel_type.language[0].pivot.name]] - [[type]]</h3>
                            </div>
                                <form name="frmTaskForm" class="form-horizontal" novalidate="">
                                    <div ng-if="modal_formTab.tab[indexTab].relTypeExist_==true">
                                        <div class="form-group">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">{{trans("dashboard/tabFormTask.REL_ENTITY1")}}:</label>
                                            <div class="col-sm-9">
                                                <ui-select ng-model="modal_formTab.entity1.selected" theme="bootstrap">
                                                    <ui-select-match placeholder="{{trans("dashboard/tabFormTask.INPUT_SEL_ENTITY")}}">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                                    <ui-select-choices repeat="item in entities1 | filter: $select.search">
                                                        <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                                    </ui-select-choices>
                                                </ui-select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">{{trans("dashboard/tabFormTask.REL_ENTITY2")}}:</label>
                                            <div class="col-sm-9">
                                                <ui-select ng-model="modal_formTab.entity2.selected" theme="bootstrap">
                                                    <ui-select-match placeholder="{{trans("dashboard/tabFormTask.INPUT_SEL_ENTITY")}}">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                                    <ui-select-choices repeat="item in entities2 | filter: $select.search">
                                                        <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                                    </ui-select-choices>
                                                </ui-select>
                                            </div>
                                        </div>
                                    </div>


                                    <div ng-repeat="prop in modal_formTab.tab[indexTab].propsform_" ng-switch="prop.value_type" emit-last-repeater-element>
                                        <div class="form-group" ng-switch-when="text|double|int" ng-switch-when-separator="|" ng-switch="prop.form_field_type">
                                            <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
                                            <div class="col-sm-9" ng-switch-when="text|number" ng-switch-when-separator="|">
                                                {{--<input type="text" uib-popover-template="dynamicPopover.templateUrl" popover-class="popover" popover-placement="top" popover-title="[[dynamicPopover.title]]" popover-trigger="'focus'" class="form-control" id="[[prop.language[0].pivot.form_field_name]]" name="[[prop.language[0].pivot.form_field_name]]" placeholder=""
                                                       ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" maxlength="[[prop.form_field_size]]" ng-required="prop.mandatory">
                                                --}}<input type="[[prop.form_field_type]]" class="form-control" id="[[prop.language[0].pivot.form_field_name]]" name="[[prop.language[0].pivot.form_field_name]]" placeholder=""
                                                                   ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" maxlength="[[prop.form_field_size]]" ng-required="prop.mandatory">

                                                <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                            </div>

                                            <div class="col-sm-9" ng-switch-when="textbox">
                                                <textarea rows="4" cols="50" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" maxlength="[[prop.form_field_size]]">

                                                </textarea>
                                                <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                            </div>
                                        </div>

                                        <div class="form-group" ng-switch-when="bool" ng-switch="prop.form_field_type">
                                            <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
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
                                            <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
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
                                                    <input type="[[prop.form_field_type]]" name="[[prop.language[0].pivot.form_field_name]]" value="[[p_a_v.id]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id]" ng-click="updateValueChild(prop.language[0].pivot.form_field_name+'-'+prop.id+'-'+p_a_v.id, $parent.$parent.$index, indexTab)" ng-required="prop.fields === undefined">[[p_a_v.language[0].pivot.name]]
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
                                                <select class="form-control" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-if="prop.has_entType=='false'" ng-options="item.id as item.language[0].pivot.name for item in prop.prop_allowed_values" ng-required="prop.mandatory">
                                                    <option value=""></option>
                                                </select>
                                                <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                            </div>
                                        </div>

                                        <div class="form-group" ng-switch-when="ent_ref">
                                            <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-options="item.id as item.language[0].pivot.name for item in prop.fk_ent_type.entity" ng-required="prop.mandatory">
                                                    <option value=""></option>
                                                </select>
                                                <span class="help-inline" ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$touched && frmTaskForm[prop.language[0].pivot.form_field_name].$invalid">
                                                            <span ng-show="frmTaskForm[prop.language[0].pivot.form_field_name].$error.required">{{trans("validation.required")}} [[prop.language[0].pivot.name]].</span>
                                                        </span>
                                            </div>
                                        </div>

                                        <div class="form-group" ng-switch-when="prop_ref">
                                            <label for="inputName" class="col-sm-3 control-label">[[prop.language[0].pivot.name]]</label>
                                            <div class="col-sm-9">
                                                {{--<select class="form-control" name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" ng-options="item.id as item.value for item in prop.fk_property.values" ng-required="prop.mandatory">
                                                    <option value=""></option>
                                                </select>--}}
                                                <ui-select name="[[prop.language[0].pivot.form_field_name]]" ng-model="prop.fields[prop.language[0].pivot.form_field_name+'-'+prop.id]" theme="bootstrap" ng-required="prop.mandatory">
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
                                </form>
