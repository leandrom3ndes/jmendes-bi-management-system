
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Notification</h4>
                    </div>
                    <div class="modal-body">
                        <div ng-bind-html="messageNotificationHTML"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-light-green" id="btn-save" ng-click="cancel()" >Close</button>
                    </div>
                </div>