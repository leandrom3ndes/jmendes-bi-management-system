<html>
<header>
    <script src="<?= asset('blockly/blockly_compressed.js') ?>"></script>
    <script src="<?= asset('blockly/javascript_compressed.js') ?>"></script>
    <script src="<?= asset('blockly/blocks/math.js') ?>"></script>
    <script src="<?= asset('blockly/msg/js/en.js') ?>"></script>
    <script src="<?= asset('blockly/disme.js') ?>"></script>

    <link href="<?= asset('../css/app.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= asset('../font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
</header>

<body>
<table>
    <tr>
        <td id="blocklyArea">
            <div style="width: 20%;">
                <br>
                <button class="btn btn-default btn-sm btn-primary" onclick="xmlData()">View XML Blockly</button>
                <button class="btn btn-default btn-sm btn-warning" onclick="showCode()">Show Code</button>
                <button class="btn btn-default btn-sm btn-danger" onclick="convertXMLToDatabase()">Convert XML To Database</button>

                <button type="button" class="btn btn-sm btn-info"
                        onclick="window.location='http://localhost:8000';" >Go Back</button>
                <hr>
                <input type="button" onclick="test()" value="Test" />
            </div>
        </td>
    </tr>
</table>


<div id="blocklyDiv" style="height: 600px; width: 100%;"></div>

<xml id="toolbox" style="display: none;">

    <category name="Geral" colour="50">
        <block type="when_is_do"></block>
        <block type="if_then"></block>
        <block type="condition"></block>
        <block type="while"></block>
        <block type="en"></block>
    </category>

    <category name="Actions" colour="360">
        <block type="action_type"></block>
    </category>

    <category name="Properties" colour="20">
        <block type="property_single"></block>
        <block type="property_value"></block>
        <block type="property"></block>
    </category>

    <category name="Cur Form Code Compute" colour="80">
        <block type="cur_form_compute_code_enable_condition"></block>
        <block type="property_condition"></block>
    </category>

    <category name="Expressions" colour="270">
        <block type="comp_evaluated_expression"></block>
    </category>

    <category name="Terminals" colour="180">
        <block type="constant_value"></block>
    </category>

    <category name="Operators" colour="100">
        <block type="and_operator"></block>
        <block type="or_operator"></block>
        <block type="not_operator"></block>
        <block type="operator"></block>
    </category>

    <category name="Math" colour="%{BKY_MATH_HUE}">
        <block type="math_number">
            <field name="NUM">123</field>
        </block>
        <block type="math_arithmetic"></block>
        <block type="math_single"></block>
        <block type="math_trig"></block>
        <block type="math_constant"></block>
        <block type="math_number_property"></block>
        <block type="math_round"></block>
        <block type="math_on_list"></block>
        <block type="math_modulo"></block>
        <block type="math_constrain">
            <value name="LOW">
                <block type="math_number">
                    <field name="NUM">1</field>
                </block>
            </value>
            <value name="HIGH">
                <block type="math_number">
                    <field name="NUM">100</field>
                </block>
            </value>
        </block>
        <block type="math_random_int">
            <value name="FROM">
                <block type="math_number">
                    <field name="NUM">1</field>
                </block>
            </value>
            <value name="TO">
                <block type="math_number">
                    <field name="NUM">100</field>
                </block>
            </value>
        </block>
        <block type="math_random_float"></block>
        <block type="math_atan2"></block>
    </category>
</xml>



<script type="text/javascript">
    var blocklyDiv = document.getElementById('blocklyDiv');
    var workspace = Blockly.inject(blocklyDiv,
        {toolbox: document.getElementById('toolbox')});
    workspace.toolbox_.flyout_.autoClose = false;

    workspace.addChangeListener(function( event )
    {
        var bloco = workspace.getBlockById(event.blockId);
        //alert(event.type===Blockly.Events.UI);
        //console.log(bloco);
        console.log(event);
        //console.log(event.type);
        if (event.type === Blockly.Events.MOVE || event.type === Blockly.Events.CHANGE
            || event.type === Blockly.Events.DELETE
        )
        {
            var dom_workspace;
            dom_workspace = Blockly.Xml.workspaceToDom(workspace);
            //console.log(Blockly.Xml.domToPrettyText(dom_workspace));
            if (dom_workspace.innerHTML !== "")
                sendWorkspaceToDB(Blockly.Xml.domToText(dom_workspace));
        }

        var bloco = workspace.getBlockById(event.blockId);
        //debugger;
        if (bloco)
            console.log(bloco);
        if (bloco)
        {
            if (bloco.type === "condition")
            {
                //debugger;
                if (bloco.parentBlock_)
                {
                    //console.log(bloco.parentBlock_);
                    if (!(bloco.parentBlock_.type === "and_operator" || bloco.parentBlock_.type === "or_operator" ||
                        bloco.parentBlock_.type === "if_then" || bloco.parentBlock_.type === "cur_form_compute_code_enable_condition"))
                    {
                        bloco.unplug();
                    }
                }

                if (bloco.childBlocks_.length >0)
                {
                    for (i = 0; i < bloco.childBlocks_.length; i++) {
                        //alert(bloco.childBlocks_[i].type);
                        if (!(bloco.childBlocks_[i].type === "and_operator" || bloco.childBlocks_[i].type === "or_operator"))
                            bloco.childBlocks_[i].unplug();
                    }
                }
            }

            if (bloco.type === "and_operator" || bloco.type === "or_operator")
            {
                //debugger;
                if (bloco.parentBlock_)
                {
                    //console.log(bloco.parentBlock_);
                    if (bloco.parentBlock_.type !== "condition")
                    {
                        bloco.unplug();
                    }
                }

                if (bloco.childBlocks_.length >0)
                {
                    for (i = 0; i < bloco.childBlocks_.length; i++) {
                        //alert(bloco.childBlocks_[i].type);
                        if (bloco.childBlocks_[i].type !== "condition")
                            bloco.childBlocks_[i].unplug();
                    }
                }
            }

            if (!(bloco.type === 'and_operator' || bloco.type === 'or_operator' || bloco.type === 'condition' ||
                bloco.type === 'comp_evaluated_expression' || bloco.type === 'constant_value' || bloco.type === 'not_operator'))
            {
                //debugger;
                if (bloco.parentBlock_)
                {
                    if (bloco.parentBlock_.type === "condition" || bloco.parentBlock_.type === "and_operator"
                    || bloco.type === 'or_operator')
                        bloco.unplug();
                }
            }
        }
    } );

    workspace.addChangeListener(showCode());

    workspace.addChangeListener(xmlData());

    function xmlData() {
        var dom_workspace;
        dom_workspace = Blockly.Xml.workspaceToDom(workspace);
        var textDom = Blockly.Xml.domToPrettyText(dom_workspace);
        alert(textDom);
    }

    //not finished
    function sendWorkspaceToDB(workspace_xml){
        var url = new URL(window.location.href);
        var param_ar_id = url.searchParams.get("id");
        //console.log(url);
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 400)
                {
                    alert("ERROR SAVING BLOCKLY WORKSPACE TO DB!!!");
                }
                //var responseArr = JSON.parse(xhr.responseText);
            }
        };
        xhr.open("POST", "http://localhost:8000/blockly/send_workspace_xml/", true);
        var params = 'xml=' + workspace_xml + '&id=' + param_ar_id;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }


    function convertXMLToDatabase(){
        Blockly.JavaScript.INFINITE_LOOP_TRAP = null;
        var code = "<xml>" + Blockly.JavaScript.workspaceToCode(workspace) + "</xml>";
        alert(code);

        var url = new URL(window.location.href);
        var param_ar_id = url.searchParams.get("id");

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 400)
                {
                    alert("ERROR CONVERTING BLOCKLY WORKSPACE TO DB!!!");
                }
            }
        };
        xhr.open("POST", "http://localhost:8000/blockly/convert_xml_to_db/", true);
        var params = 'xml=' + code + '&id=' + param_ar_id;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(params);
    }

    var backup;
    var teste;
    function showCode(){
        Blockly.JavaScript.INFINITE_LOOP_TRAP = null;
        var code = Blockly.JavaScript.workspaceToCode(workspace);
        alert(code);
    }

    function test(){
        alert(teste);
        if (teste)
            Blockly.Xml.domToWorkspace(Blockly.Xml.textToDom(teste), workspace);
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
            this.appendStatementInput("actions") //only for labeling the area with actions
                .setCheck(["action_types", "if"]) //the name chosen in the block action_type in the appendField opt_name
                .appendField(new Blockly.FieldLabel("(actions)"));
            this.setColour(315);
            this.setTooltip("");
            this.setHelpUrl("");
        }
    };

//added by magno
    Blockly.Blocks['property'] = {
        init: function() {
            /*function getProperties(input, obj){
                var xhr = new XMLHttpRequest();
                var self = obj;
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        var options1 = [];
                        var responseArr = JSON.parse(xhr.responseText);
                        for (var i = 0; i < responseArr.length; i++)
                        {
                            options1.push([responseArr[i]['name'], responseArr[i]['property_id']]);
                        }
                        console.log(self.sourceBlock_.getField('properties'));
                        self.sourceBlock_.getField('properties').menuGenerator_ = options1;
                    }
                };
                xhr.open("GET", "http://localhost:8000/blockly/get_properties/" + input, true);
                xhr.send(null);
            }*/
            function getEntTypes(){

                var options1 = [];
                    <?php foreach($ent_types as $ent_type){ ?>
                for(var i=0; i<1; i++) {
                    options1.push(['<?php echo $ent_type->name ?>', '<?php echo $ent_type->ent_type_id ?>']);
                }

                <?php } ?>


                    return options1;
            }

            var ent_types = new Blockly.FieldDropdown(getEntTypes);
            this.appendDummyInput('ddEntTypes')
                .appendField(new Blockly.FieldLabel('(property)'))
                .appendField(new Blockly.FieldLabel('ent type: '))
                .appendField(ent_types, "ent_types")
                .appendField(' ');
            this.appendDummyInput('ddProperties')
                .appendField(new Blockly.FieldLabel('property: '))
                .appendField(new Blockly.FieldDropdown([["none","NONE"]]), "properties");
            this.getField('ent_types').setValidator(function(input) {
                var self = this;
                this.sourceBlock_.getProperties(input, self.sourceBlock_, null);
            });
            this.appendValueInput("input_enable_condition")
                .setCheck(["cur_form_compute_code_enable_condition", "Number"])
                .setAlign(Blockly.ALIGN_RIGHT)
                .appendField(new Blockly.FieldLabel('(cur_form_compute_code)', 'cur_form_compute_code'));
            this.appendValueInput('input_condition')
                .setCheck('condition') //por testar
                .setAlign(Blockly.ALIGN_RIGHT)
                .appendField(new Blockly.FieldLabel('(condition)', 'condition'));
            this.setInputsInline(false);
            this.setPreviousStatement(true, "property"); //property is the name of the appendField in specify_data block
            this.setNextStatement(true, "property");
            this.setColour(215);
            this.setTooltip("");
            this.setHelpUrl("");
        },

        getProperties: function(input, obj, property, property_id){
            var xhr = new XMLHttpRequest();
            var self = obj;
            //console.log(self);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    var options1 = [];
                    var responseArr = JSON.parse(xhr.responseText);
                    for (var i = 0; i < responseArr.length; i++)
                    {
                        options1.push([responseArr[i]['name'], responseArr[i]['property_id']]);
                    }
                    self.getField('properties').menuGenerator_ = options1;
                    if (property)
                    {
                        self.getField('properties').setText(property);
                        self.getField('properties').setValue(parseInt(property_id));
                    }
                }
            };
            xhr.open("GET", "http://localhost:8000/blockly/get_properties/" + input, true);
            xhr.send(null);
        },

        mutationToDom: function() {
            var container = document.createElement('mutation');
            if (this.getField('ent_types'))
            {
                container.setAttribute('ent_type_id', this.getField('ent_types').value_);
                container.setAttribute('ent_type_name', this.getField('ent_types').text_);
            }
            else
            {
                container.setAttribute('ent_type_id', null);
                container.setAttribute('ent_type_name', null);
            }

            if (this.getField('properties') !== 'none')
            {
                container.setAttribute('property_name', this.getField('properties').text_);
                container.setAttribute('property_id', this.getField('properties').value_);
            }
            else
            {
                container.setAttribute('property_name', null);
                container.setAttribute('property_id', null);
            }

            return container;
        },

        domToMutation: function(xmlElement) {
            //console.log(xmlElement.getAttribute('ent_type_id'));
            if (xmlElement.getAttribute('ent_type_id') !== 'null' && xmlElement.getAttribute('property_id') !== 'null')
            {
                var self = this;
                this.getProperties(xmlElement.getAttribute('ent_type_id'), self,
                    xmlElement.getAttribute('property_name'), xmlElement.getAttribute('property_id'));
            }
        }
    };

    Blockly.Blocks['property_single'] = {
        init: function() {
            function getEntTypes(){

                var options1 = [];
                    <?php foreach($ent_types as $ent_type){ ?>
                for(var i=0; i<1; i++) {
                    options1.push(['<?php echo $ent_type->name ?>', '<?php echo $ent_type->ent_type_id ?>']);
                }

                <?php } ?>

                return options1;
            }
            var ent_types = new Blockly.FieldDropdown(getEntTypes);
            this.appendDummyInput('ddEntTypes')
                .appendField(new Blockly.FieldLabel('(property)'))
                .appendField(new Blockly.FieldLabel('ent type: '))
                .appendField(ent_types, "ent_types")
                .appendField(' ');
            this.appendDummyInput('ddProperties')
                .appendField(new Blockly.FieldLabel('property: '))
                .appendField(new Blockly.FieldDropdown([["none","NONE"]]), "properties");
            this.setInputsInline(false);
            this.setOutput(true, "property_single");
            this.setColour(50);
            this.setTooltip("");
            this.setHelpUrl("");
            this.getField('ent_types').setValidator(function(input) {
                //console.log(input);
                var self = this;
                this.sourceBlock_.getProperties(input, self.sourceBlock_);
            });
            this.getField('properties').setValidator(function(input){
                var self = this;
                var thisBlock = workspace.getBlockById(self.sourceBlock_.id);

                if (thisBlock.parentBlock_)
                {
                    var parBlock = thisBlock.parentBlock_;
                    var childBlock = null;
                    if (parBlock.type === "comp_evaluated_expression" || parBlock.type === "action_type")
                    {
                        for (var i = 0; i < parBlock.childBlocks_.length; i++) {
                            if (parBlock.childBlocks_[i].type === "property_value")
                            {
                                childBlock = parBlock.childBlocks_[i];
                                //alert("tem values");
                                this.sourceBlock_.getPropertiesValues(input, self, childBlock);
                            }
                        }
                    }
                }
                //console.log(thisBlock);
            });
        },

        getProperties: function(input, obj, property, property_id)
        {
            //debugger;
            var xhr = new XMLHttpRequest();
            var self = obj;
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    var options1 = [];
                    var responseArr = JSON.parse(xhr.responseText);
                    for (var i = 0; i < responseArr.length; i++)
                    {
                        options1.push([responseArr[i]['name'], responseArr[i]['property_id']]);
                    }
                    self.getField('properties').menuGenerator_ = options1;
                    //console.log(property);
                    if (property)
                    {
                        self.getField('properties').setText(property);
                        self.getField('properties').setValue(parseInt(property_id));
                        //console.log(property);
                    }
                }
            };
            xhr.open("GET", "http://localhost:8000/blockly/get_properties/" + input, true);
            xhr.send(null);
        },

        getPropertiesValues: function(input, obj, block) {
            var xhr = new XMLHttpRequest();
            var self = obj;
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    var options1 = [];
                    var responseArr = JSON.parse(xhr.responseText);
                    for (var i = 0; i < responseArr.length; i++)
                    {
                        options1.push([responseArr[i]['value'], responseArr[i]['id']]);
                    }
                    block.getField('property_values').menuGenerator_ = options1;
                    block.getField('property_values').setValue(options1[0]['id']);
                    block.getField('property_values').setText(options1[0]['value']);
                }
            };
            xhr.open("GET", "http://localhost:8000/blockly/get_properties_values/" + input, true);
            xhr.send(null);
        },

        mutationToDom: function() {
            //debugger;
            var container = document.createElement('mutation');
            if (this.getField('ent_types'))
            {
                container.setAttribute('ent_type_id', this.getField('ent_types').value_);
                container.setAttribute('ent_type_name', this.getField('ent_types').text_);
            }
            else
            {
                container.setAttribute('ent_type_id', null);
                container.setAttribute('ent_type_name', null);
            }

            if (this.getField('properties') !== 'none')
            {
                container.setAttribute('property_name', this.getField('properties').text_);
                container.setAttribute('property_id', this.getField('properties').value_);
            }
            else
            {
                container.setAttribute('property_name', null);
                container.setAttribute('property_id', null);
            }

            return container;
        },

        domToMutation: function(xmlElement) {
            if (xmlElement.getAttribute('ent_type_id') !== 'null' && xmlElement.getAttribute('property_id') !== 'null')
            {
                var self = this;
                this.getProperties(xmlElement.getAttribute('ent_type_id'), self,
                    xmlElement.getAttribute('property_name'), xmlElement.getAttribute('property_id'));
            }
        }
    };

    Blockly.Blocks['property_value'] = {
        init: function() {
            this.appendDummyInput('dummyPropertyValue')
                .appendField(new Blockly.FieldLabel('Note: please select an option on the left side'));
            this.appendDummyInput('property_values')
                .appendField(new Blockly.FieldLabel('(property value)'))
                .appendField(new Blockly.FieldDropdown([["none","NONE"]]), "property_values");
            this.setInputsInline(false);
            this.setOutput(true, "property_value");
            this.setColour(50);
            this.setTooltip("");
            this.setHelpUrl("");
            /*this.getField('property_values').onMouseDown_(function(input) {
                //debugger;
                alert(input);

                //this.sourceBlock_.removeInputs(input);

            });*/
        },

        mutationToDom: function() {
            //debugger;
            var container = document.createElement('mutation');
            if (this.getField('property_values') !== 'none')
            {
                container.setAttribute('property_value', this.getField('property_values').text_);
                container.setAttribute('property_value_id', this.getField('property_values').value_);
            }
            else
            {
                container.setAttribute('property_value', null);
                container.setAttribute('property_value_id', null);
            }

            return container;
            //alert("mutation to dom");
        },

        domToMutation: function(xmlElement) {
            //console.log(xmlElement);
            if (xmlElement.getAttribute('property_value_id') !== 'null')
            {
                var self = this;

                //por fazer, analisar
                var thisBlock = workspace.getBlockById(self.id);

                if (thisBlock.parentBlock_) //always null parentBlock
                {
                    var parBlock = thisBlock.parentBlock_;
                    var childBlock = null;
                    //console.log(parBlock.childBlocks_);
                    if (parBlock.type === "comp_evaluated_expression" || parBlock.type === "action_type")
                    {
                        for (var i = 0; i < parBlock.childBlocks_.length; i++) {
                            if (parBlock.childBlocks_[i].type === "property_value")
                            {
                                childBlock = parBlock.childBlocks_[i];
                                alert("tem values");
                                this.getPropertiesValues(input, self, childBlock);
                            }
                        }
                    }
                }
                //analisar por fazer

                //alert(xmlElement.getAttribute('property_value'));
                self.getField('property_values').setText(xmlElement.getAttribute('property_value'));
                self.getField('property_values').setValue(parseInt(xmlElement.getAttribute('property_value_id')));
            }
            //alert("dom to mutation");
        }
    };

    Blockly.Blocks['comp_evaluated_expression'] = {
        init: function() {
            this.appendDummyInput()
                .appendField('(comp_evaluated_expression)', 'comp_evaluated_expression');

            this.appendValueInput("input_property")
                .setCheck("property_single");
            this.appendDummyInput()
                .appendField(new Blockly.FieldDropdown([["operator","not_chosen"], ["<","<"], [">",">"], ["==","=="], ["!=","!="], ["~","not"]]), "operator");
            this.appendValueInput("input_property_or_value")
                .setCheck(["property_single", "property_value"]); //property_value missing
            this.setInputsInline(true);
            this.setOutput(true, "comp_evaluated_expression");
            this.setColour(20);
            this.setTooltip("");
            this.setHelpUrl("");
        }
    };


    //deleting the input field removes the blocks inside
    /*Blockly.Blocks['comp_evaluated_expression'] = {
        init: function() {
            function getProperties(input, obj){
                var xhr = new XMLHttpRequest();
                var self = obj;
                //console.log(self);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        var options1 = [];
                        var responseArr = JSON.parse(xhr.responseText);
                        for (var i = 0; i < responseArr.length; i++)
                        {
                            options1.push([responseArr[i]['name'], '"' + responseArr[i]['property_id'] + '"']);
                        }
                        var properties = new Blockly.FieldDropdown(options1);
                        self.sourceBlock_.removeInput('ddProperties');
                        self.sourceBlock_.appendDummyInput('ddProperties')
                            .appendField(properties, "properties");
                        self.sourceBlock_.removeInput('operator_comp_evaluated_expression');
                        self.sourceBlock_.appendDummyInput('operator_comp_evaluated_expression')
                            .appendField(new Blockly.FieldDropdown([["operator","not_chosen"], ["<","less_than"], [">","greater_than"], ["==","equal"], ["!=","!="], ["~","not"]]), "operator");
                        self.sourceBlock_.removeInput('input_comp_evaluated_expression');
                        self.sourceBlock_.appendValueInput("input_comp_evaluated_expression")
                            .setCheck(["property_single"]);
                        //console.log(self.sourceBlock_.getInput('ddProperties'));
                    }
                };
                xhr.open("GET", "http://localhost:8000/blockly/test/" + input, true);
                xhr.send(null);
            }
            function getEntTypes(){

                var options1 = [];
                    <?php foreach($ent_types as $ent_type){ ?>
                for(var i=0; i<1; i++) {
                    options1.push(['<?php echo $ent_type->name ?>', '<?php echo $ent_type->ent_type_id ?>']);
                }

                <?php } ?>


                    return options1;
            }
            var ent_types = new Blockly.FieldDropdown(getEntTypes);
            this.appendDummyInput('ddEntTypes')
                .appendField(new Blockly.FieldLabel('(ent type)'))
                .appendField(ent_types, "ent_types")
                .appendField(' ');
            this.appendDummyInput('ddProperties')
                .appendField(new Blockly.FieldDropdown([["none","NONE"]]), "properties");
            this.appendDummyInput('operator_comp_evaluated_expression')
                .appendField(new Blockly.FieldDropdown([["operator","not_chosen"], ["<","less_than"], [">","greater_than"], ["==","equal"], ["!=","!="], ["~","not"]]), "operator");
            this.appendValueInput("input_comp_evaluated_expression")
                .setCheck(["property_single"]); //property_value missing
            this.setInputsInline(true);
            this.setOutput(true, "comp_evaluated_expression");
            this.setColour(20);
            this.setTooltip("");
            this.setHelpUrl("");
            this.getField('ent_types').setValidator(function(input) {
                //console.log(input);
                var self = this;
                getProperties(input, self);
            });
        }
    };*/

    //changed

    Blockly.Blocks['action_type'] = {
        init: function() {
            //console.log(this.blockDragger_);
            this.appendDummyInput("action_types")
                .appendField(new Blockly.FieldLabel('(action_type)'))
                .appendField(new Blockly.FieldDropdown([["none","NONE"], ["write value","WRITE_VALUE"],
                    ["read value","READ_VALUE"], ["produce document","PRODUCE_DOCUMENT"],
                    ["client output","CLIENT_OUTPUT"], ["external call","EXTERNAL_CALL"],
                    ["c-act","C-ACT"], ["specify data", "specify_data"]]), "action_types")
                .appendField(' ');
            this.getField('action_types').setValidator(function(input) {
                //debugger;
                alert(input);
                /*var input = (input == 'WRITE_VALUE') || (input == 'specify_data');
                this.sourceBlock_.updateShape_(input);*/

                this.sourceBlock_.removeInputs(input);

                switch(input)
                {
                    case 'WRITE_VALUE':
                        //code block
                        this.sourceBlock_.updateShapeWV_(input);
                        break;
                    case 'specify_data':
                        //code block
                        this.sourceBlock_.updateShapeSD_(input);
                        break;
                    case 'C-ACT':
                        //code block
                        this.sourceBlock_.updateShapeCACT_(input);
                        break;
                    default:
                    //code block
                }
            });
            this.setInputsInline(true);
            this.setPreviousStatement(true, "action_types"); //what block to accept on top
            this.setNextStatement(true, "action_types"); //what block to accept on bottom
            this.setColour(135);
            this.setTooltip("TESTE");
            this.setHelpUrl("");
        },

        removeInputs: function()
        {
            var WVinput1Exists = this.getInput('WV_INPUT1');
            if (WVinput1Exists)
            {
                this.removeInput('WV_INPUT1');
            }

            var WVinput2Exists = this.getInput('WV_INPUT2');
            if (WVinput2Exists)
            {
                this.removeInput('WV_INPUT2');
            }

            var inputExists = this.getInput('PROPERTIES');
            if (inputExists)
            {
                this.removeInput('PROPERTIES');
            }

            inputExists = this.getInput('transaction_type');
            if (inputExists)
            {
                this.removeInput('transaction_type');
                this.removeInput('c_fact');
            }
        },

        updateShapeWV_: function(input)
        {
            this.appendValueInput("WV_INPUT1")
                .setCheck(["casual_link", "property_single"]);

            this.appendValueInput('WV_INPUT2')
                .appendField("=")
                .setCheck(['property_single', 'property_value', 'Number']);
        },

        updateShapeSD_: function(input)
        {
            this.setInputsInline(true);
            this.appendStatementInput('PROPERTIES')
                .appendField('properties')
                .setCheck('property'); //property is the name of the appendField in property block
        },

        updateShapeCACT_: function(input)
        {
            this.setInputsInline(true);
            function getTransactions()
            {
                var options = [];
                    <?php foreach($transactions as $t){ ?>
                for(var i=0; i<1; i++) {
                    options.push(['<?php echo $t->t_name ?>', '<?php echo $t->transaction_type_id ?>']);
                }
                <?php } ?>


                    return options;
            }
            function getTStates()
            {
                var options1 = [];
                    <?php foreach($tstates as $t_state){ ?>
                for(var i=0; i<1; i++) {
                    options1.push(['<?php echo $t_state->name ?>', '<?php echo $t_state->t_state_id ?>']);
                }

                <?php } ?>

                    return options1;
            }
            var dropdown = new Blockly.FieldDropdown(getTransactions);
            this.appendDummyInput("transaction_type")
                .appendField(dropdown, "transaction_type") //changed
                .appendField(" must be");
            var dropdown_tstates = new Blockly.FieldDropdown(getTStates);
            this.appendDummyInput("c_fact")
                .appendField(dropdown_tstates, 'c_fact'); //changed

        },

        mutationToDom: function() {
            var container = document.createElement('mutation');
            var wvInput = (this.getField('action_types').value_ == 'WRITE_VALUE');
            var sdInput = (this.getField('action_types').value_ == 'specify_data');
            var cactInput = (this.getField('action_types').value_ == 'C-ACT');
            container.setAttribute('WV_INPUT1', wvInput);
            container.setAttribute('SD_INPUT1', sdInput);
            container.setAttribute('CACT_INPUT1', cactInput);
            return container;
        },

        domToMutation: function(xmlElement) {
            //console.log(xmlElement);
            if (xmlElement.getAttribute('wv_input1') == 'true')
                this.updateShapeWV_(null);
            else if (xmlElement.getAttribute('sd_input1') == 'true')
            {
                this.updateShapeSD_(null);
            }
            else if (xmlElement.getAttribute('cact_input1') == 'true')
            {
                this.updateShapeCACT_(null); // por fazer, nao funciona
            }
        }
    };

    //load blockly xml to workspace
    <?php if (isset($blockly_xml)){ ?>
        var xml_text = '<?php echo $blockly_xml; ?>';
        Blockly.Xml.domToWorkspace(Blockly.Xml.textToDom(xml_text), workspace);
    <?php } ?>

</script>

</body>
</html>