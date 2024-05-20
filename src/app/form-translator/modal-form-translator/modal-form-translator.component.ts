import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import {FormApiService} from '../../shared/rest-api/form-api.service';
import {Router} from '@angular/router';
import {LanguageApiService} from '../../shared/rest-api/language-api.service';
import {Utils} from 'formiojs';
import {ValidationCondApiService} from '../../shared/rest-api/validation-cond-api.service';
import {PropertyApiService} from '../../shared/rest-api/property-api.service';
import {TranslateService} from '@ngx-translate/core';

@Component({
  selector: 'app-modal-form-translator',
  templateUrl: './modal-form-translator.component.html',
  styleUrls: ['./modal-form-translator.component.css']
})
export class ModalFormTranslatorComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  dynamicFormOld: any = {};
  dynamicFormNew: any = {};
  private languagesAvailable;
  private actionProps: any = [];
  private validationConds: any = [];
  private actionPropsData: any = [];
  private actionPropFormInsert: any = {};

  constructor(private modalService: BsModalService,
              private modalRef: BsModalRef,
              private formRestApi: FormApiService,
              public router: Router,
              private languageApiService: LanguageApiService,
              private restValidationCondApi: ValidationCondApiService,
              private restPropertyApi: PropertyApiService,
              public translate: TranslateService) {
    const params: any = this.modalService.config.initialState;
  }

  ngOnInit() {
    const params: any = this.modalService.config.initialState;
    const isEmptyObj = !Object.keys(params).length;
    if (!isEmptyObj) {
      this.loadFormToTranslate(params.id, params.idLanguage);
    }
  }

  // Função que permite carregar as action properties para o formulário que foi escolhido para traduzir
  loadActionProperties() {
      this.formRestApi.getActionProperties(this.dynamicFormOld.action_id).subscribe((data: {}) => {
      this.actionProps = data;
      this.loadValidationConditions();
    });
  }

    // Função que permite obter o formulário a traduzir através do id do formulário e da linguagem original do mesmo
    loadFormToTranslate(idForm, idLang) {
        return this.formRestApi.getFormToTranslate(idForm, idLang).subscribe((data: {}) => {
            this.dynamicFormOld = data[0];
        });
    }

  // Função que permite fechar o modal
  closeModal() {
    this.modalRef.hide();
  }

    // Função que percorre o formulário já existente e chama uma função que altera as labels dos campos, quando encontra um elemento de design percorre os mesmos recursivamente
  changeLabels() {
    for (const actionProp of this.actionProps) {
      for (const field of this.dynamicFormNew.json.components) {
        if (field.type !== 'button' && field.type !== 'htmlelement') {
          if (field.type === 'columns') {
            this.searchColumns(field, 'label', actionProp);
          } else if (field.type === 'panel') {
            this.searchPanels(field, 'label', actionProp);
          } else if (field.type === 'table') {
            this.searchTables(field, 'label', actionProp);
          } else if (field.type === 'tabs') {
            this.searchTabs(field, 'label', actionProp);
          } else {
            if (this.changeLabel(field, actionProp)) {
              break;
            }
          }
        }
      }
    }
  }

  // Função que altera a label de um dado campo
  changeLabel(field, actionProp){
    if (field.key === actionProp.property_id) {
      field.label = actionProp.property_name;
      return 1;
    }
    return 0;
  }

    // Função que carrega as validações para todos os action props daquele formulário
  loadValidationConditions() {
    for (const actionProp of this.actionProps) {
      this.restValidationCondApi.getValidationConditionsFromActionProp(actionProp.action_prop_id)
        .subscribe((data: any) => {
        this.validationConds[actionProp.action_prop_id] = data;
      });
    }
    this.loadDBData();
  }

  // Função que percorre todos os action props e para cada um deles chama uma função que carrega as condições de validação, quando for encontrado um elemento de design estes vão ser percorridos recursivamente
  changeCustomValidations() {
    for (const actionProp of this.actionProps) {
      for (const field of this.dynamicFormNew.json.components) {
        if (field.type !== 'button' && field.type !== 'htmlelement') {
          if (field.type === 'columns') {
            this.searchColumns(field, 'validations', actionProp);
          } else if (field.type === 'panel') {
            this.searchPanels(field, 'validations', actionProp);
          } else if (field.type === 'table') {
            this.searchTables(field, 'validations', actionProp);
          } else if (field.type === 'tabs') {
            this.searchTabs(field, 'validations', actionProp);
          } else {
            if (this.changeCustomValidation(field, actionProp)) {
              break;
            }
          }
        }
      }
    }
  }

    // Função que coloca as condições de validação traduzidas para um dados campo e action prop
  changeCustomValidation(field, actionProp) {
    if (field.key === actionProp.property_id) {
      const data = this.validationConds[actionProp.action_prop_id];
      let customValidation = 'let validations=[],messages=[];\n' +
        'function myFunction(item){if(typeof item==="string"){messages.push(item)}}\n';
      data.forEach(validation => {
        switch (validation.type) {
          case 'isNumber':
            if (!validation.neg) {
              customValidation += 'valid = (Number(input)) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!Number(input)) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'isInteger':
            if (!validation.neg) {
              customValidation += 'valid = (Number.isInteger(Number(input))) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!Number.isInteger(Number(input))) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'equalTo':
            if (!validation.neg) {
              customValidation += 'valid = (input == ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (input != ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'lessEqual':
            if (!validation.neg) {
              customValidation += 'valid = (input <= ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input <= ' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'higherEqual':
            if (!validation.neg) {
              customValidation += 'valid = (input >= ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input >= ' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'higherThan':
            if (!validation.neg) {
              customValidation += 'valid = (input > ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input > ' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'lessThan':
            if (!validation.neg) {
              customValidation += 'valid = (input < ' + validation.param_1 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input < ' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'belongsRange':
            if (!validation.neg) {
              customValidation += 'valid = (input > ' + validation.param_1 +
                ' && input < ' + validation.param_2 + ') ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input > ' + validation.param_1 +
                ' && input < ' + validation.param_2 + ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'hasCharacter':
            if (!validation.neg) {
              customValidation += 'valid = (input.includes(' + validation.param_1 +
                ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input.includes(' + validation.param_1 +
                '))) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'hasWord':
            if (!validation.neg) {
              customValidation += 'valid = (input.includes(' + validation.param_1 +
                ')) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'valid = (!(input.includes(' + validation.param_1 +
                '))) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'regExpression':
            if (!validation.neg) {
              customValidation += 'let regExpression = ' + validation.param_1 +
                ';\nvalid = (regExpression.test(input)) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'let regExpression = ' + validation.param_1 +
                ';\nvalid = (!regExpression.test(input)) ? true : \'' + validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'isEmail' :
            if (!validation.neg) {
              customValidation += 'let regexEmail = /^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])' +
                '?(?:\\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;\nvalid = (regexEmail.test(input)) ? true : \'' +
                validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'let regexEmail = /^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])' +
                '?(?:\\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;\nvalid = (!regexEmail.test(input)) ? true : \'' +
                validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
          case 'isURL':
            if (!validation.neg) {
              customValidation += 'let regexEmail = /^(http:\\/\\/www\\.|https:\\/\\/www\\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+' +
                '([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/;\nvalid = (regexEmail.test(input)) ? true : \'' +
                validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            } else {
              customValidation += 'let regexEmail = /^(http:\\/\\/www\\.|https:\\/\\/www\\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+' +
                '([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/;\nvalid = (!regexEmail.test(input)) ? true : \'' +
                validation.error_text + '\';\n';
              customValidation += 'validations.push(valid);\n';
            }
            break;
        }
        customValidation += 'validations.forEach(myFunction),0===messages.length?valid=!0:valid=messages[0];';
        field.validate.custom = customValidation;
      });
      return 1;
    }
    return 0;
  }

    // Função que carrega as informações da DB dos campos prop_ref e enum para cada um dos action props
  loadDBData() {
    for (const actionProp of this.actionProps) {
      if (actionProp.value_type === 'prop_ref') {
        this.restPropertyApi.getPropRefValues(actionProp.property_id).subscribe((data: any) => {
          this.actionPropsData[actionProp.action_prop_id] = data;
        });
      } else if (actionProp.value_type === 'enum') {
        this.restPropertyApi.getPropAllowedValues(actionProp.property_id).subscribe((data: any) => {
          this.actionPropsData[actionProp.action_prop_id] = data;
        });
      }
    }
  }

    // Função que percorre o formulário existente e chama uma função que altera os dados dos campos do tipo enum e prop_ref, para elementos de design os mesmos são percorridos recursivamente
  changeLangDBData() {
    for (const actionProp of this.actionProps) {
      for (const field of this.dynamicFormNew.json.components) {
        if (field.type !== 'button' && field.type !== 'htmlelement') {
          if (field.type === 'columns') {
            this.searchColumns(field, 'dataDB', actionProp);
          } else if (field.type === 'panel') {
            this.searchPanels(field, 'dataDB', actionProp);
          } else if (field.type === 'table') {
            this.searchTables(field, 'dataDB', actionProp);
          } else if (field.type === 'tabs') {
            this.searchTabs(field, 'dataDB', actionProp);
          } else {
            if (this.changeSingleDBData(field, actionProp)) {
              break;
            }
          }
        }
      }
    }
  }

  // Função que coloca os dados para cada tipo de campo (enum e prop_ref)
  changeSingleDBData(field, actionProp) {
    if (field.key === actionProp.property_id) {
      if (actionProp.value_type === 'prop_ref') {
        if (field.type === 'radio') {
          field.values = this.actionPropsData[actionProp.action_prop_id];
        } else if (field.type === 'select') {
          field.data.values = this.actionPropsData[actionProp.action_prop_id];
        }
      }
      return 1;
    }
    return 0;
  }

  // Função que traduz o botão que submit para a lingua correta
  translateButton() {
    this.dynamicFormNew.json.components.forEach(field => {
      if (field.type === 'button') {
        field.label = this.translate.instant('FORMIO.SUBMIT-BUTTON');
      }
    });
  }

  // Função que percorre recursivamente as colunas de forma a encontrar os campos
  searchColumns(component, choice, actionProp) {
    for (const column of component.columns) {
      for (const auxField of column.components) {
        if (auxField.type === 'columns') {
          this.searchColumns(auxField, choice, actionProp);
        } else if (auxField.type === 'panel') {
          this.searchPanels(auxField, choice, actionProp);
        } else if (auxField.type === 'table') {
          this.searchTables(auxField, choice, actionProp);
        } else if (auxField.type === 'tabs') {
          this.searchTabs(auxField, choice, actionProp);
        } else {
          if (choice === 'label') {
            this.changeLabel(auxField, actionProp);
          } else if (choice === 'dataDB') {
            this.changeSingleDBData(auxField, actionProp);
          } else if (choice === 'validations') {
            this.changeCustomValidation(auxField, actionProp);
          }
        }
      }
    }
  }

  // Função que percorre recursivamente os paneis de forma a encontrar os campos
  searchPanels(component, choice, actionProp) {
    for (const field of component.components) {
      if (field.type === 'panel') {
        this.searchPanels(field, choice, actionProp);
      } else if (field.type === 'columns') {
        this.searchColumns(field, choice, actionProp);
      } else if (field.type === 'table') {
        this.searchTables(field, choice, actionProp);
      } else if (field.type === 'tabs') {
        this.searchTabs(field, choice, actionProp);
      } else {
        if (choice === 'label') {
          this.changeLabel(field, actionProp);
        } else if (choice === 'dataDB') {
          this.changeSingleDBData(field, actionProp);
        } else if (choice === 'validations') {
          this.changeCustomValidation(field, actionProp);
        }
      }
    }
  }

  // Função que percorre recursivamente as tabs de forma a encontrar os campos
  searchTabs(component, choice, actionProp) {
    for (const tab of component.components) {
      for (const field of tab.components) {
        if (field.type === 'tabs') {
          this.searchTabs(field, choice, actionProp);
        } else if (field.type === 'panel') {
          this.searchPanels(field, choice, actionProp);
        } else if (field.type === 'columns') {
          this.searchColumns(field, choice, actionProp);
        } else if (field.type === 'table') {
          this.searchTables(field, choice, actionProp);
        } else {
          if (choice === 'label') {
            this.changeLabel(field, actionProp);
          } else if (choice === 'dataDB') {
            this.changeSingleDBData(field, actionProp);
          } else if (choice === 'validations') {
            this.changeCustomValidation(field, actionProp);
          }
        }
      }
    }
  }

  // Função que percorre recursivamente as tables de forma a encontrar os campos
  searchTables(component, choice, actionProp) {
    for (const line of component.rows) {
      for (const column of line) {
        for (const field of column.components) {
          if (field.type === 'table') {
            this.searchTables(field, choice, actionProp);
          } else if (field.type === 'panel') {
            this.searchPanels(field, choice, actionProp);
          } else if (field.type === 'tabs') {
            this.searchTabs(field, choice, actionProp);
          } else if (field.type === 'columns') {
            this.searchColumns(field, choice, actionProp);
          } else {
            if (choice === 'label') {
              this.changeLabel(field, actionProp);
            } else if (choice === 'dataDB') {
              this.changeSingleDBData(field, actionProp);
            } else if (choice === 'validations') {
              this.changeCustomValidation(field, actionProp);
            }
          }
        }
      }
    }
  }

    // Função que efetua o processo de tradução propriamente dito, carregando todas as informações e traduzindo labels, validações e dados da DB e criando o novo formulário
    saveData() {
        this.loadActionProperties();
        this.dynamicFormNew.action_id = this.dynamicFormOld.action_id;
        this.dynamicFormNew.json = this.dynamicFormOld.json;
        this.dynamicFormNew.id = this.dynamicFormOld.id;
        this.dynamicFormNew.json = JSON.parse(this.dynamicFormNew.json);
        setTimeout(() => {
            this.changeLabels();
            this.changeCustomValidations();
            this.changeLangDBData();
            this.translateButton();
            this.dynamicFormNew.json = JSON.stringify(this.dynamicFormNew.json, null, 4);
            this.formRestApi.createFormOtherLanguage(this.dynamicFormNew).subscribe((data: any) => { // É criado o novo conteudo de formulário (form-content para a linguagem do utilizador)
                for (const actionProp of this.actionProps) { // Para cada action prop é criado um actionPropForm
                    this.actionPropFormInsert.idForm = this.dynamicFormOld.id;
                    this.actionPropFormInsert.idActionProp = actionProp.action_prop_id;
                    this.actionPropFormInsert.idLang = this.dynamicFormNew.language;
                    this.formRestApi.insertActionPropForm(this.actionPropFormInsert).subscribe((data: any) => {});
                }
                this.passEntry.emit('SUCESSO');
                this.router.navigate(["/formsTranslator"]);
                this.closeModal();
            }, error => {
                this.passEntry.emit('ERRO');
            });
        }, 5000);
    }
}
