export interface ConstantDB {
  id: number;
  constant_id: number;
  language_id: number;
  value: string;
  value_type: string;
  name: string;
  updated_by: number;
  deleted_by: number;
  // For parsing purposes
  type: string;
  // For when it's inside a compute_expression or a query, where order is important
  order: number;
  propertyIdQueryTerm: number;
}
