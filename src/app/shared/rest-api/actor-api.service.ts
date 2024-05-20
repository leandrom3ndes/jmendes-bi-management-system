import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {Actors} from '../interfaces/actor';
import {ActorStates} from '../interfaces/actor_state';
import {catchError, retry} from 'rxjs/operators';
import {TokenVar} from './token';

@Injectable({
    providedIn: 'root'
})
export class ActorApiService {

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
            Authorization: `${localStorage.getItem(TokenVar.token_type)} ${localStorage.getItem(TokenVar.access_token)}`
        })
    };


    getActors(): Observable<Actors> {
        // return this.http.get<Actor>(this.apiURL + '/actors')
        return this.http.get<Actors>(this.apiURL + '/actors', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getActorStates(): Observable<ActorStates> {
        // return this.http.get<ActorState>(this.apiURL + '/actor_states')
        return this.http.get<ActorStates>(this.apiURL + '/actor_states', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getActor(id): Observable<Actors> {
        // return this.http.get<Actor>(this.apiURL + '/actors/' + id)
        return this.http.get<Actors>(this.apiURL + '/actors/' + id, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    createActor(xml): Observable<Actors> {
        // return this.http.post<Actor>(this.apiURL + '/actors', JSON.stringify(actor), this.httpOptions)
        return this.http.post<Actors>(this.apiURL + '/actors/', xml, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateActor(actor): Observable<Actors> {
        return this.http.put<Actors>(this.apiURL + '/actors/' + actor.id, JSON.stringify(actor), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteActor(id) {
        return this.http.delete<Actors>(this.apiURL + '/actors/' + id, this.httpOptions)
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
