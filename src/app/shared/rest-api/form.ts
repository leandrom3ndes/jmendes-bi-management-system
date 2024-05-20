import { Form } from '../interfaces/form.model';

export class Forms {
  success: boolean;
  data: Form[];
  message: string;

  constructor(success: boolean, data: Form[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
