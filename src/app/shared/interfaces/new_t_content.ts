//import { InitTDashbM } from './init_t_dashb.model';

export class NewTContent {
  success: boolean;
  data: [];
  message: string;

  constructor(success: boolean, data: [], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
