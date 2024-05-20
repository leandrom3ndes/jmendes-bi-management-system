import {Component, EventEmitter, OnInit} from '@angular/core';
import {AlertToastService} from '../../shared/common/alert-toast.service';
import {FormApiService} from '../../shared/rest-api/form-api.service';
import {TranslateService} from '@ngx-translate/core';
import {ActivatedRoute, Router} from '@angular/router';
import formio_lang from 'src/assets/i18n/formio_render.json';
import flatpickr from "flatpickr";

@Component({
  selector: 'app-dynamic-form-rendered',
  templateUrl: './dynamic-form-rendered.component.html',
  styleUrls: ['./dynamic-form-rendered.component.css']
})
export class DynamicFormRenderedComponent implements OnInit {
  public myForm: any ;
  private needUpdate: boolean;
  public idForm: any;
  public formSubmisson: any;

  public language = new EventEmitter(true);
  optionsFormio: any = {
    i18n: formio_lang
  };

  constructor(
    private alertToast: AlertToastService,
    public restFormApi: FormApiService,
    public translate: TranslateService,
    private route: ActivatedRoute,
    public router: Router) {

  }

  ngOnInit() {
    this.setCalendarLanguage();
    this.route.params.subscribe(params => {
      this.idForm = params.id;
    });
    this.renderDynamicForm(this.idForm);
  }

  // É definida a linguagem do Formio com base na linguagem do utilizador
  setFormioLanguage(){
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      this.language.emit(data.slug);
    });
  }

  // É definida a linguagem do date picker com base na linguagem do utilizador
  setCalendarLanguage(){
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      flatpickr.localize(flatpickr.l10ns[data.slug]);
    });
  }

  // Consoante o id do formulário passado o mesmo é colocado no renderizador de formulários e é renderizado na página
  renderDynamicForm(id) {
    this.restFormApi.getFormJSON(id).subscribe((data: any) => {
      this.myForm = JSON.parse(data[0].json);
      this.alertToast.showSuccess(this.translate.instant('FORM-RENDER.ERROR-SUCCESS'));
    }, error => {
      this.alertToast.showError(this.translate.instant('FORM-RENDER.ERROR-PROBLEM'));
    });
    this.setFormioLanguage();
    this.updateForm();
  }

  // Função que dá refresh ao formulário de forma a atualizar o mesmo quando este é carregado.
  updateForm() {
    setTimeout(() => { this.needUpdate = false; }, 5);
    setTimeout(() => { this.needUpdate = true; }, 5);
  }

  // Função que permite voltar à página anterior
  goBack() {
    this.router.navigate(["/formsRender"]);
  }

  // Função que permite obter os dados do formulário para um posterior tratamento dos dados.
  onSubmit(event) {

    this.formSubmisson = event.data;
    console.log(this.formSubmisson);
    //AQUI deve ser tratada a submissão
    this.goBack();
  }

}
