import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {TokenVar} from './token';
import {Action} from '../interfaces/action.model';
import {Form} from '../interfaces/form.model';
import {ActionLog} from '../interfaces/action_log.model';
import {Template} from '../interfaces/template.model';

@Injectable({
  providedIn: 'root'
})

export class ArDashboardApiService {


  // Define API URL
  apiURL = 'http://127.0.0.1:8001/api/auth';

  constructor(private http: HttpClient) {
  }

  // Http Options
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      Authorization: `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
    })
  };

  getFormFromAction(actionId): Observable<Form> {
    return this.http.get<Form>(this.apiURL + '/dashboard/get_form/' + actionId, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getExecutingAction(transType, transState, transactionID): Observable<Action> {
    return this.http.get<Action>(this.apiURL + '/dashboard/get_executing_action/' + transType +
      '_' + transState + '_' + transactionID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  storeActionLog(actionLog): Observable<ActionLog> {
    return this.http.post<ActionLog>(this.apiURL + '/dashboard/store_action_log', JSON.stringify(actionLog), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  storeFormInput(submittedValues): Observable<any> {
    return this.http.post<any>(this.apiURL + '/dashboard/store_form_input', JSON.stringify(submittedValues), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getTemplateFromAction(actionId): Observable<Template> {
    return this.http.get<Template>(this.apiURL + '/dashboard/get_template/' + actionId, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getModalTemplate(templateId): Observable<Template> {
    return this.http.get<Template>(this.apiURL + '/dashboard/get_modal_template/' + templateId, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getToastTemplate(templateId): Observable<Template> {
    return this.http.get<Template>(this.apiURL + '/dashboard/get_toast_template/' + templateId, this.httpOptions)
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
