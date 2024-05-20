import {Action} from './action.model';

export interface ActionRule {
  id: number;
  t_state_id: number;
  transaction_type_id: number;
  blockly_xml: string;
  blockly_code: string;
  preview: string;
  updated_by: number;
  deleted_by: number;
  // For parsing xml and send to server-side
  actions: Action[];
}
