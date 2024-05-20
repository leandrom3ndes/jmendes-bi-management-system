import {Component, OnInit, EventEmitter, Input, Output} from '@angular/core';
import {BsModalService, BsModalRef} from 'ngx-bootstrap/modal';
import {Router} from '@angular/router';

import {ActionApiService} from '../shared/rest-api/action-api.service';
import {FormApiService} from '../shared/rest-api/form-api.service';

@Component({
  selector: 'app-modal-dynamic-form',
  templateUrl: './modal-dynamic-form.component.html',
  styleUrls: ['./modal-dynamic-form.component.css']
})
export class ModalDynamicFormComponent implements OnInit {
  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  dynamicForm: any = {};
  private actionName;

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private restApi: FormApiService,
              public router: Router,
              private ActionApi: ActionApiService) {
    this.ActionApi.getActions().subscribe((data: {}) => {
      this.actionName = data;
    });
  }

  ngOnInit() {
    const params: any = this.modalService.config.initialState;
    const isEmptyObj = !Object.keys(params).length;
    if (!isEmptyObj) {
      this.loadFormById(params.id);
    }
  }

  // Função que permite carregar o formulário com base no id passado
  loadFormById(id) {
    return this.restApi.getForm(id).subscribe((data: {}) => {
      this.dynamicForm = data[0];
    });
  }

  // Função que fecha o modal
  closeModal() {
    this.modalRef.hide();
  }

  // Funçção que permite criar o formulário e redirecionar para a página do editor de formulários
  saveData() {
    if (!this.dynamicForm.id) { // Se o formulário não existir cria um novo
      this.restApi.createForm(this.dynamicForm).subscribe((data: any) => {
        this.passEntry.emit('SUCESSO');
        sessionStorage.setItem('formID', data);
        sessionStorage.setItem('actionID', this.dynamicForm.action_id);
        this.router.navigate(['/formsManagement/formio']);
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    } else { // Se o formulário já existir atualiza o formulário existente
      this.restApi.updateForm(this.dynamicForm).subscribe((data: {}) => {
        this.passEntry.emit('SUCESSO');
        sessionStorage.setItem('formID', this.dynamicForm.id);
        sessionStorage.setItem('actionID', this.dynamicForm.action_id);
        this.router.navigate(["/formsManagement/formio"]);
        this.closeModal();
      }, error => {
        this.passEntry.emit('ERRO');
      });
    }
  }
}
