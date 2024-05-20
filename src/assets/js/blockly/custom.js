function customBlocks(restBlocklyApi, translate, workspace, transactionTypes, transactionStates, entTypes, templates, userEvaluatedExpressions, queries, constants, properties, FkPropertyValues, propAllowedValues) {

  goog.require('Blockly.Css');
  goog.provide('Blockly.Constants.Widgets');
  goog.provide('Blockly.Blocks.math');
  goog.require('Blockly.Blocks');

// ------------------------------------------------------------------------------------------
// ------------------------------------ REUSABLE CODE ---------------------------------------
// ------------------------------------------------------------------------------------------

  function changeNextConnection(block) {

    let parent = block.parentBlock_;
    let blockBeforeParent_ = block;
    let foundConditionParent_ = false;

    // Verifies if the block is inside a 'condition' block, even if it's not the first expression
    // Also verifies if the block is inside a 'condition' block that is itself inside another 'condition' block
    while (parent && !foundConditionParent_) {
      if (parent.type === 'condition') {
        // Can be inside a 'condition' block or connected next to one through nextConnection
        if (blockBeforeParent_.previousConnection === parent.nextConnection.targetConnection) {
          // Means that it isn´t inside the block, so we keep searching
          parent = parent.parentBlock_;
          blockBeforeParent_ = blockBeforeParent_.parentBlock_;
        } else {
          // Means we're inside a 'condition' block, so we've encountered the block we wanna know the dropdown value of
          foundConditionParent_ = true;
        }
      } else {
        parent = parent.parentBlock_;
        blockBeforeParent_ = blockBeforeParent_.parentBlock_;
      }
    }

    // Update possible connections - if conditionDropdown is ISTRUE or  NOT, you can only have 1 term, thus no connections
    if(parent){

      let conditionDropdown = parent.inputList[0].fieldRow[2].value_;

      if (conditionDropdown === 'ISTRUE' || conditionDropdown === 'NOT') {
        block.nextConnection.setCheck('no_connection');
      } else {
        block.nextConnection.setCheck(['condition','user_evaluated_expression','comp_evaluated_expression']);
      }
    }  else {
      block.nextConnection.setCheck('no_connection');
    }

  }

  // Used when changing min field
  // Function to be called when we want to compare min to max value and fix max if min is bigger
  function fixMaxIfMinBigger(minField, maxField){
    let minValue = Number(minField.getValue());
    let maxValue = Number(maxField.getValue());
    if (maxField !== '*'){
      if (minValue > maxValue){
        maxField.setValue(minValue);
      }
    }
  }

  // Used when changing max field - commented code so it doesnt affect results - maybe will be deleted
  // Function to be called when we want to compare min to max value and fix max if min is bigger
  function fixMinIfMaxSmaller(minField, maxField){
    // let minValue = Number(minField.getValue());
    // let maxValue = Number(maxField.getValue());
    // if (maxField !== '*'){
    //   if (minValue > maxValue){
    //     minField.setValue(maxValue);
    //   }
    // }
  }

  // Validator functions to be used in constant and value blocks
  function validateValueType(newValue) {
    let block = this.sourceBlock_;
    // Update validator depending on dropdown choice
    switch(newValue) {
      case 'STRING':
        updateShapeString(block);
        break;
      case 'INTEGER_NUMBER':
        updateShapeInteger(block);
        break;
      case 'REAL_NUMBER':
        updateShapeReal(block);
        break;
      case 'BOOLEAN':
        updateShapeBoolean(block);
        break;
      default:
        // do nothing
        break;
    }
  }

    function updateShapeString(block) {
      block.getField('value').setValidator(validateString);
      // Just a validator to remove the previous validator
      function validateString(newValue) {
        return newValue;
      }
    }

    function updateShapeInteger(block) {
      block.getField('value').setValidator(validateInteger);
      // Checks if input is an integer
      function validateInteger(newValue) {
        if (Number.isInteger(Number(newValue))) {
          return newValue;
        } else {
          return null;
        }
      }
    }

    function updateShapeReal(block) {
      block.getField('value').setValidator(validateReal);
      // Checks if input is Real
      function validateReal(newValue) {
        if (isNaN(newValue)){
          return null;
        } else {
          return newValue;
        }
      }
    }

    function updateShapeBoolean(block) {
      block.getField('value').setValidator(validateBoolean);
      // Checks if input is boolean
      function validateBoolean(newValue) {
        if (newValue === 'true' || newValue === 'false'){
          return newValue;
        } else {
          return null;
        }
      }
    }

  function addValueTypeField(block, property) {
    // If dropdown choice is none, we don't have to check anything
    if (property === 'NONE' || !property) {
      return ;
    }

    // Get the info on the current property
    let propertyInfo;
    properties.forEach(myFunction);
    function myFunction(item) {
      if (item.id === Number(property)) {
        propertyInfo = item;
      }
    }

    let valueType;
    // Check if property values are obtained from another property
    let hasFkValues = propertyInfo.fk_property_id;
    // If it get its values from another property, we check what that other's property value type is
    if (hasFkValues) {
      restBlocklyApi.getProperty(hasFkValues).subscribe((data) => {
        valueType = data[0].value_type;
        block.appendDummyInput('value_type')
          .appendField(new Blockly.FieldLabel(
            translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.VALUE-TYPE') + ': ' + valueType, 'blockValueType'
          ));
        block.valueType = valueType;
      });
    } else {
      // If not, we check the value type of the current property
      valueType = propertyInfo.value_type;
      block.appendDummyInput('value_type')
        .appendField(new Blockly.FieldLabel(
          translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.VALUE-TYPE') + ': ' + valueType, 'blockValueType'
        ));
      block.valueType = valueType;
    }
  }

// -------------------------------------------------------------------------
// ---- METHODS TO STORE DB RESULTS IN VARIABLES FOR DROPDOWN MENUS --------

  function getTransactionTypes() {
    let options = [['none','NONE']];
    transactionTypes.forEach(myFunction);
    function myFunction(item) {
      options.push([item.t_name,item.id.toString()]);
    }
    return options;
  }

  function getTransactionStates() {
    let options = [['none','NONE']];
    transactionStates.forEach(myFunction);
    function myFunction(item) {
      options.push([item.name,item.id.toString()]);
    }
    return options;
  }

  function getUserEvaluatedExpressions() {
    let options = [['none','NONE']];
    userEvaluatedExpressions.forEach(myFunction);
    function myFunction(item) {
      options.push([item.expression_name, item.id.toString()]);
    }
    return options;
  }

  function getQueries() {
    let options = [['none','NONE']];

    queries.forEach(myFunction);
    function myFunction(item) {
      options.push([item.name, item.query_id.toString()]);
    }
    return options;
  }

  function getConstants() {
    let options = [['none','NONE']];

    constants.forEach(myFunction);
    function myFunction(item) {
      options.push([item.name, item.constant_id.toString()]);
    }
    return options;
  }

  function getEntTypes() {
    let options = [['none','NONE']];
    entTypes.forEach(myFunction);

    function myFunction(item) {
      options.push([item.name, item.id.toString()]);
    }

    return options;
  }

  function getProperties(input, obj) {
    let PropertiesFromEntTypes = [['none','NONE']];
    restBlocklyApi.getPropertiesFromEntTypes(input).subscribe((data) => {
      PropertiesFromEntTypes = data;

      // It's inside this so we can wait that it gets the DB results before doing the next function
      let options = [
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY.DROPDOWN-DEFAULT'),'NONE']
      ];

      PropertiesFromEntTypes.forEach(myFunction);

      function myFunction(item) {
        options.push([item.name,item.property_id.toString()]);
      }

      obj.getField('properties').menuGenerator_ = options;

    });
  }

  function getPropertyValues(input, block) {
    // Get property values depending on property chosen for 'property value' block
    let property = null;
    let propertyValues = [];
    let FkPropertyValues = [];
    let options = [['none','NONE']];
    let FkPropertyId;

    // Reset on the block variables so that they aren't affected by previous searches
    block.valuesFromFK = false;
    block.valuesTranslated = false;
    if (input === "NONE") {
      return ;
    }

    // Get the info on property referred by input so we can see if it has fk_property_id
    restBlocklyApi.getProperty(input).subscribe((data) => {
      property = data[0];
      // Get, if exists, fk_property_id referenced by chosen property
      FkPropertyId = property.fk_property_id;

      // If values for property will be obtained from a fk_property
      if (FkPropertyId) {
        block.valuesFromFK = true;

        // Get fk_property_id values and then add them to dropdown
        restBlocklyApi.getFkPropertyValues(FkPropertyId).subscribe((data) => {
          FkPropertyValues = data;

          FkPropertyValues.forEach(myFunction);
          function myFunction(item) {
            options.push([item.value,item.id.toString()]);
          }
        });

        // Add value options to the block dropdown
        block.getField('property_values').menuGenerator_ = options;
        // console.log(options);
        block.getField('property_values').setValue(options[0]['p_a_v_id']);

        // If values for property will be obtained from the property itself - prop_allowed_values
      } else {
        // console.log("Doesn't have FK");
        restBlocklyApi.getPropertyValues(input).subscribe((data) => {
          propertyValues = data;
          // console.log(data);

          // It's here so we wait that it gets the propertyValues from the DB before continuing
          propertyValues.forEach(myFunction);

          function myFunction(item) {
            options.push([item.name,item.p_a_v_id.toString()]);
          }
          // Add value options to the block dropdown
          block.getField('property_values').menuGenerator_ = options;
        });

      }

    });
  }

  function getUserOutputTemplates() {
    let options = [['none','NONE']];
    templates.forEach(myFunction);

    function myFunction(item) {
      if (item.type === 'modal' || item.type === 'toast') {
        options.push([item.name, item.template_id.toString()]);
      }
    }

    return options;
  }

  function getTemplatesValidationWarning() {
    let options = [['none','NONE']];
    templates.forEach(myFunction);

    function myFunction(item) {
      if (item.type === 'validation_warning') {
        options.push([item.name, item.template_id.toString()]);
      }
    }

    return options;
  }

  function getPropertiesSynchronous(block, entTypeId) {
    let options = [['none','NONE']];

    properties.forEach(myFunction);
    function myFunction(item) {
      if (item.ent_type_id === entTypeId) {
        options.push([item.name, item.property_id.toString()]);
      }
    }
    // console.log('PROPERTIES:');
    // console.log(options);

    block.getField('properties').menuGenerator_ = options;
  }

  function getFkPropertyValuesSynchronous(block, propertyId) {
    let options = [['none','NONE']];

    FkPropertyValues.forEach(myFunction);
    function myFunction(item) {
      if (item.property_id === propertyId) {
        options.push([item.value, item.id.toString()]);
      }
    }
    // console.log('VALUES:');
    // console.log(options);

    block.getField('property_values').menuGenerator_ = options;
  }

  function getPropAllowedValuesSynchronous(block, propertyId) {
    let options = [['none','NONE']];

    propAllowedValues.forEach(myFunction);
    function myFunction(item) {
      if (item.property_id === propertyId) {
        options.push([item.name, item.p_a_v_id.toString()]);
      }
    }
    // console.log('PROP ALLOWED VALUES:');
    // console.log(options);

    block.getField('property_values').menuGenerator_ = options;
  }

// ------------------------------------------------------------------------------------------
// ------------------------------------ BLOCKS ----------------------------------------------
// ------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------
// --------------------------- CATEGORY: GENERAL ---------------------------

// ---------------------------
// Block: "when_is_do"
// ---------------------------

  Blockly.Blocks['when_is_do'] = {
    init: function () {

      let dropdown = new Blockly.FieldDropdown(getTransactionTypes);
      let dropdownStates = new Blockly.FieldDropdown(getTransactionStates);

      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.WHEN-IS-DO.WHEN'),'blockTitle'))
        .appendField(dropdown, 'transaction_type');
      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.WHEN-IS-DO.IS'),'blockTitle'))
        .appendField(dropdownStates, 'fact');
      this.appendStatementInput('actions')
        .setCheck(['action', 'if_then', 'while'])
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.WHEN-IS-DO.ACTIONS') + ' :'));
      this.setColour(315);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };

// ---------------------------
// Block: "action"
// ---------------------------

  Blockly.Blocks['action'] = {
    checkingMax: false,
    firstUpdateUO_: true,
    firstUpdateUOCustom_: true,

    init: function () {

      this.appendDummyInput('action')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.ACTION.TITLE'),'blockTitle'))
        .appendField(new Blockly.FieldDropdown([[translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.NONE'), 'NONE'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.ASSIGN-EXPRESSION.TITLE'), 'ASSIGN_EXPRESSION'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.READ-VALUE.TITLE'), 'READ_VALUE'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.PRODUCE-DOCUMENT.TITLE'), 'PRODUCE_DOC'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TITLE'), 'USER_OUTPUT'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.EXTERNAL-CALL.TITLE'), 'EXTERNAL_CALL'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.CAUSAL-LINK.TITLE'), 'CAUSAL_LINK'],
          [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-INPUT.TITLE'), 'USER_INPUT']
        ]), 'action')
        .appendField(' ');

      this.getField('action').setValidator(function (input) {

        this.sourceBlock_.setInputsInline(true);

        // Remove all inputs before updating them
        this.sourceBlock_.removeInputs(input);

        // Updating block depending on input
        switch (input) {
          case 'ASSIGN_EXPRESSION':
            //code block
            this.sourceBlock_.updateShapeAE_();
            break;
          case 'USER_INPUT':
            //code block
            this.sourceBlock_.updateShapeUI_();
            break;
          case 'CAUSAL_LINK':
            //code block
            this.sourceBlock_.updateShapeCL_();
            break;
          case 'USER_OUTPUT':
            this.sourceBlock_.updateShapeUO_();
            break;
          default:
            //code block
        }
      });
      this.setOnChange(this.handleChange_);
      this.setInputsInline(true);
      this.setPreviousStatement(true, 'action'); // what other blocks call to accept this one
      this.setNextStatement(true, ['action','if_then','while']); // what block to accept on bottom
      this.setColour(120);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    // Remove the additional inputs that are on the block
    removeInputs: function () {
      let AEInput1Exists = this.getInput('AE_INPUT1');
      if (AEInput1Exists) {
        this.removeInput('AE_INPUT1');
      }

      let AEInput2Exists = this.getInput('AE_INPUT2');
      if (AEInput2Exists) {
        this.removeInput('AE_INPUT2');
      }

      let UIInputExists = this.getInput('PROPERTIES');
      if (UIInputExists) {
        this.removeInput('action_name');
        this.removeInput('PROPERTIES');
      }

      let CLInputExists = this.getInput('transaction_type');
      if (CLInputExists) {
        this.removeInput('transaction_type');
        this.removeInput('c_fact');
        this.removeInput('min');
        this.removeInput('max');
      }

      let UOInputExists = this.getInput('template_choice');
      let UONewTempInputExists = this.getInput('new_template');
      let UOExistingTempInputExists = this.getInput('existing_template');

      if (UOInputExists) {
        this.removeInput('template_choice');
      }
      if (UONewTempInputExists) {
        this.removeInput('new_template');
        this.removeInput('template_name');
      } else if(UOExistingTempInputExists) {
        this.removeInput('existing_template');
      }
      this.removeNewTemplateAdditionalInputs_();
      this.firstUpdateUO_ = true;
      this.firstUpdateUOCustom_ = true;
    },

    // Update block shape when dropdown input is 'ASSIGN EXPRESSION'
    updateShapeAE_: function () {
      this.appendValueInput('AE_INPUT1')
        .setCheck('property_single');

      this.appendValueInput('AE_INPUT2')
        .appendField('=')
        .setCheck(['constant', 'value', 'property_single', 'property_value','compute_expression', 'query']);
    },

    // Update block shape when dropdown input is 'USER INPUT'
    updateShapeUI_: function () {
      this.setInputsInline(false);
      this.appendDummyInput('action_name')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-INPUT.ACTION-NAME') + ' :')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-INPUT.ACTION-NAME-DEFAULT-TEXT')), 'action_name');
      this.appendStatementInput('PROPERTIES')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-INPUT.PROPERTIES') + ' :')
        .setCheck('property');
    },

    // Update block shape when dropdown input is 'USER OUTPUT'
    updateShapeUO_: function (dTm) {

      // Dropdown for the user to choose from either using an existing template or crete a new one
      let dropdownChoices = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DROPDOWN.NEW'),'NEW'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DROPDOWN.EXISTING'),'EXISTING']
      ]);
      this.appendDummyInput('template_choice')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TITLE'), 'blockTitle'))
        .appendField(' ')
        .appendField(dropdownChoices,'choice_template');

      this.getField('choice_template').setValidator(function (input) {
        let block = this.sourceBlock_;
        // Remove current inputs to then add them according to choice
        block.removeUOFields_();
        // Update shape depending on template dropdown choice
        switch (input) {
          case 'NEW':
            // In case user wants to create new template
            block.updateShapeUONew_();
            break;
          case 'EXISTING':
            // In case user wants to use existing template
            block.updateShapeUOExisting_();
            break;
          default:
            //code block
        }
      });

      // For when we're uploading xml to workspace and in xml, CO is Existing
      if(dTm === 'EXISTING') {
        this.setFieldValue('EXISTING','choice_template');
        this.getField('choice_template').validator_('EXISTING');
      } else {
        // Initial value to appear when 'USER OUTPUT' is selected on the 'action' block
        this.setFieldValue('NEW','choice_template');
        this.getField('choice_template').validator_('NEW');
      }
    },

    // Remove fields/inputs when changing the dropdown of NEW/EXISTING
    removeUOFields_: function() {
      // Remove current inputs to then add them according to choice
      let newTemplateFieldExists = this.getInput('new_template');
      let existingTemplateFieldExists = this.getInput('existing_template');
      let templateChoice;
      let templateTypeFieldExists = this.getField('template_type');
      if (templateTypeFieldExists) {
        templateChoice = this.getFieldValue('template_type');
      }
      let templateNameFieldExists = this.getField('template_name');
      if (templateNameFieldExists) {
        this.removeInput('template_name');
      }
      if (newTemplateFieldExists) {
        this.removeInput('new_template');
        this.removeNewTemplateAdditionalInputs_();
      } else if (existingTemplateFieldExists) {
        this.removeInput('existing_template');
      }
      // Removing fields that can be empty fields or filled/already used
      if (templateChoice && templateChoice !== 'TOAST'){
        // If user hasn't already chosen class custom, all custom fields are still empty fields so we remove them
        if (this.firstUpdateUOCustom_) {
          let templateChoiceInput = this.getInput('template_choice');
          if (this.firstUpdateUO_) {
            // If user hasn't already chosen type toast, field 'template_class' is still an empty field so we remove it
            templateChoiceInput.removeField('template_class');
          }
          templateChoiceInput.removeField('template_colour_text');
          templateChoiceInput.removeField('template_colour');
          templateChoiceInput.removeField('template_title_text');
          templateChoiceInput.removeField('template_title');
        }
      }
      // Update the global variables - as it is refreshing, first update on toast / class custom hasn't happened yet
      this.firstUpdateUO_ = true;
      this.firstUpdateUOCustom_ = true;
    },

    // If user chooses to create new template, present type options and notification text input
    updateShapeUONew_: function() {

      this.setInputsInline(false);
      let dropdownTypes = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.MODAL.TITLE'), 'MODAL'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.TITLE'), 'TOAST']
      ]);

      this.getInput('template_choice')
        // Empty fields so we can refer to them later
        .appendField('','template_class')
        .appendField('','template_colour_text')
        .appendField('','template_colour')
        .appendField('','template_title_text')
        .appendField('','template_title');
      this.appendDummyInput('template_name')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TEMPLATE-NAME') + ' :')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DEFAULT-TEMPLATE-NAME-TEXT')), 'template_name');
      this.appendDummyInput('new_template')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TITLE') + ' :')
        .appendField(dropdownTypes, 'template_type')
        .appendField( ' "')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DEFAULT-TEXT')), 'template_text')
        .appendField('"');

      this.getField('template_type').setValidator(function (input) {

        let block = this.sourceBlock_;
        // Remove empty field created earlier so we can use it now
        block.removeNewTemplateAdditionalInputs_();

        // Update shape depending on template dropdown choice
        switch (input) {
          case 'MODAL':
            // In case user wants to create new modal (window)
            block.updateShapeUONewModal_();
            break;
          case 'TOAST':
            // In case user wants to create new toast (popup notification)
            block.updateShapeUONewToast_();
            break;
          default:
            // never reaches this part
        }
      });
      // Default value to appear when user wants to create a new template
      this.setFieldValue('MODAL','template_type');
      this.getField('template_type').validator_('MODAL');
    },

    // Update shape when user wants to create new Modal type template
    updateShapeUONewModal_: function() {
      this.appendDummyInput('new_modal')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.MODAL.HEADER') + ': ')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.MODAL.DEFAULT-HEADER')
        ), 'template_header')
        .appendField(' ')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.MODAL.BUTTON') + ': ')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.MODAL.DEFAULT-BUTTON')
        ), 'template_button');
      this.appendTemplateEditorInput_();
    },

    // Update shape when user wants to create new Toast type template
    updateShapeUONewToast_: function() {
      // Delete empty fields created earlier so we can use them now
      this.deleteEmptyFieldsForNormalToast_();
      // Dropdown with the class choices for the toast notification
      let toastClassDropdown = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS-DROPDOWN.SUCCESS'), 'SUCCESS'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS-DROPDOWN.INFORMATION'), 'INFORMATION'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS-DROPDOWN.WARNING'), 'WARNING'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS-DROPDOWN.ERROR'), 'ERROR'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS-DROPDOWN.CUSTOM'), 'CUSTOM']
      ]);
      this.appendDummyInput('new_toast')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CLASS') + ': ')
        .appendField(toastClassDropdown, 'template_class');

      this.getField('template_class').setValidator(this.updateShapeUONewToastCustom_);

      this.appendTemplateEditorInput_();
    },

    // Update shape when user wants to create new Toast type template - with custom colour and title
    updateShapeUONewToastCustom_: function(input) {

      let block = this.sourceBlock_;
      let previousClassSelection = block.getFieldValue('template_class');
      // If previous selection is CUSTOM, empty fields are now being used in input 'new_toast' and are filled
      if (previousClassSelection === 'CUSTOM') {
        block.removeNewTemplateToastCustomFields_();
      } else {
        // Delete empty fields created earlier that are in input 'template_choice' so we can use them now
        block.deleteEmptyFieldsForCustomToast_();
      }

      // If dropdown value is Custom Toast, present additional inputs for colour selection and title
      if (input === 'CUSTOM') {
        // Colour Input ant its colour options to be presented and how many columns to present them
        let colourField = new Blockly.FieldColour('#ff4040');
        colourField.setColours(
          ['#ff4040', '#ff66b3', '#ff8080',
            '#6600cc', '#8080ff', '#fd9d47',
            '#000099', '#420420', '#696969'],
          [
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.DARK-PINK'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.PINK'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.LIGHT-PINK'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.PURPLE'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.LIGHT-PURPLE'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.LIGHT-ORANGE'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.DARK-BLUE'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.DARK-RED'),
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-COLOURS.GREY'),
          ]);
        colourField.setColumns(3);
        // Add the inputs to the block
        block.getInput('new_toast')
          .appendField(' ' + translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.COLOUR') + ': ', 'template_colour_text')
          .appendField(colourField, 'template_colour')
          .appendField(' ' + translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.CUSTOM-TITLE') + ': ', 'template_title_text')
          .appendField(new Blockly.FieldTextInput(
            translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TYPE.TOAST.DEFAULT-CUSTOM-TITLE')
          ),'template_title');
        // Has to do this because of a bug where the color field doesn't load when it is created - This fixes it
        block.setCollapsed(true);
        block.setCollapsed(false);

        // If we want that the block changes to the selected colour of the colour field
        // block.getField('template_colour').setValidator(function(newValue) {
        //   block.setColour(newValue);
        //   return newValue;
        // });
      }
    },

    appendTemplateEditorInput_: function() {
      // Show the edit button on the block that opens the editor
      this.appendDummyInput('template_editor_button')
        .appendField(new Blockly.FieldLabel(
          translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TEMPLATE-EDITOR-TEXT')
          ,'templateEditorButton'))
        .appendField(new Blockly.FieldButton(
          translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TEMPLATE-EDITOR-BUTTON')
        ),'TE_BUTTON')
        .setAlign(Blockly.ALIGN_LEFT);
    },

    // Remove empty field so we can use it for the class dropdown
    deleteEmptyFieldsForNormalToast_: function() {
      //Remove empty fields so we can refer to them later
      if (this.firstUpdateUO_) {
        this.getInput('template_choice')
          .removeField('template_class');
        this.firstUpdateUO_ = false;
      }
    },

    // Remove empty fields so we can use it for the toast colour and title
    deleteEmptyFieldsForCustomToast_: function() {
      //Remove empty fields so we can refer to them later
      if (this.firstUpdateUOCustom_) {
        let templateChoiceInput = this.getInput('template_choice');
        templateChoiceInput.removeField('template_colour_text', true);
        templateChoiceInput.removeField('template_colour', true);
        templateChoiceInput.removeField('template_title_text', true);
        templateChoiceInput.removeField('template_title', true);
        this.firstUpdateUOCustom_ = false;
      }
    },

    // Remove inputs when updating the shape of the block
    removeNewTemplateAdditionalInputs_: function() {
      let newTemplateModalExists = this.getInput('new_modal');
      let newTemplateToastExists = this.getInput('new_toast');
      let templateEditorButtonExists = this.getInput('template_editor_button');

      if (newTemplateModalExists)
      {
        this.removeInput('new_modal');
      }
      if (newTemplateToastExists) {
        this.removeInput('new_toast');
      }
      if (templateEditorButtonExists) {
        this.removeInput('template_editor_button');
      }
    },

    // Remove fields used in the custom toast selection when updating the shape of the block
    removeNewTemplateToastCustomFields_: function() {
      let newTemplateToastCustomExists = this.getField('template_colour');
      if (newTemplateToastCustomExists) {
        let newToastCustomInput = this.getInput('new_toast');
        newToastCustomInput.removeField('template_colour_text', true);
        newToastCustomInput.removeField('template_colour', true);
        newToastCustomInput.removeField('template_title_text', true);
        newToastCustomInput.removeField('template_title', true);
      }
    },

    // Update shape of block when user selects that he wants to use an existing template
    updateShapeUOExisting_: function() {
      this.setInputsInline(true);
      let colourFieldPresent = this.getField('template_colour');
      //console.log(colourFieldPresent);
      // Remove empty fields created earlier for custom class that weren't used so they won't occupy unnecessary space
      if (!colourFieldPresent) {
        // If selection is TOAST CUSTOM or MODAL, empty fields were used in input 'new_toast' and are filled
        this.removeNewTemplateToastCustomFields_();
      } else {
        // If selection is TOAST and not CUSTOM
        // Delete empty fields created earlier that are in input 'template_choice' so we can use them now
        this.deleteEmptyFieldsForCustomToast_();
      }
      let dropdownTemplates = new Blockly.FieldDropdown(getUserOutputTemplates);
      this.appendDummyInput('existing_template')
        .appendField(' ')
        .appendField(dropdownTemplates, 'template_text');
    },

    // Update block shape when dropdown input is 'CAUSAL LINK'
    updateShapeCL_: function () {

      this.setInputsInline(true);

      let dropdownTTypes = new Blockly.FieldDropdown(getTransactionTypes);
      let dropdownTStates = new Blockly.FieldDropdown(getTransactionStates);

      // Dropdown Fields to select Transaction Type & State
      this.appendDummyInput('transaction_type')
        .appendField(dropdownTTypes, 'transaction_type')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.CAUSAL-LINK.MUST-BE'));
      this.appendDummyInput('c_fact')
        .appendField(dropdownTStates, 'c_fact');

      // Present number input for min
      this.appendDummyInput('min')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.CAUSAL-LINK.MIN'))
        .appendField(new Blockly.FieldNumber(1,1,null,null, validatorMin), 'min');

      // Present number input for max
      this.appendDummyInput('max')
        .appendField(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.CAUSAL-LINK.MAX'))
        .appendField(new Blockly.FieldTextInput('1', validatorMax), 'max');

      // So that max is never less than min
      function validatorMin(newValue) {
        const block = this.sourceBlock_;
        if (newValue !== '1' && !block.checkingMax) {
          let minField = this;
          let maxField = block.getField('max');
          block.checkingMax = true;
          fixMaxIfMinBigger(minField, maxField);
          block.checkingMax = false;
          return newValue;
        }
      }
      // Verifies if max is smaller than min and lets us either insert a number or a *
      function validatorMax(newValue) {
        const block = this.sourceBlock_;
        if (newValue !== '1' && !block.checkingMax) {
          let minField = block.getField('min');
          let maxField = this;
          block.checkingMax = true;
          fixMinIfMaxSmaller(minField, maxField);
          block.checkingMax = false;
        }
        if ((isNaN(newValue) && newValue !== '*') || newValue<1) {
          return null;
        }
        return newValue;
      }

     },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let aeInput = (this.getField('action').value_ === 'ASSIGN_EXPRESSION');
      let uiInput = (this.getField('action').value_ === 'USER_INPUT');
      let clInput = (this.getField('action').value_ === 'CAUSAL_LINK');
      let uoInput = (this.getField('action').value_ === 'USER_OUTPUT');
      let uoExisting = (this.getFieldValue('choice_template') === 'EXISTING');
      let uoExistingToast = (this.getFieldValue('template_type') === 'TOAST');
      let uoExistingToastCustom = (this.getFieldValue('template_class') === 'CUSTOM');
      container.setAttribute('ae_input1', aeInput);
      container.setAttribute('ui_input1', uiInput);
      container.setAttribute('cl_input1', clInput);
      container.setAttribute('uo_input1', uoInput);
      container.setAttribute('uo_existing', uoExisting);
      container.setAttribute('uo_new_toast', uoExistingToast);
      container.setAttribute('uo_new_toast_custom', uoExistingToastCustom);
      return container;
    },

    domToMutation: function (xmlElement) {
      if (xmlElement.getAttribute('ae_input1') === 'true') {
        this.updateShapeAE_(null);
      } else if (xmlElement.getAttribute('ui_input1') === 'true') {
        this.updateShapeUI_(null);
      } else if (xmlElement.getAttribute('cl_input1') === 'true') {
        this.updateShapeCL_(null);
      } else if (xmlElement.getAttribute('uo_input1') === 'true') {
        if (xmlElement.getAttribute('uo_existing') === 'true') {
          this.updateShapeUO_('EXISTING');
        } else{
          this.updateShapeUO_();
          if(xmlElement.getAttribute('uo_new_toast') === 'true') {
            this.getField('template_type').validator_('TOAST');
            if (xmlElement.getAttribute('uo_new_toast_custom') === 'true') {
              this.getField('template_class').validator_('CUSTOM');
            }
          }
        }
      }
    }
  };

// ---------------------------
// Block: "if_then"
// ---------------------------

  Blockly.Blocks['if_then'] = {
    init: function() {
      this.appendStatementInput('if_input')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.IF_THEN.IF'),'blockTitle'))
        .setCheck('condition');
      this.appendStatementInput('then_input')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.IF_THEN.THEN'),'blockTitle'))
        .setCheck(['action','if_then']);
      // Function that adds the checkbox input wanted in the initialization of the block
      this.updateShapeAddCheckboxInput();
      this.setPreviousStatement(true, 'if_then');
      this.setNextStatement(true, ['action','if_then','while']);
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    // Validator function for the checkbox field, which refers to the presence of the statementInput
    // As the else input is optional (per EBNF rules), user adds/removes statementInput with the checkbox
    validateCheckboxElse: function(newValue) {
      let block = this.sourceBlock_;
      // Remove input present, so we can then add the new one
      block.removeInputs();
      if (newValue === true) {
        block.updateShapeAddStatementInput();
      } else {
        block.updateShapeAddCheckboxInput();
      }
    },

    // Remove the current additional inputs in the block
    removeInputs: function() {
      let hasStatementInput = this.getInput('else_input');
      let hasCheckboxInput = this.getInput('checkbox_else');
      if (hasStatementInput) {
        this.removeInput('else_input');
      }
      if (hasCheckboxInput) {
        this.removeInput('checkbox_else');
      }
    },

    // Update shape when we want the checkbox input without the statementInput
    updateShapeAddCheckboxInput: function() {
      this.appendDummyInput('checkbox_else')
        .appendField(new Blockly.FieldCheckbox(false),'checkbox_else')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.IF_THEN.ELSE'),'blockTitle'));
      this.getField('checkbox_else').setValidator(this.validateCheckboxElse);
    },

    // Update shape when we want the checkbox input WITH the statementInput
    // The checkbox is initialized as true so that it reflects the previous checkbox present that was clicked
    updateShapeAddStatementInput: function() {
      this.appendStatementInput('else_input')
        .setCheck(['action','if_then'])
        .appendField(new Blockly.FieldCheckbox(true),'checkbox_else')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.IF_THEN.ELSE'),'blockTitle'));
      this.getField('checkbox_else').setValidator(this.validateCheckboxElse);
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let checkbox_else = this.getFieldValue('checkbox_else') === 'TRUE';
      container.setAttribute('checkboxElse', checkbox_else);
      return container;
    },

    domToMutation: function (xmlElement) {
      const checkboxElse = xmlElement.getAttribute('checkboxelse');
      if (checkboxElse === 'true') {
        this.removeInputs();
        this.updateShapeAddStatementInput();
      }
      // If checkbox is false, the function called inside the init function guarantees we have the normal checkbox without statementInput
    }
  };

// ---------------------------
// Block: "while"
// ---------------------------

  Blockly.Blocks['while'] = {
    init: function() {
      this.appendStatementInput('while_condition')
        .setCheck(['condition','comp_evaluated_expression'])
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.WHILE.WHILE'),'blockTitle'));
      this.appendStatementInput('while_action')
        .setCheck('action')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.WHILE.DO'),'blockTitle'));
      this.setPreviousStatement(true, 'while');
      this.setNextStatement(true, ['action','if_then','while']);
      this.setColour(230);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: EVALUATE ---------------------------

// ---------------------------------------------------
// Block: "condition"
// ---------------------------------------------------

  Blockly.Blocks['condition'] = {

    init: function () {

      let dropdownChoices_ = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.CONDITION.DROPDOWN.IS-TRUE'), 'ISTRUE'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION.DROPDOWN.NOT'), 'NOT'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION.DROPDOWN.AND'), 'AND'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION.DROPDOWN.OR'),'OR']
      ]);

      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.CONDITION.TITLE'), 'blockTitle'))
        .appendField('  ')
        .appendField(dropdownChoices_, 'choice_condition');
      this.appendStatementInput('input_terms')
        .appendField(translate.instant('BLOCKLY-BLOCKS.CONDITION.TERMS') + ' :')
        .setAlign(Blockly.ALIGN_RIGHT);
      this.getField('choice_condition').setValidator(this.updateShape_);
      this.setPreviousStatement(true,'condition');
      this.setNextStatement(true,['condition','user_evaluated_expression','comp_evaluated_expression']);
      this.setColour(160);
      this.setTooltip('');
      this.setHelpUrl('');
      this.setOnChange(this.handleChange_);

    },

    handleChange_: function() {

      // Update next statement possible connections
      changeNextConnection(this);

    },

    // Update shape depending on dropdown choice
    updateShape_: function (input) {
      let block = this.sourceBlock_;

      // Update connections possible depending on dropdown choice - blocks to be accepted on ISTRUE are different
      if(input === 'ISTRUE'){
        block.getInput('input_terms')
          .setCheck(['user_evaluated_expression','comp_evaluated_expression']);
      } else{
        block.getInput('input_terms')
          .setCheck(['condition','user_evaluated_expression','comp_evaluated_expression']);
      }

    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let dropdown_choice = this.getField('choice_condition').value_;
      container.setAttribute('choiceCondition', dropdown_choice);
      return container;
    },

    domToMutation: function (xmlElement) {
      const conditionType = xmlElement.getAttribute('choicecondition');
      if (conditionType === 'NOT' || conditionType === 'AND' || conditionType === 'OR' ) {
        this.getInput('input_terms')
          .setCheck(['condition','user_evaluated_expression','comp_evaluated_expression']);
      } else {
        this.getInput('input_terms')
          .setCheck(['user_evaluated_expression','comp_evaluated_expression']);
      }
    }

  };

// -----------------------------------
// Block: "comp_evaluated_expression"
// -----------------------------------

  Blockly.Blocks['comp_evaluated_expression'] = {

    init: function() {

      let operatorDropdown = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.COMP-EVALUATED-EXPRESSION.OPERATOR'), "not_chosen"],
        ["<", "LESSTHAN"],
        [">", "GREATERTHAN"],
        ["==", "=="],
        ["!=", "!="],
        ["~", "~"]
      ]);

      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.COMP-EVALUATED-EXPRESSION.TITLE'), 'blockTitle'));
      this.appendValueInput('first_input')
        .setCheck(['constant','value','property_single','query','compute_expression']);
      this.appendDummyInput()
        .appendField(operatorDropdown, 'operator');
      this.appendValueInput('second_input')
        .setCheck(['constant','value','property_single','property_value','query','compute_expression']);
      this.setInputsInline(true);
      this.setPreviousStatement(true, 'comp_evaluated_expression');
      this.setNextStatement(true, ['condition','user_evaluated_expression','comp_evaluated_expression']);
      this.setColour(350);
      this.setTooltip('');
      this.setHelpUrl('');

      this.setOnChange(this.handleChange_);

    },

    // changeNextConnection(block) is inside this function because otherwise we couldn't pass the block argument
    handleChange_: function() {
      changeNextConnection(this)
    }
  };

// ---------------------------------------------------
// Block: "user_evaluated_expression"
// ---------------------------------------------------

  Blockly.Blocks['user_evaluated_expression'] = {
    firstUpdate_: true,

    init: function () {
      let dropdownChoices = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.USER-EVALUATED-EXPRESSION.DROPDOWN.NEW'), 'NEW'],
        [translate.instant('BLOCKLY-BLOCKS.USER-EVALUATED-EXPRESSION.DROPDOWN.EXISTING'), 'EXISTING']
      ]);

      this.appendDummyInput('block_fields')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.USER-EVALUATED-EXPRESSION.TITLE'), 'blockTitle'))
        .appendField('  ')
        .appendField(dropdownChoices, 'choice_expression')
        // Empty fields so we can refer to them later
        .appendField('','expression_text');
      this.getField('choice_expression').setValidator(this.updateShapeUExp_);
      this.setFieldValue('NEW','choice_expression');
      this.getField('choice_expression').validator_('NEW');
      this.setInputsInline(true);
      this.setPreviousStatement(true,'user_evaluated_expression');
      this.setNextStatement(true,['condition','user_evaluated_expression','comp_evaluated_expression']);
      this.setColour(100);
      this.setTooltip('');
      this.setHelpUrl('');
      this.setOnChange(this.handleChange_);

    },

    // changeNextConnection(block) is inside this function because otherwise we couldn't pass the block argument
    handleChange_: function() {
      changeNextConnection(this)
    },

    // Update shape depending o dropdown choice
    updateShapeUExp_: function (input) {
      let block = this.sourceBlock_;
      // Remove inputs to then add them according to choice
      block.removeAdditionalInputs_();
      switch (input) {
        case 'NEW':
          //code block
          block.updateShapeNew_();
          break;
        case 'EXISTING':
          //code block
          block.updateShapeExisting_();
          break;
        default:
          //code block
      }
    },

    removeAdditionalInputs_: function() {
      let newUserEvalExpressionExists = this.getInput('new_expression');
      let existingUserEvalExpressionExists = this.getInput('existing_expression');
      if (newUserEvalExpressionExists) {
        this.removeInput('new_expression');
      } else if (existingUserEvalExpressionExists) {
        this.removeInput('existing_expression');
      }
    },

    removeAdditionalFieldsFirstTime_: function() {
      //Remove empty fields so we can refer to them later
      if (this.firstUpdate_) {
        this.getInput('block_fields')
          .removeField('expression_text');
        this.firstUpdate_ = false;
      }
    },

    // Update block shape if user wants to create new user_evaluated_expression
    updateShapeNew_: function() {
      this.removeAdditionalFieldsFirstTime_();
      this.appendDummyInput('new_expression')
        .appendField('  ')
        .appendField('"')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.USER-EVALUATED-EXPRESSION.DEFAULT-TEXT')),'expression_text')
        .appendField('"');
    },

    // Update block shape if user wants to use existing user_evaluated_expression
    updateShapeExisting_: function() {
      this.removeAdditionalFieldsFirstTime_();
      let dropdownUserExpressions = new Blockly.FieldDropdown(getUserEvaluatedExpressions);
      this.appendDummyInput('existing_expression')
        .appendField('  ')
        .appendField(dropdownUserExpressions,'expression_text')
        .appendField('');
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let newExpressionInput = (this.getFieldValue('choice_expression') === 'NEW');
      let existingExpressionInput = (this.getFieldValue('choice_expression') === 'EXISTING');
      // let expressionName = this.getFieldValue('expression_text');
      container.setAttribute('new_expression_input', newExpressionInput);
      container.setAttribute('existing_expression_input', existingExpressionInput);
      // container.setAttribute('expression_name', expressionName);
      return container;
    },

    domToMutation: function (xmlElement) {
      if (xmlElement.getAttribute('new_expression_input') === 'true') {
        this.removeAdditionalInputs_();
        // let expression_name = xmlElement.getAttribute('expression_name');
        // let uee_equal_id;
        // console.log('exp name ' + expression_name);
        // for (let i=0; i<userEvaluatedExpressions.length; i++) {
        //   console.log('uee name ' + userEvaluatedExpressions[i].expression_name);
        //   if (userEvaluatedExpressions[i].expression_name === expression_name) {
        //     uee_equal_id = userEvaluatedExpressions[i].id;
        //     console.log('encontrei igualll');
        //   }
        // }
        // if (uee_equal_id) {
        //   console.log(uee_equal_id);
        //   this.updateShapeExisting_();
        //   console.log(this.getField('expression_text'));
        //   this.setFieldValue(uee_equal_id, 'expression_text');
        // } else {
        this.updateShapeNew_();
        // }
      } else if (xmlElement.getAttribute('existing_expression_input') === 'true') {
        this.removeAdditionalInputs_();
        this.updateShapeExisting_();
      }
    }
  };



// -------------------------------------------------------------------------
// --------------------------- CATEGORY: COMPUTE ---------------------------

// --------------------------------------------------------
// Block: 'compute_expression'
// --------------------------------------------------------

  Blockly.Blocks['compute_expression'] = {
    connectionTerms_: new Array(2).fill(null),
    connectionAdditionalInputs_: new Array(64).fill(null),
    additionalInputs_: 0,
    changeOperator_: false,
    updatedOperator_: null,

    init: function() {

      let operators = new Blockly.FieldDropdown([
        ['%{BKY_MATH_ADDITION_SYMBOL}', 'ADD'],
        ['%{BKY_MATH_SUBTRACTION_SYMBOL}', 'MINUS'],
        ['%{BKY_MATH_MULTIPLICATION_SYMBOL}', 'MULTIPLY'],
        ['%{BKY_MATH_DIVISION_SYMBOL}', 'DIVIDE'],
        ['%{BKY_MATH_POWER_SYMBOL}', 'POWER']
      ]);

      this.appendDummyInput('titleBlock')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.COMPUTE-EXPRESSION.TITLE'), 'blockTitle'))
        .appendField('  ')
        .appendField(operators, 'choice_operator');
      this.appendDummyInput('number_terms')
        .appendField(translate.instant('BLOCKLY-BLOCKS.COMPUTE-EXPRESSION.TERMS') + ':', 'terms')
        .appendField(new Blockly.FieldNumber(2,2,64), 'quantity_inputs')
        .setAlign(Blockly.ALIGN_RIGHT);
      this.appendValueInput('input_term1')
        .setCheck(['constant','value','property_single','query','compute_expression']);
      this.appendValueInput('input_term2')
        .setCheck(['constant','value','property_single','query','compute_expression']);
      this.getField('choice_operator').setValidator(this.updateShape_);
      this.getField('quantity_inputs').setValidator(this.updateInputNumber_);
      this.setOutput(true,'compute_expression');
      this.setColour(210);
      this.setInputsInline(false);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    // Update shape depending on operator dropdown choice
    updateShape_: function (input) {
      let block = this.sourceBlock_;
      block.updatedOperator_ = input;

      // Save any connections inside block before removing inputs
      block.saveConnections_(block);

      // Remove all inputs before adding them in updating shape
      block.removeInputs_(input);

      // Update shape depending on dropdown choice
      if (input === 'ADD' || input === 'MULTIPLY') {
        block.updateShapeMultipleOperators_();
      } else {
        block.setFieldValue(2,'quantity_inputs');
        block.additionalInputs_ = 0;
      }

      // Restore saved connections after updating inputs
      for (let i = 1; i <= 2 ; i++) {
        if (block.getInput('input_term' + i)) {
          Blockly.Mutator.reconnect(block.connectionTerms_[i], block, 'input_term' + i);
        }
      }

    },

    // Remove additional inputs if they exist
    removeInputs_: function(input){

      // Set input that changes number of input terms as invisible
      this.getInput('number_terms').setVisible(false);

      // If user changes to MINUS, DIVIDE, etc., eliminates additional inputs as these can only have the first 2
      if (input !== 'ADD' && input !== 'MULTIPLY') {
        for (let i = 0; i < this.additionalInputs_ ; i++) {
          this.removeInput('additionalInput' + i);
        }
        this.additionalInputs_ = 0;
      }

    },

    // Update shape if we want to have more than 2 inputs
    updateShapeMultipleOperators_: function(){

      this.changeOperator_ = true;
      this.getInput('number_terms').setVisible(true);

    },

    // Remove additional inputs if necessary
    removeAdditionalInputs_: function() {

      for (let i = 0; i < this.additionalInputs_ ; i++) {
        this.removeInput('additionalInput' + i);
      }

    },

    // Update the number of inputs
    updateInputNumber_: function(input) {
      let block = this.sourceBlock_;

      // Get operator chosen to know what to put between inputs
      let operatorChoice_ = block.updatedOperator_;
      let operatorSymbol = null;
      if (operatorChoice_ === 'ADD') {
        operatorSymbol = '+';
      } else if (operatorChoice_ === 'MULTIPLY') {
        operatorSymbol = 'x';
      }


      // Save previous connections on additional inputs
      for (let i = 0; i < block.additionalInputs_ ; i++) {
        let input = block.getInput('additionalInput' + i);
        if (input) {
          block.connectionAdditionalInputs_[i] = input && input.connection.targetConnection;
        }
      }

      // There are always 2 operator inputs, we just want to add the rest if there are more than 2
      input = Number(input) - 2;

      // If the user changes number of inputs or operator, we add the additional operators
      if (input !== block.additionalInputs_ || block.changeOperator_) {

        // Remove previous additional operators so we can add them again according to new number of inputs
        block.removeAdditionalInputs_();

        // Add the specified number of additional inputs
        for (let i = 0; i < input; i++) {
          block.appendValueInput('additionalInput' + i)
            .appendField(operatorSymbol)
            .setCheck(['constant','value','query','property_single','compute_expression'])
            .setAlign(Blockly.ALIGN_RIGHT);
        }
        // Save the number of additional inputs. Will also be used to remove them when necessary
        block.additionalInputs_ = input;

        // Restore saved connections after updating number of inputs
        for (let i = 0; i < block.additionalInputs_ ; i++) {
          if (block.getInput('additionalInput' + i)) {
            Blockly.Mutator.reconnect(block.connectionAdditionalInputs_[i], block, 'additionalInput' + i);
          }
        }
      }

      block.changeOperator_ = false;

    },

    // Save connections inside the block
    saveConnections_: function(containerBlock) {
      for (let i = 1; i <= 2 ; i++) {
        let input = this.getInput('input_term' + i);
        if (input) {
          this.connectionTerms_[i] = input && input.connection.targetConnection;
        }
      }
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let operator = this.getFieldValue('choice_operator');
      container.setAttribute('operator', operator);
      return container;
    },

    domToMutation: function (xmlElement) {
      let operator = xmlElement.getAttribute('operator');
      this.getField('choice_operator').setValue(operator);
      this.getField('choice_operator').validator_(operator);
    }
  };

// ---------------------------------------------------
// Block: "query"
// ---------------------------------------------------

  Blockly.Blocks['query'] = {
    nrInputs_: 0,
    queryData_: null,
    property_ids: [],
    names_in_block: [],

    init: function() {
      let dropdownQueries = new Blockly.FieldDropdown(getQueries());

      this.appendDummyInput('queryTitle')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.QUERY.TITLE'), 'blockTitle'))
        .appendField('  ')
        .appendField(dropdownQueries, 'query_choice');
      this.setOutput(true,'query');
      this.setInputsInline(false);
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
      this.getField('query_choice').setValidator(this.updateInputs);
    },

    updateInputs: function(newValue) {
      const block = this.sourceBlock_;

      // Remove the previous value inputs, so we can add the new ones after
      block.removeInputs();
      block.addInputs(newValue);
    },

    addInputs: function(querySelected) {
      // Get the selected query parameters and add the correct number of inputs
      // The form in which the inputs will appear is, for example, the following:
      // [dropdown with selected query] "property1.ent_type_name '-' property1.property_name" [input1] ....
      restBlocklyApi.getQueryParameters(querySelected).subscribe((data) => {
        // console.log(data);
        this.queryData_ = data;
        this.nrInputs_ = this.queryData_.length;
        // Reset the property_ids saves, they will serve to associate property to input in parsing
        this.property_ids = [];
        this.names_in_block = [];
        // Add the specified number of inputs
        for (let i = 0; i < this.nrInputs_; i++) {
          this.property_ids.push(this.queryData_[i].property_id);
          this.names_in_block.push([this.queryData_[i].ent_type_name,this.queryData_[i].property_name]);
          this.appendValueInput('termInput' + i)
            .setAlign(Blockly.ALIGN_RIGHT)
            .appendField(this.queryData_[i].ent_type_name + ' ⮕ ' + this.queryData_[i].property_name + ':')
            .setCheck(['constant','value','query','property_single','compute_expression']);
        }
        // console.log('PROPERTIES:')
        //console.log(this.property_ids);
        // console.log('NAMES IN BLOCK:')
        // console.log(this.names_in_block);
      });
    },

    removeInputs: function() {
      for (let i = 0; i < this.nrInputs_ ; i++) {
        this.removeInput('termInput' + i);
      }
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let nrInputs = this.nrInputs_;
      let propertyIds = this.property_ids;
      let namesInBlock = this.names_in_block;
      let querySelected_id = this.getField('query_choice').value_;
      container.setAttribute('namesInBlock', namesInBlock);
      container.setAttribute('propertyTermsIds', propertyIds);
      container.setAttribute('nrInputs', nrInputs);
      container.setAttribute('queryId', querySelected_id);
      return container;
    },

    domToMutation: function (xmlElement) {
      let nrInputs = Number(xmlElement.getAttribute('nrinputs'));
      // Get the property_ids saved in xml mutation and push them into the array in the block
      // property_ids are saved in xml in the format: "1,5" and we want them in the format: [1,5]
      let property_ids = xmlElement.getAttribute('propertytermsids').split(',');
      let propertiesQuery = [];
      for (const property_id of property_ids) {
        propertiesQuery.push(property_id);
      }
      // Get the names presented in block saved in xml mutation and add them to block
      // these names are saved in xml in the format : "entType1, property1, entType2, property2"
      // Ww want them in an array with format [[entType1, property1],[entType2, property2]]
      let names = xmlElement.getAttribute('namesinblock').split(',');
      let namesToPresent = [];
      let quantity_names_added = 0;
      let array_ent_type_property_name = [];
      for (const name of names) {
        if (quantity_names_added !== 2) {
          array_ent_type_property_name.push(name);
          quantity_names_added++;
        }
        if (quantity_names_added === 2) {
          namesToPresent.push(array_ent_type_property_name);
          quantity_names_added = 0;
          array_ent_type_property_name = [];
        }
      }

      // When loading from XML, add the correct number of inputs with the corresponding names
      if (!this.nrInputs_) {
        this.property_ids = propertiesQuery;
        this.names_in_block = namesToPresent;
        for (let i = 0; i < nrInputs; i++) {
          this.appendValueInput('termInput' + i)
            .setAlign(Blockly.ALIGN_RIGHT)
            .appendField(this.names_in_block[i][0] + ' ⮕ ' + this.names_in_block[i][1] + ':')
            .setCheck(['constant','value','query','property_single','compute_expression']);
        }
        this.nrInputs_ = nrInputs;
      }
    }

  };

  // ---------------------------------------------------
// Block: "constant"
// ---------------------------------------------------

  Blockly.Blocks['constant'] = {
    firstUpdate_: true,

    init: function() {
      let dropdownChoices = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.DROPDOWN.NEW'),'NEW'],
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.DROPDOWN.EXISTING'),'EXISTING']
      ]);

      this.appendDummyInput('constant_choice')
        .appendField(new Blockly.FieldLabel(
          translate.instant('BLOCKLY-BLOCKS.CONSTANT.TITLE')
          , 'blockTitle'))
        .appendField(' ')
        .appendField(dropdownChoices,'choice_constant')
        // Empty field so we can refer to it later
        .appendField('','constant_choice_dropdown');
      this.getField('choice_constant').setValidator(this.choiceValidator);
      this.setOutput(true,'constant');
      this.setInputsInline(true);
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    choiceValidator: function (newValue) {
        // Remove inputs to then add them according to choice
        let block = this.sourceBlock_;
        block.removeInputs(newValue);
        // Update shape depending on constant dropdown choice
        switch (newValue) {
          case 'NEW':
            // In case user wants to create new constant
            block.updateShapeNewConstant_();
            break;
          case 'EXISTING':
            // In case user wants to use existing constants
            block.updateShapeExistingConstants_();
            break;
          default:
          //code block
        }
    },

    removeInputs: function(newValue) {
      // If new dropdown choice is EXISTING, remove empty field so we can refer to it
      if (this.firstUpdate_ && newValue === 'EXISTING') {
        this.getInput('constant_choice')
          .removeField('constant_choice_dropdown');
        this.firstUpdate_ = false;
      }

      let newConstantFieldExists = this.getInput('new_constant');
      let existingConstantFieldExists = this.getInput('existing_constant');
      if (newConstantFieldExists) {
        this.removeInput('new_constant');
      } else if (existingConstantFieldExists) {
        this.removeInput('existing_constant');
      }
    },

    updateShapeNewConstant_: function() {
      let valueTypeDropdown = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE-TYPE-DROPDOWN.STRING'), 'STRING'],
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE-TYPE-DROPDOWN.INTEGER-NUMBER'), 'INTEGER_NUMBER'],
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE-TYPE-DROPDOWN.REAL-NUMBER'), 'REAL_NUMBER'],
        [translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE-TYPE-DROPDOWN.BOOLEAN'),'BOOLEAN']
      ]);

      this.appendDummyInput('new_constant')
        .appendField(' ' +
          translate.instant('BLOCKLY-BLOCKS.CONSTANT.NAME')
          + ':')
        .appendField('"')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONSTANT.DEFAULT-TEXT-NAME')
        ), 'name')
        .appendField('"')
        .appendField(translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE-TYPE-DROPDOWN.TITLE') + ':')
        .appendField(valueTypeDropdown, 'value_type')
        .appendField(' ' +
          translate.instant('BLOCKLY-BLOCKS.CONSTANT.VALUE')
          + ':')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONSTANT.DEFAULT-TEXT-VALUE')
        ), 'value');
      this.getField('value_type').setValidator(validateValueType);
    },

    updateShapeExistingConstants_: function() {
      let existingConstants = new Blockly.FieldDropdown(getConstants());
      this.appendDummyInput('existing_constant')
        .appendField(' ')
        .appendField(existingConstants,'constant_choice_dropdown');
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let constantNew = (this.getField('choice_constant').value_ === 'NEW');
      let constantExisting = (this.getField('choice_constant').value_ === 'EXISTING');
      container.setAttribute('constantnew', constantNew);
      container.setAttribute('constantexisting', constantExisting);
      return container;
    },

    domToMutation: function (xmlElement) {
      if (xmlElement.getAttribute('constantnew') === 'true') {
        this.removeInputs('NEW');
        this.updateShapeNewConstant_();
      } else if (xmlElement.getAttribute('constantexisting') === 'true') {
        this.removeInputs('EXISTING');
        this.updateShapeExistingConstants_();
      } else {
        this.setFieldValue('NEW','choice_constant');
        this.getField('choice_constant').validator_('NEW');
      }
    }
  };

// ---------------------------------------------------
// Block: "value"
// ---------------------------------------------------

  Blockly.Blocks['value'] = {
    init: function() {
      let valueTypeDropdown = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.VALUE.VALUE-TYPE-DROPDOWN.STRING'), 'STRING'],
        [translate.instant('BLOCKLY-BLOCKS.VALUE.VALUE-TYPE-DROPDOWN.INTEGER-NUMBER'), 'INTEGER_NUMBER'],
        [translate.instant('BLOCKLY-BLOCKS.VALUE.VALUE-TYPE-DROPDOWN.REAL-NUMBER'), 'REAL_NUMBER'],
        [translate.instant('BLOCKLY-BLOCKS.VALUE.VALUE-TYPE-DROPDOWN.BOOLEAN'),'BOOLEAN']
      ]);

      this.appendDummyInput('value')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.VALUE.TITLE'), 'blockTitle'))
        .appendField(' ')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.VALUE.DEFAULT-VALUE')), 'value');
      this.appendDummyInput('value_type')
        .appendField(' ')
        .appendField(translate.instant('BLOCKLY-BLOCKS.VALUE.VALUE-TYPE-DROPDOWN.TITLE') + ':')
        .appendField(valueTypeDropdown,'value_type');
      this.getField('value_type').setValidator(validateValueType);
      this.setInputsInline(true);
      this.setOutput(true, 'value');
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: USER INPUT ----------------------

// ---------------------------------------------------
// Block: "property" with mutator for optional fields
// ---------------------------------------------------

  // TODO carregar properties no bloco quando é carregado de XML
  // Names to appear inside mutator dialog block and inside 'property' block when added
  const PROPERTY_FIELDS = [
    translate.instant('BLOCKLY-BLOCKS.PROPERTY.FORM-COMPUTE'),
    translate.instant('BLOCKLY-BLOCKS.PROPERTY.ENABLE-CONDITION'),
    translate.instant('BLOCKLY-BLOCKS.PROPERTY.VALIDATION-CONDITION')
  ];

  // Block types to be checked
  const PROPERTY_TYPES = ['form_compute', 'enable_condition', 'validation_condition'];

  Blockly.Blocks['property'] = {
    valueType:null,

    init: function () {

      let dropdownScope_ = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.ENTITY'), 'ENTITY'],
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.PROCESS'), 'PROCESS'],
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.GLOBAL'), 'GLOBAL']
      ]);

      let entTypesDropdown = new Blockly.FieldDropdown(getEntTypes);
      this.appendDummyInput('blockTitle')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY.TITLE'), 'blockTitle'));
      this.appendDummyInput('ddScopes')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE') + ':'))
        .appendField(dropdownScope_, 'scopes');
      this.appendDummyInput('ddEntTypes')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY.ENT-TYPE') + ':'))
        .appendField(entTypesDropdown, 'entTypes')
        .appendField(' ');
      this.appendDummyInput('ddProperties')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY.PROPERTY') + ':'))
        .appendField(new Blockly.FieldDropdown([['none', 'NONE']]), 'properties');
      this.appendDummyInput('mandatory')
        .appendField(new Blockly.FieldLabel(
          translate.instant('BLOCKLY-BLOCKS.PROPERTY.MANDATORY') + ':')
          )
        .appendField(new Blockly.FieldCheckbox(false),'mandatory_checkbox');
      this.getField('entTypes').setValidator(function (input) {
        getProperties(input, this.sourceBlock_);
      });
      // When property chosen changes, if 'property value' block is on the right of parent block, it updates its dropdown values
      this.getField('properties').setValidator(function (input) {
        // Get the current block
        let block = this.sourceBlock_;
        // Check if block has value type input, if so remove it. Then add the new property's value type field
        let hasValueTypeInput = block.getInput('value_type');
        if (hasValueTypeInput) {
          block.removeInput('value_type');
        }
        addValueTypeField(block, input);
      });
      this.setColour(270);
      this.setPreviousStatement(true, 'property'); //property is the name of the appendField in USER_INPUT block
      this.setNextStatement(true, 'property');
      this.jsonInit({'mutator': 'property_mutator'});
    }
  };

  Blockly.Blocks['property_mutator_block'] = {
    init: function() {
      for (let i = 0; i < PROPERTY_FIELDS.length; i++) {
        this.appendDummyInput()
          .setAlign(Blockly.ALIGN_RIGHT)
          .appendField(PROPERTY_FIELDS[i])
          .appendField(new Blockly.FieldCheckbox(false), PROPERTY_TYPES[i]);
      }
      this.setColour(270);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };

  Blockly.Constants.Widgets.PROPERTY_MUTATOR_MIXIN = {
    inputFormCompute_: false,
    inputEnable_: false,
    inputValidation_: false,
    connections_: Array(PROPERTY_FIELDS.length).fill(null),
    /**
     * Create XML to represent the number inputs.
     * @return {Element} XML storage element.
     * @this Blockly.Block
     */
    mutationToDom: function() {
      if (!this.inputFormCompute_ && !this.inputEnable_ && !this.inputValidation_) {
        return null;
      }
      let container = document.createElement('mutation');
      if (this.inputFormCompute_){
        container.setAttribute('form_compute', true);
      }
      if(this.inputEnable_){
        container.setAttribute('enable_condition', true);
      }
      if(this.inputValidation_){
        container.setAttribute('validation_condition', true);
      }
      container.setAttribute('ent_type_id', this.getFieldValue('entTypes'));
      container.setAttribute('property_id', this.getFieldValue('properties'));
      container.setAttribute('value_type', this.valueType);
      return container;
    },
    /**
     * Parse XML to restore the inputs.
     * @param {!Element} xmlElement XML storage element.
     * @this Blockly.Block
     */
    domToMutation: function(xmlElement) {
      this.inputFormCompute_ = xmlElement.getAttribute('form_compute');
      this.inputEnable_ = xmlElement.getAttribute('enable_condition');
      this.inputValidation_= xmlElement.getAttribute('validation_condition');
      this.updateShape_();
      getPropertiesSynchronous(this, Number(xmlElement.getAttribute('ent_type_id')));
      this.value_type = xmlElement.getAttribute('value_type');
      addValueTypeField(this, Number(xmlElement.getAttribute('property_id')));
    },
    /**
     * Populate the mutator's dialog with this block's components.
     * @param {!Blockly.Workspace} workspace Mutator's workspace.
     * @return {!Blockly.Block} Root block in mutator.
     * @this Blockly.Block
     */
    decompose: function(workspace) {
      let containerBlock = workspace.newBlock('property_mutator_block');
      containerBlock.setFieldValue(this.inputFormCompute_,'form_compute');
      containerBlock.setFieldValue(this.inputEnable_,'enable_condition');
      containerBlock.setFieldValue(this.inputValidation_,'validation_condition');
      containerBlock.initSvg();
      return containerBlock;
    },
    /**
     * Reconfigure this block based on the mutator dialog's components.
     * @param {!Blockly.Block} containerBlock Root block in mutator.
     * @this Blockly.Block
     */
    /**
     * Reconfigure this block based on the mutator dialog's components.
     * @param {!Blockly.Block} containerBlock Root block in mutator.
     * @this Blockly.Block
     */
    compose: function(containerBlock) {
      // Get check box values
      this.inputFormCompute_ = containerBlock.getFieldValue('form_compute') === 'TRUE';
      this.inputEnable_ = containerBlock.getFieldValue('enable_condition') === 'TRUE';
      this.inputValidation_ = containerBlock.getFieldValue('validation_condition') === 'TRUE';
      this.updateShape_();
      // Reconnect any child blocks
      for (let i = 0; i < PROPERTY_TYPES.length; i++) {
        if (this.getInput(PROPERTY_TYPES[i])) {
          Blockly.Mutator.reconnect(this.connections_[i], this, PROPERTY_TYPES[i]);
        }
      }
    },
    /**
     * Store pointers to any connected child blocks.
     * @param {!Blockly.Block} containerBlock Root block in mutator.
     * @this Blockly.Block
     */
    saveConnections: function(containerBlock) {
      for (let i = 0; i < this.connections_.length; i++) {
        let input = this.getInput(PROPERTY_TYPES[i]);
        if (input) {
          this.connections_[i] = input && input.connection.targetConnection;
        }
      }
    },
    /**
     * Modify this block to have the correct number of inputs.
     * @this Blockly.Block
     * @private
     */
    updateShape_: function() {
      // Delete everything.
      PROPERTY_TYPES.forEach(element => {
        if (this.getInput(element)) {
          this.removeInput(element);
        }
      });
      // Rebuild block.
      if(this.inputFormCompute_){
        this.appendValueInput('form_compute')
          .setCheck(['form_compute'])
          .setAlign(Blockly.ALIGN_RIGHT)
          .appendField(translate.instant('BLOCKLY-BLOCKS.PROPERTY.FORM-COMPUTE') + ':');
      }
      if(this.inputEnable_){
        this.appendValueInput('enable_condition')
          .setCheck('enable_condition')
          .setAlign(Blockly.ALIGN_RIGHT)
          .appendField(translate.instant('BLOCKLY-BLOCKS.PROPERTY.ENABLE-CONDITION') + ':');
      }
      if(this.inputValidation_){
        this.appendValueInput('validation_condition')
          .setCheck('validation_condition')
          .setAlign(Blockly.ALIGN_RIGHT)
          .appendField(translate.instant('BLOCKLY-BLOCKS.PROPERTY.VALIDATION-CONDITION') + ':');
      }
    },

    validateEntType_: function(entType) {
      this.getField('entTypes').validator_(entType);
    }
  };
  Blockly.Extensions.registerMutator('property_mutator', Blockly.Constants.Widgets.PROPERTY_MUTATOR_MIXIN, null, ['']);

// ---------------------------------------------------------
// Block: 'form_compute'
// --------------------------------------------------------

  Blockly.Blocks['form_compute'] = {
    connectionTerms_: new Array(2).fill(null),
    connectionAdditionalInputs_: new Array(64).fill(null),
    additionalInputs_: 0,
    changeOperator_: false,
    updatedOperator_: null,
    firstUpdate: true,

    init: function() {

      let operators = new Blockly.FieldDropdown([
        ['%{BKY_MATH_ADDITION_SYMBOL}', 'ADD'],
        ['%{BKY_MATH_SUBTRACTION_SYMBOL}', 'MINUS'],
        ['%{BKY_MATH_MULTIPLICATION_SYMBOL}', 'MULTIPLY'],
        ['%{BKY_MATH_DIVISION_SYMBOL}', 'DIVIDE']
      ]);

      this.appendDummyInput('titleBlock')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.FORM-COMPUTE.TITLE'), 'blockTitle'))
        // Initializing empty fields so we can use them when updating shape without getting errors
        .appendField('','terms')
        .appendField('','whiteSpaceAfterTerms');
      this.appendValueInput('input_term1')
        .setCheck(['property_single','Number','form_compute']);
      this.appendDummyInput('operatorsDropdown')
        .appendField('  ')
        .appendField(operators, 'choice_operator')
        .appendField('  ', 'whiteSpace_afterOperator');
      this.appendValueInput('input_term2')
        .setCheck(['property_single','Number','form_compute']);
      this.getField('choice_operator').setValidator(this.updateShape_);
      this.setOutput(true,'form_compute');
      this.setColour(180);
      this.setInputsInline(true);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    // Update shape depending on operator dropdown choice
    updateShape_: function (input) {
      let block = this.sourceBlock_;
      block.updatedOperator_ = input;

      // Save any connections inside block before removing inputs
      block.saveConnections_(block);

      // Remove all inputs before adding them in updating shape
      block.removeInputs_(input);

      // Update shape depending on dropdown choice
      if (input === 'ADD' || input === 'MULTIPLY') {
        this.sourceBlock_.updateShapeMultipleOperators_();
      } else {
        // Do Nothing
      }

      // Restore saved connections after updating inputs
      for (let i = 1; i <= 2 ; i++) {
        if (block.getInput('input_term' + i)) {
          Blockly.Mutator.reconnect(block.connectionTerms_[i], block, 'input_term' + i);
        }
      }

    },

    // Remove additional inputs if they exist
    removeInputs_: function(input){

      // On the first update remove the empty fields created earlier, we can now reference them when updating shape
      if (this.firstUpdate) {
        this.getInput('titleBlock')
          .removeField('terms');
        this.getInput('titleBlock')
          .removeField('whiteSpaceAfterTerms');
        this.firstUpdate = false;
      }

      let numberOperatorsInput = this.getField('quantity_inputs');

      if(numberOperatorsInput) {
        this.getInput('titleBlock')
          .removeField('terms');
        this.getInput('titleBlock')
          .removeField('quantity_inputs');
        this.getInput('titleBlock')
          .removeField('whiteSpaceAfterTerms');
      }

      // If user changes to MINUS, DIVIDE, etc., eliminates additional inputs as these can only have the first 2
      if (input !== 'ADD' && input !== 'MULTIPLY') {
        for (let i = 0; i < this.additionalInputs_ ; i++) {
          this.removeInput('additionalInput' + i);
        }
        this.additionalInputs_ = 0;
      }

    },

    // Update shape if we want to have more than 2 inputs
    updateShapeMultipleOperators_: function(){

      this.changeOperator_ = true;

      this.getInput('titleBlock')
        .appendField(translate.instant('BLOCKLY-BLOCKS.FORM-COMPUTE.TERMS') + ':', 'terms')
        .appendField(new Blockly.FieldNumber(2,2,64), 'quantity_inputs')
        .appendField('  ', 'whiteSpaceAfterTerms');
      this.getField('quantity_inputs').setValidator(this.updateInputNumber_);

      // Maintain same number of inputs even if user changes operator
      let operatorNumberField = this.getField('quantity_inputs');
      operatorNumberField.setValue(this.additionalInputs_ + 2);
      operatorNumberField.validator_(this.additionalInputs_ + 2);


    },

    // Remove additional inputs if necessary
    removeAdditionalInputs_: function() {

      for (let i = 0; i < this.additionalInputs_ ; i++) {
        this.removeInput('additionalInput' + i);
      }

    },

    // Update the number of inputs
    updateInputNumber_: function(input) {
      let block = this.sourceBlock_;

      // Get operator chosen to know what to put between inputs
      let operatorChoice_ = block.updatedOperator_;
      let operatorSymbol = null;
      if (operatorChoice_ === 'ADD') {
        operatorSymbol = '+';
      } else if (operatorChoice_ === 'MULTIPLY') {
        operatorSymbol = 'x';
      }


      // Save previous connections on additional inputs
      for (let i = 0; i < block.additionalInputs_ ; i++) {
        let input = block.getInput('additionalInput' + i);
        if (input) {
          block.connectionAdditionalInputs_[i] = input && input.connection.targetConnection;
        }
      }

      // There are always 2 operator inputs, we just want to add the rest if there are more than 2
      input = Number(input) - 2;

      // If the user changes number of inputs or operator, we add the additional operators
      if (input !== block.additionalInputs_ || block.changeOperator_) {

        // Remove previous additional operators so we can add them again according to new number of inputs
        block.removeAdditionalInputs_();

        // Add the specified number of additional inputs
        for (let i = 0; i < input; i++) {
          block.appendValueInput('additionalInput' + i)
            .appendField(operatorSymbol)
            .setCheck(['property_single','Number','form_compute']);
        }
        // Save the number of additional inputs. Will also be used to remove them when necessary
        block.additionalInputs_ = input;

        // Restore saved connections after updating number of inputs
        for (let i = 0; i < block.additionalInputs_ ; i++) {
          if (block.getInput('additionalInput' + i)) {
            Blockly.Mutator.reconnect(block.connectionAdditionalInputs_[i], block, 'additionalInput' + i);
          }
        }
      }

      block.changeOperator_ = false;

    },

    // Save connections inside the block
    saveConnections_: function(containerBlock) {
      for (let i = 1; i <= 2 ; i++) {
        let input = this.getInput('input_term' + i);
        if (input) {
          this.connectionTerms_[i] = input && input.connection.targetConnection;
        }
      }
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let operator = this.getFieldValue('choice_operator');
      container.setAttribute('operator', operator);
      return container;
    },

    domToMutation: function (xmlElement) {
      let operator = xmlElement.getAttribute('operator');
      // in case the operator is MULTIPLY, ADD or none (when creating a block), we update the shape
      if (!operator) {
        this.getField('choice_operator').setValue('ADD');
        this.getField('choice_operator').validator_('ADD');
      } else {
        this.getField('choice_operator').setValue(operator);
        this.getField('choice_operator').validator_(operator);
      }
    }

  };

// -----------------------------------
// Block: "validation_condition"
// -----------------------------------

  Blockly.Blocks['validation_condition'] = {
    init: function() {
      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.VALIDATION-CONDITION.TITLE'), 'blockTitle'));
      this.appendStatementInput('conditions')
        .appendField(translate.instant('BLOCKLY-BLOCKS.VALIDATION-CONDITION.CONDITION') + ' :','validation_conditions')
        .setCheck('condition_validation_condition');
      this.setOutput(true,'validation_condition');
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };

// -----------------------------------
// Block: "enable_condition"
// -----------------------------------

  Blockly.Blocks['enable_condition'] = {
    init: function() {
      this.appendDummyInput()
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.ENABLE-CONDITION.TITLE'), 'blockTitle'));
      this.appendStatementInput("condition")
        .appendField(translate.instant('BLOCKLY-BLOCKS.ENABLE-CONDITION.CONDITION') + ' :', 'enable_conditions')
        .setCheck('condition');
      this.setOutput(true,'enable_condition');
      this.setColour(180);
      this.setTooltip('');
      this.setHelpUrl('');
    }
  };


// -----------------------------------
// Block: "condition_validation_condition"
// -----------------------------------

  Blockly.Blocks['condition_validation_condition'] = {
    firstTimeUpdatingShape: true,
    checkingMax: false,

    init: function() {

      let dropdownValidation = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.REQUIRED'), 'REQUIRED'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.IS-NUMBER'), 'IS_NUMBER'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.IS-INTEGER'), 'IS_INTEGER'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.IS-EMAIL'), 'IS_EMAIL'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.IS-URL'), 'IS_URL'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.EQUAL-TO'), 'EQUAL_TO'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.LESS-EQUAL'), 'LESS_EQUAL'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.HIGHER-EQUAL'), 'HIGHER_EQUAL'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.HIGHER-THAN'), 'HIGHER_THAN'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.LESS-THAN'), 'LESS_THAN'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.MIN-LENGTH'), 'MIN_LENGTH'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.MAX-LENGTH'), 'MAX_LENGTH'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.BELONGS-RANGE'), 'BELONGS_RANGE'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.MIN-WORD-LENGTH'), 'MIN_WORD_LENGTH'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.MAX-WORD-LENGTH'), 'MAX_WORD_LENGTH'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.HAS-CHARACTER'), 'HAS_CHARACTER'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.HAS-WORD'), 'HAS_WORD'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.REGULAR-EXPRESSION'), 'REG_EXPRESSION'],
        [translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.DROPDOWN.CUSTOM-VALIDATION'), 'CUSTOM_VALIDATION']
      ]);

      this.appendDummyInput('first_part_block')
        .appendField(new Blockly.FieldLabel(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.TITLE'),
          'blockTitle'))
        .appendField(' ')
        .appendField(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.EXTRA-FIELDS.NOT') + ':',
          'negation_text_field')
        .appendField(new Blockly.FieldCheckbox(false), 'negation')
        .appendField(' ')
        .appendField(dropdownValidation,'dropdown_choice')
        .appendField(' ')
        // Empty fields so we can refer to them later on
        .appendField('', 'term1')
        .appendField('', 'term2')
        .appendField('','extraField1')
        .appendField('','extraField2');
      this.getField('dropdown_choice').setValidator(this.updateShape_);

      let dropdownChoices = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DROPDOWN.NEW'),'NEW'],
        [translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DROPDOWN.EXISTING'),'EXISTING']
      ]);

      this.appendDummyInput('template_choice')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.TITLE')))
        .appendField(' ')
        .appendField(dropdownChoices,'choice_template')
        // Empty fields so we can refer to them later on
        .appendField('','extraField3')
        .appendField('','extraField4');
      this.getField('choice_template').setValidator(function (input) {

        // Remove inputs to then add them according to choice
        let block = this.sourceBlock_;
        let templateFieldExists = block.getField('template_field');
        let hasExtraField3 = block.getField('extraField3');
        let hasExtraField4 = block.getField('extraField4');

        if (templateFieldExists)
        {
          block.getInput('template_choice').removeField('template_field');
        }
        if (hasExtraField3) {
          block.getInput('template_choice').removeField('extraField3');
        }
        if (hasExtraField4) {
          block.getInput('template_choice').removeField('extraField4');
        }

        // Update shape depending on template dropdown choice
        switch (input) {
          case 'NEW':
            // In case user wants to create new template
            block.updateShapeCONew_();
            break;
          case 'EXISTING':
            // In case user wants to use existing template
            block.updateShapeCOExisting_();
            break;
          default:
          //code block
        }
      });
      this.setFieldValue('NEW','choice_template');
      this.getField('choice_template').validator_('NEW');
      this.setPreviousStatement(true, 'condition_validation_condition');
      this.setNextStatement(true,'condition_validation_condition');
      this.setInputsInline(false);
      this.setColour(230);
      this.setTooltip('');
      this.setHelpUrl('');

    },

    updateShapeCO_: function(dTm) {
      // Remove inputs to then add them according to choice
      let templateFieldExists = this.getField('template_field');
      let hasExtraField3 = this.getField('extraField3');
      let hasExtraField4 = this.getField('extraField4');

      if (templateFieldExists)
      {
        this.getInput('template_choice').removeField('template_field');
      }
      if (hasExtraField3) {
        this.getInput('template_choice').removeField('extraField3');
      }
      if (hasExtraField4) {
        this.getInput('template_choice').removeField('extraField4');
      }

      // For when we're uploading xml to workspace and in xml, CO is Existing
      if(dTm === 'EXISTING') {
        this.setFieldValue('EXISTING','choice_template');
        this.getField('choice_template').validator_('EXISTING');
      } else {
        // Initial value to appear in 'USER OUTPUT'
        this.setFieldValue('NEW','choice_template');
        this.getField('choice_template').validator_('NEW');
      }
    },

    updateShapeCONew_: function() {
      this.getInput('template_choice')
        .appendField('"', 'extraField3')
        .appendField(new Blockly.FieldTextInput(translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DEFAULT-TEXT')), 'template_field')
        .appendField('"', 'extraField4')
    },

    updateShapeCOExisting_: function() {
      let dropdownTemplates = new Blockly.FieldDropdown(getTemplatesValidationWarning);
      this.getInput('template_choice')
        .appendField(dropdownTemplates, 'template_field');
    },

    // Update shape depending on dropdown choice
    updateShape_: function (newValue) {
      let block = this.sourceBlock_;

      // Set these fields visible as they can be invisible due to previous choice
      block.getField('negation_text_field').setVisible(true);
      block.getField('negation').setVisible(true);
      block.setFieldValue(false,'negation');

      // Remove all inputs before adding them in updating shape
      block.removeInputs_(newValue);

      // Updating block depending on newValue
      if (newValue === 'IS_NUMBER' || newValue === 'IS_INTEGER' || newValue === 'IS_EMAIL' || newValue === 'IS_URL') {

        // Do Nothing

      } else if (newValue === 'REQUIRED') {

        block.updateShapeRequired_();

      } else if (newValue === 'EQUAL_TO' || newValue === 'LESS_EQUAL' || newValue === 'HIGHER_EQUAL' || newValue === 'HIGHER_THAN' || newValue === 'LESS_THAN') {

        // Append one number input
        block.updateShapeOneNumberInput_();

      } else if (newValue === 'MIN_LENGTH' || newValue === 'MAX_LENGTH' || newValue === 'MIN_WORD_LENGTH' || newValue === 'MAX_WORD_LENGTH') {

        // Append one number input with validator for integers only
        block.updateShapeOneNumberInputValidator_();

      } else if (newValue === 'BELONGS_RANGE') {

        // Append 2 number inputs, first value can't be bigger than second
        block.updateShapeBR_();

      } else if (newValue === 'HAS_CHARACTER') {

        // Append text input with validation for 1 character only
        block.updateShapeHC_();

      } else if (newValue === 'HAS_WORD') {

        // Append text input with validation for 1 word only
        block.updateShapeHW_();

      } else if (newValue === 'REG_EXPRESSION') {

        // Append text input - if possible verify if reg expression is well formed
        block.updateShapeRE_();

      } else if (newValue === 'CUSTOM_VALIDATION') {

        // Append text input
        block.updateShapeCV_();

      }
    },

    updateShapeRequired_: function() {
      // Set fields as invisible as they don't apply here
      this.getField('negation_text_field').setVisible(false);
      this.getField('negation').setVisible(false);
    },

    updateShapeOneNumberInput_: function() {

      this.getInput('first_part_block')
        .appendField(new Blockly.FieldNumber(1), 'term1')

    },

    updateShapeOneNumberInputValidator_: function() {

      // Set fields as invisible as they don't apply here
      this.getField('negation_text_field').setVisible(false);
      this.getField('negation').setVisible(false);

      this.getInput('first_part_block')
        // FieldNumber(opt_value, opt_min, opt_max, opt_precision, opt_validator)
        // Precision on 1 means only integers, but it rounds up, we use validator that highlights when value is prohibited
        .appendField(new Blockly.FieldNumber(1,1,null,null, integerValidator_), 'term1');

      // Validate FieldNumber changes for integers only, otherwise reverts to old value
      function integerValidator_(newValue) {
        newValue = Number(newValue);
        if (Number.isInteger(newValue)) {
          return newValue;
        } else {
          return null;
        }
      }

    },

    updateShapeBR_: function() {

      this.getInput('first_part_block')
        .appendField(new Blockly.FieldNumber(1,null,null,null,firstInputValidator), 'term1')
        .appendField(translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.EXTRA-FIELDS.BELONGS-RANGE-TO'), 'extraField1')
        .appendField(new Blockly.FieldNumber(2,null,null,null,secondInputValidator), 'term2');

      // Verifies if min is greater than max, if is fixes the max
      function firstInputValidator(newValue) {
        let block = this.sourceBlock_;
        if (newValue !== '1' && !block.checkingMax) {
          let minField = this;
          let maxField = block.getField('term2');
          block.checkingMax = true;
          fixMaxIfMinBigger(minField, maxField);
          block.checkingMax = false;
        }
      }

      // Verifies if max is smaller than min, if is fixes the min
      function secondInputValidator(newValue) {
        let block = this.sourceBlock_;
        if (newValue !== '2' && !block.checkingMax) {
          let minField = block.getField('term1');
          let maxField = this;
          block.checkingMax = true;
          fixMinIfMaxSmaller(minField, maxField);
          block.checkingMax = false;
        }
      }

    },

    updateShapeHC_: function() {

      this.getInput('first_part_block')
        .appendField('"', 'extraField1')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.VALIDATOR-WARNING.HAS-CHARACTER')
        ), 'term1')
        .appendField('"', 'extraField2');

      this.getField('term1').setValidator(validateHasOneCharacter);

      // Checks if text input has only 1 character, if not returns to old value
      function validateHasOneCharacter(newValue) {
        if (newValue.length > 1) {
          return null;
        } else {
          return newValue;
        }
      }


    },

    updateShapeHW_: function() {

      this.getInput('first_part_block')
        .appendField('"', 'extraField1')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.VALIDATOR-WARNING.HAS-WORD')
        ), 'term1')
        .appendField('"', 'extraField2');

      this.getField('term1').setValidator(validateHasOneWord);

      // Checks if text input has only 1 word, if not returns to old value
      function validateHasOneWord(newValue) {
        let nrOfWords = newValue.split(' ').length;
        if (nrOfWords > 1) {
          return null;
        } else {
          return newValue;
        }
      }

    },

    updateShapeRE_: function() {

      this.getInput('first_part_block')
        .appendField('"', 'extraField1')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.VALIDATOR-WARNING.REGULAR-EXPRESSION')
        ), 'term1')
        .appendField('"', 'extraField2');

    },

    updateShapeCV_: function() {

      // Set fields as invisible as they don't apply here
      this.getField('negation_text_field').setVisible(false);
      this.getField('negation').setVisible(false);

      this.getInput('first_part_block')
        .appendField('"', 'extraField1')
        .appendField(new Blockly.FieldTextInput(
          translate.instant('BLOCKLY-BLOCKS.CONDITION-VALIDATION-CONDITION.VALIDATOR-WARNING.CUSTOM-VALIDATION')
        ), 'term1')
        .appendField('"', 'extraField2');

    },


    removeInputs_: function () {

      // On the first update remove the empty fields created earlier, we can now reference them when updating shape
      if (this.firstTimeUpdatingShape) {
        this.getInput('first_part_block')
          .removeField('term1');
        this.getInput('first_part_block')
          .removeField('term2');
        this.getInput('first_part_block')
          .removeField('extraField1');
        this.getInput('first_part_block')
          .removeField('extraField2');
        this.firstTimeUpdatingShape = false;
      }

      // If there are optional inputs, it removes them before updating shape
      let has1stTerm = this.getField('term1');
      let has2ndTerm = this.getField('term2');
      let hasExtraField1 = this.getField('extraField1');
      let hasExtraField2 = this.getField('extraField2');

      if (has1stTerm) {
        this.getInput('first_part_block').removeField('term1');
      }
      if (has2ndTerm) {
        this.getInput('first_part_block').removeField('term2');
      }
      if (hasExtraField1) {
        this.getInput('first_part_block').removeField('extraField1');
      }
      if (hasExtraField2) {
        this.getInput('first_part_block').removeField('extraField2');
      }
    },

    mutationToDom: function () {
      let container = document.createElement('mutation');
      let dropdown_choice = this.getField('dropdown_choice').value_;
      let isRequired = dropdown_choice === 'REQUIRED';
      let has1NumberInput = (dropdown_choice === 'EQUAL_TO' || dropdown_choice === 'LESS_EQUAL' || dropdown_choice === 'HIGHER_EQUAL' || dropdown_choice === 'HIGHER_THAN' || dropdown_choice === 'LESS_THAN');
      let has1NumberInputOnlyIntegers = (dropdown_choice === 'MIN_LENGTH' || dropdown_choice === 'MAX_LENGTH' || dropdown_choice === 'MIN_WORD_LENGTH' || dropdown_choice === 'MAX_WORD_LENGTH');
      let has2NumberInputs = dropdown_choice === 'BELONGS_RANGE';
      let hasTextInputOnly1Character = dropdown_choice === 'HAS_CHARACTER';
      let hasTextInputOnly1Word = dropdown_choice === 'HAS_WORD';
      let hasTextInputRegExpression = dropdown_choice === 'REG_EXPRESSION';
      let hasTextInputCustomValidation = dropdown_choice === 'CUSTOM_VALIDATION';
      let coExisting = (this.getFieldValue('choice_template') === 'EXISTING');
      container.setAttribute('required', isRequired);
      container.setAttribute('has1NumberInput', has1NumberInput);
      container.setAttribute('has1NumberInputOnlyIntegers', has1NumberInputOnlyIntegers);
      container.setAttribute('has2NumberInputs', has2NumberInputs);
      container.setAttribute('hasTextInputOnly1Character', hasTextInputOnly1Character);
      container.setAttribute('hasTextInputOnly1Word', hasTextInputOnly1Word);
      container.setAttribute('hasTextInputRegExpression', hasTextInputRegExpression);
      container.setAttribute('hasTextInputCustomValidation', hasTextInputCustomValidation);
      container.setAttribute('co_existing', coExisting);
      return container;
    },

    domToMutation: function (xmlElement) {
      this.removeInputs_();
      if (xmlElement.getAttribute('required') === 'true') {
        this.updateShapeRequired_();
      } else if (xmlElement.getAttribute('has1numberinput') === 'true') {
        this.updateShapeOneNumberInput_();
      } else if (xmlElement.getAttribute('has1numberinputonlyintegers') === 'true') {
        this.updateShapeOneNumberInputValidator_();
      } else if (xmlElement.getAttribute('has2numberinputs') === 'true') {
        this.updateShapeBR_();
      } else if (xmlElement.getAttribute('hastextinputonly1character') === 'true') {
        this.updateShapeHC_();
      } else if (xmlElement.getAttribute('hastextinputonly1word') === 'true') {
        this.updateShapeHW_();
      } else if (xmlElement.getAttribute('hastextinputregexpression') === 'true') {
        this.updateShapeRE_();
      } else if (xmlElement.getAttribute('hastextinputcustomvalidation') === 'true') {
        this.updateShapeCV_();
      }
      if (xmlElement.getAttribute('co_existing') === 'true') {
        this.updateShapeCO_('EXISTING');
      }
    }
  };


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: PROPERTY --------------------------

// ---------------------------
// Block: "property_single"
// ---------------------------

  Blockly.Blocks['property_single'] = {
    valuesFromFK: false,
    valuesTranslated: false,
    valueType: null,

    init: function () {

      let dropdownScope_ = new Blockly.FieldDropdown([
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.ENTITY'), 'ENTITY'],
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.PROCESS'), 'PROCESS'],
        [translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE-DROPDOWN.GLOBAL'), 'GLOBAL']
      ]);

      let entTypesDropdown = new Blockly.FieldDropdown(getEntTypes);
      this.appendDummyInput('title')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.TITLE'), 'blockTitle'));
      this.appendDummyInput('ddScopes')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.SCOPE') + ':'))
        .appendField(dropdownScope_, 'property_scope')
        .appendField(' ');
      this.appendDummyInput('ddEntTypes')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.ENT-TYPE') + ':'))
        .appendField(entTypesDropdown, 'entTypes')
        .appendField(' ');
      this.appendDummyInput('ddProperties')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-SINGLE.PROPERTY') + ':'))
        .appendField(new Blockly.FieldDropdown([['none', 'NONE']]), 'properties');
      this.setInputsInline(false);
      this.setOutput(true, 'property_single');
      this.setColour(50);
      this.setTooltip('');
      this.setHelpUrl('');

      // When entType chosen changes, properties are updated accordingly
      this.getField('entTypes').setValidator(function (input) {
        // console.log('Validator para property_single');
        getProperties(input, this.sourceBlock_);
        // console.log(this.sourceBlock_.getField('properties').menuGenerator_);
      });

      // When property chosen changes, if 'property value' block is on the right of parent block, it updates its dropdown values
      this.getField('properties').setValidator(function (input) {
        // Get the current block
        let block = this.sourceBlock_;
        // Check if block has value type input, if so remove it. Then add the new property's value type field
        let hasValueTypeInput = block.getInput('value_type');
        if (hasValueTypeInput) {
          block.removeInput('value_type');
        }
        addValueTypeField(block, input);

        let parBlock = block.parentBlock_;
        if (parBlock) {
          let childBlock = null;
          if (parBlock.type === 'comp_evaluated_expression' || parBlock.type === 'action') {
            for (let i = 0; i < parBlock.childBlocks_.length; i++) {
              if (parBlock.childBlocks_[i].type === 'property_value') {
                childBlock = parBlock.childBlocks_[i];
                getPropertyValues(input, childBlock);
              }
            }
          }
        }
      });
    },

    mutationToDom: function () {
      //debugger;
      let container = document.createElement('mutation');
      container.setAttribute('ent_type_id', this.getFieldValue('entTypes'));
      container.setAttribute('property_id', this.getFieldValue('properties'));
      container.setAttribute('value_type', this.valueType);
      return container;
    },

    domToMutation: function (xmlElement) {
      getPropertiesSynchronous(this, Number(xmlElement.getAttribute('ent_type_id')));
      this.value_type = xmlElement.getAttribute('value_type');
      addValueTypeField(this, Number(xmlElement.getAttribute('property_id')));
    }
  };

// ---------------------------
// Block: "property_value"
// ---------------------------

  Blockly.Blocks['property_value'] = {
    valuesFromFK: false,
    valuesTranslated: false,

    init: function() {
      this.appendDummyInput('dummyPropertyValue')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-VALUE.WARNING')));
      this.appendDummyInput('property_values')
        .appendField(new Blockly.FieldLabel(translate.instant('BLOCKLY-BLOCKS.PROPERTY-VALUE.TITLE'),'blockTitle'))
        .appendField(new Blockly.FieldDropdown([['none','NONE']]), 'property_values');
      this.setInputsInline(false);
      this.setOutput(true, 'property_value');
      this.setColour(50);
      this.setTooltip('');
      this.setHelpUrl('');
    },

    // Get the assigned property in 'property_single' block to know what values to load when loading from XML
    getPropertyOnLeftBlock: function() {

      let propertySingleValue = null;
      if (this.parentBlock_)
      {
        let parBlock = this.parentBlock_;
        let childBlock = null;

        if (parBlock.type === 'comp_evaluated_expression' || parBlock.type === 'action')
        {
          for (let i = 0; i < parBlock.childBlocks_.length; i++) {
            if (parBlock.childBlocks_[i].type === 'property_single')
            {
              childBlock = parBlock.childBlocks_[i];
              propertySingleValue = childBlock.getFieldValue('properties');
            }
          }
        }
        return propertySingleValue;
      }
    },

    mutationToDom: function() {
      //debugger;
      let container = document.createElement('mutation');
      container.setAttribute('property_value_id', this.getFieldValue('property_values'));
      container.setAttribute('property_id',this.getPropertyOnLeftBlock());
      container.setAttribute('values_from_fk',this.valuesFromFK);
      container.setAttribute('values_translated',this.valuesTranslated);
      return container;
    },

    domToMutation: function(xmlElement) {
      // Get the dropdown choices for property_values field using synchronous functions
      let property_id = Number(xmlElement.getAttribute('property_id'));
      this.valuesFromFK = xmlElement.getAttribute('values_from_fk');
      this.valuesTranslated = xmlElement.getAttribute('values_translated');
      if (this.valuesFromFK === 'true') {
        // Find the fk property associated to the property selected in the dropdown
        let FKProperty = null;
        properties.forEach(myFunction);
        function myFunction(item) {
          if (item.property_id === property_id) {
            FKProperty = item.fk_property_id;
          }
        }
        getFkPropertyValuesSynchronous(this, FKProperty)
      } else {
        // If values aren't by fk, we get the values from the prop allowed values table
        getPropAllowedValuesSynchronous(this, property_id);
      }
    }

  };


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: TESTS -----------------------------

}
