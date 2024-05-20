import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {BsModalService} from 'ngx-bootstrap/modal';
import {TemplateEditorComponent} from './template-editor.component';

@Component({
  selector: 'app-template-editor',
  template: '<button type="button" class="btn-info" (click)="editRow()">' +
    ' {{ \'TEMPLATE-EDITOR.TEMPLATE-TABLE.EDIT\' | translate }} ' +
    '</button>' +
    '<button type="button" class="btn-warning" (click)="deleteRow()">' +
    ' {{ \'TEMPLATE-EDITOR.TEMPLATE-TABLE.DELETE\' | translate }} ' +
    '</button>',
  styleUrls: ['./template-editor.component.css']
})
export class TemplateEditorCellComponent {

  data: any;
  params: any;

  constructor(private http: HttpClient,
              private router: Router,
              private modalService: BsModalService,
              private templateEditorComponent: TemplateEditorComponent,
  ) {
  }

  agInit(params) {
    this.params = params;
    this.data = params.value;
  }

  editRow() {
    const rowData = this.params;
    console.log(rowData);
    rowData.data.from = 'templateEditorComponent';
    this.templateEditorComponent.openModal(rowData.data);
  }

  deleteRow() {
    const rowData = this.params;
    this.templateEditorComponent.deleteTemplate(rowData.data.template_id);
  }

}
