import {CompEvaluatedExpression} from './comp_evaluated_expression.model';
import {UserEvaluatedExpression} from './user_evaluated_expression.model';

export interface Condition {
  id: number;
  type: string;
  parent_cond_id: number;
  action_id: number;
  updated_by: number;
  deleted_by: number;
  // For parsing purposes
  comp_evaluated_expressions?: CompEvaluatedExpression[];
  user_evaluated_expressions?: UserEvaluatedExpression[];
  conditions?: Condition[];
}
