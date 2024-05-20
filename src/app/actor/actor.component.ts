import {Component, OnInit} from '@angular/core';
import {ModalActorComponent} from '../modal-actor/modal-actor.component';

import {ActorCellCustomComponent} from './actor_cell.component';
import {GridOptions} from 'ag-grid-community';

import {ActorApiService} from '../shared/rest-api/actor-api.service';
import {BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {AgGridTranslateService} from '../shared/common/ag-grid-translate.service';

@Component({
  selector: 'app-actor',
  templateUrl: './actor.component.html',
  styleUrls: ['./actor.component.css'],
  providers: [ModalActorComponent]
})

export class ActorComponent implements OnInit {

  public gridOptions: GridOptions;
  private gridApi;
  private gridColumnApi;

  private Actors: any = [];

  constructor(
    private modalService: BsModalService,
    private modal: ModalActorComponent,
    public restActorApi: ActorApiService,
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
    // actor_id = {int} 1
    // language_id = {int} 2
    // name = "Renter"
    // updated_by = {int} 1
    // deleted_by = null
    // created_at = "2018-07-23 15:10:05"
    // updated_at = "2018-07-23 15:10:05"
    // deleted_at = null
    // id = {int} 1
    return [
      {
        headerName: 'Name',
        field: 'name',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Created At',
        field: 'created_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Updated At',
        field: 'updated_at',
        sortable: true, filter: true,
        width: 90
      },
      {
        headerName: 'Acções', field: 'edit',
        cellRendererFramework: ActorCellCustomComponent,
        width: 200
      }
    ];
  }

  ngOnInit() {
    this.loadActors();
  }

  loadActors() {
    return this.restActorApi.getActors().subscribe((data: {}) => {
      this.Actors = data;
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
    const modalRef = this.modalService.show(ModalActorComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      console.log(receivedEntry);
      if (receivedEntry === 'SUCESSO') {
        this.loadActors();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      } else {
        this.alertToast.showError('Operação não realizada');
      }

    });
  }

  deleteActor(id) {
    if (window.confirm('Are you sure, you want to delete?')) {
      this.restActorApi.deleteActor(id).subscribe(data => {
        this.loadActors();
        this.alertToast.showSuccess('Operação realizada com sucesso');
      }, error => {
        this.alertToast.showError('Operação não realizada');
      });
    }
  }
}
