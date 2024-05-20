import { User } from '../interfaces/user.model';

export class Users {
  success: boolean;
  data: User[];
  message: string;

  constructor(success: boolean, data: User[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
