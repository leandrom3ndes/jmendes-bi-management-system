import { Language } from './language.model';

export class Languages {
  success: boolean;
  data: Language[];
  message: string;

  constructor(success: boolean, data: Language[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
