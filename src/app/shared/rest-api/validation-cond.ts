import { ValidationCond } from '../interfaces/validation_cond.model';

export class ValidationConds {
  success: boolean;
  data: ValidationCond[];
  message: string;

  constructor(success: boolean, data: ValidationCond[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
