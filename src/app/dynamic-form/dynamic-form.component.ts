import { Component, OnInit } from '@angular/core';

import {DynamicFormCellCustomComponent} from './dynamic-form_cell.component';
import {GridOptions} from 'ag-grid-community';

import {FormApiService} from '../shared/rest-api/form-api.service';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';

import { ModalDynamicFormComponent } from '../modal-dynamic-form/modal-dynamic-form.component';

import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {TranslateService} from '@ngx-translate/core';

@Component({
  selector: 'app-dynamic-form',
  templateUrl: './dynamic-form.component.html',
  styleUrls: ['./dynamic-form.component.css'],
  providers: [ModalDynamicFormComponent]
})
export class DynamicFormComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;
  private DynamicForms: any = [];

  constructor(
    private modalService: BsModalService,
    private modal: ModalDynamicFormComponent,
    private alertToast: AlertToastService,
    public restFormApi: FormApiService,
    public translate: TranslateService,
    private agGridTranslate: AgGridTranslateService) {
    this.gridOptions = {} as GridOptions;
    this.gridOptions.columnDefs = this.columnDefs();
    this.gridOptions.localeText = this.agGridTranslate.localeText();
    this.gridOptions.defaultColDef = {
      resizable: true
    };
  }

  // Definição das entradas da tabela que mostra os formulários existentes
  private columnDefs() {
    return [
      {
        headerName: 'ID',
        field: 'id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-NAME'),
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-TRANSACTION-NAME'),
        field: 'transaction_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-ACTION-NAME'),
        field: 'action_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-UPDATED'),
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-CREATED'),
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-MANAGEMENT.FORM-ACTIONS-AVAILABLE'),
        field: 'edit',
        cellRendererFramework: DynamicFormCellCustomComponent,
        width: 200
      }
    ];
  }

  ngOnInit() {
    this.loadDynamicForms();
  }

  // Função que carrega os formulários existentes na DB consoante a linguagem do utilizador
  loadDynamicForms() {
    return this.restFormApi.getForms().subscribe((data: {}) => {
      this.DynamicForms = data;
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

  // Função que exibe um modal que permite a criação de um formulário
  openModal(params = {}) {
    const modalRef = this.modalService.show(ModalDynamicFormComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry === 'SUCESSO') {
        this.loadDynamicForms();
        this.alertToast.showSuccess(this.translate.instant('FORM-MANAGEMENT.ERROR-SUCCESS'));
      } else {
        this.alertToast.showError(this.translate.instant('FORM-MANAGEMENT.ERROR-PROBLEM'));
      }
    });
  }

  // Função que permite apagar um formulário através do seu ID
  deleteDynamicForm(id) {
    if (window.confirm(this.translate.instant('FORM-MANAGEMENT.ASK-DELETE'))) {
      this.restFormApi.deleteForm(id).subscribe(data => {
        this.loadDynamicForms();
        this.alertToast.showSuccess(this.translate.instant('FORM-MANAGEMENT.ERROR-SUCCESS'));
      }, error => {
        this.alertToast.showError(this.translate.instant('FORM-MANAGEMENT.ERROR-PROBLEM'));
      });
    }
  }
}
