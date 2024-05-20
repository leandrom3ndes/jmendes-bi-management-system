import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {ModalDynamicFormComponent} from '../modal-dynamic-form/modal-dynamic-form.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {ActorApiService} from '../shared/rest-api/actor-api.service';
import {DynamicFormComponent} from './dynamic-form.component';

@Component({
  selector: 'app-dynamic-form',
  template: '<button type="button" class="btn-info" (click)="editRow()"> {{ \'FORM-MANAGEMENT.FORM-EDIT\' | translate }} </button>' +
            '<button type="button" class="btn-warning" (click)="deleteRow()"> {{ \'FORM-MANAGEMENT.FORM-DELETE\' | translate }} </button>',
  styleUrls: ['./dynamic-form.component.css']
})
export class DynamicFormCellCustomComponent {

  data: any;
  params: any;

  constructor(private http: HttpClient,
              private router: Router,
              private modal: ModalDynamicFormComponent,
              private modalService: BsModalService,
              private restApi: ActorApiService,
              private dynamicFormComp: DynamicFormComponent
  ) {
  }

  agInit(params) {
    this.params = params;
    this.data = params.value;
  }

  // Funçao que permite abrir um modal para editar o formulário
  editRow() {
    let rowData = this.params;
    let i = rowData.rowIndex;
    this.dynamicFormComp.openModal(rowData.data);
  }

  // Função que permite abrir um modal para eliminar um formulário
  deleteRow() {
    let rowData = this.params;
    this.dynamicFormComp.deleteDynamicForm(rowData.data.id);
  }

}
