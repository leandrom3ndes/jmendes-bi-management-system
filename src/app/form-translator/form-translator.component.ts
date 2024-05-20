import { Component, OnInit } from '@angular/core';
import {GridOptions} from 'ag-grid-community';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {FormApiService} from '../shared/rest-api/form-api.service';
import {TranslateService} from '@ngx-translate/core';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';
import {TranslatorFormCellComponent} from './translator-form-cell';
import {ModalFormTranslatorComponent} from './modal-form-translator/modal-form-translator.component';

@Component({
  selector: 'app-form-translator',
  templateUrl: './form-translator.component.html',
  styleUrls: ['./form-translator.component.css']
})
export class FormTranslatorComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;
  private DynamicForms: any = [];

  constructor(
    private modalService: BsModalService,
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

  // Definição das colunas que vão apresentar os formulários a traduzir
  private columnDefs() {
    return [
      {
        headerName: 'ID',
        field: 'id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-LANGUAGE-ID'),
        field: 'idLanguage',
        sortable: true, filter: true,
        width: 75
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-NAME'),
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-TRANSACTION-NAME'),
        field: 'transaction_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-ACTION-NAME'),
        field: 'action_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-UPDATED'),
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-CREATED'),
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TRANSLATOR.FORM-ACTIONS'),
        field: 'render',
        cellRendererFramework: TranslatorFormCellComponent,
        width: 90
      }
    ];
  }

  ngOnInit() {
    this.loadDynamicForms();
  }

  // Aqui é efetuado o carregamento dos formulários de forma a exibir os mesmos na tabela de tradução
  loadDynamicForms() {
    return this.restFormApi.getFormsToTranslate().subscribe((data: {}) => {
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

  // Função que permite abrir um modal para a tradução do formulário
  openModal(params = {}) {
    const modalRef = this.modalService.show(ModalFormTranslatorComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry === 'SUCESSO') {
        this.loadDynamicForms();
        this.alertToast.showSuccess(this.translate.instant('TRANSLATOR.ERROR-SUCCESS'));
      } else {
        this.alertToast.showError(this.translate.instant('TRANSLATOR.ERROR-PROBLEM'));
      }
    });
  }

}
