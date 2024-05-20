import {Action} from './action.model';

// Trigger template transactionType
export class Actions {
  success: boolean;
  data: Action[];
  message: string;

  constructor(success: boolean, data: Action[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
