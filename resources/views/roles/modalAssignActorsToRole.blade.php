
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalAssignActorsToRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmAssignActorsToRole" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">{{trans("roles/modalAssignActorsToRole.LBL1")}} [[ role.name]]</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>{{trans("roles/modalAssignActorsToRole.LBL2")}}</label>
                    <ui-select multiple ng-model="selactors.selected" theme="bootstrap" style="width: 100%"
                               sortable="true" close-on-select="false" title="Choose an Actor">
                        <ui-select-match placeholder="Actors...">[[$item.name]] (Id:[[$item.id]])</ui-select-match>
                        <ui-select-choices repeat="actor in actors | propsFilter: {name: $select.search, id: $select.search}">
                            {{--[[role.name]] (id:[[role.id]])--}}
                            <div ng-bind-html="actor.name | highlight: $select.search"></div>
                            (Id:<span ng-bind-html="actor.id | highlight: $select.search"></span>)

                        </ui-select-choices>
                    </ui-select>
                    {{--<p>Selected: [[selactors.selected]]</p>--}}
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmAssignActorsToRole.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>