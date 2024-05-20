import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {InitTDashbs} from '../interfaces/init_t_dashb';
import {catchError, retry} from 'rxjs/operators';
import { TokenVar } from './token';

@Injectable({
  providedIn: 'root'
})
export class InitTDashbApiService {

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


  getInitTDashbs(): Observable<InitTDashbs> {
    // console.log(this.apiURL + '/dashboard/get_all_inic_trans');
    // return this.http.get<InitTDashbs>(this.apiURL + '/dashboard/get_all_inic_exec_trans', this.httpOptions)
    return this.http.get<InitTDashbs>(this.apiURL + '/dashboard/get_all_inic_trans', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }
  handleError(error) {
    return throwError(error.statusText);
  }

}
