import { LanguageState } from './language_state.model';

export class LanguageStates {
  success: boolean;
  data: LanguageState[];
  message: string;

  constructor(success: boolean, data: LanguageState[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
