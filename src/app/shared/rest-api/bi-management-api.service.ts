import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import { TokenVar } from './token';
import { BiElement } from '../interfaces/bi_element.model';
import { BiEngine } from '../interfaces/bi_engine.model';
import { BiElementEng } from '../interfaces/bi_element_engine.model';
import { BiKnowage } from '../interfaces/bi_knowage.model';
import {ActionLog} from '../interfaces/action_log.model';
import { BiElementType } from '../interfaces/bi_element_type';
import {Actors} from '../interfaces/actor';


@Injectable({
    providedIn: 'root'
})
export class BiManagementApiService {

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
    // ------ Bi_Element Service ------
    getAllBiElements(): Observable<BiElement> {
        return this.http.get<BiElement>(this.apiURL + '/biManagement/get_all_bielements', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getBiElementDetail(biElementid): Observable<BiElement> {
        return this.http.get<BiElement>(this.apiURL + '/biManagement/get_bielement_detail/' + biElementid, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getAllBiElementsDetail(): Observable<BiElement> {
        return this.http.get<BiElement>(this.apiURL + '/biManagement/get_all_bielements_detail', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getBiUserCollection(): Observable<BiElement> {
        return this.http.get<BiElement>(this.apiURL + '/biManagement/get_biuser_collection', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }
    getBiElementTypeSlug(): Observable<BiElementType> {
        return this.http.get<BiElementType>(this.apiURL + '/biManagement/get_bielement_type_slug', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }
    getBiElementsTypes(): Observable<BiElementType> {
        return this.http.get<BiElementType>(this.apiURL + '/biManagement/get_all_bielement_types', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }
    getBiElementTypeDetail(biElementTypeId): Observable<BiElementType> {
        return this.http.get<BiElementType>(this.apiURL + '/biManagement/get_bielement_type_detail/' + biElementTypeId, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    storeBiElement(biElement): Observable<BiElement> {
        return this.http.post<BiElement>(this.apiURL + '/biManagement/store_bielement', JSON.stringify(biElement), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    storeBiUserCollection(biElementid): Observable<BiElement> {
        return this.http.post<BiElement>(this.apiURL + '/biManagement/store_biuser_collection/' + biElementid, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    storeBiElementType(biElementType): Observable<BiElementType> {
        return this.http.post<BiElementType>(this.apiURL + '/biManagement/store_bielement_type',
            JSON.stringify(biElementType), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateBiElement(biElement): Observable<BiElement> {
        return this.http.post<BiElement>(this.apiURL + '/biManagement/update_bielement/' + biElement.id,
            JSON.stringify(biElement), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateBiElementType(biElementType): Observable<BiElementType> {
        return this.http.post<BiElementType>(this.apiURL + '/biManagement/update_bielement_type/' + biElementType.id,
            JSON.stringify(biElementType), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteBiElement(biElementid) {
        return this.http.delete<BiElement>(this.apiURL + '/biManagement/delete_bielement/' + biElementid, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteBiUserCollection(biElementid) {
        return this.http.delete<BiElement>(this.apiURL + '/biManagement/delete_biuser_collection/' + biElementid, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteBiElementType(biElementTypeId) {
        return this.http.delete<BiElement>(this.apiURL + '/biManagement/delete_bielement_type/' + biElementTypeId, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    // ------ Bi_Engine Service ------
    getAllEngines(): Observable<BiEngine> {
        return this.http.get<BiEngine>(this.apiURL + '/biManagement/get_all_engines', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getEngBiElements(biEngineId): Observable<BiElementEng> {
        return this.http.get<BiElementEng>(this.apiURL + '/biManagement/get_eng_bielements/' + biEngineId, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }


    storeBiEngine(biEngine): Observable<BiEngine> {
        return this.http.post<BiEngine>(this.apiURL + '/biManagement/store_biengine',
            JSON.stringify(biEngine), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateBiEngine(biEngine): Observable<BiEngine> {
        return this.http.post<BiEngine>(this.apiURL + '/biManagement/update_biengine/' + biEngine.id,
            JSON.stringify(biEngine), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteBiEngine(biEngineId) {
        return this.http.delete<BiEngine>(this.apiURL + '/biManagement/delete_biengine/' + biEngineId, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    // ------ Bi_Knowage Service ------
    getAllBiKnowage(): Observable<BiKnowage> {
        return this.http.get<BiKnowage>(this.apiURL + '/biManagement/get_all_biknowage', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getBiKnowageDetail(biKnowageId): Observable<BiKnowage> {
        return this.http.get<BiKnowage>(this.apiURL + '/biManagement/get_biknowage_detail/' + biKnowageId, this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    getAllBiKnowageDetail(): Observable<BiKnowage> {
        return this.http.get<BiKnowage>(this.apiURL + '/biManagement/get_all_biknowage_detail', this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    storeBiKnowage(biKnowage): Observable<BiKnowage> {
        return this.http.post<BiKnowage>(this.apiURL + '/biManagement/store_biknowage',
            JSON.stringify(biKnowage), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    updateBiKnowage(biKnowage): Observable<BiKnowage> {
        return this.http.post<BiKnowage>(this.apiURL + '/biManagement/update_biknowage/' + biKnowage.id,
            JSON.stringify(biKnowage), this.httpOptions)
            .pipe(
                retry(1),
                catchError(this.handleError)
            );
    }

    deleteBiKnowage(biKnowageId) {
        return this.http.delete<BiKnowage>(this.apiURL + '/biManagement/delete_biknowage/' + biKnowageId, this.httpOptions)
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
