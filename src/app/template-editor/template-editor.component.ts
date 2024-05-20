import { Component, OnInit } from '@angular/core';

import { TemplateEditorCellComponent } from './template-editor_cell.component';
import { GridOptions } from 'ag-grid-community';

import { TemplateApiService } from '../shared/rest-api/template-api.service';
import { AgGridTranslateService } from '../shared/common/ag-grid-translate.service';

import { BsModalService } from 'ngx-bootstrap/modal';
import { AlertToastService } from '../shared/common/alert-toast.service';
import { TranslateService } from '@ngx-translate/core';
import { ModalTemplateEditorComponent } from '../modal-template-editor/modal-template-editor.component';

@Component({
  selector: 'app-template-editor',
  templateUrl: './template-editor.component.html',
  styleUrls: ['./template-editor.component.css']
})
export class TemplateEditorComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;
  private templates: any = [];

  constructor(
    private modalService: BsModalService,
    private alertToast: AlertToastService,
    public restTemplateApi: TemplateApiService,
    public translate: TranslateService,
    private agGridTranslate: AgGridTranslateService) {
    this.gridOptions = {} as GridOptions;
    this.gridOptions.columnDefs = this.columnDefs();
    this.gridOptions.localeText = this.agGridTranslate.localeText();
    this.gridOptions.defaultColDef = {
      resizable: true
    };
  }

  private columnDefs() {
    return [
      {
        headerName: 'ID',
        field: 'template_id',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TEMPLATE-EDITOR.TEMPLATE-TABLE.NAME'),
        field: 'name',
        sortable: true, filter: true,
        width: 200
      },
      {
        headerName: this.translate.instant('TEMPLATE-EDITOR.TEMPLATE-TABLE.TYPE'),
        field: 'type',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TEMPLATE-EDITOR.TEMPLATE-TABLE.UPDATED-AT'),
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TEMPLATE-EDITOR.TEMPLATE-TABLE.CREATED-AT'),
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: this.translate.instant('TEMPLATE-EDITOR.TEMPLATE-TABLE.AVAILABLE-ACTIONS'),
        field: 'edit',
        cellRendererFramework: TemplateEditorCellComponent,
        width: 200
      }
    ];
  }

  ngOnInit() {
    this.loadEditableTemplates();
  }

  loadEditableTemplates() {
    return this.restTemplateApi.getTemplates().subscribe((data: {}) => {
      this.templates = data;
    });
  }

  onGridReady(params) {
    this.gridApi = params.api;
    this.gridColumnApi = params.columnApi;

    params.api.sizeColumnsToFit();

    params.api.sizeColumnsToFit();
    // tslint:disable-next-line:only-arrow-functions
    window.addEventListener('resize', function() {
      // tslint:disable-next-line:only-arrow-functions
      setTimeout(function() {
        params.api.sizeColumnsToFit();
      });
    });
  }

  openModal(params = {}) {
    const modalRef = this.modalService.show(ModalTemplateEditorComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry) {
        this.loadEditableTemplates();
        // In case the ID is already defined, it means the user is updating the template
        if (modalRef.content.template.id) {
          this.alertToast.showSuccess(this.translate.instant('TEMPLATE-EDITOR.SUCCESS.UPDATING'));
        } else {
        // In case the ID is not defined, it means the user is creating the template
          this.alertToast.showSuccess(this.translate.instant('TEMPLATE-EDITOR.SUCCESS.CREATING'));
        }
      } else {
        // In case the ID is already defined, it means the user is updating the template
        if (modalRef.content.template.id) {
          this.alertToast.showSuccess(this.translate.instant('TEMPLATE-EDITOR.ERROR.UPDATING'));
        } else {
        // In case the ID is not defined, it means the user is creating the template
          this.alertToast.showSuccess(this.translate.instant('TEMPLATE-EDITOR.ERROR.CREATING'));
        }
      }
    });
  }

  deleteTemplate(id) {
    if (window.confirm(this.translate.instant('TEMPLATE-EDITOR.DELETE-CONFIRMATION-MESSAGE'))) {
      this.restTemplateApi.deleteTemplate(id).subscribe(data => {
        if (data.belongsAR === 'true') {
          this.alertToast.showWarning(this.translate.instant( 'TEMPLATE-EDITOR.WARNING.TEMPLATE-USED-IN-AR'));
        } else {
          this.loadEditableTemplates();
          this.alertToast.showSuccess(this.translate.instant('TEMPLATE-EDITOR.SUCCESS.DELETING'));
        }
      }, error => {
        console.log(error);
        this.alertToast.showError(this.translate.instant('TEMPLATE-EDITOR.ERROR.DELETING'));
      });
    }
  }

}
