import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {Actions} from './action';
import {catchError, retry} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class ActionApiService {

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


  getActions(): Observable<Actions> {
    return this.http.get<Actions>(this.apiURL + '/actions', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getAction(id): Observable<Actions> {
    return this.http.get<Actions>(this.apiURL + '/actions/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createAction(property): Observable<Actions> {
    return this.http.post<Actions>(this.apiURL + '/actions/', JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateAction(property): Observable<Actions> {
    return this.http.put<Actions>(this.apiURL + '/actions/' + property.id, JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteAction(id) {
    return this.http.delete<Actions>(this.apiURL + '/actions/' + id, this.httpOptions)
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
