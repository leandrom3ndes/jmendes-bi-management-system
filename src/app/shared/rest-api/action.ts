import { Action } from '../interfaces/action.model';

export class Actions {
  success: boolean;
  data: Action[];
  message: string;

  constructor(success: boolean, data: Action[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
