import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {TokenVar} from './token';
import {Templates} from '../interfaces/template';

@Injectable({
  providedIn: 'root'
})

export class TemplateApiService {

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
      Authorization: `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
    })
  };

  getTemplates(): Observable<Templates> {
    return this.http.get<Templates>(this.apiURL + '/templates', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getTemplate(id): Observable<Templates> {
    return this.http.get<Templates>(this.apiURL + '/templates/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  deleteTemplate(id): Observable<any> {
    return this.http.delete<any>(this.apiURL + '/templates/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  createTemplate(template): Observable<Templates> {
    return this.http.post<Templates>(this.apiURL + '/templates/', JSON.stringify(template), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
    );
  }

  updateTemplate(template): Observable<Templates> {
    return this.http.put<Templates>(this.apiURL + '/templates/' + template.id, JSON.stringify(template), this.httpOptions)
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
