
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("languages/modalLanguages.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmLanguages" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("languages/modalLanguages.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="language_name" name="language_name" placeholder="" value="@]]name]]"
                           ng-model="language.name" ng-required="true" ng-maxlength="language_name_maxLength">
                    <div class="help-inline" ng-messages="frmLanguages.language_name.$error" ng-show="frmLanguages.language_name.$invalid && frmLanguages.language_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("languages/modalLanguages.INPUT_NAME")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("languages/modalLanguages.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[::language_name_maxLength]].</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSlug" class="col-sm-3 control-label">{{trans("languages/modalLanguages.INPUT_SLUG")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="language_slug" name="language_slug" placeholder="" value="@]]slug]]"
                           ng-model="language.slug" ng-required="true" ng-maxlength="language_slug_maxLength">
                    <div class="help-inline" ng-messages="frmLanguages.language_slug.$error" ng-show="frmLanguages.language_slug.$invalid && frmLanguages.language_slug.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("languages/modalLanguages.INPUT_SLUG")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("languages/modalLanguages.INPUT_SLUG")}} {{trans("validation.miniMessage")}} [[::language_slug_maxLength]].</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("languages/modalLanguages.INPUT_STATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="language_state" value="active" ng-model="language.state" required>{{trans("languages/modalLanguages.INPUT_STATE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="language_state" value="inactive" ng-model="language.state" required>{{trans("languages/modalLanguages.INPUT_STATE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmLanguages.language_state.$error" ng-show="frmLanguages.language_state.$invalid && frmLanguages.language_state.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("languages/modalLanguages.INPUT_STATE")}}.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmLanguages.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>