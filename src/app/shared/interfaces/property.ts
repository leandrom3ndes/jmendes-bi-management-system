import {Property} from './property.model';

// Trigger template transactionType
export class Properties {
  success: boolean;
  data: Property[];
  message: string;

  constructor(success: boolean, data: Property[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
