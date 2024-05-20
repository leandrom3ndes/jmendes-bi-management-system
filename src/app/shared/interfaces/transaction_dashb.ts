import { TransactionDashb } from './transaction_dashb.model';

export class TransactionsDashb {
  success: boolean;
  data: TransactionDashb[];
  message: string;

  constructor(success: boolean, data: TransactionDashb[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
