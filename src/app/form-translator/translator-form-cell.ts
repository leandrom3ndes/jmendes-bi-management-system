import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {ActorApiService} from '../shared/rest-api/actor-api.service';
import {FormTranslatorComponent} from './form-translator.component';

@Component({
  selector: 'app-translator-form',
  template: '<button type="button" class="btn-info" (click)="translate()"> ' +
    '{{ \'TRANSLATOR.FORM-TRANSLATE-ACTION\' | translate }} </button>',
  styleUrls: ['./form-translator.component.css']
})
export class TranslatorFormCellComponent {

  data: any;
  params: any;

  constructor(private http: HttpClient,
              private router: Router,
              private restApi: ActorApiService,
              private formTranslator: FormTranslatorComponent
  ) {
  }

  agInit(params) {
    this.params = params;
    this.data = params.value;
  }

  // Função que guarda os parametros da tabela de forma a referênciar o formulário e abre o modal com esses mesmos dados
  translate() {
    let rowData = this.params;
    let i = rowData.rowIndex;
    this.formTranslator.openModal(rowData.data);
  }

}
