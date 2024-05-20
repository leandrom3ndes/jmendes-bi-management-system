<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{trans("systemIntegration/modalSystemIntegration.FORM_NAME")}} </h4>
    </div>
    <div class="modal-body">
        <form name="frmsystemIntegration" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="prop_ext_name" name="prop_ext_name" placeholder="" value="@]]name]]"
                           ng-model="propExtName.name" ng-required="true">
                    <div ng-messages="frmsystemIntegration.prop_ext_name.$error" ng-show="frmsystemIntegration.prop_ext_name.$invalid && frmsystemIntegration.prop_ext_name.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_NAME_UNIT")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_EXTERNAL")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="propExtName_external" ng-model="propExtName.external_integration_id" ng-options="item.id as item.name for item in external_integrations" required>
                        <option value="">{{trans("systemIntegration/modalSystemIntegration.INPUT_SELECT_EXTERNAL")}}</option>
                    </select>
                    <div ng-messages="frmsystemIntegration.propExtName_external.$error" ng-show="frmsystemIntegration.propExtName_external.$invalid && frmpropExtNames.propExtName_external.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_EXTERNAL_ALLOWED")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_PROPERTY")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="propExtName_prop" ng-model="propExtName.property_id" ng-options="item.language[0].pivot.property_id as item.language[0].pivot.name for item in properties" required>
                        <option value="">{{trans("systemIntegration/modalSystemIntegration.INPUT_SELECT_PROP")}}</option>
                    </select>
                    <div ng-messages="frmsystemIntegration.propExtName_prop.$error" ng-show="frmsystemIntegration.propExtName_prop.$invalid && frmpropExtNames.propExtName_prop.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_PROP_ALLOWED")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save()" ng-disabled="frmsystemIntegration.$invalid">{{trans("systemIntegration/modalSystemIntegration.BTN1FORM")}}</button>
    </div>
</div>
