import {FormCompute} from './form_compute.model';

// Trigger template transactionType
export class FormComputes {
  success: boolean;
  data: FormCompute[];
  message: string;

  constructor(success: boolean, data: FormCompute[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
