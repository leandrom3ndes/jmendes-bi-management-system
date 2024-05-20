export interface ValueTerm {
  id: number;
  value: string;
  value_type: string;
  updated_by: number;
  deleted_by: number;
  // For when it's inside a compute_expression or a query, where order is important
  order: number;
  propertyIdQueryTerm: number;
}
