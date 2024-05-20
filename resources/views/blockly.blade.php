@extends('layouts.default')
@section('page_name')
    Blockly
@stop
@section('content')

    <table>
        <tr>
            <td id="blocklyArea">
                <div style="width: 20%;">
                    <input type="button" onclick="showCode()" value="ShowCode" />
                    <hr>
                </div>
            </td>
        </tr>
    </table>


    <div id="blocklyDiv" style="height: 380px; width: 100%;"></div>

    <xml id="toolbox" style="display: none;">
        <category name="Blockly">
        <block type="controls_repeat_ext"></block>
        <block type="logic_compare"></block>
        <block type="math_number"></block>
        <block type="math_arithmetic"></block>
        <block type="text"></block>
        <block type="text_print"></block>
        </category>

        <category name="Disme">
            <block type="when_is_do"></block>
            <block type="if_then"></block>
            <block type="condition"></block>
            <block type="while"></block>
            <block type="and_operator"></block>
            <block type="or_operator"></block>
            <block type="not_operator"></block>
            <block type="operator"></block>
            <block type="action_type"></block>
            <block type="assign_expression"></block>
            <block type="casual_link"></block>
            <block type="en"></block>
        </category>

    </xml>



    <script type="text/javascript">
        var blocklyDiv = document.getElementById('blocklyDiv');
        var workspace = Blockly.inject(blocklyDiv,
            {toolbox: document.getElementById('toolbox')});

        workspace.addChangeListener(showCode());

        function showCode(){
            Blockly.JavaScript.INFINITE_LOOP_TRAP = null;
            var code = Blockly.JavaScript.workspaceToCode(workspace);
            alert(code);
        }



        Blockly.Blocks['when_is_do'] = {
            init: function() {
                function getTransactions(){
					var options = [];
					<?php foreach($transactions as $t){ ?>
						for(var i=0; i<1; i++) {
							options.push(['<?php echo $t->t_name ?>', '<?php echo $t->t_name ?>']);
						}
					<?php } ?>


					return options;
                }
                var dropdown = new Blockly.FieldDropdown(getTransactions);
                this.appendDummyInput()
                    .appendField("when")
                    .appendField(dropdown, "transaction_type");
                this.appendDummyInput()
                    .appendField("is")
                    .appendField(new Blockly.FieldDropdown([["none","NONE"], ["requested","requested"], ["promised","promised"], ["stated","stated"], ["accepted","accepted"], ["revoke request requested","revoke_request_requested"], ["revoke request allowed","revoke_request_allowed"], ["revoke request refused","revoke_request_refused"], ["revoke promise requested","revoke_promise_requested"], ["revoke promise allowed","revoke_promise_allowed"], ["revoke promise refused","revoke_promise_refused"], ["revoke statement requested","revoke_statement_requested"], ["revoke statement allowed","revoke_statement_allowed"], ["revoke statement refused","revoke_statement_refused"], ["revoke acceptance requested","revoke_acceptance_requested"], ["revoke acceptance allowed","revoke_acceptance_allowed"], ["revoke acceptance refused","revoke_acceptance_refused"], ["rejected","rejected"], ["declined","declined"], ["executed","executed"]]), "fact");
                this.appendStatementInput("statements")
                    .setCheck("action")
                    .appendField("do");
                this.setColour(315);
                this.setTooltip("");
                this.setHelpUrl("");
            }
        };


        Blockly.Blocks['assign_expression'] = {
            init: function() {
                function getProperties(){

                    var options1 = [];
                        <?php foreach($properties as $p){ ?>
                    for(var i=0; i<1; i++) {
                            options1.push(['<?php echo $p->name ?>', '<?php echo $p->name ?>']);
                    }

                    <?php } ?>


                        return options1;
                }
                var properties = new Blockly.FieldDropdown(getProperties);


                this.appendDummyInput()
                    .appendField(properties, "properties");
                this.getField('properties').setValidator(function(dateInput) {
                    var dateInput = (dateInput == 'Contracted End Date');
                    this.sourceBlock_.updateShape_(dateInput);
                });
                this.setInputsInline(true);
                this.setOutput(true, "assign_expression");
                this.setColour(230);
                this.setTooltip("");
                this.setHelpUrl("");
            },



            mutationToDom: function() {
            var container = document.createElement('mutation');
            var dateInput = (this.getFieldValue('properties') == 'Contracted End Date');
            container.setAttribute('dateInput', dateInput);
            return container;
        },


        domToMutation: function(xmlElement) {
            var dateInput = (xmlElement.getAttribute('dateInput') == 'true');
            this.updateShape_(dateInput);
        },


        updateShape_: function(dateInput) {
            // Add or remove a Value Input.
            var inputExists = this.getInput('DATE');
            if (dateInput) {
                if (!inputExists) {
                    this.appendValueInput('DATE')
                        .appendField("= (date)")
                        .setCheck('String');
                }
            } else if (inputExists) {
                this.removeInput('DATE');
            }
        }



        };


        Blockly.Blocks['casual_link'] = {

            init: function() {
                function getTransactions(){

                    var options = [];
                        <?php foreach($transactions as $t){ ?>
                    for(var i=0; i<1; i++) {
                        options.push(['<?php echo $t->t_name ?>', '<?php echo $t->t_name ?>']);
                    }
                    <?php } ?>


                        return options;
                }
                var dropdown = new Blockly.FieldDropdown(getTransactions);
                this.appendDummyInput()
                    .appendField(dropdown, "transaction_type")
                    .appendField(" must be");
                this.appendDummyInput()
                    .appendField(new Blockly.FieldDropdown([["none","NONE"], ["requested","requested"], ["promised","promised"], ["stated","stated"], ["accepted","accepted"], ["revoke request requested","revoke_request_requested"], ["revoke request allowed","revoke_request_allowed"], ["revoke request refused","revoke_request_refused"], ["revoke promise requested","revoke_promise_requested"], ["revoke promise allowed","revoke_promise_allowed"], ["revoke promise refused","revoke_promise_refused"], ["revoke statement requested","revoke_statement_requested"], ["revoke statement allowed","revoke_statement_allowed"], ["revoke statement refused","revoke_statement_refused"], ["revoke acceptance requested","revoke_acceptance_requested"], ["revoke acceptance allowed","revoke_acceptance_allowed"], ["revoke acceptance refused","revoke_acceptance_refused"], ["rejected","rejected"], ["declined","declined"], ["executed","executed"]]), "c_fact");
                this.setInputsInline(true);
                this.setOutput(true, null);
                this.setColour(230);
                this.setTooltip("");
                this.setHelpUrl("");
            }
        };

    </script>


@stop
@section('footerContent')

@stop