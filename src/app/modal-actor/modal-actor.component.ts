import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';

import {ActorApiService} from '../shared/rest-api/actor-api.service';

@Component({
  selector: 'app-modal-actor',
  templateUrl: './modal-actor.component.html',
  styleUrls: ['./modal-actor.component.css']
})
export class ModalActorComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  actor: any = {};
  private actorState;


  // constructor(private modalService: BsModalService, private modalRef: BsModalRef,
  //             private restApi: ActorApiService,
  //             public router: Router) {
  // }

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private restApi: ActorApiService,
              public router: Router,
              private LangStateApi: ActorApiService) {
    this.LangStateApi.getActorStates().subscribe((data: {}) => {
      this.actorState = data;
    });
  }

  ngOnInit() {
    // this.loadActorStates();
    let params: any = this.modalService.config.initialState;
    let isEmptyObj = !Object.keys(params).length;
    console.log(params);
    if (!isEmptyObj) {
      this.loadActorById(params.id);
    }
  }

  closeModal() {
    this.modalRef.hide();
  }

  loadActorById(id) {
    return this.restApi.getActor(id).subscribe((data: {}) => {
      this.actor = data;
      console.log(this.actor);
    });
  }

  loadActorStates() {
    return this.restApi.getActorStates().subscribe((data: {}) => {
      this.actorState = data;
      console.log(this.actorState);
    });
  }

  saveData() {
    console.log(this.actor);
    if (!this.actor.id) {
      this.restApi.createActor(this.actor).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    } else {
      this.restApi.updateActor(this.actor).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    }
  }
}

