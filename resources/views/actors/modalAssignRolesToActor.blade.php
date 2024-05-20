
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("actors/modalAssignRolesToActor.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmAssignRolesToActor" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">{{trans("actors/modalAssignRolesToActor.LBL1")}} [[ actor.name]]</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>{{trans("actors/modalAssignRolesToActor.LBL2")}}</label>
                    <ui-select multiple ng-model="selroles.selected" theme="bootstrap" style="width: 100%"
                               sortable="true" close-on-select="false" title="Choose a Role">
                        <ui-select-match placeholder="Actor Roles...">[[$item.name]] (Id:[[$item.id]])</ui-select-match>
                        <ui-select-choices repeat="role in roles | propsFilter: {name: $select.search, id: $select.search}">
                            {{--[[role.name]] (id:[[role.id]])--}}
                            <div ng-bind-html="role.name | highlight: $select.search"></div>
                            (Id:<span ng-bind-html="role.id | highlight: $select.search"></span>)

                        </ui-select-choices>
                    </ui-select>
                    {{--<p>Selected: [[selroles.selected]]</p>--}}
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmAssignRolesToActor.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>