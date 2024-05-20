import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders} from '../../../../node_modules/@angular/common/http';
import {Observable, throwError} from 'rxjs';
import {catchError, retry} from 'rxjs/operators';
import {TokenVar} from './token';
import {TransactionTypes} from '../interfaces/transaction_type';
import {TransactionStates} from '../interfaces/transaction_state';
import {Properties} from '../interfaces/property';
import {EntTypes} from '../interfaces/ent_type';
import {PropertyValues} from '../interfaces/property_value';
import {Values} from '../interfaces/value';
import {ActionRules} from '../interfaces/action_rule';
import {Templates} from '../interfaces/template';
import {UserEvaluatedExpressions} from '../interfaces/user_evaluated_expression';
import {Queries} from '../interfaces/query';
import {ConstantsDB} from '../interfaces/constant';
import {QueryParameters} from '../interfaces/query_parameter';

@Injectable({
  providedIn: 'root'
})

export class BlocklyApiService {


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

  getTransactionTypes(): Observable<TransactionTypes> {
    return this.http.get<TransactionTypes>(this.apiURL + '/blockly/get_transactiontypes', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getTransactionStates(): Observable<TransactionStates> {
    return this.http.get<TransactionStates>(this.apiURL + '/blockly/get_transactionstates', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getPropertiesFromEntTypes(entType): Observable<Properties> {
    return this.http.get<Properties>(this.apiURL + '/blockly/get_properties/' + entType, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getProperty(propertyId): Observable<Properties> {
    return this.http.get<Properties>(this.apiURL + '/blockly/get_property/' + propertyId, this.httpOptions)
        .pipe(
            retry(1),
            catchError(this.handleError)
        );
  }

  getPropertyValues(property): Observable<PropertyValues> {
    return this.http.get<PropertyValues>(this.apiURL + '/blockly/get_propertyvalues/' + property, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getFkPropertyValues(fkProperty): Observable<Values> {
    return this.http.get<Values>(this.apiURL + '/blockly/get_fkpropertyvalues/' + fkProperty, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getEntTypes(): Observable<EntTypes> {
    return this.http.get<EntTypes>(this.apiURL + '/blockly/get_enttypes', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getTemplates(): Observable<Templates> {
    return this.http.get<Templates>(this.apiURL + '/blockly/get_templates', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getUserEvaluatedExpressions(): Observable<UserEvaluatedExpressions> {
    return this.http.get<UserEvaluatedExpressions>(this.apiURL + '/blockly/get_userevaluatedexpressions', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getQueries(): Observable<Queries> {
    return this.http.get<Queries>(this.apiURL + '/blockly/get_queries', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getConstants(): Observable<ConstantsDB> {
    return this.http.get<ConstantsDB>(this.apiURL + '/blockly/get_constants', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getActionRules(): Observable<ActionRules> {
    return this.http.get<ActionRules>(this.apiURL + '/blockly/get_actionrules', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getQueryParameters(queryId): Observable<QueryParameters> {
    return this.http.get<QueryParameters>(this.apiURL + '/blockly/get_queryparameters/' + queryId, this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getAllProperties(): Observable<Properties> {
    return this.http.get<Properties>(this.apiURL + '/blockly/get_allproperties', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getAllFkPropertyValues(): Observable<Values> {
    return this.http.get<Values>(this.apiURL + '/blockly/get_allfkpropertyvalues', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  getAllPropAllowedValues(): Observable<PropertyValues> {
    return this.http.get<PropertyValues>(this.apiURL + '/blockly/get_allpropallowedvalues', this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  storeActionRule(actionRule): Observable<ActionRules> {
    return this.http.post<ActionRules>(this.apiURL + '/blockly/store_action_rule', JSON.stringify(actionRule), this.httpOptions)
      .pipe(
        retry(1),
        catchError(this.handleError)
      );
  }

  updateActionRule(actionRule): Observable<ActionRules> {
    const id = actionRule.id;
    return this.http.put<ActionRules>(this.apiURL + '/blockly/action_rules' + id, JSON.stringify(actionRule), this.httpOptions)
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
