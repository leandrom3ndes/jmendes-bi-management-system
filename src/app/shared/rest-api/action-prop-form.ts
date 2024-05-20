import { ActionPropForm } from '../interfaces/action_prop_form.model';

export class ActionsPropForm {
  success: boolean;
  data: ActionPropForm[];
  message: string;

  constructor(success: boolean, data: ActionPropForm[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
