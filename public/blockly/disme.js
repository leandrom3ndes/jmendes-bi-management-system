goog.provide('Blockly.Blocks.math');

goog.require('Blockly.Blocks');
//**************************************************************************
//Definition of the enable block (optional connection depending on checkbox)
//**************************************************************************
Blockly.Blocks['en'] = {
    init: function() {
        var checkbox = new Blockly.FieldCheckbox("TRUE", function(pxchecked) {
            this.sourceBlock_.updateShape_(pxchecked);
        });
        this.setInputsInline(false);
        this.appendDummyInput()
            .appendField("Unit")
            .appendField(new Blockly.FieldTextInput("C01"), "ENName");
        this.appendDummyInput()
            .appendField("PX")
            .appendField(checkbox, 'HasPX');
        this.setPreviousStatement(true, ["C", "EN"]);
        this.setNextStatement(true, ["C", "EN"]);
        this.setColour(40);
    },
    /**
     * Create XML to represent whether the 'pxchecked' should be present.
     * @return {Element} XML storage element.
     * @this Blockly.Block
     */
    mutationToDom: function() {
        var container = document.createElement('mutation');
        var pxchecked = (this.getFieldValue('HasPX') == 'TRUE');
        container.setAttribute('pxchecked', pxchecked);
        return container;
    },
    /**
     * Parse XML to restore the 'pxchecked'.
     * @param {!Element} xmlElement XML storage element.
     * @this Blockly.Block
     */
    domToMutation: function(xmlElement) {
        var pxchecked = (xmlElement.getAttribute('pxchecked') == 'true');
        this.updateShape_(pxchecked);
    },
    /**
     * Modify this block to have (or not have) an input for 'HasPX'.
     * @param {boolean} pxchecked True if this block HasPX is pxchecked.
     * @private
     * @this Blockly.Block
     */
    updateShape_: function(pxchecked) {
        // Add or remove a Value Input.
        if (pxchecked) {
            this.appendValueInput("PX")
                .setCheck('PX');
        } else {
            if (this.childBlocks_.length > 0) {
                for (var i = 0; i < this.childBlocks_.length; i++) {
                    if (this.childBlocks_[i].type == 'px') {
                        this.childBlocks_[i].unplug();
                        break;
                    }
                }
            }
            this.removeInput('PX');
        }
    }
};




Blockly.Blocks['and_operator'] = {
    init: function() {
        this.appendDummyInput()
            .appendField("AND", 'and_operator');

        this.setInputsInline(true);
        //this.setOutput(true, 'and_operator');
        this.setPreviousStatement(true, null);
        this.setNextStatement(true, null);
        this.setColour(90);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

Blockly.Blocks['or_operator'] = {
    init: function() {
        this.appendDummyInput()
            .appendField("OR", "or_operator");
        this.setInputsInline(true);
        //this.setOutput(true, 'or_operator');
        this.setPreviousStatement(true, null);
        this.setNextStatement(true, null);
        this.setColour(90);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

Blockly.Blocks['not_operator'] = {
    init: function() {
        this.appendDummyInput()
            .appendField("NOT");
        this.setInputsInline(true);
        this.setOutput(true, 'not_operator');
        this.setColour(90);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

Blockly.Blocks['operator'] = {
    init: function() {
        this.appendDummyInput()
            .appendField(new Blockly.FieldDropdown([["operator","not_chosen"], ["<","<"], [">",">"], ["==","=="], ["!=","!="], ["~","not"]]), "operator");
        this.setInputsInline(true);
        this.setOutput(true, "operator");
        this.setColour(0);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};


//conditions em falta
Blockly.Blocks['if_then'] = {
    init: function() {
        this.appendStatementInput("if_input")
            .appendField("if")
            .setCheck("condition");
        this.appendStatementInput("then_input")
            .setCheck("action_types")
            .appendField("then");
        this.appendStatementInput("else_input")
            .setCheck("action_types")
            .appendField("else");
        this.setInputsInline(false);
        this.setPreviousStatement(true, "action_types");
        this.setNextStatement(true, "action_types");
        this.setColour(180);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

Blockly.Blocks['while'] = {
    init: function() {
        this.appendValueInput("while_condition")
            .setCheck("condition")
            .appendField("while");
        this.appendStatementInput("while_action")
            .setCheck("action")
            .appendField("do");
        this.setPreviousStatement(true, "action");
        this.setNextStatement(true, "action");
        this.setColour(230);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

//ADDED BY MAGNO

Blockly.Blocks['cur_form_compute_code_enable_condition'] = {
    init: function() {
        this.appendDummyInput()
            .appendField('ENABLE', "properties");
        this.setNextStatement(true, null);
        this.setInputsInline(true);
        this.setOutput(true, "cur_form_compute_code_enable_condition");
        this.setColour(200);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

Blockly.Blocks['condition'] = {
    init: function() {
        this.appendDummyInput()
            .appendField("(condition)", "condition");
        this.setInputsInline(false);
        this.appendValueInput("condition_not")
            .setCheck("not_operator");

        this.appendValueInput("condition_evaluated_expression")
            .setCheck(["comp_evaluated_expression", "constant_value"]);

        this.setPreviousStatement(true, null); //if input
        this.setNextStatement(true, null); //and operator not working

        this.setColour(135);
        this.setTooltip("");
        this.setHelpUrl("");

        this.setOnChange(function(changeEvent) {
            //alert("adsads");
            //console.log("teste");
            /*if (this.getInput('NUM').connection.targetBlock()) {
                this.setWarningText(null);
            } else {
                this.setWarningText('Must have an input block.');
            }*/
            //alert(changeEvent.type);
        });
    },
    onchange: function(event) {
        //alert(event.type);
        if(Blockly.Events.BLOCK_CHANGE === event.type) {
            // do something
            alert("dragged");
        }
    }
};

Blockly.Blocks['property_condition'] = {
    init: function() {
        this.appendDummyInput()
            .appendField("(condition)", "condition");
        this.setInputsInline(true);
        this.appendValueInput("condition_not")
            .setCheck("not_operator");

        this.appendValueInput("condition_evaluated_expression")
            .setCheck(["comp_evaluated_expression", "constant_value"]);

        this.setOutput('property_condition');
        this.setColour(135);
        this.setTooltip("");
        this.setHelpUrl("");
    }
};

//TERMINALS
Blockly.Blocks['constant_value'] = {
    init: function() {
        this.appendDummyInput()
            .appendField(new Blockly.FieldTextInput("[string]"), "content");
        this.setOutput(true, "constant_value");
        this.setColour(180);
        this.setTooltip('');
    }
};


Blockly.JavaScript['condition'] = function(block) {
    var value_input1 = Blockly.JavaScript.valueToCode(block, 'condition_not', Blockly.JavaScript.ORDER_ATOMIC);
    var value_input2 = Blockly.JavaScript.valueToCode(block, 'condition_evaluated_expression', Blockly.JavaScript.ORDER_ATOMIC);
    // TODO: Assemble JavaScript into code variable.
    var code = value_input1 + ' ' + value_input2;

    return code;
};

Blockly.JavaScript['property_condition'] = function(block) {
    var value_input1 = Blockly.JavaScript.valueToCode(block, 'condition_not', Blockly.JavaScript.ORDER_ATOMIC);
    var value_input2 = Blockly.JavaScript.valueToCode(block, 'condition_evaluated_expression', Blockly.JavaScript.ORDER_ATOMIC);
    // TODO: Assemble JavaScript into code variable.
    var code = value_input1 + ' ' + value_input2;

    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['and_operator'] = function(block) {
    // TODO: Assemble JavaScript into code variable.
    var code = "<operator>" + "and" + "</operator>";
    // TODO: Change ORDER_NONE to the correct strength.
    return code;
};

Blockly.JavaScript['or_operator'] = function(block) {
    // TODO: Assemble JavaScript into code variable.
    var code = "<operator>" + "or" + "</operator>";
    // TODO: Change ORDER_NONE to the correct strength.
    return code;
};

Blockly.JavaScript['not_operator'] = function(block) {
    // TODO: Assemble JavaScript into code variable.
    var code = "<operator>" + "not" + "</operator>";
    // TODO: Change ORDER_NONE to the correct strength.
    return [code, Blockly.JavaScript.ORDER_ATOMIC];
};

Blockly.JavaScript['operator'] = function(block) {
    var dropdown_operator = block.getFieldValue('operator');
    // TODO: Assemble JavaScript into code variable.
    var code = "<operator>" + dropdown_operator + "</operator>";
    // TODO: Change ORDER_NONE to the correct strength.
    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['when_is_do'] = function(block) {
    var dropdown_transaction_type = block.getFieldValue('transaction_type');
    var dropdown_fact = block.getFieldValue('fact');
    var statements_name = Blockly.JavaScript.statementToCode(block, 'actions');
    // TODO: Assemble JavaScript into code variable.
    var code = 'WHEN \'' + dropdown_transaction_type + '\' IS ' + dropdown_fact + '\n' + statements_name;
    return code;
};

Blockly.JavaScript['if_then'] = function(block) {
    var statements_if_input = Blockly.JavaScript.statementToCode(block, 'if_input');
    var statements_then_input = Blockly.JavaScript.statementToCode(block, 'then_input');
    var statements_else_input = Blockly.JavaScript.statementToCode(block, 'else_input');
    // TODO: Assemble JavaScript into code variable.
    var code = 'IF'+ statements_if_input +' \nTHEN \n\t' + statements_then_input +'\nELSE\n\t' + statements_else_input + '\n';
    return code;
};

Blockly.JavaScript['while'] = function(block) {
    var value_while_condition = Blockly.JavaScript.valueToCode(block, 'while_condition', Blockly.JavaScript.ORDER_ATOMIC);
    var statements_while_action = Blockly.JavaScript.statementToCode(block, 'while_action');
    // TODO: Assemble JavaScript into code variable.
    var code = 'WHILE ('+ value_while_condition +') {' + statements_while_action + '}' +'\n';
    return code;
};

Blockly.JavaScript['action_type'] = function(block) {
    var dropdown_action_types = block.getFieldValue('action_types');
    var code = "<action_type><name>" + dropdown_action_types + "</name>";
    if (dropdown_action_types === "WRITE_VALUE")
    {
        code += "<properties>" + Blockly.JavaScript.valueToCode(block, 'WV_INPUT1', Blockly.JavaScript.ORDER_ATOMIC)
            + Blockly.JavaScript.valueToCode(block, 'WV_INPUT2', Blockly.JavaScript.ORDER_ATOMIC)
            + '</properties>\n' + "<operator>=</operator>";
    }
    else if (dropdown_action_types === "specify_data")
    {
        var statements_spec_data = Blockly.JavaScript.statementToCode(block, 'PROPERTIES');
        code += "<properties>" + statements_spec_data + '</properties>\n';
    }
    else if (dropdown_action_types === "C-ACT")
    {
        var dropdown_c_act_trans_type = block.getField('transaction_type').text_;
        var dropdown_c_act_trans_type_id = block.getField('transaction_type').value_;
        var dropdown_c_act_fact = block.getField('c_fact').text_;
        var dropdown_c_act_fact_id = block.getField('c_fact').value_;

        code += "<transaction_type>" +
                "<value>" + dropdown_c_act_trans_type_id + "</value>" +
                "<text>" + dropdown_c_act_trans_type + "</text>" +
                "</transaction_type>\n" +
                "<fact>" +
                "<value>" + dropdown_c_act_fact_id + "</value>" +
                "<text>" + dropdown_c_act_fact + "</text>"
                + "</fact>\n";
    }

    code += '</action_type>\n';

    return code;
};

Blockly.JavaScript['comp_evaluated_expression'] = function(block) {
    //var comp_eval_expression = block.getFieldValue('comp_evaluated_expression');
    var comp_eval_expression_operator = block.getFieldValue('operator');

    var code;
    code = "<comp_eval_expression>" +
            Blockly.JavaScript.valueToCode(block, 'input_property', Blockly.JavaScript.ORDER_ATOMIC)
            + "<operator>" + comp_eval_expression_operator + "</operator>" +
            Blockly.JavaScript.valueToCode(block, 'input_property_or_value', Blockly.JavaScript.ORDER_ATOMIC)
        + "</comp_eval_expression>"
        + '\n';

    return [code, Blockly.JavaScript.ORDER_ATOMIC];
};

Blockly.JavaScript['casual_link'] = function(block) {
    var dropdown_transaction_type = block.getFieldValue('transaction_type');
    var dropdown_c_act = block.getFieldValue('c_fact');
    // TODO: Assemble JavaScript into code variable.
    var code = ' \''+dropdown_transaction_type + '\'  [must be]  ' + dropdown_c_act;
    // TODO: Change ORDER_NONE to the correct strength.
    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['property_single'] = function(block) {
    var dropdown_property_name = block.getField('properties').text_;
    var dropdown_property_value = block.getField('properties').value_;

    var code = "<property type='normal'>" +
        "<value>" + dropdown_property_value + "</value>" +
        "<text>" + dropdown_property_name + "</text>"
        + "</property>\n";

    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['property_value'] = function(block) {
    var dropdown_property_text= block.getField('property_values').text_;
    var dropdown_property_value= block.getField('property_values').value_;

    var code = "<property type='value'>"
        + "<value>" +
        dropdown_property_value +
        "</value>" +
        "<text>" + dropdown_property_text + "</text>"
        + "</property>";

    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['property'] = function(block) {
    var code = "<cur_form_compute_code>" + "<enable>"
        + Blockly.JavaScript.valueToCode(block, 'input_enable_condition', Blockly.JavaScript.ORDER_ATOMIC) + "</enable>"
        + "<condition>" + Blockly.JavaScript.valueToCode(block, 'input_condition', Blockly.JavaScript.ORDER_ATOMIC) + "</condition>"
        + "</cur_form_compute_code>";

    var statements_properties = "<property type='normal'>" +
            "<value>" + block.getField('properties').value_ + "</value>" +
            "<text>" + block.getField('properties').text_ + "</text>" +
            code
        + "</property>";

    return statements_properties + '\n';
};

Blockly.JavaScript['cur_form_compute_code_enable_condition'] = function(block) {
    var input_enable = block.getFieldValue('properties');

    var code = input_enable;

    return [code, Blockly.JavaScript.blockToCode()];
};

Blockly.JavaScript['constant_value'] = function(block) {
    var constant_value = block.getFieldValue('content');
    // TODO: Assemble JavaScript into code variable.
    var code = constant_value;
    // TODO: Change ORDER_NONE to the correct strength.
    return [code, Blockly.JavaScript.blockToCode()];
};