export interface InitTDashbM {
  id: number;
  transaction_type_id: number;
  state: string;
  status: boolean;
  process_id: number;
  updated_by: number;
  deleted_by: number;
  created_at: string;
  updated_at: string;
  deleted_at: string;
  t_state_id: number;
  t_state_name: string;
  process_name: string;
  process_type_name: string;
  transaction_type_name: string;
  // t_state_created_at: string;
}


