import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {TranslateService} from '@ngx-translate/core';
import {ActivatedRoute, Router} from '@angular/router';

@Component({
  selector: 'app-modal-user-output-dashboard',
  templateUrl: './modal-user-output-dashboard.component.html',
  styleUrls: ['./modal-user-output-dashboard.component.css']
})

export class ModalUserOutputDashboardComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  public templateHeader: string;
  public templateText: string;
  public templateButton: string;
  private success: boolean;

  constructor(
    private modalService: BsModalService,
    private modalRef: BsModalRef,
    public translate: TranslateService,
    private route: ActivatedRoute,
    public router: Router) {
  }

  ngOnInit() {
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
