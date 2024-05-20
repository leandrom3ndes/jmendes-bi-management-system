import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {ActionsProp} from './action-prop';
import {catchError, retry} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ActionPropApiService {

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


  getActionsProp(): Observable<ActionsProp> {
    return this.http.get<ActionsProp>(this.apiURL + '/actions_prop', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getActionProp(id): Observable<ActionsProp> {
    return this.http.get<ActionsProp>(this.apiURL + '/actions_prop/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createActionProp(property): Observable<ActionsProp> {
    return this.http.post<ActionsProp>(this.apiURL + '/actions_prop/', JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateActionProp(property): Observable<ActionsProp> {
    return this.http.put<ActionsProp>(this.apiURL + '/actions_prop/' + property.id, JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteActionProp(id) {
    return this.http.delete<ActionsProp>(this.apiURL + '/actions_prop/' + id, this.httpOptions)
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
