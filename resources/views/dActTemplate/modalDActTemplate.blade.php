<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{trans("dActTemplate/modaldActTemplate.FORM_NAME")}} </h4>
    </div>
    <div class="modal-body">
        <form name="frmdActTemplate" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("dActTemplate/modaldActTemplate.INPUT_D_ACTION")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="d_action" ng-model="dActTemplate.d_action_id" ng-options="item.id as item.d_action_name for item in d_actions" required>
                        <option value="">{{trans("dActTemplate/modaldActTemplate.INPUT_SELECT_D_ACTION")}}</option>
                    </select>
                    <div ng-messages="frmdActTemplate.d_action.$error" ng-show="frmdActTemplate.d_action.$invalid && frmdActTemplate.d_action.$touched">
                        <p ng-message="required">{{trans("dActTemplate/modaldActTemplate.REQUIRED_D_ACTION_ALLOWED")}}</p>
                    </div>
                </div>
            </div>


            {{-- TextAngular --}}
            <div class="form-group">
                {{--<label for="" class="col-sm-3 control-label">{{trans("dActTemplate/modaldActTemplate.INPUT_TEXT")}}</label>--}}
                <label for="" class="col-sm-3 control-label">TextAngular</label>
                <div class="col-sm-9">
                    <div text-angular="text-angular" name="text" ng-model="dActTemplate.text" class="ta-root focussed col-sm-9" ng-click="getCurrentPosition()" required>
                    </div>
                    <div ng-messages="frmdActTemplate.text.$error" ng-show="frmdActTemplate.text.$invalid && frmdActTemplate.text.$touched">
                        <p ng-message="required">{{trans("dActTemplate/modaldActTemplate.REQUIRED_TEXT")}}</p>
                    </div>
                </div>
            </div>

            {{-- Summernote --}}
            <div class="form-group">
                {{--<label for="" class="col-sm-3 control-label">{{trans("dActTemplate/modaldActTemplate.INPUT_TEXT")}}</label>--}}
                <label for="" class="col-sm-3 control-label">Froala</label>
                <div class="col-sm-9">
                    <textarea froala="froalaOptions" ng-model="myHtml"></textarea>
                    <div ng-messages="frmdActTemplate.textF.$error" ng-show="frmdActTemplate.textF.$invalid && frmdActTemplate.textF.$touched">
                        <p ng-message="required">{{trans("dActTemplate/modaldActTemplate.REQUIRED_TEXT")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">Selecionar Propriedades Externas</label>
                <div class="col-sm-9">
                    <select class="form-control" name="prop_ext_name" ng-model="dActTemplate.prop_ext_name" ng-options="item.name as item.name for item in prop_ext_name"">
                        <option value="">Selecionar</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save()" ng-disabled="frmdActTemplate.$invalid">{{trans("dActTemplate/modaldActTemplate.BTN1FORM")}}</button>
    </div>
</div>
