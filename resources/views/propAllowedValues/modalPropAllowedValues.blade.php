<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("propAllowedValues/modalPropAllowedValues.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmpropAllowedValues" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("propAllowedValues/modalPropAllowedValues.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="prop_allowed_value_name" name="prop_allowed_value_name" placeholder="" value="@]]name]]"
                           ng-model="propAllowedValue.language[0].pivot.name" ng-required="true">
                    <div ng-messages="frmpropAllowedValues.prop_allowed_value_name.$error" ng-show="frmpropAllowedValues.prop_allowed_value_name.$invalid && frmpropAllowedValues.prop_allowed_value_name.$touched">
                        <p ng-message="required">{{trans("propAllowedValues/modalPropAllowedValues.REQUIRED_NAME_ALLOWED")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("propAllowedValues/modalPropAllowedValues.INPUT_PROPERTY")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="propAllowedValue_prop" ng-disabled="checkProp" ng-model="propAllowedValue.property_id" ng-options="item.language[0].pivot.property_id as item.language[0].pivot.name for item in properties" required>
                        <option value="">{{trans("propAllowedValues/modalPropAllowedValues.INPUT_SELECT_PROP")}}</option>
                    </select>
                    <div ng-messages="frmpropAllowedValues.propAllowedValue_prop.$error" ng-show="frmpropAllowedValues.propAllowedValue_prop.$invalid && frmpropAllowedValues.propAllowedValue_prop.$touched">
                        <p ng-message="required">{{trans("propAllowedValues/modalPropAllowedValues.REQUIRED_PROP_ALLOWED")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("propAllowedValues/modalPropAllowedValues.INPUT_STATE")}}:</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="prop_allowed_value_state" value="active" ng-model="propAllowedValue.state" required>Active
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="prop_allowed_value_state" value="inactive" ng-model="propAllowedValue.state" required>Inactive
                    </label>
                    <div ng-messages="frmpropAllowedValues.prop_allowed_value_state.$error" ng-show="frmpropAllowedValues.prop_allowed_value_state.$invalid && frmpropAllowedValues.prop_allowed_value_state.$touched">
                        <p ng-message="required">{{trans("propAllowedValues/modalPropAllowedValues.REQUIRED_STATE_ALLOWED")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save()" ng-disabled="frmpropAllowedValues.$invalid">{{trans("propAllowedValues/modalPropAllowedValues.BTN1FORM")}}</button>
    </div>
</div>
