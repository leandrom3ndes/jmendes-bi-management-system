import {Template} from './template.model';

// Trigger template transactionType
export class Templates {
  success: boolean;
  data: Template[];
  message: string;

  constructor(success: boolean, data: Template[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
