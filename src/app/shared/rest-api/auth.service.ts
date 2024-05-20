import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { FormGroup } from '@angular/forms';
import { Observable } from 'rxjs';
import { catchError, map, mapTo } from 'rxjs/operators';
import { environment } from 'src/environments/environment';
import { Token, TokenVar } from './token';
import {TranslateService} from '@ngx-translate/core';

import { throwError } from 'rxjs';


@Injectable({ providedIn: 'root' })
export class AuthService {
    env = environment;
    constructor(private http: HttpClient,
                public translate: TranslateService) {
    }

  getAccessToken(login): Observable<any> {

    const headers = new HttpHeaders({
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
    });

    console.log(JSON.stringify(login));
    return this.http.post<Token>(`${this.env.apiUrl}api/auth/login`, JSON.stringify(login), { headers })
      .pipe(
        map(tokens => {
          this.setToken(tokens.access_token);
          this.setTokenType(tokens.token_type);
          this.setTokenRefresh(tokens.refresh_token);
          this.setTokenLanguage(tokens.language_slug);
          this.translate.use(tokens.language_slug);
          return Object.assign(
            new Token(
              tokens.token_type,
              tokens.expires_in,
              tokens.access_token,
              tokens.refresh_token,
              tokens.language_slug),
            tokens);
        }),
        catchError(this.handleError)
      );
  }

   setToken(token: string) {
        localStorage.setItem(TokenVar.access_token, token);
        console.log(token);
        console.log(localStorage.getItem(TokenVar.access_token));
    }

    setTokenType(tokenType: string) {
        localStorage.setItem(TokenVar.token_type, tokenType);
    }

    setTokenRefresh(tokenRefresh: string) {
        localStorage.setItem(TokenVar.refresh_token, tokenRefresh);
    }

    setTokenLanguage(tokenLanguage: string) {
        // console.log(tokenLanguage);
        localStorage.setItem(TokenVar.language_slug, tokenLanguage);
        // console.log(localStorage.getItem(TokenVar.language_slug));
    }

    refreshToken(): Observable<any> {

        const httpOptions = {
            headers: new HttpHeaders({
                'Content-Type': 'application/json',
                'Authorization': `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
            })
        };

        return this.http.post<Token>(`${this.env.apiUrl}oauth/token/refresh`,
          { refreshToken: localStorage.getItem(TokenVar.refresh_token) },
          httpOptions).pipe(mapTo(tokens => Object.assign(
            new Token(
              tokens.token_type,
              tokens.expires_in,
              tokens.access_token,
              tokens.refresh_token,
              tokens.language_slug,
            ), tokens)),
            catchError(this.handleError)
        );
    }

  getToken() {
    return localStorage.getItem('access_token');
  }

  get isLoggedIn(): boolean {
    const authToken = localStorage.getItem('access_token');
    return (authToken !== null) ? true : false;
  }

    removeTokens() {
        localStorage.removeItem(TokenVar.access_token);
        localStorage.removeItem(TokenVar.expires_in);
        localStorage.removeItem(TokenVar.refresh_token);
        localStorage.removeItem(TokenVar.token_type);
    }

    private handleError(error: Response | any) {
        const body = '';
        console.log('error: ', error);
        // return Observable.throw(body);

        return throwError(error.message || error);
    }

}
