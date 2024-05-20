export interface Template {
  id: number;
  language_id: number;
  type: string;
  name: string;
  text: string;
  header?: string;
  button?: string;
  class?: string;
  colour?: string;
  title?: string;
  openedEditor?: string;
  hasHTML?: string;
  updated_by: number;
  deleted_by: number;
}
