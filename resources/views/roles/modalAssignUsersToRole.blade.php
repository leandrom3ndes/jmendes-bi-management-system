
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalAssignUsersToRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmAssignUsersToRole" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">{{trans("roles/modalAssignUsersToRole.LBL1")}} [[ role.name]]</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>{{trans("roles/modalAssignUsersToRole.LBL2")}}</label>
                    <ui-select multiple ng-model="selusers.selected" theme="bootstrap" style="width: 100%"
                               sortable="true" close-on-select="false" title="Choose a User">
                        <ui-select-match placeholder="Users...">[[$item.name]] (Id:[[$item.id]])</ui-select-match>
                        <ui-select-choices repeat="user in users | propsFilter: {name: $select.search, id: $select.search}">
                            <div ng-bind-html="user.name | highlight: $select.search"></div>
                            (Id:<span ng-bind-html="user.id | highlight: $select.search"></span>)
                        </ui-select-choices>
                    </ui-select>
                    {{--<p>Selected: [[selactors.selected]]</p>--}}
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmAssignUsersToRole.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>