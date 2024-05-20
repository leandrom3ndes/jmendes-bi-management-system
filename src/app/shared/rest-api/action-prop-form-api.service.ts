import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {ActionsPropForm} from './action-prop-form';
import {catchError, retry} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ActionPropFormApiService {

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


  getActionsPropForm(): Observable<ActionsPropForm> {
    return this.http.get<ActionsPropForm>(this.apiURL + '/actions_prop_form', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getActionPropForm(id): Observable<ActionsPropForm> {
    return this.http.get<ActionsPropForm>(this.apiURL + '/actions_prop_form/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createActionPropForm(property): Observable<ActionsPropForm> {
    return this.http.post<ActionsPropForm>(this.apiURL + '/actions_prop_form/', JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateActionPropForm(property): Observable<ActionsPropForm> {
    return this.http.put<ActionsPropForm>(this.apiURL + '/actions_prop_form/' + property.id, JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteActionPropForm(id) {
    return this.http.delete<ActionsPropForm>(this.apiURL + '/actions_prop_form/' + id, this.httpOptions)
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
