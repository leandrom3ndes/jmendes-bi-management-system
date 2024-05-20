import {Component} from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { ModalLanguageComponent } from '../modal-language/modal-language.component';
import { BsModalService} from 'ngx-bootstrap/modal';
import { LanguageApiService} from '../shared/rest-api/language-api.service';
import { LanguageComponent } from '../language/language.component';

@Component({
  selector: 'app-dashboard',
  template: '<button type="button" class="btn-info" (click)="editRow()">Editar</button>' +
    '<button type="button" class="btn-warning" (click)="deleteRow()">Apagar</button>',
  styleUrls: ['../language/language.component.css']
})
export class TestCellCustomComponent {

  data: any;
  params: any;
  constructor(private http: HttpClient,
              private router: Router,
              private modal: ModalLanguageComponent,
              private modalService: BsModalService,
              private restApi: LanguageApiService,
              private languageComp: LanguageComponent
  ) { }

  agInit(params) {
    this.params = params;
    this.data =  params.value;
  }

  editRow() {
    let rowData = this.params;
    let i = rowData.rowIndex;
    console.log(rowData.data);
    // this.languageComp.openModal(rowData.data);
  }

  deleteRow() {
    let rowData = this.params;
    // this.languageComp.deleteLanguage(rowData.data.id);
  }


}
