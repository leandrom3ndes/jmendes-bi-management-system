export interface TransactionDashb {
  id: number;
  state: string;
  status: boolean;
  process_type_id: number;
  init_proc: number;
  executer: number;
  auto_activate: number;
  freq_activate: number;
  when_activate: number;
  updated_by: number;
  deleted_by: number;
  created_at: string;
  updated_at: string;
  deleted_at: string;
  is_del: number;
  t_name: string;
  rt_name: string;
}
