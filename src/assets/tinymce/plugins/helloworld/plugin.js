/**
 * Example Plugin for TinyMCE 5 (built with RC1)
 *
 * @author Marty Friedel
 */
(function () {
  var helloworld = (function () {
    tinymce.PluginManager.add('helloworld', (editor, url) => {

      function _onAction() {
        // Do something when the plugin is triggered
        editor.insertContent('<p>Content added from my Hello World plugin.</p>');
      }

      // Define the Toolbar button
      editor.ui.registry.addButton('helloworld', {
        text: 'Hello Button',
        onAction: _onAction
      });

      // Define the Menu Item
      editor.ui.registry.addMenuItem('helloworld', {
        text: 'Hello Menu Item',
        context: 'insert',
        onAction: _onAction
      });

      // Return details to be displayed in TinyMCE's "Help" plugin, if you use it
      // This is optional.
      return {
        getMetadata() {
          return {
            name: 'Hello World example',
            url: 'https://www.martyfriedel.com/blog/tinymce-5-creating-a-plugin-with-a-dialog-and-custom-icons'
          };
        }
      };
    });
  });
});
