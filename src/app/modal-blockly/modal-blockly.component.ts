import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';
import {AlertToastService} from '../shared/common/alert-toast.service';

import { BlocklyApiService } from '../shared/rest-api/blockly-api.service';
import {TranslateService} from 'node_modules/@ngx-translate/core';
import {DomSanitizer} from '@angular/platform-browser';

@Component({
  selector: 'app-modal-blockly',
  templateUrl: './modal-blockly.component.html',
  styleUrls: ['./modal-blockly.component.css']
})
export class ModalBlocklyComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  private xmlToLoad = '';
  private ActionRules: any = [];

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private alertToast: AlertToastService,
              private restBlocklyApi: BlocklyApiService,
              public translate: TranslateService,
              public router: Router,
              private sanitizer: DomSanitizer) {
    this.restBlocklyApi.getActionRules().subscribe((data: {}) => {
      this.ActionRules = data;
      this.alertToast.showSuccess(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.SUCCESS.LOAD-AR'));
    }, error => {
      this.alertToast.showError(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.ERROR.LOAD-AR'));
    });
  }

  ngOnInit() {
  }

  closeModal() {
    this.modalRef.hide();
  }

  getARPreview() {
      const actionRuleSelected = this.ActionRules.find(x => x.blockly_xml === this.xmlToLoad);
      return this.sanitizer.bypassSecurityTrustUrl(actionRuleSelected.preview);
  }

  passBack() {
    this.passEntry.emit(this.xmlToLoad);
    this.closeModal();
  }
}
