import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';

import {LanguageApiService} from '../shared/rest-api/language-api.service';

@Component({
  selector: 'app-modal-language',
  templateUrl: './modal-language.component.html',
  styleUrls: ['./modal-language.component.css']
})
export class ModalLanguageComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  language: any = {};
  private languageState;


  // constructor(private modalService: BsModalService, private modalRef: BsModalRef,
  //             private restApi: LanguageApiService,
  //             public router: Router) {
  // }

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private restApi: LanguageApiService,
              public router: Router,
              private LangStateApi: LanguageApiService) {
    this.LangStateApi.getLanguageStates().subscribe((data: {}) => {
      this.languageState = data;
    });
  }

  ngOnInit() {
    this.loadLanguageStates();
    let params: any = this.modalService.config.initialState;
    let isEmptyObj = !Object.keys(params).length;
    console.log('------ params ---------');
    console.log(params);
    console.log(isEmptyObj);
    if (!isEmptyObj) {
        console.log('------ params [ID]---------');
        console.log(params.id);
        this.loadLanguageById(params.id);
    } else {
        console.log('not loaded')
    }
  }

  closeModal() {
    this.modalRef.hide();
  }

  loadLanguageById(id) {
    return this.restApi.getLanguage(id).subscribe((data: {}) => {
      this.language = data;
      console.log('DADOOOOS');
      console.log(this.language);
    });
  }

  loadLanguageStates() {
    return this.restApi.getLanguageStates().subscribe((data: {}) => {
      this.languageState = data;
      console.log(this.languageState);
    });
  }

  saveData() {
    console.log(this.language);
    if (!this.language.id) {
      this.restApi.createLanguage(this.language).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    } else {
      this.restApi.updateLanguage(this.language).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    }
  }
}

