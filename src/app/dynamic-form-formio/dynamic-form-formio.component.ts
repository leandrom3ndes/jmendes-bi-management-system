import {Component, OnInit} from '@angular/core';
import {PropertyApiService} from '../shared/rest-api/property-api.service';
import {FormApiService} from '../shared/rest-api/form-api.service';
import {ValidationCondApiService} from '../shared/rest-api/validation-cond-api.service';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {Router} from '@angular/router';
import {TranslateService} from '@ngx-translate/core';
import formio_lang from 'src/assets/i18n/formio_builder.json';
import flatpickr from 'flatpickr';

@Component({
  selector: 'app-dynamic-form-formio',
  templateUrl: './dynamic-form-formio.component.html',
  styleUrls: ['./dynamic-form-formio.component.css']
})
export class DynamicFormFormioComponent implements OnInit {

  constructor(
    public restFormApi: FormApiService,
    public restPropertyApi: PropertyApiService,
    private alertToast: AlertToastService,
    public router: Router,
    public translate: TranslateService,
    public restValidationCondApi: ValidationCondApiService) {}

  // tslint:disable-next-line:ban-types
  public myForm: any = {
    components: []
  };

  // tslint:disable-next-line:ban-types
  public options: any = {};
  private sendRequest: any = {};
  public needUpdate = false;
  private ActionProps: any = [];
  private actionPropFormInsert: any = {};
  private actionPropAssociations: any = [];
  private allowedValues: any = [];
  private profRefValues: any = [];
  private validationConds: any = [];

  ngOnInit() {
    // Definir a lingua do date picker consoante a linguage do utilizador
    this.setCalendarLanguage();
    // Carregar os action properties
    this.loadActionProperties();
  }

  // Permite definir a linguagem do utilizador consoante a sua linguagem de registo da DB
  setCalendarLanguage() {
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      flatpickr.localize(flatpickr.l10ns[data.slug]);
    });
  }

  // Carrega o formulário com base no id
  loadFormDB() {
    this.restFormApi.getForm(sessionStorage.getItem('formID')).subscribe((data: any) => {
      const form = JSON.parse(data[0].json);
      this.myForm = form;
      // Para cada um dos componentes do formulário vai verificar o tipo de componente, se for componente de design vai procurar componentes que não sejam de design iterativamente
      form.components.forEach(field => {
        // Se for elemento de design
        if (field.type !== 'button' && field.type !== 'htmlelement') {
          if (field.type === 'columns') {
            this.searchColumns(field, 'add');
          } else if (field.type === 'panel') {
            this.searchPanels(field, 'add');
          } else if (field.type === 'table') {
            this.searchTables(field, 'add');
          } else if (field.type === 'tabs') {
            this.searchTabs(field, 'add');
          } else { // Se não for um componente de design
            const idForm = sessionStorage.getItem('formID');
            // Vamos obter os actionPropForm com base no id fo formulário e na chave passada
            this.restFormApi.getActionPropFormFromPropID(idForm, field.key).subscribe((data: any) => {
              const type = this.translate.instant('FORMIO.LABEL-TYPE');
              const name = this.translate.instant('FORMIO.LABEL-NAME');
              sessionStorage.setItem('actionPropFormID', data[0].action_prop_form_id);
              this.actionPropAssociations[field.key] = sessionStorage.getItem('actionPropFormID');
              delete this.options.builder[field.attributes.propertyID].components;
              setTimeout(() => {
                this.options.builder[field.attributes.propertyID].title += ' - ( ' + type + ': ' + field.type + ' | ' + name + ': ' + field.label + ' )';
                this.refreshBuilder();
              }, 150);
            });
          }
        } else if (field.type === 'button') { // Quando o componente for o botão de submit vai traduzir o mesmo
          field.label = this.translate.instant('FORMIO.SUBMIT-BUTTON');
          // this.refreshBuilder();
        }
      });
      setTimeout(() => { this.refreshBuilder(); }, 1000);
    });
  }

  // Vai carregar os actionProperties para um dado ID de ação
  loadActionProperties() {
    return this.restFormApi.getActionProperties(sessionStorage.getItem('actionID')).subscribe((data: {}) => {
      this.ActionProps = data;
      // Vai efetuar o carregamento das validações para cada um das propriedades
      this.loadValidationConditions();
      setTimeout(() => { this.createBuilder(); }, 2500);
    });
  }

  // Vai criar o editor de formulários
  createBuilder() {
    // É obtido o utilizador que está a aceder ao formulário
    this.restFormApi.getUserAccessingForm().subscribe((data: any) => {
      const userLanguage = data.slug;
      // São definidos quais as partes do editor de formulários que não devem ser mostradas
      const componentsToHideInside = [{key: 'cloneRows', ignore: 1}, {key: 'hidden', ignore: 1}, {key: 'mask', ignore: 1}, {key: 'tableView', ignore: 1}, {key: 'disabled', ignore: 1}, {key: 'showCharCount', ignore: 1}, {key: 'showWordCount', ignore: 1}, {key: 'tabindex', ignore: 1}, {key: 'editor', ignore: 1}];
      // São definidos quais as tabs do editor de formulários que não devem ser mostradas
      const tabDefinitions = [{key: 'display', ignore: 0, components : componentsToHideInside}, {key: 'validation', ignore: 1}, {key: 'data', ignore: 1}, {key: 'conditional', ignore: 1}, {key: 'logic', ignore: 1}, {key: 'layout', ignore: 1}, {key: 'api', ignore: 1}, {key: 'provider', ignore: 1}];
      this.options = {
        builder: {
          basic: false,
          advanced: false,
          data: false,
          premium: false,
          layout: {
            components: {
              well: false,
              fieldset: false,
              content: false
            }
          }
        },
        language: userLanguage,
        i18n: formio_lang,
        editForm: {
          textfield: tabDefinitions,
          textarea: tabDefinitions,
          email: tabDefinitions,
          address: tabDefinitions,
          password: tabDefinitions,
          radio: tabDefinitions,
          select: tabDefinitions,
          number: tabDefinitions,
          currency: tabDefinitions,
          datetime: tabDefinitions,
          day: tabDefinitions,
          time: tabDefinitions,
          file: tabDefinitions,
          columns: tabDefinitions,
          panel: tabDefinitions,
          table: tabDefinitions,
          tabs: tabDefinitions,
          htmlelement: tabDefinitions
        }
      };
      // Para cada um dos actionProp, vamos criar uma "caixa" que irá conter diversos tipos de campos
      for (const property of this.ActionProps) {
        const propertyID = property.property_id;
        this.options.builder[propertyID] = {};
        this.options.builder[propertyID].title = property.property_name;
        this.options.builder[propertyID].weight = property.property_id;
        this.options.builder[propertyID].components = {};
        // Para cada tipo propriedade vão ser criados os campos
        this.defineFieldType(property);
      }
      // É efetuado o carregamento do formulário
      this.loadFormDB();
    });
  }

  // são carregadas as condições de validação para cada um dos actionProps
  loadValidationConditions() {
    // Para cada actionProp é guardado num vetor as validações
    for (const actionProp of this.ActionProps) {
      this.restValidationCondApi.getValidationConditionsFromActionProp(actionProp.action_prop_id).subscribe((data: any) => {
        this.validationConds[actionProp.action_prop_id] = data;
      });
    }
  }

  // Aqui são construidas as validações de cada propriedade com base na informação da tabela validation_cond
  createCustomValidation(property, fieldType) {
    const propertyID = property.property_id;
    const idActionProp = property.action_prop_id;
    const fieldName = property.form_field_name;

    const data = this.validationConds[idActionProp];
    // Cria o inicio da validação onde são guardadas as validações e mensagens
    let customValidation = 'let validations=[],messages=[];\nfunction myFunction(item){if(typeof item==="string"){messages.push(item)}}\n';
    this.options.builder[propertyID].components[fieldName + fieldType].schema.validate = {};
    data.forEach(validation => { // Para cada tipo de validação é efetuada a mesma ou é adicionada ao vetor de validações
      switch (validation.type) {
        case 'required':
          if (!validation.neg) {
            this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.required = true;
          }
          break;
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
        case 'minLength':
          if (!validation.neg) {
            this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.minLength = validation.param_1;
          }
          break;
        case 'maxLength':
          if (!validation.neg) {
            this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.maxLength = validation.param_1;
          }
          break;
        case 'belongsRange':
          if (!validation.neg) {
            customValidation += 'valid = (input > ' + validation.param_1 + ' && input < ' + validation.param_2 + ') ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'valid = (!(input > ' + validation.param_1 + ' && input < ' + validation.param_2 + ')) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'minWordLength':
          if (!validation.neg) {
            this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.minWords = validation.param_1;
          }
          break;
        case 'maxWordLength':
          if (!validation.neg) {
            this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.maxWords = validation.param_1;
          }
          break;
        case 'hasCharacter':
          if (!validation.neg) {
            customValidation += 'valid = (input.includes(' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'valid = (!(input.includes(' + validation.param_1 + '))) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'hasWord':
          if (!validation.neg) {
            customValidation += 'valid = (input.includes(' + validation.param_1 + ')) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'valid = (!(input.includes(' + validation.param_1 + '))) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'regExpression':
          if (!validation.neg) {
            customValidation += 'let regExpression = ' + validation.param_1 + ';\nvalid = (regExpression.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'let regExpression = ' + validation.param_1 + ';\nvalid = (!regExpression.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'isEmail' :
          if (!validation.neg) {
            customValidation += 'let regexEmail = /^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;\nvalid = (regexEmail.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'let regexEmail = /^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;\nvalid = (!regexEmail.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'isURL':
          if (!validation.neg) {
            customValidation += 'let regexEmail = /^(http:\\/\\/www\\.|https:\\/\\/www\\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/;\nvalid = (regexEmail.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          } else {
            customValidation += 'let regexEmail = /^(http:\\/\\/www\\.|https:\\/\\/www\\.|http:\\/\\/|https:\\/\\/)?[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}(:[0-9]{1,5})?(\\/.*)?$/;\nvalid = (!regexEmail.test(input)) ? true : \'' + validation.error_text + '\';\n';
            customValidation += 'validations.push(valid);\n';
          }
          break;
        case 'customValidation':
          if (!validation.neg) {
            customValidation += validation.custom_validation;
            customValidation += 'validations.push(valid);\n';
          }
          break;
      }
    });
    // No final é adicionado um ciclo for que percorre todas as validações e verifica se existem mensagens de erro a ser mostradas
    customValidation += 'validations.forEach(myFunction),0===messages.length?valid=!0:valid=messages[0];';
    // Aqui é adicionada a validação ao campo.
    this.options.builder[propertyID].components[fieldName + fieldType].schema.validate.custom = customValidation;
    // this.refreshBuilder();

  }

  // Aqui é criado um cada um dos campos, através das informações vindas da base de dados
  createBuilderField(property, fieldType, icon) {
    const propertyID = property.property_id;
    const idActionProp = property.action_prop_id;
    const propertyName = property.property_name;
    const fieldName = property.form_field_name;
    const valueTypeDB = property.value_type;
    this.options.builder[propertyID].components[fieldName + fieldType] = {};
    this.options.builder[propertyID].components[fieldName + fieldType].title = fieldType.charAt(0).toUpperCase() + fieldType.slice(1);
    this.options.builder[propertyID].components[fieldName + fieldType].icon = icon;

    this.options.builder[propertyID].components[fieldName + fieldType].schema = {};
    this.options.builder[propertyID].components[fieldName + fieldType].schema.label = propertyName;
    this.options.builder[propertyID].components[fieldName + fieldType].schema.attributes = {};
    this.options.builder[propertyID].components[fieldName + fieldType].key = propertyID + '-' + idActionProp;
    this.options.builder[propertyID].components[fieldName + fieldType].schema.attributes.propertyID = propertyID;
    this.options.builder[propertyID].components[fieldName + fieldType].schema.attributes.idActionProp = idActionProp;
    this.options.builder[propertyID].components[fieldName + fieldType].schema.type = fieldType;
    this.options.builder[propertyID].components[fieldName + fieldType].schema.input = true;

    // São criadas as validações
    this.createCustomValidation(property, fieldType);

    // Se o campo for do tipo select são carregados os valores
    if (fieldType === 'select') {
      this.options.builder[propertyID].components[fieldName + fieldType].schema.data = {};
      this.options.builder[propertyID].components[fieldName + fieldType].schema.data.values = [];
      if (valueTypeDB === 'prop_ref') {
        return this.restPropertyApi.getPropRefValues(propertyID).subscribe((data: any) => {
          this.profRefValues[propertyID] = data;
          this.options.builder[propertyID].components[fieldName + fieldType].schema.data.values = this.profRefValues[propertyID];
          // this.refreshBuilder();
        });
      } else if (valueTypeDB === 'enum') {
        return this.restPropertyApi.getPropAllowedValues(propertyID).subscribe((data: any) => {
          this.allowedValues[propertyID] = data;
          this.options.builder[propertyID].components[fieldName + fieldType].schema.data.values = this.allowedValues[propertyID];
          // this.refreshBuilder();
        });
      }

    } else if (fieldType === 'radio') { // Se o campo for do tipo radio são carregadas as validações
      this.options.builder[propertyID].components[fieldName + fieldType].schema.values = [];
      if (valueTypeDB === 'prop_ref') {
        return this.restPropertyApi.getPropRefValues(propertyID).subscribe((data: any) => {
          this.profRefValues[propertyID] = data;
          this.options.builder[propertyID].components[fieldName + fieldType].schema.values = this.profRefValues[propertyID];
          // this.refreshBuilder();
        });
      } else if (valueTypeDB === 'enum') {
        return this.restPropertyApi.getPropAllowedValues(propertyID).subscribe((data: any) => {
          this.allowedValues[propertyID] = data;
          this.options.builder[propertyID].components[fieldName + fieldType].schema.values = this.allowedValues[propertyID];
          // this.refreshBuilder();
        });
      } else if (valueTypeDB === 'bool') {
        const isTrue = this.translate.instant('FORMIO.OPTION-TRUE');
        const isFalse = this.translate.instant('FORMIO.OPTION-FALSE');
        this.options.builder[propertyID].components[fieldName + fieldType].schema.values = [{label: isTrue, value: true}, {label: isFalse, value: false}];
        // this.refreshBuilder();
      }

    }
  }

  // São definidos para cada um dos tipos de campo da DB os campos que aparecerão em cada "caixa" do editor de formulários.
  defineFieldType(property) {
    const valueTypeDB = property.value_type;
    switch (valueTypeDB) {
      case 'text': {
        this.createBuilderField(property, 'textfield', 'terminal');
        this.createBuilderField(property, 'textarea', 'terminal');
        this.createBuilderField(property, 'email', 'terminal');
        this.createBuilderField(property, 'address', 'terminal');
        this.createBuilderField(property, 'password', 'terminal');
        break;
      }
      case 'prop_ref': {
        this.createBuilderField(property, 'radio', 'terminal');
        this.createBuilderField(property, 'select', 'terminal');
        break;
      }
      case 'bool': {
        this.createBuilderField(property, 'radio', 'terminal');
        break;
      }
      case 'int': {
        this.createBuilderField(property, 'number', 'terminal');
        this.createBuilderField(property, 'currency', 'terminal');
        break;
      }
      case 'double': {
        this.createBuilderField(property, 'number', 'terminal');
        this.createBuilderField(property, 'currency', 'terminal');
        break;
      }
      case 'enum': {
        this.createBuilderField(property, 'radio', 'terminal');
        this.createBuilderField(property, 'select', 'terminal');
        break;
      }
      case 'date': {
        this.createBuilderField(property, 'datetime', 'terminal');
        this.createBuilderField(property, 'day', 'terminal');
        break;
      }
      case 'time': {
        this.createBuilderField(property, 'time', 'terminal');
        break;
      }
      case 'file': {
        this.createBuilderField(property, 'file', 'terminal');
        break;
      }
      default: {
        break;
      }
    }
  }

  onChange(event) {
      // Quando um componente é arastado e se este não for de design é feita uma inserção da tabela actionPropForm
      if (event.type === 'addComponent') {
      if (event.component.type !== 'columns' && event.component.type !== 'tabs' && event.component.type !== 'table' &&
        event.component.type !== 'panel' && event.component.type !== 'button' && event.component.type !== 'htmlelement') {
        // Vitor - So that the key returned by the submit button is the propertyId and not the label of the field
        event.component.key = event.component.attributes.propertyID;
        // End Vitor
        const idActionProp = event.component.attributes.idActionProp;
        this.actionPropFormInsert.idForm = sessionStorage.getItem('formID');
        this.actionPropFormInsert.idActionProp = idActionProp;
        // this.refreshBuilder();
        this.insertActionProp(event);
      }
    } else if (event.type === 'deleteComponent') { // Quando um componente é apagado e não é de design é feita uma remoção do mesmo da tabela actionPropForm
      if (event.component.type !== 'columns' && event.component.type !== 'tabs' && event.component.type !== 'table' && event.component.type !== 'panel' && event.component.type !== 'button' && event.component.type !== 'htmlelement') {
        this.deleteActionProp(event.component);
      } else { // Quando for um componente de design é feita uma procura recursiva pelo componente de não design
        if (event.component.type === 'columns') {
          this.searchColumns(event.component, 'delete');
        } else if (event.component.type === 'panel') {
          this.searchPanels(event.component, 'delete');
        } else if (event.component.type === 'table') {
          this.searchTables(event.component, 'delete');
        } else if (event.component.type === 'tabs') {
          this.searchTabs(event.component, 'delete');
        }
      }
    }
  }

  // Vai efetuar a inserção na tabela actionPropForm, esta inserção é feita quando um campo é arrastado para o editor de formulários
  insertActionProp(event) {
    const type = this.translate.instant('FORMIO.LABEL-TYPE');
    const name = this.translate.instant('FORMIO.LABEL-NAME');
    const propertyID = event.component.attributes.propertyID;
    this.restFormApi.insertActionPropForm(this.actionPropFormInsert).subscribe((data: any) => {
      if (data !== -1) { // Se for inserido com sucesso, guarda a chave e coloca a mensagem que o campo foi inserido
        sessionStorage.setItem('actionPropFormID', data);
        this.actionPropAssociations[event.component.key] = sessionStorage.getItem('actionPropFormID');
        delete this.options.builder[propertyID].components;
        this.options.builder[propertyID].title += ' - ( ' + type + ': ' + event.component.type + ' | ' + name + ': ' + event.component.label + ' )';
        this.refreshBuilder();
      }
    });
  }

  // Aqui é eliminado o actionPropForm referente ao componente eliminado e é novamente carregado as informaçoes na "caixa" respetiva do editor de formulários
  deleteActionProp(component) {
    const idActionPropForm = this.actionPropAssociations[component.key];
    // É feita a remoção do actionPropForm
    this.restFormApi.removeActionPropForm(idActionPropForm).subscribe((data: any) => {
      sessionStorage.setItem('deletedPropertyID', data[0].prop_id);
      // tslint:disable-next-line:max-line-length
      // É feito o carregamento da informação novamente na "caixa" do editor de formulários"
      this.restFormApi.getActionProperty(sessionStorage.getItem('actionID'), sessionStorage.getItem('deletedPropertyID')).subscribe((prop: any) => {
        const deletedProperty = prop[0];
        const deletedPropertyID = deletedProperty.property_id;
        const propertyName = deletedProperty.property_name;
        this.options.builder[deletedPropertyID] = {};
        this.options.builder[deletedPropertyID].title = propertyName;
        this.options.builder[deletedPropertyID].weight = deletedPropertyID;
        this.options.builder[deletedPropertyID].components = {};
        this.defineFieldType(deletedProperty);
        this.refreshBuilder();
      });
    });
  }

  // Função recursiva que percorre o elemento de design colunas de forma a encontrar o componente de não design, quando encontra ou remove ou adiciona o mesmo consoante o parametro passado
  searchColumns(component, choice) {
    for (const column of component.columns) {
      for (const aux_field of column.components) {
        if (aux_field.type === 'columns') {
          this.searchColumns(aux_field, choice);
        } else if (aux_field.type === 'panel') {
          this.searchPanels(aux_field, choice);
        } else if (aux_field.type === 'table') {
          this.searchTables(aux_field, choice);
        } else if (aux_field.type === 'tabs') {
          this.searchTabs(aux_field, choice);
        } else {
          if (choice === 'delete') {
            this.deleteActionProp(aux_field);
          } else if (choice === 'add') {
              const idForm = sessionStorage.getItem('formID');
              this.restFormApi.getActionPropFormFromPropID(idForm, aux_field.key).subscribe((data: any) => {
                const type = this.translate.instant('FORMIO.LABEL-TYPE');
                const name = this.translate.instant('FORMIO.LABEL-NAME');
                sessionStorage.setItem('actionPropFormID', data[0].action_prop_form_id);
                this.actionPropAssociations[aux_field.key] = sessionStorage.getItem('actionPropFormID');
                delete this.options.builder[aux_field.attributes.propertyID].components;
                setTimeout(() => {
                  this.options.builder[aux_field.attributes.propertyID].title += ' - ( ' + type + ': ' + aux_field.type + ' | ' + name + ': ' + aux_field.label + ' )';
                  this.refreshBuilder();
                }, 150);
              });
              setTimeout(() => { this.refreshBuilder(); }, 1000);
          }
        }
      }
    }
  }

  // Função recursiva que percorre o elemento de design painel de forma a encontrar o componente de não design, quando encontra ou remove ou adiciona o mesmo consoante o parametro passado
  searchPanels(component, choice) {
    for (const field of component.components) {
      if (field.type === 'panel') {
        this.searchPanels(field, choice);
      } else if (field.type === 'columns') {
        this.searchColumns(field, choice);
      } else if (field.type === 'table') {
        this.searchTables(field, choice);
      } else if (field.type === 'tabs') {
        this.searchTabs(field, choice);
      } else {
        if (choice === 'delete') {
          this.deleteActionProp(field);
        } else if (choice === 'add') {
          const idForm = sessionStorage.getItem('formID');
          this.restFormApi.getActionPropFormFromPropID(idForm, field.key).subscribe((data: any) => {
            const type = this.translate.instant('FORMIO.LABEL-TYPE');
            const name = this.translate.instant('FORMIO.LABEL-NAME');
            sessionStorage.setItem('actionPropFormID', data[0].action_prop_form_id);
            this.actionPropAssociations[field.key] = sessionStorage.getItem('actionPropFormID');
            delete this.options.builder[field.attributes.propertyID].components;
            setTimeout(() => {
              this.options.builder[field.attributes.propertyID].title += ' - ( ' + type + ': ' + field.type + ' | ' + name + ': ' + field.label + ' )';
              this.refreshBuilder();
            }, 150);
          });
          setTimeout(() => { this.refreshBuilder(); }, 1000);
        }
      }
    }
  }

  // Função recursiva que percorre o elemento de design tabs de forma a encontrar o componente de não design, quando encontra ou remove ou adiciona o mesmo consoante o parametro passado
  searchTabs(component, choice) {
    for (const tab of component.components) {
      for (const field of tab.components) {
        if (field.type === 'tabs') {
          this.searchTabs(field, choice);
        } else if (field.type === 'panel') {
          this.searchPanels(field, choice);
        } else if (field.type === 'columns') {
          this.searchColumns(field, choice);
        } else if (field.type === 'table') {
          this.searchTables(field, choice);
        } else {
          if (choice === 'delete') {
            this.deleteActionProp(field);
          } else if (choice === 'add') {
            const idForm = sessionStorage.getItem('formID');
            this.restFormApi.getActionPropFormFromPropID(idForm, field.key).subscribe((data: any) => {
              const type = this.translate.instant('FORMIO.LABEL-TYPE');
              const name = this.translate.instant('FORMIO.LABEL-NAME');
              sessionStorage.setItem('actionPropFormID', data[0].action_prop_form_id);
              this.actionPropAssociations[field.key] = sessionStorage.getItem('actionPropFormID');
              delete this.options.builder[field.attributes.propertyID].components;
              setTimeout(() => {
                this.options.builder[field.attributes.propertyID].title += ' - ( ' + type + ': ' + field.type + ' | ' + name + ': ' + field.label + ' )';
                this.refreshBuilder();
              }, 150);
            });
            setTimeout(() => { this.refreshBuilder(); }, 1000);
          }
        }
      }
    }
  }

  // Função recursiva que percorre o elemento de design table de forma a encontrar o componente de não design, quando encontra ou remove ou adiciona o mesmo consoante o parametro passado
  searchTables(component, choice) {
    for (const line of component.rows) {
      for (const column of line) {
        for (const field of column.components) {
          if (field.type === 'table') {
            this.searchTables(field, choice);
          } else if (field.type === 'panel') {
            this.searchPanels(field, choice);
          } else if (field.type === 'tabs') {
            this.searchTabs(field, choice);
          } else if (field.type === 'columns') {
            this.searchColumns(field, choice);
          } else {
            if (choice === 'delete') {
              this.deleteActionProp(field);
            } else if (choice === 'add') {
              const idForm = sessionStorage.getItem('formID');
              this.restFormApi.getActionPropFormFromPropID(idForm, field.key).subscribe((data: any) => {
                const type = this.translate.instant('FORMIO.LABEL-TYPE');
                const name = this.translate.instant('FORMIO.LABEL-NAME');
                sessionStorage.setItem('actionPropFormID', data[0].action_prop_form_id);
                this.actionPropAssociations[field.key] = sessionStorage.getItem('actionPropFormID');
                delete this.options.builder[field.attributes.propertyID].components;
                setTimeout(() => {
                  this.options.builder[field.attributes.propertyID].title += ' - ( ' + type + ': ' + field.type + ' | ' + name + ': ' + field.label + ' )';
                  this.refreshBuilder();
                }, 150);
              });
              setTimeout(() => { this.refreshBuilder(); }, 1000);
            }
          }
        }
      }
    }
  }

  // Função que atualiza o builder e força o mesmo a voltar a ser rederizado
  refreshBuilder() {
    setTimeout(() => { this.needUpdate = false; }, 5);
    setTimeout(() => { this.needUpdate = true; }, 5);
  }

  // Função que permite salvar o formulário quando todos os campos tiverem sido colocados
  saveForm() {
    let canSave = true;
    for (const property of this.ActionProps) { // Se algum dos campos não tiver sido colocado, o canSave é dado como false
      if (this.options.builder[property.property_id].components !== undefined) {
        canSave = false;
      }
    }

    if (canSave) { // Se for possível salvar o JSON do formulário é atualizado na base de dados
      if (window.confirm(this.translate.instant('FORMIO.ASK-YOUSURE'))) {
        this.sendRequest.json = JSON.stringify(this.myForm, null, 4);
        this.sendRequest.id = sessionStorage.getItem('formID');
        this.restFormApi.addJSONForm(this.sendRequest).subscribe((data: any) => {
          this.alertToast.showSuccess(this.translate.instant('FORMIO.ERROR-SUCCESS'));
          this.router.navigate(['/formsManagement']);
        });
      }
    } else { // Caso contrário é mostrado um erro
      this.alertToast.showError(this.translate.instant('FORMIO.ERROR-INSERTALLFIELDS'));
    }
  }

}
