import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {FormApiService} from '../shared/rest-api/form-api.service';
import {TranslateService} from '@ngx-translate/core';
import {ActivatedRoute, Router} from '@angular/router';
import formio_lang from 'src/assets/i18n/formio_render.json';
import flatpickr from 'flatpickr';

import {Location} from '@angular/common';
import {ArDashboardApiService} from '../shared/rest-api/arDashboard-api.service';

@Component({
  selector: 'app-modal-form-dashboard',
  templateUrl: './modal-form-dashboard.component.html',
  styleUrls: ['./modal-form-dashboard.component.css']
})

export class ModalFormDashboardComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  public myForm: any ;
  private needUpdate: boolean;
  public idForm: any;
  public transactionId: any;
  public formSubmisson: any;
  public name;
  private success: boolean;

  public language = new EventEmitter(true);
  optionsFormio: any = {
    i18n: formio_lang
  };

  constructor(
    private modalService: BsModalService,
    private modalRef: BsModalRef,
    private location: Location,
    private alertToast: AlertToastService,
    public restFormApi: FormApiService,
    public arDashboardApi: ArDashboardApiService,
    public translate: TranslateService,
    private route: ActivatedRoute,
    public router: Router) {

  }

  ngOnInit() {
    this.setCalendarLanguage();
    // console.log('FORM ID' + this.idForm);
    this.renderDynamicForm(this.idForm);
  }

  setFormioLanguage() {
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      this.language.emit(data.slug);
    });
  }

  setCalendarLanguage() {
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      flatpickr.localize(flatpickr.l10ns[data.slug]);
    });
  }

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

  updateForm() {
    setTimeout(() => { this.needUpdate = false; }, 5);
    setTimeout(() => { this.needUpdate = true; }, 5);
  }

  onSubmit(event) {
    this.formSubmisson = event.data;
    // Construct data to be passed to server side to store form submission data
    const submittedValues = {submittedValues: Object.entries(this.formSubmisson), transactionId: this.transactionId};
    console.log(submittedValues);
    return this.arDashboardApi.storeFormInput(submittedValues).subscribe((data: {}) => {
        if (data) {
          this.passBack();
        }
    });
  }

  closeModal() {
    this.success = false;
    this.passEntry.emit(this.success);
    this.modalRef.hide();
  }

  passBack() {
    this.success = true;
    this.passEntry.emit(this.success);
    this.modalRef.hide();
  }
}
