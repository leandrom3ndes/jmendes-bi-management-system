import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {TokenVar} from './token';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {Forms} from './form';
import {Users} from '../interfaces/user';

@Injectable({
  providedIn: 'root'
})
export class FormApiService {

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

  // Obtenção de todos formulários
  getForms(): Observable<Forms> {
    return this.http.get<Forms>(this.apiURL + '/forms', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Obtenção de um formulário através do seu ID
  getForm(id): Observable<Forms> {
    return this.http.get<Forms>(this.apiURL + '/forms/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Criação de um formulário através do JSON passado
  createForm(property): Observable<Forms> {
    return this.http.post<Forms>(this.apiURL + '/forms/', JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Update de um formulário através do ID e JSON passado
  updateForm(property): Observable<Forms> {
    return this.http.put<Forms>(this.apiURL + '/forms/' + property.id, JSON.stringify(property), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Eliminação de formulário
  deleteForm(id) {
    return this.http.delete<Forms>(this.apiURL + '/forms/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Obtenção das action properties através do id
  getActionProperties(id) {
    return this.http.get<Forms>(this.apiURL + '/forms/action_properties/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Obtenção de uma action property em especifico através do id da ação e id de propriedade
  getActionProperty(actionID, propertyID) {
    return this.http.get<Forms>(this.apiURL + '/forms/action_properties/' + actionID + '/' + propertyID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Inserção de um actionPropForm (chamado quando um campo é inserido no formulário)
  insertActionPropForm(request) {
    return this.http.post<Forms>(this.apiURL + '/forms/action_prop_form', JSON.stringify(request), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Remoção de um actionPropForm (chamado quando um campo é removido de um formulário)
  removeActionPropForm(id) {
    return this.http.delete<Forms>(this.apiURL + '/forms/action_prop_form/' + id, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que adiciona o JSON ao formulário
  addJSONForm(request):  Observable<Forms>  {
    return this.http.put<Forms>(this.apiURL + '/forms/json_update/' + request.id , JSON.stringify(request), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter um actionPropForm de um dado formulário através do id do formulário e id de propriedade
  getActionPropFormFromPropID(idForm, propID):  Observable<Forms>  {
    return this.http.get<Forms>(this.apiURL + '/forms/getActionPropForm/' + idForm + '/' + propID, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter o JSON de um formulário
  getFormJSON(idForm):  Observable<Forms>  {
    return this.http.get<Forms>(this.apiURL + '/forms/getJSON/' + idForm, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getFormProperties(idForm):  Observable<Forms>  {
    return this.http.get<Forms>(this.apiURL + '/forms/properties/' + idForm, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter o utilizador a aceder ao formulário
  getUserAccessingForm():  Observable<Users>  {
    return this.http.get<Users>(this.apiURL + '/user', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que cria um formulário após tradução
  createFormOtherLanguage(form): Observable<Forms> {
    return this.http.post<Forms>(this.apiURL + '/forms/create_form_other_language', JSON.stringify(form), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter os formulário aptos a tradução
  getFormsToTranslate() {
    return this.http.get<Forms>(this.apiURL + '/formsToTranslate', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  // Função que permite obter o formulário a traduzir através do id do formulário e id de linguagem
  getFormToTranslate(idForm, idLang) {
      return this.http.get<Forms>(this.apiURL + '/formToTranslate/' + idForm + '/' + idLang, this.httpOptions)
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
