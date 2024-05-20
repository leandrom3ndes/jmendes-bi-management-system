import {ProcessTypeState} from "./processtypestate.model";

export interface Language {
  id: number;
  name: string;
  slug: string;
  state: string;
  created_by: number;
  updated_by: number;
  pivot: ProcessTypeState;
}
