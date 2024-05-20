import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {ProcessTypes} from '../interfaces/processtype';
import {ProcessTypeStates} from '../interfaces/processtypestate';
import {catchError, retry} from 'rxjs/operators';
import {TokenVar} from './token';

@Injectable({
    providedIn: 'root'
})
export class ProcessTypeApiService {

    // Define API URL
    apiURL = 'http://127.0.0.1:8001/api/auth';

    constructor(private http: HttpClient) {
    }

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


    getProcessTypes(): Observable<ProcessTypes> {
        // return this.http.get<Processtype>(this.apiURL + '/processtypes')
        return this.http.get<ProcessTypes>(this.apiURL + '/processtypes', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getProcessTypeStates(): Observable<ProcessTypeStates> {
        // return this.http.get<ProcesstypeState>(this.apiURL + '/processtype_states')
        return this.http.get<ProcessTypeStates>(this.apiURL + '/processtypestates', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getProcessType(id): Observable<ProcessTypes> {
        // return this.http.get<Processtype>(this.apiURL + '/processtypes/' + id)
        return this.http.get<ProcessTypes>(this.apiURL + '/processtypes/' + id, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    createProcessType(processType): Observable<ProcessTypes> {
        // return this.http.post<Processtype>(this.apiURL + '/processtypes', JSON.stringify(processtype), this.httpOptions)
        return this.http.post<ProcessTypes>(this.apiURL + '/processtypes/', JSON.stringify(processType), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateProcessType(processType): Observable<ProcessTypes> {
        return this.http.put<ProcessTypes>(this.apiURL + '/processtypes/' + processType.id, JSON.stringify(processType), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteProcessType(id) {
        return this.http.delete<ProcessTypes>(this.apiURL + '/processtypes/' + id, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    // Error handling
    handleError(error) {
        /*let errorMessage = '';
        if(error.error instanceof ErrorEvent) {
          // Get client-side error
          errorMessage = error.error.message;
        } else {
          // Get server-side error
          errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
        }
        window.alert(errorMessage);
        return throwError(errorMessage);*/

        return throwError(error.statusText);
    }

}
