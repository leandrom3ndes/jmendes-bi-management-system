import {ValidationCondition} from './validation_condition.model';

export class ValidationConditions {
  success: boolean;
  data: ValidationCondition[];
  message: string;

  constructor(success: boolean, data: ValidationCondition[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
