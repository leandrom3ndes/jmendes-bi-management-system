import {TransactionType} from './transaction_type.model';

// Trigger template transactionType
export class TransactionTypes {
  success: boolean;
  data: TransactionType[];
  message: string;

  constructor(success: boolean, data: TransactionType[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
