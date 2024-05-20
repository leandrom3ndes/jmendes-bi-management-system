import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {ActorApiService} from '../shared/rest-api/actor-api.service';
import {DynamicFormRenderedComponent} from './dynamic-form-rendered/dynamic-form-rendered.component';
import {TranslateService} from '@ngx-translate/core';

@Component({
  selector: 'app-dynamic-form-render',
  template: '<button type="button" class="btn-info" (click)="renderForm()"> {{ \'FORM-RENDER.FORM-RENDER-ACTION\' | translate }} </button>',
  styleUrls: ['./dynamic-form-render.component.css'],
  providers: [DynamicFormRenderedComponent]
})
export class DynamicFormRenderCellCustomComponent {

  data: any;
  params: any;

  constructor(private http: HttpClient,
              private router: Router,
              public translate: TranslateService,
              private restApi: ActorApiService,
              private dynamicFormRenderedComp: DynamicFormRenderedComponent
  ) {
  }

  agInit(params) {
    this.params = params;
    this.data = params.value;
  }

  // Função que exibe um modal que permite renderizar o formulário
  renderForm() {
    const rowData = this.params;
    if (window.confirm(this.translate.instant('FORM-RENDER.ASK-RENDER'))) {
      this.router.navigate(["/formRendered/" + rowData.data.id]);
    }

  }

}
