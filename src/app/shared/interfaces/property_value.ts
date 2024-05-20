import {PropertyValue} from './property_value.model';

// Trigger template transactionType
export class PropertyValues {
  success: boolean;
  data: PropertyValue[];
  message: string;

  constructor(success: boolean, data: PropertyValue[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
