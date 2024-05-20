import {Condition} from './condition.model';

export class Conditions {
  success: boolean;
  data: Condition[];
  message: string;

  constructor(success: boolean, data: Condition[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
