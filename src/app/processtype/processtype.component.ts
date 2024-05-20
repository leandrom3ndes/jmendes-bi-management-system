import {Component, OnInit} from '@angular/core';
import {ModalProcessTypeComponent} from '../modal-processtype/modal-processtype.component';

import {ProcessTypeCellCustomComponent} from './processtype_cell.component';
import {GridOptions} from 'ag-grid-community';

import {ProcessTypeApiService} from '../shared/rest-api/processtype-api.service';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';

@Component({
  selector: 'app-processtype',
  templateUrl: './processtype.component.html',
  styleUrls: ['./processtype.component.css'],
  providers: [ModalProcessTypeComponent]
})
export class ProcessTypeComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;

  private ProcessTypes: any = [];

  constructor(
    private modalService: BsModalService,
    private modal: ModalProcessTypeComponent,
    public restProcessTypeApi: ProcessTypeApiService,
    private alertToast: AlertToastService,
    private agGridTranslate: AgGridTranslateService) {
    this.gridOptions = <GridOptions>{};
    this.gridOptions.columnDefs = this.columnDefs();
    this.gridOptions.localeText = this.agGridTranslate.localeText();
    this.gridOptions.defaultColDef = {
      resizable: true
    };
  }

  private columnDefs() {
    /*'state' => $this->state,
      'updated_by' => $this->updated_at,
      'deleted_by' => $this->deleted_at,
      'process_type_id'=>$this->process_type_id,
      'language_id'=>$this->language_id,
      'name'=>$this->name*/
    return [
      {
        headerName: 'Id',
        field: 'process_type_id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Name',
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'State',
        field: 'state',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Updated at',
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      /*{
        headerName: 'deleted_at',
        field: 'deleted_at',
        sortable: true, filter: true,
        width: 90
      },*/
      {
        headerName: 'Created at',
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Language Id',
        field: 'language_id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Acções', field: 'edit',
        cellRendererFramework: ProcessTypeCellCustomComponent,
        width: 200
      }
    ];
  }

  ngOnInit() {
    this.loadProcessTypes();
  }

  loadProcessTypes() {
    return this.restProcessTypeApi.getProcessTypes().subscribe((data: {}) => {
      this.ProcessTypes = data;
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

  openModal(params = {}) {
    const modalRef = this.modalService.show(ModalProcessTypeComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      console.log(receivedEntry);
      if (receivedEntry === 'SUCESSO') {
        this.loadProcessTypes();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      } else {
        this.alertToast.showError('Operação não realizada');
      }

    });
  }

  deleteProcessType(id) {
    if (window.confirm('Are you sure, you want to delete?')) {
      this.restProcessTypeApi.deleteProcessType(id).subscribe(data => {
        this.loadProcessTypes();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      }, error => {
        this.alertToast.showError('Operação não realizada');
      });
    }
  }
}
