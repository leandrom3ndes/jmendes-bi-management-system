import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {ModalActorComponent} from '../modal-actor/modal-actor.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {ActorApiService} from '../shared/rest-api/actor-api.service';
import {ActorComponent} from './actor.component';

@Component({
  selector: 'app-actor',
  template: '<button type="button" class="btn-info" (click)="editRow()">Editar</button>' +
    '<button type="button" class="btn-warning" (click)="deleteRow()">Apagar</button>',
  styleUrls: ['./actor.component.css']
})
export class ActorCellCustomComponent {

  data: any;
  params: any;

  constructor(private http: HttpClient,
              private router: Router,
              private modal: ModalActorComponent,
              private modalService: BsModalService,
              private restApi: ActorApiService,
              private actorComp: ActorComponent
  ) {
  }

  agInit(params) {
    this.params = params;
    this.data = params.value;
  }

  editRow() {
    const rowData = this.params;
    const i = rowData.rowIndex;
    console.log(rowData.data);
    this.actorComp.openModal(rowData.data);
  }

  deleteRow() {
    const rowData = this.params;
    this.actorComp.deleteActor(rowData.data.id);
  }


}
