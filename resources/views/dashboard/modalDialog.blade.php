
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Prompt dialog</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Transaction: [[transTypeName]]</h5>
                        <h5>T State: [[tStateName]]</h5>
                        <h5>Min: [[transTypeMin]]</h5>
                        <h5>Max: [[transTypeMax]]</h5>
                        <form name="frmModalDialog" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-12 control-label">Number of transactions to iniciate?</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="number_T" name="number_T" placeholder=""
                                           ng-model="modalDialog.number">
                                   </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
                        <button type="button" class="btn btn-lg btn-light-green" id="btn-save" ng-click="cancel(modalDialog)" >Confirm</button>
                    </div>
                </div>