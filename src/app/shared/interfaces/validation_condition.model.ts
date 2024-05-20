import {Template} from './template.model';

export interface ValidationCondition {
  id: number;
  type: string;
  action_prop_id: number;
  param_1: string;
  param_2: string;
  custom_validation: string;
  negative: number;
  updated_by: number;
  deleted_by: number;
  // For parsing purposes
  template: Template;
}
