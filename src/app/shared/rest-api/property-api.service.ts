import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {Properties} from './property';

@Injectable({
  providedIn: 'root'
})
export class PropertyApiService {

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


  getProperties(): Observable<Properties> {
    return this.http.get<Properties>(this.apiURL + '/properties', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getProperty(id): Observable<Properties> {
    return this.http.get<Properties>(this.apiURL + '/properties/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createProperty(property): Observable<Properties> {
    return this.http.post<Properties>(this.apiURL + '/properties/', JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateProperty(property): Observable<Properties> {
    return this.http.put<Properties>(this.apiURL + '/properties/' + property.id, JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteProperty(id) {
    return this.http.delete<Properties>(this.apiURL + '/properties/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter os prop allowed values para um dado id de propriedade
  getPropAllowedValues(id) {
    return this.http.get<Properties>(this.apiURL + '/property/prop_allowed_values/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter os prop ref para um dado id de propriedade
  getPropRefValues(id) {
    return this.http.get<Properties>(this.apiURL + '/property/prop_ref_values/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getPropAllowedValuesOtherLang(idProperty, langID) {
    return this.http.get<Properties>(this.apiURL + '/property/prop_allowed_values_other_lang/' +
      idProperty + '/' + langID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getPropRefValuesOtherLang(idProperty, langID) {
    return this.http.get<Properties>(this.apiURL + '/property/prop_ref_values_other_lang/' + idProperty + '/' + langID, this.httpOptions)
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
