
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Choose a Ent Type</h3>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-6">col1
                                                <div class="form-inline" ng-repeat="entType in entTypes">
                                                    <div class="checkbox checkbox-inline checkbox-success checkbox-sm">
                                                        <input type="checkbox" class="styled" name="currency" ng-disabled="options[$index].disabled" id="chk-[[entType.id]]" ng-model="options[$index].checked" ng-value="entType" ng-change="toogleEntType($index, entType)">
                                                        <label for="chk-[[entType.id]]">[[entType.language[0].pivot.name]]</label>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-md-6">col2
                                                <div class="panel panel-info" ng-repeat="entTypePar in propsFromEntTypes.entTypePar">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">[[entTypePar.language[0].pivot.name]]</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="form-inline" ng-repeat="property in entTypePar.properties" ng-switch="property.value_type">
                                                            <div class="form-group" ng-switch-when="text|double|int" ng-switch-when-separator="|"
                                                                 ng-switch="property.form_field_type">
                                                                <div ng-switch-when="text|number" ng-switch-when-separator="|">
                                                                    <label for="name">[[property.language[0].pivot.name]]</label>
                                                                    <input type="checkbox" ng-model="checkboxes[$index]" ng-change="changeEntTypePar($index, 0, true)">
                                                                    <input id="[[property.id]]" type="[[property.form_field_type]]" class="form-control"
                                                                           name="[[property.language[0].pivot.form_field_name]]" placeholder=""
                                                                           ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]"
                                                                           maxlength="[[property.form_field_size]]" ng-focus="changeEntTypePar($index, 1, true)">
                                                                </div>
                                                            </div>

                                                            <div class="form-group" ng-switch-when="bool" ng-switch="property.form_field_type">
                                                                <label class="col-sm-3 control-label">[[property.language[0].pivot.name]]</label>
                                                                <div class="col-sm-9" ng-switch-when="radio">
                                                                    <label for="" class="radio-inline state">
                                                                        <input type="radio" name="[[property.language[0].pivot.form_field_name]]" value="1"
                                                                               ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]">
                                                                        {{trans("dashboard/tabFormTask.INPUT_BOOL_VAL1")}}
                                                                    </label>
                                                                    <label for="" class="radio-inline state">
                                                                        <input type="radio" name="[[property.language[0].pivot.form_field_name]]" value="0"
                                                                               ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]">
                                                                        {{trans("dashboard/tabFormTask.INPUT_BOOL_VAL2")}}
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="form-group" ng-switch-when="enum"
                                                                 ng-switch="property.form_field_type">
                                                                <div ng-switch-when="radio">
                                                                    <label for="name">[[property.language[0].pivot.name]]</label>
                                                                    <input type="checkbox">
                                                                    <div ng-repeat="p_a_v in property.prop_allowed_values">
                                                                        <input id="[[property.id]]" type="[[property.form_field_type]]" class="form-control"
                                                                               name="[[property.language[0].pivot.form_field_name]]" placeholder=""
                                                                               ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]"
                                                                               value="[[p_a_v.id]]">
                                                                        [[p_a_v.language[0].pivot.name]]
                                                                    </div>
                                                                </div>

                                                                <div ng-switch-when="selectbox">
                                                                    <label for="name">[[property.language[0].pivot.name]]</label>
                                                                    <input type="checkbox">
                                                                    <select class="form-control" id="[[property.id]]" name="[[property.language[0].pivot.form_field_name]]"
                                                                            ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]"
                                                                            ng-options="item.id as item.language[0].pivot.name for item in property.prop_allowed_values">
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group" ng-switch-when="prop_ref"
                                                                 ng-switch="property.form_field_type">
                                                                <label for="name">[[property.language[0].pivot.name]]</label>
                                                                <input type="checkbox" ng-model="checkboxes[$index]" ng-change="changeEntTypePar($index, 0, true)">
                                                                <ui-select uis-open-close="changeEntTypePar($index, 1, true)" name="[[property.language[0].pivot.form_field_name]]"
                                                                           ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]" theme="bootstrap">
                                                                    <ui-select-match placeholder="">[[$select.selected.value]]</ui-select-match>
                                                                    <ui-select-choices repeat="item.id as item in property.fk_property.values | filter: $select.search">
                                                                        <div ng-bind-html="item.value | highlight: $select.search"></div>
                                                                    </ui-select-choices>
                                                                </ui-select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="panel panel-info" ng-repeat="entTypeChild in propsFromEntTypes.entTypeChild">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">[[entTypeChild.language[0].pivot.name]]</h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div ng-if="entTypeChild.properties.length === 0">
                                                            There is no properties
                                                        </div>
                                                        <div ng-if="entTypeChild.properties.length > 0">
                                                            <div class="form-inline" ng-repeat="property in entTypeChild.properties" ng-switch="property.value_type">
                                                                <div class="form-group" ng-switch-when="text|double|int" ng-switch-when-separator="|"
                                                                     ng-switch="property.form_field_type">
                                                                <label>[[property.language[0].pivot.name]]</label>
                                                                <div class="col-sm-9" ng-switch-when="text|number" ng-switch-when-separator="|">
                                                                    <input id="[[property.id]]" type="[[property.form_field_type]]" class="form-control"
                                                                           name="[[property.language[0].pivot.form_field_name]]" placeholder=""
                                                                           ng-model="property.fields[property.language[0].pivot.form_field_name+'-'+property.id]"
                                                                           maxlength="[[property.form_field_size]]">
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer text-right">
                                        <button type="button" ng-disabled="disabledContinue"
                                                class="btn btn-lg btn-light-green" ng-click="nextTabContinue(0, 1, 'Second Step', 'tabResultsSecondStep')"
                                                id="btn-save" >{{trans("dashboard/modal.BTN_CONTINUE")}}</button>
                                    </div>
                                 </div>

