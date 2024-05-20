import { Component, OnInit } from '@angular/core';
import {GridOptions} from 'ag-grid-community';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {FormApiService} from '../shared/rest-api/form-api.service';
import {TranslateService} from '@ngx-translate/core';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';
import {DynamicFormRenderCellCustomComponent} from './dynamic-form-render-cell.component';

@Component({
  selector: 'app-dynamic-form-render',
  templateUrl: './dynamic-form-render.component.html',
  styleUrls: ['./dynamic-form-render.component.css']
})
export class DynamicFormRenderComponent implements OnInit {

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

  // Definição das colunas da tabela de formulários a renderizar
  private columnDefs() {
    return [
      {
        headerName: 'ID',
        field: 'id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-NAME'),
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-TRANSACTION-NAME'),
        field: 'transaction_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-ACTION-NAME'),
        field: 'action_name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-UPDATED'),
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-CREATED'),
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('FORM-RENDER.FORM-ACTIONS-AVAILABLE'),
        field: 'render',
        cellRendererFramework: DynamicFormRenderCellCustomComponent,
        width: 90
      }
    ];
  }

  ngOnInit() {
    this.loadDynamicForms();
  }

  // Aqui é feito o carregamento dos formulários existentes na base de dados
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
    window.addEventListener('resize', function () {
      setTimeout(function () {
        params.api.sizeColumnsToFit();
      });
    });
  }

}
