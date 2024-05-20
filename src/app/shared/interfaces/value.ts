import {Value} from './value.model';

// Trigger template transactionType
export class Values {
  success: boolean;
  data: Value[];
  message: string;

  constructor(success: boolean, data: Value[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
