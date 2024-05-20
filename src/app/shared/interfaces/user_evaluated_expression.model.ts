export interface UserEvaluatedExpression {
  id: number;
  user_evaluated_expression_id: number;
  language_id: number;
  expression_name: string;
  expression_text: string;
  created_by: number;
  updated_by: number;
  // For parsing purposes
  type?: string;
}
