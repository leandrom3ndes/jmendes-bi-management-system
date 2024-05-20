import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';

// import { AuthenticationService } from '@app/_services';
import { AuthService } from '../shared/rest-api/auth.service';
import {TokenVar} from '../shared/rest-api/token';

@Injectable({ providedIn: 'root' })
export class AuthGuard implements CanActivate {
  constructor(
    private router: Router,
    private auth: AuthService,
  ) { }

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
    let currenttoken = this.auth.getToken();
    console.log(currenttoken);
    if (currenttoken) {
      // logged in so return true
      return true;
    }

    // not logged in so redirect to login page with the return url
    this.router.navigate(['login']);
    return false;
  }
}
