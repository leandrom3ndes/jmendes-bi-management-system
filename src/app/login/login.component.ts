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
  templateUrl: 'login.component.html'
})
export class LoginComponent implements OnInit {
  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  loginData: any = {};


  constructor(private auth: AuthService, private router: Router) { }

  ngOnInit() {
  }

  // doLogin(loginform: FormGroup) {
  //   console.log('form data', loginform.value);
  //   this.auth.getAccessToken(loginform).subscribe();
  //
  //   // Navigate to the dashboard
  //   this.router.navigate(['dashboard']);
  // }


  doLogin(){
    console.log(this.loginData);
    this.auth.getAccessToken(this.loginData).subscribe();
    setTimeout(() => {
      this.router.navigate(['dashboard']);
    }, 2000);
    // this.router.navigate(['dashboard']);
  }
}















// import { Component } from '@angular/core';
//
// @Component({
//   selector: 'app-dashboard',
//   templateUrl: 'login.component.html'
// })
// export class LoginComponent { }
