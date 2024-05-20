goog.provide('Blockly.Blocks.math');

goog.require('Blockly.Blocks');


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: GENERAL ---------------------------


// ------------------------------------------------
// ------------- Block: "when_is_do" --------------

Blockly.JavaScript['when_is_do'] = function(block) {
  let dropdown_transaction_type = block.getFieldValue('transaction_type');
  let dropdown_fact = block.getFieldValue('fact');
  let statements_name = Blockly.JavaScript.statementToCode(block, 'actions');
  return 'WHEN \'' + dropdown_transaction_type + '\' IS \'' + dropdown_fact + '\' \n' + statements_name;
};


// ------------------------------------------------
// ------------- Block: "action" ------------------

Blockly.JavaScript['action'] = function(block) {
  let action_type = block.getFieldValue('action');

  let code = '<action>' +
    '<type>' + action_type + '</type>';

  if (action_type === 'ASSIGN_EXPRESSION')
  {
    code +=
      '<first_term>' + Blockly.JavaScript.valueToCode(block, 'AE_INPUT1', Blockly.JavaScript.ORDER_ATOMIC) + '</first_term>\n' +
      '<second_term>' + Blockly.JavaScript.valueToCode(block, 'AE_INPUT2', Blockly.JavaScript.ORDER_ATOMIC) + '</second_term>' +
      '<operator>=</operator>';
  }

  else if (action_type === 'USER_INPUT')
  {
    let statements_spec_data = Blockly.JavaScript.statementToCode(block, 'PROPERTIES');
    let action_name = block.getFieldValue('action_name');
    code += '<action_name>' + action_name + '</action_name>';
    code += '<properties>' + statements_spec_data + '</properties>';
  }

  else if (action_type === 'CAUSAL_LINK')
  {
    let dropdown_cl_trans_type = block.getField('transaction_type').text_;
    let dropdown_cl_trans_type_id = block.getField('transaction_type').value_;
    let dropdown_cl_trans_state = block.getField('c_fact').text_;
    let dropdown_cl_trans_state_id = block.getField('c_fact').value_;
    let min_value = block.getFieldValue('min');
    let max_value = block.getFieldValue('max');

    code += '<transaction_type>' +
        '<value>' + dropdown_cl_trans_type_id + '</value>' +
        '<text>' + dropdown_cl_trans_type + '</text>' +
      '</transaction_type>\n' +
      '<transaction_state>' +
        '<value>' + dropdown_cl_trans_state_id + '</value>' +
        '<text>' + dropdown_cl_trans_state + '</text>' +
      '</transaction_state>\n' +
      '<min>' + min_value + '</min>' +
      '<max>' + max_value + '</max>';
  }

  else if (action_type === 'USER_OUTPUT')
  {
    let dropdown_choice = block.getFieldValue('choice_template');
    if (dropdown_choice === 'NEW') {

      let new_template_name = block.getFieldValue('template_name');
      let dropdown_template_type = block.getFieldValue('template_type');

      code += '<new_template>'  +
        '<blockId>' + block.id + '</blockId>' +
        '<type>' + dropdown_template_type + '</type>' +
        '<name>' + new_template_name + '</name>';

      let new_template_text;
      if (block.template_editor_text_) {
        code += '<openedEditor>opened</openedEditor>';
        new_template_text = block.template_editor_text_;
      } else {
        code += '<openedEditor>didnt_open</openedEditor>';
        new_template_text = new_template_text = block.getFieldValue('template_text');
      }
      localStorage.setItem('templateText' + block.id, new_template_text);

      code += '<text>' + new_template_text + '</text>';

      if (dropdown_template_type === 'MODAL') {

        let template_header = block.getFieldValue('template_header');
        let template_button = block.getFieldValue('template_button');
        code += '<header>' + template_header + '</header>' +
          '<button>' + template_button + '</button>';

      } else if (dropdown_template_type === 'TOAST') {

        let template_class = block.getFieldValue('template_class');
        code += '<class>' + template_class + '</class>';

        if (template_class === 'CUSTOM') {

          let template_colour = block.getFieldValue('template_colour');
          let template_title = block.getFieldValue('template_title');
          code += '<colour>' + template_colour + '</colour>' +
          '<title>' + template_title + '</title>';

        }
      }

      code += '</new_template>' ;

    } else if (dropdown_choice === 'EXISTING') {

      let existing_template = block.getField('template_text').text_;
      let existing_template_id = block.getField('template_text').value_;

      code += '<existing_template>' +
          '<name>' + existing_template + '</name>' +
          '<value>' + existing_template_id + '</value>' +
        '</existing_template>' ;

    }
  }

  code += '</action>\n';

  return code;
};


// ------------------------------------------------
// ------------- Block: "if_then" -----------------

Blockly.JavaScript['if_then'] = function(block) {
  let statements_if_input = Blockly.JavaScript.statementToCode(block, 'if_input');
  let statements_then_input = Blockly.JavaScript.statementToCode(block, 'then_input');
  let statements_else_input = Blockly.JavaScript.statementToCode(block, 'else_input');
  let code;
  code = '<action>' +
    '<type>IF</type>' +
    '<ifCondition>' + statements_if_input + '</ifCondition>' +
    '<thenAction>' + statements_then_input + '</thenAction>';
  if (statements_else_input) {
    code += '<elseAction>' + statements_else_input + '</elseAction>'
  }
    code += '</action>';

  return code;
};


// ------------------------------------------------
// ------------- Block: "while" -------------------

Blockly.JavaScript['while'] = function(block) {
  let statement_while_condition = Blockly.JavaScript.statementToCode(block, 'while_condition');
  let statements_while_action = Blockly.JavaScript.statementToCode(block, 'while_action');
  return '<action>' +
    '<type>WHILE</type>' +
    '<whileCondition>' + statement_while_condition + '</whileCondition>' +
    '<doAction>' + statements_while_action + '</doAction>' +
    '</action>';
};



// -------------------------------------------------------------------------
// --------------------------- CATEGORY: EVALUATE ---------------------------

// ------------------------------------------------
// ------------- Block: "condition" ---------------

Blockly.JavaScript['condition'] = function(block) {
  let code = '<condition>';

  let condition_type = block.getFieldValue('choice_condition');
  let condition_terms = Blockly.JavaScript.statementToCode(block, 'input_terms');

  code += '<type>' + condition_type + '</type>' +
    '<terms>' + condition_terms + '</terms>' +
    '</condition>';

  return code;
};


// ------------------------------------------------
// ------ Block: "comp_evaluated_expression" ------

Blockly.JavaScript['comp_evaluated_expression'] = function(block) {
  let operator = block.getFieldValue('operator');
  let left_term = Blockly.JavaScript.valueToCode(block, 'first_input', Blockly.JavaScript.ORDER_ATOMIC);
  let right_term = Blockly.JavaScript.valueToCode(block, 'second_input', Blockly.JavaScript.ORDER_ATOMIC);
  let code;

  code = '<comp_evaluated_expression>' +
    '<left_term>' + left_term + '</left_term>' +
    '<operator>' + operator + "</operator>" +
    '<right_term>' + right_term + '</right_term>' +
    '</comp_evaluated_expression>' + '\n';

  return code;
};


// ------------------------------------------------
// ------ Block: "user_evaluated_expression" ------

Blockly.JavaScript['user_evaluated_expression'] = function(block) {
  let dropdown_choice = block.getFieldValue('choice_expression');

  let code = '<user_evaluated_expression>';

  if (dropdown_choice === 'NEW') {

    let new_expression_text = block.getFieldValue('expression_text');

    code += '<new_expression>' +
        '<text>' + new_expression_text + '</text>' +
      '</new_expression>' ;

  } else if (dropdown_choice === 'EXISTING') {

    let existing_expression = block.getField('expression_text').text_;
    let existing_expression_id = block.getField('expression_text').value_;

    code += '<existing_expression>' +
        '<name>' + existing_expression + '</name>' +
        '<value>' + existing_expression_id + '</value>' +
      '</existing_expression>' ;

  }

  code += '</user_evaluated_expression>';

  return code;
};



// -------------------------------------------------------------------------
// --------------------------- CATEGORY: COMPUTE ---------------------------

// ------------------------------------------------
// ------- Block: "compute_expression" ------------

Blockly.JavaScript['compute_expression'] = function(block) {

  let additionalInputsNumber = block.additionalInputs_;
  let additionalInputs = new Array(additionalInputsNumber).fill(null);

  let code = '<compute_expression>';

  let input_term1 = Blockly.JavaScript.valueToCode(block, 'input_term1', Blockly.JavaScript.ORDER_ATOMIC);
  let input_term2 = Blockly.JavaScript.valueToCode(block, 'input_term2', Blockly.JavaScript.ORDER_ATOMIC);
  let operator = block.getFieldValue('choice_operator');

  for (let i = 0; i < additionalInputsNumber ; i++) {
    let hasInput = Blockly.JavaScript.valueToCode(block, 'additionalInput' + i, Blockly.JavaScript.ORDER_ATOMIC);
    if (hasInput) {
      additionalInputs[i] = hasInput;
    }
  }

  code += '<operator>' + operator + '</operator>' +
    '<term>' + input_term1 + '</term>' +
    '<term>' +  input_term2 + '</term>';

  for (let i = 0; i < additionalInputs.length ; i++) {
    if (additionalInputs[i]) {
      code += '<term>' + additionalInputs[i] + '</term>';
    }
  }

  code += '</compute_expression>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// -------------- Block: "query" ------------------

Blockly.JavaScript['query'] = function(block) {
  let query = block.getField('query_choice').text_;
  let query_id = block.getField('query_choice').value_;
  let nrInputs = block.nrInputs_;
  let property_ids = block.property_ids;

  let code = '<query>' +
      '<text>' + query + '</text>' +
      '<value>' + query_id + '</value>';

  for (let i=0; i<nrInputs; i++) {
    let input = Blockly.JavaScript.valueToCode(block, 'termInput' + i, Blockly.JavaScript.ORDER_ATOMIC);
    code += '<termInput>' +
      '<property_id>' + property_ids[i] + '</property_id>'+
      input +
      '</termInput>'
  }

  code += '</query>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// -------------- Block: "constant" ---------------

Blockly.JavaScript['constant'] = function(block) {
  let dropdown_choice = block.getFieldValue('choice_constant');

  let code = '<constant>';

  if (dropdown_choice === 'NEW') {

    let new_constant_name = block.getFieldValue('name');
    let new_constant_value_type = block.getFieldValue('value_type');
    let new_constant_value = block.getFieldValue('value');

    code += '<new_constant>' +
      '<name>' + new_constant_name + '</name>' +
      '<value_type>' + new_constant_value_type + '</value_type>' +
      '<value>' + new_constant_value + '</value>' +
      '</new_constant>' ;

  } else if (dropdown_choice === 'EXISTING') {

    let existing_constant = block.getField('constant_choice_dropdown').text_;
    let existing_constant_id = block.getField('constant_choice_dropdown').value_;

    code += '<existing_constant>' +
      '<name>' + existing_constant + '</name>' +
      '<value>' + existing_constant_id + '</value>' +
      '</existing_constant>' ;

  }

  code += '</constant>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// -------------- Block: "value" ---------------

Blockly.JavaScript['value'] = function(block) {
  let value = block.getFieldValue('value');
  let value_type = block.getFieldValue('value_type');

  let code = '<value>' +
    '<value>' + value + '</value>' +
    '<value_type>' + value_type + '</value_type>' +
    '</value>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};



// -------------------------------------------------------------------------
// --------------------------- CATEGORY: SPECIFY DATA ----------------------

// ------------------------------------------------
// -------------- Block: "property" ---------------

Blockly.JavaScript['property'] = function(block) {
  let property = block.getField('properties').text_;
  let property_id = block.getField('properties').value_;
  let scope = block.getFieldValue('scopes');
  let mandatory = block.getFieldValue('mandatory_checkbox');
  let form_compute = Blockly.JavaScript.valueToCode(block, 'form_compute', Blockly.JavaScript.ORDER_ATOMIC);
  let enable_condition = Blockly.JavaScript.valueToCode(block, 'enable_condition', Blockly.JavaScript.ORDER_ATOMIC);
  let validation_condition = Blockly.JavaScript.valueToCode(block, 'validation_condition', Blockly.JavaScript.ORDER_ATOMIC);
  let code;

  code = '<property_userInput>' +
    '<property>' +
      '<scope>' + scope + '</scope>' +
      '<text>' + property + '</text>' +
      '<value>' + property_id + '</value>' +
    '</property>' +
    form_compute +
    enable_condition +
    validation_condition +
    '<mandatory>' + mandatory + '</mandatory>' +
    '</property_userInput>';

  return code;
};

// ------------------------------------------------
// ------- Block: "form_compute" ------------------

Blockly.JavaScript['form_compute'] = function(block) {

  let additionalInputsNumber = block.additionalInputs_;
  let additionalInputs = new Array(additionalInputsNumber).fill(null);

  let code = '<form_compute>';

  let input_term1 = Blockly.JavaScript.valueToCode(block, 'input_term1', Blockly.JavaScript.ORDER_ATOMIC);
  let input_term2 = Blockly.JavaScript.valueToCode(block, 'input_term2', Blockly.JavaScript.ORDER_ATOMIC);
  let operator = block.getFieldValue('choice_operator');

  for (let i = 0; i < additionalInputsNumber ; i++) {
    let hasInput = Blockly.JavaScript.valueToCode(block, 'additionalInput' + i, Blockly.JavaScript.ORDER_ATOMIC);
    if (hasInput) {
      additionalInputs[i] = hasInput;
    }
  }

  code += '<operator>' + operator + '</operator>' +
    '<term>' + input_term1 + '</term>' +
    '<term>' +  input_term2 + '</term>';

  for (let i = 0; i < additionalInputs.length ; i++) {
    if (additionalInputs[i]) {
      code += '<term>' + additionalInputs[i] + '</term>';
    }
  }

  code += '</form_compute>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};



// ------------------------------------------------
// --------- Block: "enable_condition" ------------

Blockly.JavaScript['enable_condition'] = function(block) {
  let condition = Blockly.JavaScript.statementToCode(block, 'condition');
  let code;

  code = '<enable_condition>' + condition + '</enable_condition>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// --------- Block: "validation_condition" --------

Blockly.JavaScript['validation_condition'] = function(block) {
  let conditions = Blockly.JavaScript.statementToCode(block, 'conditions');
  let code;

  code = '<validation_condition>' + conditions + '</validation_condition>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// --- Block: "condition_validation_condition" ----

Blockly.JavaScript['condition_validation_condition'] = function(block) {
  const neg = block.getFieldValue('negation');
  const condition_type = block.getFieldValue('dropdown_choice');
  const term1 = block.getFieldValue('term1');
  const term2 = block.getFieldValue('term2');
  const dropdown_user_output = block.getFieldValue('choice_template');
  let code;

  code = '<condition_validation_condition>' +
    '<negation>' + neg + '</negation>' +
    '<dropdown_type>' + condition_type + '</dropdown_type>' +
    '<term1>' + term1 + '</term1>' +
    '<term2>' + term2 + '</term2>';

  if (dropdown_user_output === 'NEW') {

    let new_template_text = block.getFieldValue('template_field');

    code += '<new_template>' +
      '<text>' + new_template_text + '</text>' +
      '</new_template>' ;

  } else if (dropdown_user_output === 'EXISTING') {

    let existing_template = block.getField('template_field').text_;
    let existing_template_id = block.getField('template_field').value_;

    code += '<existing_template>' +
      '<name>' + existing_template + '</name>' +
      '<value>' + existing_template_id + '</value>' +
      '</existing_template>' ;

  }
   code += '</condition_validation_condition>';

  return code;
};


// -------------------------------------------------------------------------
// --------------------------- CATEGORY: PROPERTY --------------------------

// ------------------------------------------------
// // --------- Block: "property_single" -------------

Blockly.JavaScript['property_single'] = function(block) {
  let dropdown_property_name = block.getField('properties').text_;
  let dropdown_property_value = block.getField('properties').value_;
  let dropdown_scope = block.getFieldValue('property_scope');

  let code = '<property>' +
    '<scope>' + dropdown_scope + '</scope>' +
      '<value>' + dropdown_property_value + '</value>' +
      '<text>' + dropdown_property_name + '</text>' +
    '</property>\n';

  return [code, Blockly.JavaScript.ORDER_NONE];
};


// ------------------------------------------------
// --------- Block: "property_value" --------------

Blockly.JavaScript['property_value'] = function(block) {
  let dropdown_property_text= block.getField('property_values').text_;
  let dropdown_property_value= block.getField('property_values').value_;
  let has_values_from_fk = block.valuesFromFK;

  let code = '<property_value>' +
      '<value>' + dropdown_property_value + '</value>' +
      '<text>' + dropdown_property_text + '</text>' +
      '<has_values_from_fk>' + has_values_from_fk + '</has_values_from_fk>' +
    '</property_value>';

  return [code, Blockly.JavaScript.ORDER_NONE];
};
