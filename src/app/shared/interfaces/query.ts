import {Query} from './query.model';

export class Queries {
  success: boolean;
  data: Query[];
  message: string;

  constructor(success: boolean, data: Query[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
