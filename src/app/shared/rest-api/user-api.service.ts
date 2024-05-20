import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import {catchError, map, mapTo, retry} from 'rxjs/operators';
import { throwError } from 'rxjs';
import {Users} from '../interfaces/user';


@Injectable({ providedIn: 'root' })
export class UserApiService {

  // Define API URL
  apiURL = 'http://127.0.0.1:8001/api/auth';

  constructor(private http: HttpClient) { }

  // Http Options
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      'X-Requested-With' : 'XMLHttpRequest'
    })
  };

  createUser(user): Observable<Users> {
    return this.http.post<Users>(this.apiURL + '/signup', JSON.stringify(user), this.httpOptions)
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
