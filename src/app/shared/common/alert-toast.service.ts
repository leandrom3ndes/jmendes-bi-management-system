import { Injectable } from '@angular/core';
import {ToastrService} from 'ngx-toastr';

@Injectable({
  providedIn: 'root'
})

export class AlertToastService {

  constructor(private toastr: ToastrService) { }

  private timeOut = 5000;
  private extendedTimeOut = 3000;

  showSuccess(message) {
    this.toastr.success(message, 'Success!', {
      timeOut: this.timeOut,
      extendedTimeOut: this.extendedTimeOut,
      progressBar: true,
      enableHtml: true,
    });
  }

  showError(message) {
    this.toastr.error(message, 'Error!', {
      timeOut: this.timeOut,
      extendedTimeOut: this.extendedTimeOut,
      progressBar: true,
      enableHtml: true,
    });
  }

  showWarning(message) {
    this.toastr.warning(message, 'Warning!', {
      timeOut: this.timeOut,
      extendedTimeOut: this.extendedTimeOut,
      progressBar: true,
      enableHtml: true,
    });
  }

  showInfo(message) {
    this.toastr.info(message, 'Info!', {
      timeOut: this.timeOut,
      extendedTimeOut: this.extendedTimeOut,
      progressBar: true,
      enableHtml: true,
    });
  }

  showCustom(message, title, cssColourClass) {
    this.toastr.show(message, title, {
      timeOut: this.timeOut,
      extendedTimeOut: this.extendedTimeOut,
      progressBar: true,
      enableHtml: true,
      toastClass: 'ngx-toastr dashboard-toast-blockly-custom ' + cssColourClass,
    });
  }
}
