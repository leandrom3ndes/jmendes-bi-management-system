import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';

import {ProcessTypeApiService} from '../shared/rest-api/processtype-api.service';

@Component({
  selector: 'app-modal-processtype',
  templateUrl: './modal-processtype.component.html',
  styleUrls: ['./modal-processtype.component.css']
})
export class ModalProcessTypeComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  processType: any = {};
  private processTypeState;


  // constructor(private modalService: BsModalService, private modalRef: BsModalRef,
  //             private restApi: ProcessTypeApiService,
  //             public router: Router) {
  // }

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private restApi: ProcessTypeApiService,
              public router: Router,
              private ProcessTypeApi: ProcessTypeApiService) {
      this.ProcessTypeApi.getProcessTypeStates().subscribe((data: {}) => {
      this.processTypeState = data;
    });
  }

  ngOnInit() {
    // this.loadProcesstypeStates();
    let params: any = this.modalService.config.initialState;
    let isEmptyObj = !Object.keys(params).length;
    console.log(params);
    if (!isEmptyObj) {
      this.loadProcessTypeById(params./*process_type_id*/id);
    }
  }

  closeModal() {
    this.modalRef.hide();
  }

  loadProcessTypeById(id) {
    return this.restApi.getProcessType(id).subscribe((data: {}) => {
      this.processType = data;
      console.log(this.processType);
    });
  }

  loadProcessTypeStates() {
    return this.restApi.getProcessTypeStates().subscribe((data: {}) => {
      this.processTypeState = data;
      console.log('processTypeState: ' + this.processTypeState);
    });
  }

  saveData() {
    console.log(this.processType);
    if (!this.processType.id) {
      this.restApi.createProcessType(this.processType).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    } else {
      this.restApi.updateProcessType(this.processType).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    }
  }
}

