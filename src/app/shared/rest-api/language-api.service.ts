import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {Languages} from '../interfaces/language';
import {LanguageStates} from '../interfaces/language_state';
import {catchError, retry} from 'rxjs/operators';
import { TokenVar } from './token';

@Injectable({
  providedIn: 'root'
})
export class LanguageApiService {

   // Define API URL
   apiURL = 'http://127.0.0.1:8001/api/auth';

   constructor(private http: HttpClient) { }

    /*========================================
    CRUD Methods for consuming RESTful API
  =========================================*/

  // Http Options
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
    })
  };


  getLanguages(): Observable<Languages> {
    // return this.http.get<Language>(this.apiURL + '/languages')
    return this.http.get<Languages>(this.apiURL + '/languages', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getLanguageStates(): Observable<LanguageStates> {
    // return this.http.get<LanguageState>(this.apiURL + '/language_states')
    return this.http.get<LanguageStates>(this.apiURL + '/language_states', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getLanguage(id): Observable<Languages> {
    // return this.http.get<Language>(this.apiURL + '/languages/' + id)
    return this.http.get<Languages>(this.apiURL + '/languages/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createLanguage(language): Observable<Languages> {
    // return this.http.post<Language>(this.apiURL + '/languages', JSON.stringify(language), this.httpOptions)
    return this.http.post<Languages>(this.apiURL + '/languages/', JSON.stringify(language), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateLanguage(language): Observable<Languages> {
    return this.http.put<Languages>(this.apiURL + '/languages/' + language.id, JSON.stringify(language), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteLanguage(id) {
    return this.http.delete<Languages>(this.apiURL + '/languages/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Error handling
  handleError(error) {
    /*let errorMessage = '';
    if(error.error instanceof ErrorEvent) {
      // Get client-side error
      errorMessage = error.error.message;
    } else {
      // Get server-side error
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    window.alert(errorMessage);
    return throwError(errorMessage);*/

    return throwError(error.statusText);
  }

}
