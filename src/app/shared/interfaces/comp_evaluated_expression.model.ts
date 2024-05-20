import {ConstantDB} from './constant.model';
import {ValueTerm} from './value_term.model';
import {Property} from './property.model';
import {Query} from './query.model';
import {ComputeExpression} from './compute_expression.model';
import {PropertyValue} from './property_value.model';

export interface CompEvaluatedExpression {
  id: number;
  parent_cond_id: number;
  logical_operator: string;
  term_1_id: number;
  term_2_id: number;
  updated_by: number;
  deleted_by: number;
  // For parsing purposes
  constant_term_1?: ConstantDB;
  value_term_1?: ValueTerm;
  property_term_1?: Property;
  query_term_1?: Query;
  compute_expression_term_1?: ComputeExpression;
  constant_term_2?: ConstantDB;
  value_term_2?: ValueTerm;
  property_term_2?: Property;
  property_value_term_2?: PropertyValue;
  query_term_2?: Query;
  compute_expression_term_2?: ComputeExpression;
}
