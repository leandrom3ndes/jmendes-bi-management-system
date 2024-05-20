import {Component, OnInit, EventEmitter, Input, Output} from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';

@Component({
  selector: 'app-modal-dynamic-form-data',
  templateUrl: './modal-dynamic-form-data.component.html',
  styleUrls: ['./modal-dynamic-form-data.component.css']
})
export class ModalDynamicFormDataComponent implements OnInit {
  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  dynamicFormData: any = {};
  private dynamicFormDataState;

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              public router: Router) {}

  ngOnInit() {
    const params: any = this.modalService.config.initialState;
    const isEmptyObj = !Object.keys(params).length;
    // console.log(params);
    /*if (!isEmptyObj) {
      this.loadActorById(params.id);
    }*/
  }

  closeModal() {
    this.modalRef.hide();
  }
}

