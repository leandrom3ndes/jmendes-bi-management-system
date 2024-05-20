import {FormCompute} from './form_compute.model';
import {Condition} from './condition.model';
import {ValidationCondition} from './validation_condition.model';

export interface Property {
  property_id: number;
  language_id: number;
  name: string;
  scope: string;
  value_type: string;
  fk_property_id: number;
  requires_translation: number;
  form_field_name: string;
  ent_type_id: number;
  updated_by: number;
  deleted_by: number;
  id: number;
  created_at: number;
  updated_at: number;
  deleted_at: number;
  // For DB parsing
  form_compute?: FormCompute;
  enable_condition?: Condition;
  validation_conditions?: ValidationCondition[];
  mandatory?: number;
  // For when it's inside a compute_expression or a query, where order is important
  order: number;
  propertyIdQueryTerm: number;
}
