import {Language} from "./language.model";

export interface ProcessType {

  /*'state' => $this->state,
  'updated_by' => $this->updated_at,
  'deleted_by' => $this->deleted_at,
  'process_type_id'=>$this->process_type_id,
  'language_id'=>$this->language_id,
  'name'=>$this->name*/

  state: string;
  name: string;
  language: Language[];
  language_id: string;
  process_type_id: number;
  deleted_by: number;
  updated_by: number;
}
