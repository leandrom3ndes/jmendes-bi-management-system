import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { Router } from '@angular/router';
import { InitTDashbApiService} from '../shared/rest-api/initTDashb-api.service';

@Component({
  selector: 'app-modal-inittdashb',
  templateUrl: './modal-inittdashb.component.html',
  styleUrls: ['./modal-inittdashb.component.css']
})
export class ModalinitTDashbComponent implements OnInit {

  initTDashb: any = [];

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              // private restApi: InitTDashbApiService,
              // public router: Router
              ) { }


  ngOnInit() {
    let params: any = this.modalService.config.initialState;
    let isEmptyObj = !Object.keys(params).length;
    // console.log('Estou aqui 27 Modal');
    if (!isEmptyObj) {
      // this.loadinitTDashbById(params.id);
      this.initTDashb = params;
    }
  }

  closeModal() {
    this.modalRef.hide();
  }

}

