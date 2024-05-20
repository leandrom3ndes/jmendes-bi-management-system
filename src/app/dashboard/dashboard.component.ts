import {Component, OnInit} from '@angular/core';
import {TransactionsDashbApiService} from '../shared/rest-api/transactionDashb-api.service';
import {InitTDashbApiService} from '../shared/rest-api/initTDashb-api.service';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';
import {GridOptions} from 'ag-grid-community';
import {InitTDashbCellCustomComponent} from './inittdashb_cell.component';
import {ModalinitTDashbComponent} from '../modal-inittdashb/modal-inittdashb.component';
import {ModalNewtdashbComponent} from '../modal-newtdashb/modal-newtdashb.component';
import {TestCellCustomComponent} from '../dashboard/test_cell.component';
import {NewTContentApiService} from '../shared/rest-api/newTContent-api.service';
import {ArDashboardApiService} from '../shared/rest-api/arDashboard-api.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import {ModalFormDashboardComponent} from '../modal-form-dashboard/modal-form-dashboard.component';
import {ActionLog} from '../shared/interfaces/action_log.model';
import {ModalUserOutputDashboardComponent} from '../modal-user-output-dashboard/modal-user-output-dashboard.component';


@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  private newTContent: any = [];
  private TransactionsDashB: any = [];
  private InitTDashB: any = [];
  private OngoingInitTDashB: any = [];
  private FinishedInitTDashB: any = [];
  public gridOptions: GridOptions;
  public gridOptions2: GridOptions;
  private gridApi;
  private gridColumnApi;
  // Dashboard Vitor
  private finishedAction = false;
  private transType;
  private transState;
  private transactionId;

  constructor(
    private router: Router,
    private route: ActivatedRoute,
    public newTContentApi: NewTContentApiService,
    public restTransactionsDashbApi: TransactionsDashbApiService,
    public restinitTDashbApi: InitTDashbApiService,
    public arDashboardApi: ArDashboardApiService,
    private modalService: BsModalService,
    private alertToast: AlertToastService,
    private agGridTranslate: AgGridTranslateService) {
    this.gridOptions = {} as GridOptions;
    this.gridOptions.columnDefs = DashboardComponent.columnDefs();
    this.gridOptions.localeText = this.agGridTranslate.localeText();
    this.gridOptions.defaultColDef = {
      resizable: true
    };

    this.gridOptions2 = {} as GridOptions;
    this.gridOptions2.columnDefs = DashboardComponent.columnDefs2();
    this.gridOptions2.localeText = this.agGridTranslate.localeText();
    this.gridOptions2.defaultColDef = {
      resizable: true
    };
  }

  private static columnDefs() {
    return [
      {
        headerName: 'Tipo de Processo',
        field: 'process_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Processo',
        field: 'process_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'ID de Transacção',
        field: 'id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Tipo de Transacção',
        field: 'transaction_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Estado da Transacção',
        field: 't_state_name', // ver este ponto!
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Criado em',
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Actor Pode',
        field: 'transaction_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Ver Tarefa', field: 'edit',
        cellRendererFramework: InitTDashbCellCustomComponent,
        width: 90
      }
    ];
  }

  private static columnDefs2() {
    return [
      {
        headerName: 'Tipo de Processo 2',
        field: 'process_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Processo 2',
        field: 'process_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'ID de Transacção',
        field: 'id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Tipo de Transacção',
        field: 'transaction_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Estado da Transacção',
        field: 't_state_name', // ver este ponto!
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Criado em',
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Actor Pode',
        field: 'transaction_type_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Ver Tarefa', field: 'edit',
        cellRendererFramework: InitTDashbCellCustomComponent,
        width: 90
      }
    ];
  }

  ngOnInit() {
    this.loadTransactionsDashb();
    this.loadInitTDashb();
  }

  loadTransactionsDashb() {
    return this.restTransactionsDashbApi.getTransactionsDashb().subscribe((data: {}) => {
      this.TransactionsDashB = data;
    });
  }

  loadInitTDashb() {
    return this.restinitTDashbApi.getInitTDashbs().subscribe((data: {}) => {
      this.filtertransactions(data);
      this.InitTDashB = data;
    });
  }

  loadNewTContent(params) {
    return this.newTContentApi.getNewTContent(params).subscribe((data: {}) => {
      this.newTContent = data;
      console.log(this.newTContent);
      const modalRef = this.modalService.show(ModalNewtdashbComponent, {class: 'modal-lg', initialState: data});
    });
  }



  filtertransactions(data) {
    this.OngoingInitTDashB = data.filter(this.unfinishedtransactions);
    this.FinishedInitTDashB = data.filter(this.finishedtransactions);
}

  unfinishedtransactions(element, index, array) {
    // console.log(element);
    return (element.status  === 0);
  }

  finishedtransactions(element, index, array) {
    return (element.status  === 1);
    // return (element.t_state_id  === 5);
  }

  openModalContinueTransaction(size, id, actorCan) {
    const modalInstance = this.modalService.show({
      animation: true,
      ariaLabelledBy: 'modal-title',
      ariaDescribedBy: 'modal-body',
      templateUrl: 'modalContinueTransaction',
      controller: 'ModalInstanceCtrlContinueTransaction',
      // scope: $scope,
      msize: size,
      // resolve: {
      //   transaction_id: function() {
      //     return id
      //   },
      //   actor_can: function() {
      //     return actorCan
      //   }
      // }
    });
  }

  onGridReady(params) {
    this.gridApi = params.api;
    this.gridColumnApi = params.columnApi;

    params.api.sizeColumnsToFit();

    params.api.sizeColumnsToFit();
    window.addEventListener('resize', function() {
      setTimeout(function() {
        params.api.sizeColumnsToFit();
      });
    });
  }

  openModal(params = {}) {
    console.log('continue transaction');
    const modalRef = this.modalService.show(ModalinitTDashbComponent, {class: 'modal-lg', initialState: params});
  }

  openNewTModal(params) {
    console.log(params);
    if ( params.init_proc === 1 ) {
      this.loadNewTContent(params);
    } else {
      console.log( 'todo (does not initiate process)' );
      // const modalRef = this.modalService.show(ModalSelProcDashbComponent, {class: 'modal-lg', initialState: params});
    }
  }

  startNewTransaction(TransactionDashB) {
    this.openNewTModal(TransactionDashB);
  }

  // DASHBOARD VITOR

  openModalForm(params = {}) {
    // Open the modal that will present the form to the user
    const modalRef = this.modalService.show(ModalFormDashboardComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry) {
        // @ts-ignore
        // If form is submitted, store the action as executed in the action log table
        this.storeActionLog('executed', params.actionId, this.transactionId);
        this.getCurrentAction(this.transType, this.transState, this.transactionId);
      }
    });
  }

  openModalTemplate(params = {}) {
    // Open the modal that will present the template text to the user
    const modalRef = this.modalService.show(ModalUserOutputDashboardComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry) {
        // @ts-ignore
        // If user confirms the user output modal, store the action as executed in the action log table
        this.storeActionLog('executed', params.actionId, this.transactionId);
        this.getCurrentAction(this.transType, this.transState, this.transactionId);
      }
    });
  }

  getCurrentAction(transType, transState, transactionId) {
    this.transType = transType;
    this.transState = transState;
    this.transactionId = transactionId;
    // Search for the current action that's waiting for conclusion in the AR
    return this.arDashboardApi.getExecutingAction(transType, transState, transactionId).subscribe((data: {}) => {
      if (data[0]) {
        // If there's an action waiting for completing, deal with that action
        this.dealAction(data[0]);
      } else {
        // If there are no executing records in the action log table, we're going to get the first action in the AR
        // Will be implemented in the Executer Branch
      }
    });
  }

  storeActionLog(state, actionId, transactionId) {
    const actionLog = {} as ActionLog;
    actionLog.state = state;
    actionLog.action_id = actionId;
    actionLog.transaction_id = transactionId;
    console.log(JSON.stringify(actionLog));
    return this.arDashboardApi.storeActionLog(actionLog).subscribe((data: {}) => {
    });
  }

  dealAction(action) {
    // Log the action that will now be performed in action log table as executing
    this.storeActionLog('executing', action.id, this.transactionId);
    switch (action.type) {
      case 'user_input':
        console.log('USER INPUT ACTION');
        // Act accordingly - Present the modal with the form to the user
        this.presentForm(action);
        break;
      case 'assign_expression':
        console.log('ASSIGN EXPRESSION ACTION');
        // Placeholder while behavior is not defined - Log action in action log table as executed
        this.storeActionLog('executed', action.id, this.transactionId);
        this.getCurrentAction(this.transType, this.transState, this.transactionId);
        break;
      case 'user_output':
        console.log('USER OUTPUT ACTION');
        this.dealUserOutputAction(action);
        break;
      default:
        console.log('ERROR');
        break;
    }
  }

  presentForm(action) {
    // Search for the form associated with the action and present it in a modal
    return this.arDashboardApi.getFormFromAction(action.id).subscribe((data: {}) => {
      const formId = data[0].form_id;
      // console.log(formId);
      this.openModalForm({idForm: formId, actionId: action.id, transactionId: this.transactionId});
    });
  }

  dealUserOutputAction(action) {
    return this.arDashboardApi.getTemplateFromAction(action.id).subscribe((data: {}) => {
      const template = data[0];
      console.log(template);

      // Depending on the template type, act accordingly
      if (template.type === 'modal') {
          this.presentModalUserOutput(template, action);
      } else if (template.type === 'toast') {
          this.presentToastUserOutput(template, action);
      }
    });
  }

  presentModalUserOutput(modalTemplate, action) {
    // Placeholder while behavior is not defined - Log action in action log table as executed
    this.openModalTemplate({
      from: 'dashboard', actionId: action.id, templateHeader: modalTemplate.header,
      templateText: modalTemplate.text, templateButton: modalTemplate.button
    });
  }

  presentToastUserOutput(template, action) {
    // Present the toast notification depending on the class it belongs to
    switch (template.class) {
      case 'success': {
        this.alertToast.showSuccess(template.text);
        break;
      }
      case 'information': {
        this.alertToast.showInfo(template.text);
        break;
      }
      case 'warning': {
        this.alertToast.showWarning(template.text);
        break;
      }
      case 'error': {
        this.alertToast.showError(template.text);
        break;
      }
      case 'custom': {
        // Get the colour of the custom toast so we can get the custom CSS class that will be applied to the toast
        // So we get only the hexadecimal part after #
        const toastColour = template.colour.substring(1);
        // Adding the appropriate CSS class depending on the colour retrieved from the DB
        const addedCssClass = 'dashboard-toast-blockly-custom-' + toastColour;
        this.alertToast.showCustom(template.text, template.title, addedCssClass);
        break;
      }
      default: {
        this.alertToast.showError('ERROR! TRY AGAIN!');
        break;
      }
    }

    // After the toast is presented, store the action as executed in the action log table
    this.storeActionLog('executed', action.id, this.transactionId);
    this.getCurrentAction(this.transType, this.transState, this.transactionId);
  }

}

