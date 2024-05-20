import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import { TokenVar } from './token';
import {NewTContent} from '../interfaces/new_t_content';

@Injectable({
  providedIn: 'root'
})
export class NewTContentApiService {
  // Define API URL
  apiURL = 'http://127.0.0.1:8001/api/auth';

  constructor(private http: HttpClient) { }


// Http Options
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'Authorization': `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
    })
  };

  getNewTContent(data): Observable<NewTContent> {
    return this.http.post<NewTContent>(this.apiURL + '/dashboard/get_data_for_tab', JSON.stringify(data), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }
  handleError(error) {
    return throwError(error.statusText);
  }

}
