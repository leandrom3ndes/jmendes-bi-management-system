import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {ValidationConds} from './validation-cond';

@Injectable({
  providedIn: 'root'
})
export class ValidationCondApiService {

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


  getValidationConds(): Observable<ValidationConds> {
    return this.http.get<ValidationConds>(this.apiURL + '/validation_cond', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getValidationCond(id): Observable<ValidationConds> {
    return this.http.get<ValidationConds>(this.apiURL + '/validation_cond/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createValidationCond(validationCond): Observable<ValidationConds> {
    return this.http.post<ValidationConds>(this.apiURL + '/validation_cond/', JSON.stringify(validationCond), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateValidationCond(validationCond): Observable<ValidationConds> {
    return this.http.put<ValidationConds>(this.apiURL + '/validation_cond/' +
      validationCond.id, JSON.stringify(validationCond), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteValidationCond(id) {
    return this.http.delete<ValidationConds>(this.apiURL + '/validation_cond/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter as condições de validação para um dado actionProp id
  getValidationConditionsFromActionProp(actionPropID){
    return this.http.get<ValidationConds>(this.apiURL + '/validation_cond/get_by_action_prop/' + actionPropID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getValidationConditionsFromActionPropOtherLang(actionPropID, langID) {
    return this.http.get<ValidationConds>(this.apiURL + '/validation_cond/get_by_action_prop_other_lang/' +
      actionPropID + '/' + langID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Error handling
  handleError(error) {
    return throwError(error.statusText);
  }

}
