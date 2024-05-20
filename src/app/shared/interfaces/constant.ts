import {ConstantDB} from './constant.model';

export class ConstantsDB {
  success: boolean;
  data: ConstantDB[];
  message: string;

  constructor(success: boolean, data: ConstantDB[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
