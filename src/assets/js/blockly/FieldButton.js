goog.provide('Blockly.FieldButton');

goog.require('Blockly.Field');
goog.require('Blockly.Msg');
goog.require('goog.asserts');
goog.require('goog.dom');
goog.require('goog.userAgent');


/**
 * Class for an editable text field.
 * @param {string} text The initial content of the field.
 * @param opt_validator
 *     to validate any constraints on what the user entered.  Takes the new
 *     text as an argument and returns either the accepted text, a replacement
 *     text, or null to abort the change.
 * @extends {Blockly.Field}
 * @constructor
 */
Blockly.FieldButton = function(text, opt_validator) {
  Blockly.FieldTextInput.superClass_.constructor.call(this, text,
    opt_validator);
};
goog.inherits(Blockly.FieldButton, Blockly.Field);
/**
 * Mouse cursor style when over the hotspot that initiates the editor.
 */
Blockly.FieldButton.prototype.CURSOR = 'pointer';
/**
 * Editable fields are saved by the XML renderer, non-editable fields are not.
 */
Blockly.FieldButton.prototype.EDITABLE = true;

/**
 * Close the input widget if this input is being deleted.
 */
Blockly.FieldButton.prototype.dispose = function() {
  Blockly.WidgetDiv.hideIfOwner(this);
  Blockly.FieldButton.superClass_.dispose.call(this);
};

/**
 * Show the inline free-text editor on top of the text.
 * @param {boolean=} opt_quietInput True if editor should be created without
 *     focus.  Defaults to false.
 * @private
 */
Blockly.FieldButton.prototype.showEditor_ = function(opt_quietInput) {
  // Get the translate service created on the Blockly constructor
  const translate = my.namespace.translator();

  console.log("editor activated");

  let block = this.sourceBlock_;
  const blockTemplate = {};
  blockTemplate.type = block.getFieldValue('template_type').toLowerCase();
  // Check if field 'Name' has been edited, if not, don't pass the default text to the editor
  const hasEditedName =
    block.getFieldValue('template_name') !== translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DEFAULT-TEMPLATE-NAME-TEXT');
  if (hasEditedName) {
    blockTemplate.name = block.getFieldValue('template_name');
  }

  // Check if field 'text' has been edited by the user, and check if it is html from a previous editor interaction or text inserted by the user
  const hasHTMLText = block.template_editor_text_;
  const hasEditedText =
    block.getFieldValue('template_text') !== translate.instant('BLOCKLY-BLOCKS.ACTION.DROPDOWN.USER-OUTPUT.DEFAULT-TEXT');
  if (hasHTMLText) {
    blockTemplate.text = block.template_editor_text_;
  } else if (hasEditedText) {
    blockTemplate.text = block.getFieldValue('template_text');
  }

  if (blockTemplate.type === 'modal') {
    blockTemplate.header = block.getFieldValue('template_header');
    blockTemplate.button = block.getFieldValue('template_button');
  } else if (blockTemplate.type === 'toast') {
    blockTemplate.class = block.getFieldValue('template_class').toLowerCase();
    if (blockTemplate.class === 'custom') {
      blockTemplate.colour = block.getFieldValue('template_colour');
      blockTemplate.title = block.getFieldValue('template_title');
    }
  }
  // console.log("Source Block FieldButton");
  // console.log(block);
  // console.log(blockTemplate);
  my.namespace.publicFunc(block, blockTemplate);
};

