import {Property} from './property.model';
import {ConstantDB} from './constant.model';
import {ValueTerm} from './value_term.model';
import {Query} from './query.model';

export interface ComputeExpression {
  id: number;
  operator: string;
  constant_term?: ConstantDB[];
  value_term?: ValueTerm[];
  property_term?: Property[];
  query_term?: Query[];
  compute_expression_term?: ComputeExpression[];
  updated_by: number;
  deleted_by: number;
  // For when it's inside a compute_expression or a query, where order is important
  order: number;
  propertyIdQueryTerm: number;
}
