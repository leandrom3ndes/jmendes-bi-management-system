
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("processTypes/modalProcessTypes.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmProcessTypes" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("processTypes/modalProcessTypes.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="process_type_name" name="process_type_name" placeholder="" value="[[name]]"
                           ng-model="processtype.language[0].pivot.name" required ng-maxlength="process_type_name_maxLength">
                    <div class="help-inline" ng-messages="frmProcessTypes.process_type_name.$error" ng-show="frmProcessTypes.process_type_name.$invalid && frmProcessTypes.process_type_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("processTypes/modalProcessTypes.INPUT_NAME")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("processTypes/modalProcessTypes.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[process_type_name_maxLength]].</p>
                    </div>
                </div>
            </div>

            <div ng-if="::modalstate!=='add_name_lang'">
            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("processTypes/modalProcessTypes.INPUT_STATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="process_type_state" value="active" ng-model="processtype.state" required>{{trans("processTypes/modalProcessTypes.INPUT_STATE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="process_type_state" value="inactive" ng-model="processtype.state" required>{{trans("processTypes/modalProcessTypes.INPUT_STATE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmProcessTypes.process_type_state.$error" ng-show="frmProcessTypes.process_type_state.$invalid && frmProcessTypes.process_type_state.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} {{trans("processTypes/modalProcessTypes.INPUT_STATE")}}</p>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmProcessTypes.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>