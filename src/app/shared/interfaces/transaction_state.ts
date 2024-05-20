import {TransactionState} from './transaction_state.model';

// Trigger template transactionType
export class TransactionStates {
  success: boolean;
  data: TransactionState[];
  message: string;

  constructor(success: boolean, data: TransactionState[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
