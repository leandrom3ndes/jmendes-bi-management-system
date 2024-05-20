import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {GridOptions} from 'ag-grid-community';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import { UserApiService } from '../shared/rest-api/user-api.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-dashboard',
  templateUrl: 'register.component.html'
})
export class RegisterComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  user: any = {};


  // constructor(private modalService: BsModalService, private modalRef: BsModalRef,
  //             private restApi: LanguageApiService,
  //             public router: Router) {
  // }

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private restApi: UserApiService,
              public router: Router,
              ) { }

  ngOnInit() {
  }


  saveData() {
    // if (this.user) {
      this.restApi.createUser(this.user).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        this.router.navigate(['/login']);
      }, error => {
        this.passEntry.emit('ERRO');
      });
    // }
  }
}
