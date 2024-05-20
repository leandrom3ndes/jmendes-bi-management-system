import {Property} from './property.model';
import {ConstantDB} from './constant.model';
import {ValueTerm} from './value_term.model';
import {PropertyValue} from './property_value.model';
import {ComputeExpression} from './compute_expression.model';
import {Query} from './query.model';
import {Template} from './template.model';
import {Condition} from './condition.model';

export interface Action {
  id: number;
  action_rule_id: number;
  type: string;
  prev_action_id: number;
  next_action_id: number;
  name: string;
  par_action_id: number;
  updated_by: number;
  deleted_by: number;
  created_at: number;
  updated_at: number;
  deleted_at: number;
  // In case it is causal_link
  caused_action_trans_type_id?: number;
  caused_action_t_state_id?: number;
  min?: string;
  max?: string;
  // In case is user_output
  template?: Template;
  // In case it is user_input
  properties?: Property[];
  // In case it is assign_expression
  left_property?: Property;
  property_term?: Property;
  property_value_term?: PropertyValue;
  constant_term?: ConstantDB;
  value_term?: ValueTerm;
  query_term?: Query;
  compute_expression_term?: ComputeExpression;
  // In case is if_then
  ifCondition: Condition;
  thenAction: Action[];
  elseAction?: Action[];
  // In case is WHILE DO
  whileCondition: Condition;
  doAction: Action[];
}
