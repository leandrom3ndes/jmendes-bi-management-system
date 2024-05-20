import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import * as _ from 'lodash';
import { DomSanitizer } from '@angular/platform-browser';
import { of } from 'rxjs';

@Component({
  selector: 'app-bi-knowage-modal',
  templateUrl: './bi-knowage-modal.component.html',
  styleUrls: ['./bi-knowage-modal.component.css']
})

export class BiKnowageModalComponent implements OnInit {

    @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

    private getKnowageDocumentsUrlAPI = 'http://localhost:8080/knowage/restful-services/2.0/documents/';

    private biKnowageData: any = {};
    private biKnowageApiData;
    private imageError: string;
    private isImageSaved: boolean;
    private cardImageBase64: string;
    private biKnowageSession: any;
    public selectedLabel: string;
    public labelChanged = false;

    constructor(private modalService: BsModalService,
                private modalRef: BsModalRef,
                private biManagementApiService: BiManagementApiService,
                private httpClient: HttpClient,
                private domSanitizer: DomSanitizer,
    ) {}

    ngOnInit() {
      this.getBiKnowageDocuments();
      const params: any = this.modalService.config.initialState;
      const isEmptyObj = !Object.keys(params).length;
      if (!isEmptyObj) {
          this.biKnowageData = params;
      }
    }

    closeModal() {
        this.modalRef.hide();
    }
    onLabelChange(selectedLabel) {
        console.log('SELECTED VALUE:', selectedLabel);
        this.biKnowageSession = this.readLocalStorageValue('biKnowageSession');
        const authorizationData = 'Basic ' + btoa(this.biKnowageSession[0].username + ':' + this.biKnowageSession[0].password);
        const httpOptions = {
            headers: new HttpHeaders({
                'Content-Type': 'application/json',
                Authorization: authorizationData
            })
        };
        this.httpClient.get(this.getKnowageDocumentsUrlAPI + selectedLabel, httpOptions)
            .subscribe(
                data => { // json data
                    console.log('Success: ', data);
                    const docLabelData = JSON.parse(JSON.stringify(data));
                    this.biKnowageData.name = docLabelData.name;
                    this.biKnowageData.description = docLabelData.description;
                    this.biKnowageData.type = docLabelData.typeCode;
                    this.biKnowageData.role = docLabelData.creationUser;
                    this.biKnowageData.dataset_label = docLabelData.dataSetLabel;
                    this.biKnowageData.preview = this.domSanitizer.bypassSecurityTrustResourceUrl(
                        this.getKnowageDocumentsUrlAPI + selectedLabel + '/preview');
                    this.biKnowageData.display_toolbar = true;
                    this.biKnowageData.display_sliders = true;
                    this.biKnowageData.reset_parameters = true;
                    if (this.biKnowageData.preview === null) {
                        this.isImageSaved = false;
                    } else {
                        this.isImageSaved = true;
                    }
                    this.labelChanged = true;
                },
                error => {
                    console.log('Error: ', error);
                }
            );
    }
    readLocalStorageValue(key: string): string {
        return JSON.parse(localStorage.getItem(key));
    }
    getBiKnowageDocuments() {
        this.biKnowageSession = this.readLocalStorageValue('biKnowageSession');
        const authorizationData = 'Basic ' + btoa(this.biKnowageSession[0].username + ':' + this.biKnowageSession[0].password);
        const httpOptions = {
            headers: new HttpHeaders({
                'Content-Type': 'application/json',
                Authorization: authorizationData
            })
        };
        return this.httpClient.get(this.getKnowageDocumentsUrlAPI, httpOptions)
            .subscribe(
                data => { // json data
                    this.biKnowageApiData = of(data);
                    console.log('Success: ', data);
                },
                error => {
                    console.log('Error: ', error);
                });
    }
    public fileChangeEvent(fileInput: any) {
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
                        this.biKnowageData.preview = this.cardImageBase64;
                    }
                };
            };
            reader.readAsDataURL(fileInput.target.files[0]);
        }
    }
    removeImage() {
        this.biKnowageData.preview = null;
        this.cardImageBase64 = null;
        this.isImageSaved = false;
    }
    saveData() {
        if (!this.biKnowageData.id) {
            this.biManagementApiService.storeBiKnowage(this.biKnowageData).subscribe((data: {}) => {
                console.log('CREATE SUCESS');
                this.isImageSaved = false;
                this.passEntry.emit('SUCESSO');
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        } else {
            this.biManagementApiService.updateBiKnowage(this.biKnowageData).subscribe((data: {}) => {
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
