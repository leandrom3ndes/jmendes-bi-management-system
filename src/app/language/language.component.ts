import {Component, OnInit} from '@angular/core';
import {ModalLanguageComponent} from '../modal-language/modal-language.component';
import {LanguageCellCustomComponent} from './language_cell.component';
import {GridOptions} from 'ag-grid-community';
import {LanguageApiService} from '../shared/rest-api/language-api.service';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';

@Component({
  selector: 'app-language',
  templateUrl: './language.component.html',
  styleUrls: ['./language.component.css'],
  providers: [ModalLanguageComponent]
})
export class LanguageComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;

  private Languages: any = [];

  constructor(
    private modalService: BsModalService,
    private modal: ModalLanguageComponent,
    public restLanguageApi: LanguageApiService,
    private alertToast: AlertToastService,
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
        headerName: 'Name',
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Slug',
        field: 'slug',
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
        headerName: 'Acções', field: 'edit',
        cellRendererFramework: LanguageCellCustomComponent,
        width: 200
      }
    ];
  }

  ngOnInit() {
    this.loadLanguages();
  }

  loadLanguages() {
    return this.restLanguageApi.getLanguages().subscribe((data: {}) => {
      this.Languages = data;
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
    const modalRef = this.modalService.show(ModalLanguageComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      console.log(receivedEntry);
      if (receivedEntry === 'SUCESSO') {
        this.loadLanguages();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      } else {
        this.alertToast.showError('Operação não realizada');
      }

    });
  }

  deleteLanguage(id) {
    if (window.confirm('Are you sure, you want to delete?')) {
      this.restLanguageApi.deleteLanguage(id).subscribe(data => {
        this.loadLanguages();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      }, error => {
        this.alertToast.showError('Operação não realizada');
      });
    }
  }
}
