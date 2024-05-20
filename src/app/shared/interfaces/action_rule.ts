import {ActionRule} from './action_rule.model';

// Trigger template transactionType
export class ActionRules {
  success: boolean;
  data: ActionRule[];
  message: string;

  constructor(success: boolean, data: ActionRule[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
