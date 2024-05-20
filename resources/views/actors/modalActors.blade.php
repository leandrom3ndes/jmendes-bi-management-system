
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("actors/modalActors.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmActors" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("actors/modalActors.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="actor_name" name="actor_name" placeholder="" value="[[name]]"
                           ng-model="actor.name" ng-required="true">
                    <span class="help-inline" ng-messages="frmActors.actor_name.$error" ng-show="frmActors.actor_name.$invalid && frmActors.actor_name.$touched">
                        <span ng-message="required">{{trans("validation.required")}} {{trans("actors/modalActors.INPUT_NAME")}}.</span>
                        <span ng-message="maxlength">{{trans("validation.max.string")}} {{trans("actors/modalActors.INPUT_NAME")}} {{trans("validation.miniMessage")}} 45.</span>
                    </span>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmActors.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>