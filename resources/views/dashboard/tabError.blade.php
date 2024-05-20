
<div class="alert alert-info">
    <strong>Info!</strong> [[message]].
</div>

<div class="modal-footer">
    <button type="button" ng-if="tabs.length-1==$index" ng-disabled="frmTaskForm.$invalid || (tabs.length===1 && tabs[0].templateUrl==='tabProcess')" class="btn btn-lg btn-light-green" id="btn-save" ng-click="saveAndContinue(modal_formTab, modalInstance, 'Task Form', 'tabFormTask', tabnumber, null, typeid)">{{trans("dashboard/modal.BTN_SAVE_CONTINUE")}}</button>
</div>