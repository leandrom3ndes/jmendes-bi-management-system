import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import * as _ from 'lodash';
import { of } from 'rxjs';

@Component({
  selector: 'app-bi-element-type-modal',
  templateUrl: './bi-element-type-modal.component.html',
  styleUrls: ['./bi-element-type-modal.component.css']
})
export class BiElementTypeModalComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();
  public biElementTypeData: any = {};

    constructor(private modalService: BsModalService,
                private modalRef: BsModalRef,
                private biManagementApiService: BiManagementApiService) {
    }

      ngOnInit() {
          let params: any = this.modalService.config.initialState;
          let isEmptyObj = !Object.keys(params).length;
          if (!isEmptyObj) {
            this.biElementTypeData = params;
          }
      }
    closeModal() {
        this.modalRef.hide();
    }
    saveData() {
        console.log(this.biElementTypeData);
        if (!this.biElementTypeData.id) {
            this.biManagementApiService.storeBiElementType(this.biElementTypeData).subscribe((data: {}) => {
                console.log('CREATE SUCESS');
                this.passEntry.emit('SUCESSO');
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        } else {
            this.biManagementApiService.updateBiElementType(this.biElementTypeData).subscribe((data: {}) => {
                console.log('UPDATE SUCESS');
                this.passEntry.emit('SUCESSO');
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        }
    }

}
