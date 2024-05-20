import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import * as _ from 'lodash';
import { of } from 'rxjs';

@Component({
  selector: 'app-bi-element-modal',
  templateUrl: './bi-element-modal.component.html',
  styleUrls: ['./bi-element-modal.component.css']
})
export class BiElementModalComponent implements OnInit {

    @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();
    public biElementData: any = {};
    private allEngines;
    private biElementTypeSlug;
    private imageError: string;
    private isImageSaved: boolean;
    private cardImageBase64: string;

    constructor(private modalService: BsModalService,
                private modalRef: BsModalRef,
                private biManagementApiService: BiManagementApiService
    ) {}

  ngOnInit() {
      this.getEngines();
      this.getBiElementTypeSlug();

      let params: any = this.modalService.config.initialState;
      let isEmptyObj = !Object.keys(params).length;
      console.log('------PARAMETERES-----');
      console.log(params);
      console.log(isEmptyObj);
      if (!isEmptyObj) {
          console.log('------LOADEDDD-----');
          console.log(params.id);
          // this.getBiElementDetail(params.id);
          this.biElementData = params;
      } else {
          console.log('Not loaded');
      }
  }
    closeModal() {
        this.modalRef.hide();
    }
    getEngines() {
        return this.biManagementApiService.getAllEngines().subscribe((data: {}) => {
            this.allEngines =  of(data['allEngines']);
        });
    }
    getBiElementTypeSlug() {
        return this.biManagementApiService.getBiElementTypeSlug().subscribe((data: {}) => {
            this.biElementTypeSlug =  of(data['biElementTypeSlug']);
        });
    }
    getBiElementDetail(biElementid) {
        return this.biManagementApiService.getBiElementDetail(biElementid).subscribe((data: {}) => {
            this.biElementData = data.biElementDetail;
            console.log('DADOOOOS');
            console.log(this.biElementData);
        });
    }
    fileChangeEvent(fileInput: any) {
        this.imageError = null;
        if (fileInput.target.files && fileInput.target.files[0]) {
            // Size Filter Bytes
            const maxSize = 20971520;
            const allowedTypes = ['image/png', 'image/jpeg'];
            const maxHeight = 15200;
            const maxWidth = 25600;

            if (fileInput.target.files[0].size > maxSize) {
                this.imageError =
                    'Maximum size allowed is ' + maxSize / 1000 + 'Mb';
                return false;
            }

            if (!_.includes(allowedTypes, fileInput.target.files[0].type)) {
                this.imageError = 'Only Images are allowed ( JPG | PNG )';
                return false;
            }
            const reader = new FileReader();
            reader.onload = (e: any) => {
                const image = new Image();
                image.src = e.target.result;
                image.onload = rs => {
                    const imgHeight = rs.currentTarget['height'];
                    const imgWidth = rs.currentTarget['width'];
                    console.log(imgHeight, imgWidth);
                    if (imgHeight > maxHeight && imgWidth > maxWidth) {
                        this.imageError =
                            'Maximum dimentions allowed ' +
                            maxHeight +
                            '*' +
                            maxWidth +
                            'px';
                        return false;
                    } else {
                        const imgBase64Path = e.target.result;
                        this.cardImageBase64 = imgBase64Path;
                        this.isImageSaved = true;
                        this.biElementData.preview = this.cardImageBase64;
                    }
                };
            };
            reader.readAsDataURL(fileInput.target.files[0]);
        }
    }

    removeImage() {
        this.cardImageBase64 = null;
        this.isImageSaved = false;
    }

    saveData() {
        console.log(this.biElementData);
        if (!this.biElementData.id) {
            this.biManagementApiService.storeBiElement(this.biElementData).subscribe((data: {}) => {
                console.log('CREATE SUCESS');
                this.isImageSaved = false;
                this.passEntry.emit('SUCESSO');
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        } else {
            this.biManagementApiService.updateBiElement(this.biElementData).subscribe((data: {}) => {
                console.log('UPDATE SUCESS');
                this.isImageSaved = false;
                this.passEntry.emit('SUCESSO');
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        }
    }

}
