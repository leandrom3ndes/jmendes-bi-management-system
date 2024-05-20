import {CompEvaluatedExpression} from './comp_evaluated_expression.model';

export class CompEvaluatedExpressions {
  success: boolean;
  data: CompEvaluatedExpression[];
  message: string;

  constructor(success: boolean, data: CompEvaluatedExpression[], message: string) {
    this.success = success;
    this.data = data;
    this.message = message;
  }
}
