import {ConstantDB} from './constant.model';
import {ValueTerm} from './value_term.model';
import {Property} from './property.model';
import {ComputeExpression} from './compute_expression.model';

export interface Query {
  query_id: number;
  language_id: number;
  name: string;
  updated_by: number;
  deleted_by: number;
  // For parsing purposes, when we have input terms
  constant_term?: ConstantDB[];
  value_term?: ValueTerm[];
  property_term?: Property[];
  query_term?: Query[];
  compute_expression_term?: ComputeExpression[];
  // For when it's inside a compute_expression or a query, where order is important
  order: number;
  propertyIdQueryTerm: number;
}
