import { InitTDashbM } from './init_t_dashb.model';

export class InitTDashbs {
  success: boolean;
  data: InitTDashbM[];
  message: string;

  constructor(success: boolean, data: InitTDashbM[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
