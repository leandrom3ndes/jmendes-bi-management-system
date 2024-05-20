
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("users/modalUsers.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmUsers" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="" value="@]]name]]"
                           ng-model="user.name" ng-required="true" ng-maxlength="user_name_maxLength">
                    <div class="help-inline" ng-messages="frmUsers.user_name.$error" ng-show="frmUsers.user_name.$invalid && frmUsers.user_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_NAME")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("users/modalUsers.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[user_name_maxLength]].</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_USERNAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="user_user_name" name="user_user_name" placeholder="" value="@]]user_name]]"
                           ng-model="user.user_name" ng-required="true" ng-maxlength="user_user_name_maxLength">
                    <div class="help-inline" ng-messages="frmUsers.user_user_name.$error" ng-show="frmUsers.user_user_name.$invalid && frmUsers.user_user_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_USERNAME")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("users/modalUsers.INPUT_USERNAME")}} {{trans("validation.miniMessage")}} [[user_user_name_maxLength]].</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_EMAIL")}}</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="user_email" name="user_email" placeholder="" value="@]]email]]"
                           ng-model="user.email" ng-required="true" ng-maxlength="user_email_maxLength">
                    <div class="help-inline" ng-messages="frmUsers.user_email.$error" ng-show="frmUsers.user_email.$invalid && frmUsers.user_email.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_EMAIL")}}.</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("users/modalUsers.INPUT_EMAIL")}} {{trans("validation.miniMessage")}} [[user_email_maxLength]].</p>
                        <p ng-message="email">{{trans("validation.email")}} {{trans("users/modalUsers.INPUT_EMAIL")}}.</p>
                    </div>
                </div>
            </div>


            <div ng-switch on="modalstate_view">
                <div ng-switch-when="add">

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_PASSWORD")}}</label>
                        <div class="col-sm-9">
                            <input ng-model='user.password' class="form-control" type="password" name='user_password' placeholder='' required ng-maxlength="user_password_maxLength">
                            <div class="help-inline" ng-messages="frmUsers.user_password.$error" ng-show="frmUsers.user_password.$invalid && frmUsers.user_password.$touched">
                                <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_PASSWORD")}}.</p>
                                <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("users/modalUsers.INPUT_PASSWORD")}} {{trans("validation.miniMessage")}} [[user_password_maxLength]].</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_CONFPASSWORD")}}</label>
                        <div class="col-sm-9">
                            <input ng-model='user.password_verify' class="form-control" type="password" name='confirm_password' placeholder='' required data-password-verify="user.password">
                            <div class="help-inline" ng-messages="frmUsers.confirm_password.$error" ng-show="frmUsers.confirm_password.$invalid && frmUsers.confirm_password.$touched">
                                <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_CONFPASSWORD")}}.</p>
                                <p ng-message="passwordVerify">{{trans("validation.same_first")}} {{trans("users/modalUsers.INPUT_PASSWORD")}}
                                    {{trans("validation.same_middle")}} {{trans("users/modalUsers.INPUT_CONFPASSWORD")}}
                                    {{trans("validation.same_second")}}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
                <div ng-switch-when="edit">

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_NEWPASSWORD")}}</label>
                        <div class="col-sm-9">
                            <input ng-model='user.password' class="form-control" type="password" name='user_password' placeholder='' ng-maxlength="user_password_maxLength">
                            <div class="help-inline" ng-messages="frmUsers.user_password.$error" ng-show="frmUsers.user_password.$invalid && frmUsers.user_password.$touched">
                                <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_NEWPASSWORD")}}.</p>
                                <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("users/modalUsers.INPUT_NEWPASSWORD")}} {{trans("validation.miniMessage")}} [[user_password_maxLength]].</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_CONFNEWPASSWORD")}}</label>
                        <div class="col-sm-9">
                            <input ng-model='user.password_verify' class="form-control" type="password" name='confirm_password' placeholder='' ng-required='user.password' data-password-verify="user.password">
                            <div class="help-inline" ng-messages="frmUsers.confirm_password.$error" ng-show="frmUsers.confirm_password.$invalid && frmUsers.confirm_password.$touched">
                                <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_CONFNEWPASSWORD")}}.</p>
                                <p ng-message="passwordVerify">{{trans("validation.same_first")}} {{trans("users/modalUsers.INPUT_PASSWORD")}}
                                    {{trans("validation.same_middle")}} {{trans("users/modalUsers.INPUT_CONFPASSWORD")}}
                                    {{trans("validation.same_second")}}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
                {{--<div  ng-switch-when="remove"></div>--}}
                {{--<div class="animate-switch" ng-switch-default>default</div>--}}
            </div>


            <div class="form-group">
                <label for="langSelect" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_LANGUAGE")}}</label>
                {{--<div class="col-sm-9">--}}
                {{--<select ng-model="user.language_id" ng-options="lang.id as lang.name for lang in langs" ng-init="lang = [[user.language_id]]"></select>--}}
                {{--</div>--}}
                <div class="col-sm-9">
                    <select class="form-control" name="languageselect" ng-model="user.language_id" ng-options="lang.id as lang.name for lang in langs" required>
                        <option value="">{{trans("users/modalUsers.INPUT_language_id")}}</option>
                    </select>
                    <div class="help-inline" ng-messages="frmUsers.languageselect.$error" ng-show="frmUsers.languageselect.$invalid && frmUsers.languageselect.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_LANGUAGE")}}.</p>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="inputUsertype" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_USERTYPE")}} :</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="user_type" value="internal" ng-model="user.user_type" required>{{trans("users/modalUsers.INPUT_USERTYPE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="user_type" value="external" ng-model="user.user_type" required>{{trans("users/modalUsers.INPUT_USERTYPE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmUsers.position.$error" ng-show="frmUsers.position.$invalid && frmUsers.position.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_USERTYPE")}}.</p>
                    </div>
                </div>
            </div>

            <div ng-switch on="user.user_type">
                <div ng-switch-when="external">
                    <div class="form-group">
                        <label for="entitiesSelect" class="col-sm-3 control-label">{{trans("users/modalUsers.INPUT_ENTITY")}}</label>
                        <div class="col-sm-9">
                            {{--<select ng-model="user.entity_id" ng-options="entity.id as entity.name for entity in entities" ng-init="entity = [[user.entity_id]]"></select>--}}
                            {{--</div>--}}

                            <select class="form-control" name="entityselect" ng-model="user.entity_id" ng-options="entity.id as entity.name for entity in entities" required>
                                <option value="">{{trans("users/modalUsers.INPUT_entity_id")}}</option>
                            </select>
                            <div class="help-inline" ng-messages="frmUsers.entityselect.$error" ng-show="frmUsers.entityselect.$invalid && frmUsers.entityselect.$touched">
                                <p ng-message="required">{{trans("validation.required")}} {{trans("users/modalUsers.INPUT_ENTITY")}}.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmUsers.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>