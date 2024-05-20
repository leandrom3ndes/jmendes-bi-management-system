import {ValueTerm} from './value_term.model';

export class ValueTerms {
  success: boolean;
  data: ValueTerm[];
  message: string;

  constructor(success: boolean, data: ValueTerm[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
