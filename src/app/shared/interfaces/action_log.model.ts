export interface ActionLog {
  id: number;
  state: string;
  action_id: number;
  transaction_id: number;
  updated_by: number;
  deleted_by: number;
}
