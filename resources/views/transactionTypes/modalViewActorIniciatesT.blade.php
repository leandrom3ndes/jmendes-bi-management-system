<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("transactionTypes/modalActorIniciate.VIEW_ACTOR")}}</h4>
    </div>

    <div class="modal-body">
        <div class="form-group">
            <label class="col-sm-12 control-label" style="text-align: center">[[ transactionType.language[0].pivot.t_name ]]</label>
            <label class="col-sm-12 control-label" style="text-align: left">{{trans("transactionTypes/modalActorIniciate.LBL3")}}</label>
            <div class="col-sm-12">
                <table class="table" >
                    <thead>
                    <tr>
                        <th>{{trans("transactionTypes/modalActorIniciate.THEADER1VIEW1")}}</th>
                        <th>{{trans("transactionTypes/modalActorIniciate.THEADER1VIEW2")}}</th>
                        <th>{{trans("transactionTypes/modalActorIniciate.THEADER1VIEW3")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="actor in transactionType.iniciator_actor">
                        <td>[[ actor.id ]]</td>
                        <td>[[ actor.language[0].pivot.name ]]</td>
                        <td>[[ actor.updated_at]]</td>
                        <td>
                            <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removeActor(transactionType.id,actor.id)">{{trans("transactionTypes/modalActorIniciate.BTNREMOVE_ACTOR")}}</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-footer">

    </div>
</div>
