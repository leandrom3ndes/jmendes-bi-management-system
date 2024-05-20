import {QueryParameter} from './query_parameter.model';

export class QueryParameters {
  success: boolean;
  data: QueryParameter[];
  message: string;

  constructor(success: boolean, data: QueryParameter[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
