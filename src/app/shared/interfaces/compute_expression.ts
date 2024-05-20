import {ComputeExpression} from './compute_expression.model';

export class ComputeExpressions {
  success: boolean;
  data: ComputeExpression[];
  message: string;

  constructor(success: boolean, data: ComputeExpression[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
