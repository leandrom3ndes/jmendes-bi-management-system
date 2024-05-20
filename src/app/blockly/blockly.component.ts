import {Component, NgZone, OnDestroy, OnInit} from '@angular/core';
import {BlocklyApiService} from '../shared/rest-api/blockly-api.service';
import * as xml2js from 'xml2js';
import {ActionRule} from '../shared/interfaces/action_rule.model';
import {Action} from '../shared/interfaces/action.model';
import {Property} from '../shared/interfaces/property.model';
import {ConstantDB} from '../shared/interfaces/constant.model';
import {ValueTerm} from '../shared/interfaces/value_term.model';
import {PropertyValue} from '../shared/interfaces/property_value.model';
import {ComputeExpression} from '../shared/interfaces/compute_expression.model';
import {Query} from '../shared/interfaces/query.model';
import {Template} from '../shared/interfaces/template.model';
import {CompEvaluatedExpression} from '../shared/interfaces/comp_evaluated_expression.model';
import {Condition} from '../shared/interfaces/condition.model';
import {UserEvaluatedExpression} from '../shared/interfaces/user_evaluated_expression.model';
import {ValidationCondition} from '../shared/interfaces/validation_condition.model';
import {FormCompute} from '../shared/interfaces/form_compute.model';

import {TranslateService} from 'node_modules/@ngx-translate/core';
import {ModalBlocklyComponent} from '../modal-blockly/modal-blockly.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {Token} from '../shared/rest-api/token';

import {AlertToastService} from '../shared/common/alert-toast.service';
import {ModalTemplateEditorComponent} from '../modal-template-editor/modal-template-editor.component';


declare var window: MyWindow;
declare var Blockly: any;

declare const customBlocks: any;

@Component({
  selector: 'app-blockly',
  templateUrl: './blockly.component.html',
  styleUrls: ['./blockly.component.css'],
  providers: [ModalBlocklyComponent]
})
export class BlocklyComponent implements OnInit, OnDestroy {

  workspace: any;
  public count = 0;
  public TransactionTypes: any = [];
  public TransactionStates: any = [];
  public EntTypes: any = [];
  public Templates: any = [];
  public UserEvaluatedExpressions: any = [];
  public Queries: any = [];
  public Constants: any = [];
  public Properties: any = [];
  public FkPropertyValues: any = [];
  public PropAllowedValues: any = [];
  public xmlToLoad: any;

  constructor( private modalService: BsModalService,
               private alertToast: AlertToastService,
               private modal: ModalBlocklyComponent,
               public restBlocklyApi: BlocklyApiService,
               public translate: TranslateService,
               private ngZone: NgZone) {  }

  ngOnInit() {
    this.workspace = Blockly.inject('blocklyDiv', {
      toolbox: document.getElementById('toolbox'),
      collapse : true,
      comments : true,
      disable : true,
      maxBlocks : Infinity,
      trashcan : true,
      horizontalLayout : false,
      toolboxPosition : 'start',
      css : true,
      media : 'https://blockly-demo.appspot.com/static/media/',
      rtl : false,
      scrollbars : true,
      sounds : true,
      oneBasedIndex : true,
      move: {
        scrollbars: true,
        drag: true,
        wheel: true}
    });
    const languageSlug = Token.getTokenLanguage();
    // console.log('blockly slug' + languageSlug);
    this.translate.use(languageSlug);
    this.loadDatabaseResources();
    // So we can call this component from the FieldButton definition
    window.my = window.my || {};
    window.my.namespace = window.my.namespace || {};
    window.my.namespace.publicFunc = this.publicFunc.bind(this);
    window.my.namespace.translator = () => this.translate;
  }

  ngOnDestroy() {
    window.my.namespace.publicFunc = null;
    window.my.namespace.translator = null;
  }

  publicFunc(block, blockTemplate) {
    this.ngZone.run(() => this.privateFunc(block, blockTemplate));
  }

  // Open Template Editor from Blockly blocks
  privateFunc(block, blockTemplate) {
    // console.log('Source Block Blockly Component');
    // console.log(block);
    // console.log(blockTemplate);
    this.openTemplateEditorModal({
      from: 'blockly', blockTemplate
      }, block);
  }

  // Open the template editor modal when it's requested from an 'action->user_output' block
  openTemplateEditorModal(params = {}, block) {
    const modalRef = this.modalService.show(ModalTemplateEditorComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry) {
        // console.log('VALUES RECEIVED FROM MODAL: ');
        // console.log(receivedEntry);
        // Get the template info inserted in the Template Editor and update the block's fields
        if (receivedEntry.name) {
          block.setFieldValue(receivedEntry.name, 'template_name');
        }
        block.setFieldValue(this.translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TEXT-NOT-EDITABLE'), 'template_text');
        block.getField('template_text').EDITABLE = false;
        block.template_editor_text_ = receivedEntry.text;

        // Update the option in the type dropdown and validate (update the block's fields) such type
        block.getField('template_type').validator_(receivedEntry.type.toUpperCase());
        block.setFieldValue(receivedEntry.type.toUpperCase(), 'template_type');
        // Depending on what template type comes from the Editor, fill the rest of the corresponding fields
        if (receivedEntry.type === 'modal') {
          block.setFieldValue(receivedEntry.header, 'template_header');
          block.setFieldValue(receivedEntry.button, 'template_button');
        } else if (receivedEntry.type === 'toast') {
          // Update the class dropdown and validate (update the block's fields) if the class is custom
          block.getField('template_class').validator_(receivedEntry.class.toUpperCase());
          block.setFieldValue(receivedEntry.class.toUpperCase(), 'template_class');
          if (receivedEntry.class === 'custom') {
            block.setFieldValue(receivedEntry.colour, 'template_colour');
            block.setFieldValue(receivedEntry.title, 'template_title');
          }
        }
        this.alertToast.showSuccess(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.SUCCESS.LOAD-TEMPLATE-IN-BLOCK'));
      }
    });
  }

  openModal(params = {}) {
    const modalRef = this.modalService.show(ModalBlocklyComponent, {class: 'modal-lg', initialState: params});
    modalRef.content.passEntry.subscribe((receivedEntry) => {
      if (receivedEntry) {
        this.xmlToLoad = receivedEntry;
        console.log(this.xmlToLoad);
        try {
          this.loadXmlCode(this.xmlToLoad);
          this.alertToast.showSuccess(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.SUCCESS.LOAD-XML'));
        } catch (e) {
          console.log(e);
          this.alertToast.showError(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.ERROR.LOAD-XML'));
        }
      }
    });
  }

  public loadTransactionTypes() {
    return this.restBlocklyApi.getTransactionTypes().subscribe((data: {}) => {
        this.TransactionTypes = data;
    });
  }

  public loadTransactionStates() {
    return this.restBlocklyApi.getTransactionStates().subscribe((data: {}) => {
      this.TransactionStates = data;
    });
  }

  public loadTemplates() {
    return this.restBlocklyApi.getTemplates().subscribe((data: {}) => {
      this.Templates = data;
    });
  }

  public loadUserEvaluatedExpressions() {
    return this.restBlocklyApi.getUserEvaluatedExpressions().subscribe((data: {}) => {
      this.UserEvaluatedExpressions = data;
    });
  }

  public loadQueries() {
    return this.restBlocklyApi.getQueries().subscribe((data: {}) => {
      this.Queries = data;
    });
  }

  public loadConstants() {
    return this.restBlocklyApi.getConstants().subscribe((data: {}) => {
      this.Constants = data;
    });
  }

  public loadAllProperties() {
    return this.restBlocklyApi.getAllProperties().subscribe((data: {}) => {
      this.Properties = data;
    });
  }

  public loadAllFkPropertyValues() {
    return this.restBlocklyApi.getAllFkPropertyValues().subscribe((data: {}) => {
      this.FkPropertyValues = data;
    });
  }

  public loadAllPropAllowedValues() {
    return this.restBlocklyApi.getAllPropAllowedValues().subscribe((data: {}) => {
      this.PropAllowedValues = data;
    });
  }

  public loadEntTypes() {
    return this.restBlocklyApi.getEntTypes().subscribe((data: {}) => {
      this.EntTypes = data;
      // Must be in the last DB function to be called in loadDataResources
      // It's here so we wait that it gets the data and only then call this function
      customBlocks(this.restBlocklyApi,
        this.translate,
        this.workspace,
        this.TransactionTypes,
        this.TransactionStates,
        this.EntTypes,
        this.Templates,
        this.UserEvaluatedExpressions,
        this.Queries,
        this.Constants,
        this.Properties,
        this.FkPropertyValues,
        this.PropAllowedValues);
    });
  }

  public storeActionRule(actionRule) {
    return this.restBlocklyApi.storeActionRule(actionRule).subscribe((data: {}) => {
      if (data) {
        this.alertToast.showSuccess(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.SUCCESS.SAVE-AR'));
      } else {
        this.alertToast.showError(this.translate.instant('BLOCKLY-ACTIONS-NOTIFICATIONS.ERROR.SAVE-AR'));
      }
    });
  }

  // Need to be careful because as it is asynchronous, it doesn't wait for the data loading to call customBlocks()

  public loadDatabaseResources() {
    this.loadTransactionTypes();
    this.loadTransactionStates();
    this.loadTemplates();
    this.loadUserEvaluatedExpressions();
    this.loadQueries();
    this.loadConstants();
    this.loadAllProperties();
    this.loadAllFkPropertyValues();
    this.loadAllPropAllowedValues();
    this.loadEntTypes();
  }

  public showCode() {
    const code = Blockly.JavaScript.workspaceToCode(this.workspace);
    console.log(code);
    window.alert(code);
    return code;
  }

  public getXmlCode() {
    const domWorkspace = Blockly.Xml.workspaceToDom(this.workspace);
    return Blockly.Xml.domToText(domWorkspace);
  }

  public showXmlCode() {
    console.log(this.getXmlCode());
    window.alert(this.getXmlCode());
  }

  public loadXmlCode(xml) {
    const dom = Blockly.Xml.textToDom(xml);
    this.workspace.clear();
    console.log(dom);
    Blockly.Xml.domToWorkspace(dom, this.workspace);
  }

  private saveWorkspaceSVG() {
        const workspace = Blockly.getMainWorkspace();
        const svgBlock = workspace.svgBlockCanvas_.cloneNode(true);
        svgBlock.removeAttribute('width');
        svgBlock.removeAttribute('height');
        if (svgBlock.children[0] !== undefined) {
            svgBlock.removeAttribute('transform');
            svgBlock.children[0].removeAttribute('transform');
            svgBlock.children[0].children[0].removeAttribute('transform');
            const linkElm = document.createElementNS('http://www.w3.org/1999/xhtml', 'style');
            linkElm.textContent = Blockly.Css.CONTENT.join('') + '\n\n';
            svgBlock.insertBefore(linkElm, svgBlock.firstChild);
            // @ts-ignore
            const bbox = document.getElementsByClassName('blocklyBlockCanvas')[0].getBBox();
            let xml = new XMLSerializer().serializeToString(svgBlock);
            // tslint:disable-next-line:max-line-length
            xml = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="' + bbox.width + '" height="' + bbox.height + '" viewBox="0 0 ' + bbox.width + ' ' + bbox.height + '"><rect width="100%" height="100%" fill="white"></rect>' + xml + '</svg>';
            return 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(xml)));
        }
        return null;
    }

  public parserXML() {

    let parsedResult;

    const blocklyCode = Blockly.JavaScript.workspaceToCode(this.workspace);
    const blocklyXML = this.getXmlCode();

    const XML = '<xml>' + blocklyCode + '</xml>';

    // Does the XML Parsing and stores the result in parsedResult
    // tslint:disable-next-line:only-arrow-functions
    xml2js.parseString(XML, {trim: true}, function(err, result) {
      if ( err ) { console.log(err); }
      parsedResult = result.xml;
    });

    console.log('PARSING RESULT:');
    console.log(parsedResult);

    const actionRule = {} as ActionRule;

    actionRule.blockly_code = JSON.stringify(blocklyCode);

    // Contains the transaction_type and transaction_state id's. For example: WHEN '1' is '2'
    const transactions = parsedResult._;
    // To isolate the numbers of the string above (Transaction_type and transaction_state)
    const transNumbers = transactions.match(/\d+/g);
    const transactionType = transNumbers[0];
    const transactionState = transNumbers[1];
    // console.log('Transaction_Type: ' + transNumbers[0]);
    // console.log('Transaction_State: ' + transNumbers[1]);

    actionRule.transaction_type_id = transactionType;
    actionRule.t_state_id = transactionState;

    // Gets the actions in the action rule
    const actions = parsedResult.action;
    // console.log('ACTIONS: ');
    // console.log(actions);

    // If there are any actions directly assigned to the 'when_is' block, store them in the AR object
    if (actions) {
      actionRule.actions = [];
      this.dealActions(actionRule.actions, null, actions, blocklyXML);
    }

    actionRule.blockly_xml = blocklyXML;
    actionRule.preview = this.saveWorkspaceSVG();
    console.log('ACTION RULE: ');
    console.log(actionRule);

    // Store the AR in the DB
    this.storeActionRule(actionRule);
  }

  public dealActions(parentComponent, ifType, actions, blocklyXML) {
    for (const actionBlockly of actions) {
      console.log('ACTION:');
      console.log(actionBlockly);
      const actionAdd = {} as Action;
      // Action type of the current action(ex: assign_expression)
      actionAdd.type = actionBlockly.type[0].toLowerCase();
      // console.log('action type: ' + actionAdd.type);

      if (actionAdd.type === 'causal_link') {

        // console.log('TRANS TYPE VALUE: ' + actionBlockly.transaction_type[0].value[0]);
        // console.log('TRANS STATE VALUE: ' +  actionBlockly.transaction_state[0].value[0]);
        // console.log('MIN VALUE: ' +  actionBlockly.min[0]);
        // console.log('MAX VALUE: ' +  actionBlockly.max[0]);
        // Get the caused action, min and max for this causal link action
        actionAdd.caused_action_trans_type_id = actionBlockly.transaction_type[0].value[0];
        actionAdd.caused_action_t_state_id = actionBlockly.transaction_state[0].value[0];
        actionAdd.min = actionBlockly.min[0];
        actionAdd.max = actionBlockly.max[0];

      } else if (actionAdd.type === 'assign_expression') {

        const leftProperty = {} as Property;
        let rightTerm = null;
        // console.log('LEFT PROPERTY: ' + actionBlockly.first_term[0].property[0].value[0]);
        // Get the property inserted in the first input (left side) of the assign expression action
        leftProperty.id = actionBlockly.first_term[0].property[0].value[0];
        actionAdd.left_property = leftProperty;
        // console.log('RIGHT TERM: ');
        // Get the input inserted in the second input of the block, whether it is a property/property_value/
        // compute_expression/query/constant or value or a nesting of compute_expressions, check what type it is,
        // and add it correctly as objects into the action object
        rightTerm = actionBlockly.second_term[0];
        // console.log(rightTerm);
        this.figureTermType(rightTerm, actionAdd, null, null);

      }  else if (actionAdd.type === 'user_output') {

        // console.log('USER_OUTPUT:');
        // console.log(actionBlockly);
        const template = {} as Template;
        if (actionBlockly.new_template) {
          const templateBlockly = actionBlockly.new_template[0];
          template.name = templateBlockly.name[0];
          template.type = templateBlockly.type[0].toLowerCase();
          // console.log('NEW TEMPLATE');
          // Check whether the text is a js object (contains HTML) or simple text and act accordingly
          template.openedEditor = templateBlockly.openedEditor[0];
          if (typeof templateBlockly.text[0] === 'string') {
            template.text = templateBlockly.text[0];
            template.hasHTML = 'hasNormalText';
          } else {
            // Save the template HTML text in localStorage, if we get it directly, it will be parsed alongside the XML
            // Guarantees that HTML saved is the one entered and not the one parsed that would have to be assembled and could have problems
            template.text = localStorage.getItem('templateText' + templateBlockly.blockId[0]);
            template.hasHTML = 'hasHTMLText';
          }
          console.log(template.hasHTML);
          console.log(template.openedEditor);
          localStorage.removeItem('templateText' + templateBlockly.blockId[0]);
          // If template is of type modal, save the header and button text info
          if (template.type === 'modal') {
            template.header = templateBlockly.header[0];
            template.button = templateBlockly.button[0];
          } else if (template.type === 'toast') {
            // If template is of type toast, save the class info
            template.class = templateBlockly.class[0].toLowerCase();
            // If class is custom toast, save the custom colour and toast title info
            if (template.class === 'custom') {
              template.colour = templateBlockly.colour[0];
              template.title = templateBlockly.title[0];
            }
          }
        } else {
          // console.log('EXISTING TEMPLATE');
          // Get the existing template id
          template.id = actionBlockly.existing_template[0].value[0];
        }
        actionAdd.template = template;

      } else if (actionAdd.type === 'user_input') {

        // Initialize the array so we can push objects onto it later
        actionAdd.properties = [];
        // console.log('USER_INPUT:');
        // console.log(actionBlockly);
        // Get the properties inside the user input block
        actionAdd.name = actionBlockly.action_name[0];
        const properties = actionBlockly.properties[0].property_userInput;
        for (const property of properties) {
          // console.log('PROPERTY:');
          // console.log(property);
          const propertyUserInput = {} as Property;
          // Get the property info(id, scope) and check if it has a form_compute/enable condition/validation conditions
          const propertyInfo = property.property[0];
          const hasFormCompute = property.form_compute;
          const hasEnableCondition = property.enable_condition;
          const hasValidationConditions = property.validation_condition;
          let mandatory = property.mandatory[0].toLowerCase();
          if (mandatory === 'true') {
            mandatory = 1;
          } else {
            mandatory = 0;
          }
          propertyUserInput.id = propertyInfo.value[0];
          propertyUserInput.scope = propertyInfo.scope[0];
          propertyUserInput.mandatory = mandatory;

          if (hasFormCompute) {
            // Initialize a form compute object to add the json Logic, and get the form compute from the block
            const formComputeObject = {} as FormCompute;
            const formCompute = hasFormCompute[0];
            // console.log('FORM COMPUTE');
            // console.log(formCompute);
            // Passing the form compute as a whole (operator + terms), get the json logic string
            const jsonLogic = this.getJsonLogicFormCompute(formCompute, '');
            console.log('JSON LOGIC:');
            console.log(jsonLogic);
            // Add the json logic to the form compute object
            formComputeObject.json_logic = jsonLogic;
            // Assign the form compute object filled correctly to the form compute field of the property object
            propertyUserInput.form_compute = formComputeObject;
          }

          if (hasEnableCondition) {
            // Initialize a condition object to add the components, and get the enable condition from the block
            const enableConditionUserInput = {} as Condition;
            const enableCondition = hasEnableCondition[0].condition[0];
            // console.log('Enable Condition:');
            // console.log(enableCondition);
            // Get condition type (AND or OR or ISTRUE or NOT) and terms
            enableConditionUserInput.type = enableCondition.type[0].toLowerCase();
            const enableConditionTerms = enableCondition.terms[0];
            // console.log(enableConditionType);
            // console.log(enableConditionTerms);
            // Check what terms the condition has and add them to the enable condition object
            this.figureConditionTermTypes(enableConditionTerms, enableConditionUserInput);
            // Assign the enable condition object filled correctly to the enable condition field of the property object
            propertyUserInput.enable_condition = enableConditionUserInput;
          }

          if (hasValidationConditions) {
            propertyUserInput.validation_conditions = [];
            const validationConditions = hasValidationConditions[0].condition_validation_condition;
            for (const validationCondition of validationConditions) {
              const validationConditionObject = {} as ValidationCondition;
              // Get the validation condition type - 'REQUIRED', 'IS_NUMBER'...
              const validationConditionType = validationCondition.dropdown_type[0];
              // Transforms the ALL CAPS type received from XML to accepted validation condition type in the DB
              validationConditionObject.type = this.transformValidationConditionType(validationConditionType);
              // See if negation is true or false and transform it into binary - as it is stored in the DB
              const negation = validationCondition.negation[0];
              if (negation === 'TRUE') {
                validationConditionObject.negative = 1;
              } else {
                validationConditionObject.negative = 0;
              }
              // Get the extra fields values if they are present (custom validation text, param1 and param2)
              if (validationConditionObject.type === 'customValidation') {
                validationConditionObject.custom_validation = validationCondition.term1[0];
              } else if (validationCondition.term1[0] !== 'null') {
                validationConditionObject.param_1 = validationCondition.term1[0];
                if (validationCondition.term2[0] !== 'null') {
                  validationConditionObject.param_2 = validationCondition.term2[0];
                }
              }
              // Get the template info associated to user_output in this validation condition
              const templateObject = {} as Template;
              const hasExistingTemplate = validationCondition.existing_template;
              if (hasExistingTemplate) {
                templateObject.id = hasExistingTemplate[0].value[0];
              } else {
                templateObject.text = validationCondition.new_template[0].text[0];
              }
              validationConditionObject.template = templateObject;
              // console.log('VALIDATION CONDITION:');
              // console.log(validationConditionObject);
              // Assign the validation condition object filled correctly to the validation condition array of the property object
              propertyUserInput.validation_conditions.push(validationConditionObject);
            }
          }
          // Add the property (with all its info) to the user_input action
          actionAdd.properties.push(propertyUserInput);
        }

      } else if (actionAdd.type === 'if') {

        // elseAction starts as null as it is optional
        let elseAction = null;
        // Get the ifCondition and thenAction from block statementInputs
        const ifCondition = actionBlockly.ifCondition[0].condition[0];
        const thenAction = actionBlockly.thenAction[0].action;
        // Check is elseAction statementInput is present on block
        const hasElseAction = actionBlockly.elseAction;
        // If elseAction statementInput is present on block, get the corresponding action inserted
        if (hasElseAction) {
          elseAction = hasElseAction[0].action;
        }
        // Initialize a condition object to store the condition present in the if statementInput
        const ifConditionObject = {} as Condition;
        // Get the condition type to be stored
        ifConditionObject.type = ifCondition.type[0].toLowerCase();
        // Get the condition terms to be analysed and then added to the object
        const ifConditionTerms = ifCondition.terms[0];
        this.figureConditionTermTypes(ifConditionTerms, ifConditionObject);
        // Store the condition object correctly filled to the current Action object
        actionAdd.ifCondition = ifConditionObject;
        // Store the action present in the 'then' statementInput in the current Action
        actionAdd.thenAction = [];
        this.dealActions(actionAdd.thenAction, 'ifThen', thenAction, blocklyXML);
        // As the else part of block is optional, we only add the action if they are present
        if (elseAction) {
          actionAdd.elseAction = [];
          this.dealActions(actionAdd.elseAction, 'ifElse', elseAction, blocklyXML);
        }

      } else if (actionAdd.type === 'while') {

        // Get the inputs in the 'while' and 'do' statementInputs
        const whileCondition = actionBlockly.whileCondition[0].condition[0];
        const doAction = actionBlockly.doAction[0].action;
        // Initialize a condition object to store the condition in the 'while' statementInput
        const whileConditionObject = {} as Condition;
        // Store the condition type on the object
        whileConditionObject.type = whileCondition.type[0];
        // Get the condition terms and store them accordingly to the condition object
        const whileConditionTerms = whileCondition.terms[0];
        this.figureConditionTermTypes(whileConditionTerms, whileConditionObject);
        // Add the statementInput corresponding condition to the Action Object
        actionAdd.whileCondition = whileConditionObject;
        // Store the action present in the 'do' statementInput in the current Action
        actionAdd.doAction = [];
        this.dealActions(actionAdd.doAction, 'whileDo', doAction, blocklyXML);
      }

      // console.log(actionAdd);
      // Add the action to the action array in the parentComponent object
      parentComponent.push(actionAdd);
    }
  }

  // Get the form compute object and transform it into json logic string
  public getJsonLogicFormCompute(formCompute, jsonLogic) {
    // JSON LOGIC example - logic = {"+":[1,{"var":"1"}, {"*":[3,{"var":"1"}]}]}
    // Should be called later as:
    // jsonLogic.apply(
    //   logic, // Logic
    //   { "1": 7}   // Data
    // );
    const operator = formCompute.operator[0];
    const formComputeOperator = this.transformOperatorToSymbol(operator);
    const formComputeTerms = formCompute.term;
    // console.log('FORM COMPUTE INFO');
    // console.log(formComputeTerms);
    // console.log(formComputeOperator);
    let iterations = formComputeTerms.length;
    jsonLogic += '{"' + formComputeOperator + '":[';
    for (const formComputeTerm of formComputeTerms) {
      const isProperty = formComputeTerm.property;
      const isFormCompute = formComputeTerm.form_compute;
      if (isProperty) {
        // console.log('IT\'S A PROPERTY.');
        const propertyId = isProperty[0].value[0];
        jsonLogic += '{"var":"' + propertyId + '"}';
      } else if (isFormCompute) {
        // console.log('IT\'S A FORM COMPUTE.');
        jsonLogic = this.getJsonLogicFormCompute(isFormCompute[0], jsonLogic);
      } else {
        // console.log('IT\'S A NUMBER.');
        jsonLogic += formComputeTerm;
      }
      // Check if this is the last iteration of the terms, as thw ',' won't be needed here
      if (--iterations) {
        jsonLogic += ',';
      }
    }
    jsonLogic += ']}';
    return jsonLogic;
  }

  // Get the form compute/compute expression operator as a string and return the corresponding correct symbol to be used
  public transformOperatorToSymbol(operator) {
    switch (operator) {
      case 'MULTIPLY':
        return '*';
      case 'ADD':
        return '+';
      case 'MINUS':
        return '-';
      case 'DIVIDE':
        return '/';
      case 'POWER':
        return '^';
      default:
        console.log('Error transforming the form compute operator!');
        break;
    }
  }

  // Transforms the ALL CAPS type received from XML to accepted validation condition type in the DB
  public transformValidationConditionType(type) {
    // 'required','isNumber','isInteger','equalTo','maxWordLength','lessEqual',
    // 'higherEqual','higherThan','lessThan','minLength','belongsRange','maxLength','minWordLength','hasCharacter',
    // 'regExpression','hasWord','isEmail','isURL','customValidation'
    switch (type) {
      case 'REQUIRED':
        return 'required';
      case 'IS_NUMBER':
        return 'isNumber';
      case 'IS_INTEGER':
        return 'isInteger';
      case 'EQUAL_TO':
        return 'equalTo';
      case 'MAX_WORD_LENGTH':
        return 'maxWordLength';
      case 'LESS_EQUAL':
        return 'lessEqual';
      case 'HIGHER_EQUAL':
        return 'higherEqual';
      case 'HIGHER_THAN':
        return 'higherThan';
      case 'LESS_THAN':
        return 'lessThan';
      case 'MIN_LENGTH':
        return 'minLength';
      case 'BELONGS_RANGE':
        return 'belongsRange';
      case 'MAX_LENGTH':
        return 'maxLength';
      case 'MIN_WORD_LENGTH':
        return 'minWordLength';
      case 'HAS_CHARACTER':
        return 'hasCharacter';
      case 'REG_EXPRESSION':
        return 'regExpression';
      case 'HAS_WORD':
        return 'hasWord';
      case 'IS_EMAIL':
        return 'isEmail';
      case 'IS_URL':
        return 'isURL';
      case 'CUSTOM_VALIDATION':
        return 'customValidation';
      default:
        console.log('Invalid validation condition type!');
        break;
    }
  }

  // Get the terms presented in a condition block, check what tpe they are and act accordingly
  public figureConditionTermTypes(conditionTerms, parentComponentToAdd) {
    // Check if condition has comp_evaluated_expression terms and add them to parentComponent object
    const hasCompEvaluatedExpressions = conditionTerms.comp_evaluated_expression;
    if (hasCompEvaluatedExpressions) {
      // The array needs to be initialized so we can push objects onto it later
      parentComponentToAdd.comp_evaluated_expressions = [];
      for (const compEvaluatedExpression of hasCompEvaluatedExpressions) {
        const compEvaluatedExpressionObject = {} as CompEvaluatedExpression;
        // console.log('CONDITION_TERM:');
        // console.log(compEvaluatedExpression);
        this.dealConditionTerm('comp_evaluated_expression', compEvaluatedExpression, compEvaluatedExpressionObject);
        parentComponentToAdd.comp_evaluated_expressions.push(compEvaluatedExpressionObject);
      }
    }
    // Check if condition has user_evaluated_expression terms and add them to parentComponent object
    const hasUserEvaluatedExpressions = conditionTerms.user_evaluated_expression;
    if (hasUserEvaluatedExpressions) {
      // The array needs to be initialized so we can push objects onto it later
      parentComponentToAdd.user_evaluated_expressions = [];
      for (const userEvaluatedExpression of hasUserEvaluatedExpressions) {
        const userEvaluatedExpressionObject = {} as UserEvaluatedExpression;
        this.dealConditionTerm('user_evaluated_expression', userEvaluatedExpression, userEvaluatedExpressionObject);
        parentComponentToAdd.user_evaluated_expressions.push(userEvaluatedExpressionObject);
      }
    }
    // Check if condition has nested condition terms and add them to parentComponent object
    const hasConditions = conditionTerms.condition;
    if (hasConditions) {
      // The array needs to be initialized so we can push objects onto it later
      parentComponentToAdd.conditions = [];
      for (const condition of hasConditions) {
        const conditionObject = {} as Condition;
        this.dealConditionTerm('condition', condition, conditionObject);
        parentComponentToAdd.conditions.push(conditionObject);
      }
    }
  }

  // Depending on what type condition term is, act accordingly - used when condition blocks are used
  public dealConditionTerm(type, term, parentComponentToAdd) {
    if (type === 'comp_evaluated_expression') {
      const leftTerm = term.left_term[0];
      let operator = term.operator[0];
      if (operator === 'LESSTHAN') {
        operator = '<';
      } else if (operator === 'GREATERTHAN') {
        operator = '>';
      }
      const rightTerm = term.right_term[0];
      parentComponentToAdd.logical_operator = operator;
      this.figureTermType(leftTerm, parentComponentToAdd, null, 'left');
      this.figureTermType(rightTerm, parentComponentToAdd, null, 'right');
    } else if (type === 'user_evaluated_expression') {
      // If user_evaluated_expression is an existing expression
      if (term.existing_expression) {
        // console.log(term.existing_expression);
        parentComponentToAdd.type = 'existingExpression';
        parentComponentToAdd.id = term.existing_expression[0].value[0];
      } else {
        // If user_evaluated_expression is a new expression
        // console.log(term.new_expression);
        parentComponentToAdd.type = 'newExpression';
        parentComponentToAdd.expression_text = term.new_expression[0].text[0];
      }
    } else if (type === 'condition') {
      // console.log('CONDITION:');
      // console.log(term);
      parentComponentToAdd.type = term.type[0]; // Get condition type (AND or OR or ISTRUE or NOT)
      this.figureConditionTermTypes(term.terms[0], parentComponentToAdd);
    }
  }

  // See what type term is and act accordingly - used by assign expression, compute_expression & comp_evaluated_expression
  public figureTermType(term, parentComponentToAdd, order, leftOrRightTerm) {
    // Check what block is attached to second_term and act accordingly
    if (term.constant) {
      // console.log('é constant');
      const constant = {} as ConstantDB;
      // console.log(rightTerm.constant);
      const constantBlock = term.constant[0];
      // Check if user wants to create constant or use existing one
      if (constantBlock.new_constant) {
        // If user wants to create constant, we get the name, value type and value of the new constant
        // console.log('Wants new constant');
        const newConstant = constantBlock.new_constant[0];
        constant.type = 'newConstant';
        constant.name = newConstant.name[0];
        constant.value_type = newConstant.value_type[0].toLowerCase();
        constant.value = newConstant.value[0];
        // console.log('New constant: ');
        // console.log(constant);
      } else {
        // If user wants to use existing constant, we only need the constant id
        // console.log('Wants existing constant');
        const existingConstant = constantBlock.existing_constant[0];
        constant.type = 'existingConstant';
        constant.constant_id = existingConstant.value[0];
        // console.log('Existing Constant: ');
        // console.log(constant);
      }
      // in case parentComponent is an action (of type assign expression)
      if (parentComponentToAdd.type) {
        parentComponentToAdd.constant_term = constant;
      } else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.constant_term_1 = constant;
        } else {
          parentComponentToAdd.constant_term_2 = constant;
        }
      } else {
        // In case parentComponent is a compute_expression
        // Initialize the array to be used if it hasn't been used yet
        if (!parentComponentToAdd.constant_term) {
          parentComponentToAdd.constant_term = [];
        }
        constant.order = order;
        const isQueryTerm = term.property_id;
        if (isQueryTerm) {
          constant.propertyIdQueryTerm = term.property_id[0];
        }
        parentComponentToAdd.constant_term.push(constant);
      }

    } else if (term.value) {
      // Get the inserted value type and value by user
      // console.log('é value');
      const newValue = {} as ValueTerm;
      // console.log(rightTerm.value);
      const valueBlock = term.value[0];
      newValue.value_type = valueBlock.value_type[0].toLowerCase();
      newValue.value = valueBlock.value[0];
      // console.log('New value:');
      // console.log(newValue);
      // in case parentComponent is an action (assign expression)
      if (parentComponentToAdd.type) {
        parentComponentToAdd.value_term = newValue;
      } else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.value_term_1 = newValue;
        } else {
          parentComponentToAdd.value_term_2 = newValue;
        }
      } else {
        // in case parentComponent is a compute expression
        // Initialize the array to be used if it hasn't been used yet
        if (!parentComponentToAdd.value_term) {
          parentComponentToAdd.value_term = [];
        }
        newValue.order = order;
        const isQueryTerm = term.property_id;
        if (isQueryTerm) {
          newValue.propertyIdQueryTerm = term.property_id[0];
        }
        parentComponentToAdd.value_term.push(newValue);
      }

    } else if (term.property) {
      // Get the id of the chosen property
      // console.log('é property');
      const property = {} as Property;
      // console.log(rightTerm.property);
      const propertyBlock = term.property[0];
      property.id = propertyBlock.value[0];
      // console.log('Chosen Property:');
      // console.log(property);
      // in case parentComponent is an action (assign expression
      if (parentComponentToAdd.type) {
        parentComponentToAdd.property_term = property;
      }  else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.property_term_1 = property;
        } else {
          parentComponentToAdd.property_term_2 = property;
        }
      } else {
        // In case parentComponent is a compute_expression
        // Initialize the array to be used if it hasn't been used yet
        if (!parentComponentToAdd.property_term) {
          parentComponentToAdd.property_term = [];
        }
        property.order = order;
        const isQueryTerm = term.property_id;
        if (isQueryTerm) {
          property.propertyIdQueryTerm = term.property_id[0];
        }
        parentComponentToAdd.property_term.push(property);
      }

    } else if (term.property_value) {
      // Get the id of the chosen property value
      // console.log('é propertyValue');
      const propertyValue = {} as PropertyValue;
      // console.log(term.property_value);
      const propertyValueBlock = term.property_value[0];
      propertyValue.id = propertyValueBlock.value[0];
      // So we know which table contains the value referenced by the property value chosen
      if (propertyValueBlock.has_values_from_fk[0] === 'true') {
        propertyValue.table = 'value';
      } else {
        propertyValue.table = 'prop_allowed_value';
      }
      // console.log('Chosen Property Value:');
      // console.log(propertyValue);
      // In case parentComponent is an action (assign expression)
      if (parentComponentToAdd.type) {
        parentComponentToAdd.property_value_term = propertyValue;
      } else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.property_value_term_1 = propertyValue;
        } else {
          parentComponentToAdd.property_value_term_2 = propertyValue;
        }
      }

    } else if (term.compute_expression) {
      let orderComputeExpression = 1;
      // console.log('é compute expression');
      const computeExpression = {} as ComputeExpression;
      console.log(term.compute_expression);
      const computeExpressionBlock = term.compute_expression[0];
      computeExpression.operator = this.transformOperatorToSymbol(computeExpressionBlock.operator[0]);
      for (const computeExpressionTerm of computeExpressionBlock.term) {
        this.figureTermType(computeExpressionTerm, computeExpression, orderComputeExpression, null);
        orderComputeExpression++;
      }
      // console.log('Compute Expression:');
      // console.log(computeExpression);
      // In case parentComponent is an action (assign expression)
      if (parentComponentToAdd.type) {
        parentComponentToAdd.compute_expression_term = computeExpression;
      }  else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.compute_expression_term_1 = computeExpression;
        } else {
          parentComponentToAdd.compute_expression_term_2 = computeExpression;
        }
      } else {
        // In case parentComponent is a compute expression
        // Initialize the array to be used if it hasn't been used yet
        if (!parentComponentToAdd.compute_expression_term) {
          parentComponentToAdd.compute_expression_term = [];
        }
        computeExpression.order = order;
        const isQueryTerm = term.property_id;
        if (isQueryTerm) {
          computeExpression.propertyIdQueryTerm = term.property_id[0];
        }
        parentComponentToAdd.compute_expression_term.push(computeExpression);
      }

    } else if (term.query) {
      let orderQuery = 1;
      // console.log('é query');
      const query = {} as Query;
      query.query_id = term.query[0].value[0];
      // Get the input terms of the query
      const inputTerms = term.query[0].termInput;
      for (const inputTerm of inputTerms) {
        this.figureTermType(inputTerm, query, orderQuery, null);
        orderQuery++;
      }
      // console.log('query id: ' + query.query_id);
      // console.log('Query:');
      // console.log(query);
      // If parentComponent is an action (Assign expression)
      if (parentComponentToAdd.type) {
        parentComponentToAdd.query_term = query;
      } else if (parentComponentToAdd.logical_operator) {
        // In case parentComponent is a comp_evaluated_expression
        if (leftOrRightTerm === 'left') {
          parentComponentToAdd.query_term_1 = query;
        } else {
          parentComponentToAdd.query_term_2 = query;
        }
      } else {
        // In case parentComponent is a compute expression
        // Initialize the array to be used if it hasn't been used yet
        if (!parentComponentToAdd.query_term) {
          parentComponentToAdd.query_term = [];
        }
        query.order = order;
        const isQueryTerm = term.property_id;
        if (isQueryTerm) {
          query.propertyIdQueryTerm = term.property_id[0];
        }
        parentComponentToAdd.query_term.push(query);
      }
    }
  }
}
