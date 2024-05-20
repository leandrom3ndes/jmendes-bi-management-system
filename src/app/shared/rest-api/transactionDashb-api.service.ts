import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {TransactionsDashb} from '../interfaces/transaction_dashb';
import {catchError, retry} from 'rxjs/operators';
import { TokenVar } from './token';

@Injectable({
  providedIn: 'root'
})
export class TransactionsDashbApiService {

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


  getTransactionsDashb(): Observable<TransactionsDashb> {
    return this.http.get<TransactionsDashb>(this.apiURL + '/dashboardManage', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }
  handleError(error) {
    return throwError(error.statusText);
  }

}
