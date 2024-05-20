import {Component, EventEmitter, NgModule, OnInit, Output} from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { MatFormFieldModule } from '@angular/material';
import { AuthService } from '../shared/rest-api/auth.service';
import { Router } from '@angular/router';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';

@NgModule({
  imports: [MatFormFieldModule],
})
@Component({
  selector: 'app-dashboard',
  templateUrl: 'logout.component.html'
})
export class LogoutComponent implements OnInit {
  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  loginData: any = {};


  constructor(private auth: AuthService, private router: Router) { }

  ngOnInit() {
      this.auth.removeTokens();
      this.router.navigate(['login']);
  }
}















// import { Component } from '@angular/core';
//
// @Component({
//   selector: 'app-dashboard',
//   templateUrl: 'login.component.html'
// })
// export class LoginComponent { }
