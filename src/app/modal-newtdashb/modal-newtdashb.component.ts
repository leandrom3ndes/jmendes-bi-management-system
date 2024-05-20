import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Router } from '@angular/router';

@Component({
  selector: 'app-modal-newtdashb',
  templateUrl: './modal-newtdashb.component.html',
  styleUrls: ['./modal-newtdashb.component.css']
})
export class ModalNewtdashbComponent implements OnInit {

  newTDashb: any = [];

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              // public router: Router
  ) { }

  ngOnInit() {
    let params: any = this.modalService.config.initialState;
    let isEmptyObj = !Object.keys(params).length;
    if (!isEmptyObj) {
      this.newTDashb = params;
    }
  }
  closeModal() {
    this.modalRef.hide();
  }
}



