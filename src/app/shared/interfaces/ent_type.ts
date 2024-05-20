import {EntType} from './ent_type.model';

// Trigger template transactionType
export class EntTypes {
  success: boolean;
  data: EntType[];
  message: string;

  constructor(success: boolean, data: EntType[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
