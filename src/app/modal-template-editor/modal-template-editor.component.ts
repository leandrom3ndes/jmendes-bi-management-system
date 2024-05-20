import {Component, EventEmitter, OnInit, Output} from '@angular/core';
import {BsModalRef, BsModalService} from 'ngx-bootstrap/modal';
import {AlertToastService} from '../shared/common/alert-toast.service';
import {TemplateApiService} from '../shared/rest-api/template-api.service';
import {TranslateService} from '@ngx-translate/core';
import {ActivatedRoute, Router} from '@angular/router';

import {Template} from '../shared/interfaces/template.model';
import {getTinymce} from '../../assets/tinymce/tinymce-angular/esm5/TinyMCE';

@Component({
  selector: 'app-modal-template-editor',
  templateUrl: './modal-template-editor.component.html',
  styleUrls: ['./modal-template-editor.component.css']
})
export class ModalTemplateEditorComponent implements OnInit {

  @Output() passEntry: EventEmitter<any> = new EventEmitter<any>();

  private template: any = {} as Template;
  private templateClass = [
    [this.translate.instant('TEMPLATE-EDITOR.MODAL.NOTIFICATION-CLASS-SUCCESS'), 'success'],
    [this.translate.instant('TEMPLATE-EDITOR.MODAL.NOTIFICATION-CLASS-INFORMATION'), 'information'],
    [this.translate.instant('TEMPLATE-EDITOR.MODAL.NOTIFICATION-CLASS-WARNING'), 'warning'],
    [this.translate.instant('TEMPLATE-EDITOR.MODAL.NOTIFICATION-CLASS-ERROR'), 'error'],
    [this.translate.instant('TEMPLATE-EDITOR.MODAL.NOTIFICATION-CLASS-CUSTOM'), 'custom'],
  ];
  private isModal = true;
  private isToast = false;
  private isClassCustom = false;
  private success: boolean;
  private from: string;
  private tinymce;

  constructor(
    private modalService: BsModalService,
    private modalRef: BsModalRef,
    private alertToast: AlertToastService,
    private restTemplateApi: TemplateApiService,
    public translate: TranslateService,
    private route: ActivatedRoute,
    public router: Router) {

    // Initial selections to be presented on select inputs
    this.template.type = 'modal';
    this.template.class = 'success';
    this.template.colour = '#ff4040';
    this.template.text = this.translate.instant('TEMPLATE-EDITOR.MODAL.TEMPLATE-TEXT-DEFAULT');
  }

  ngOnInit() {
    const params: any = this.modalService.config.initialState;
    const isEmptyObj = !Object.keys(params).length;
    if (!isEmptyObj) {
      // Comes from the Template Editor Page in order to update a Template, get its id and load the Template
      if (params.template_id) {
        this.loadTemplateById(params.template_id);
      } else {
        // Comes from Blockly in order to update a Template, get the block field values to load the fields in editor
        this.template = params.blockTemplate;
        // Update the component variables so the select inputs are also updated if necessary
        this.isModal = this.template.type === 'modal';
        this.isToast = this.template.type === 'toast';
        this.isClassCustom = this.template.class === 'custom';
      }
    } else {
      params.from = 'templateEditorComponent';
    }
    // Get the tinyMce instance
    // setTimeout(() => this.getTinyMceInstance(), 1000);
  }

  loadTemplateById(templateId) {
    this.restTemplateApi.getTemplate(templateId).subscribe((data: {}) => {
      this.template = data[0];
      // Update the component variables so the select inputs are also updated if necessary
      this.isModal = this.template.type === 'modal';
      this.isToast = this.template.type === 'toast';
      this.isClassCustom = this.template.class === 'custom';
    }, error => {
      this.alertToast.showError(this.translate.instant('TEMPLATE-EDITOR.MODAL.ERROR.TEMPLATE-INFORMATION'));
    });
  }

  onTypeChange(event: any) {
    const newType = event.target.value;
    this.isModal = newType === 'modal';
    this.isToast = newType === 'toast';
  }

  onClassChange(event: any) {
    const newClass = event.target.value;
    this.isClassCustom = newClass === 'custom';
  }

  closeModal() {
    this.modalRef.hide();
  }

  clearNonUsedInputs(templateType) {
    if (templateType === 'modal') {
      delete this.template.class;
      delete this.template.title;
      delete this.template.colour;
    } else if (templateType === 'toast') {
      delete this.template.header;
      delete this.template.button;
      if (!this.isClassCustom) {
        delete this.template.colour;
        delete this.template.title;
      }
    }
  }

  // Change the select background colour depending on the option choice
  changeSelectBackgroundColour() {
    const newColour = this.template.colour;
    const templateColourSelect = (document.getElementById('templateColour')) as HTMLSelectElement;
    templateColourSelect.style.backgroundColor = newColour;
    templateColourSelect.style.color = 'white';
  }

  passBack() {
    // Check where the template editor modal was called from
    const params: any = this.modalService.config.initialState;
    const from: any = params.from;
    // Get the template-type select input value
    const templateType = (document.getElementById('type')) as HTMLSelectElement;
    const templateTypeValue = templateType.value;
    // If call was made from the dashboard, save/update the template
    if (from === 'templateEditorComponent') {
      console.log('I WAS CALLED FROM TEMPLATE EDITOR COMPONENT');
      // Save the Template in the DB
      // If we're creating a new Template
      if (!this.template.id) {
        // Clear the inputs thar won't be used in the DB depending on the template type
        this.clearNonUsedInputs(templateTypeValue);
        // console.log(this.template);
        this.restTemplateApi.createTemplate(this.template).subscribe((data: {}) => {
          this.success = true;
          this.passEntry.emit(this.success);
          this.closeModal();
        }, error => {
          this.success = false;
          this.passEntry.emit(this.success);
        });
        // If we're updating an existing template
      } else {
        // Clear the inputs thar won't be used in the DB depending on the template type
        this.clearNonUsedInputs(templateTypeValue);
        // console.log(this.template);
        this.restTemplateApi.updateTemplate(this.template).subscribe((data: {}) => {
          this.success = true;
          this.passEntry.emit(this.success);
          this.closeModal();
        }, error => {
          this.success = false;
          this.passEntry.emit(this.success);
        });
      }
    // If call was made from blockly, send back the template values updated in the modal
    } else if (from === 'blockly') {
      // Clear the inputs thar won't be used in the DB depending on the template type
      this.clearNonUsedInputs(templateTypeValue);
      console.log('I WAS CALLED FROM BLOCKLY');
      this.passEntry.emit(this.template);
      this.closeModal();
    }
  }

  // getTinyMceInstance() {
  //   this.tinymce = getTinymce();
  //   console.log(this.tinymce);
  //   this.createPluginProperties();
  // }
  //
  // createPluginProperties()  {
  //   this.tinymce.PluginManager.yoyoyo = 'yoyooy';
  //   this.tinymce.activeEditor.windowManager.open({
  //     title: 'Dialog Title', // The dialog's title - displayed in the dialog header
  //     body: {
  //       type: 'panel', // The root body type - a Panel or TabPanel
  //       items: [ // A list of panel components
  //         {
  //           type: 'htmlpanel', // A HTML panel component
  //           html: 'Panel content goes here.'
  //         }
  //       ]
  //     },
  //     buttons: [ // A list of footer buttons
  //       {
  //         type: 'submit',
  //         text: 'OK'
  //       }
  //     ]
  //   });
    // this.tinymce.PluginManager.add('example', (editor, url) => {
    //   const openDialog = () => {
    //     return editor.windowManager.open({
    //       title: 'Example plugin',
    //       body: {
    //         type: 'panel',
    //         items: [
    //           {
    //             type: 'input',
    //             name: 'title',
    //             label: 'Title'
    //           }
    //         ]
    //       },
    //       buttons: [
    //         {
    //           type: 'cancel',
    //           text: 'Close'
    //         },
    //         {
    //           type: 'submit',
    //           text: 'Save',
    //           primary: true
    //         }
    //       ],
    //       onSubmit(api) {
    //         const data = api.getData();
    //         // Insert content when the window form is submitted
    //         editor.insertContent('Title: ' + data.title);
    //         api.close();
    //       }
    //     });
    //   };
    //
    //   // Add a button that opens a window
    //   editor.ui.registry.addButton('example', {
    //     text: 'My button',
    //     onAction() {
    //       // Open window
    //       openDialog();
    //     }
    //   });
    //
    //   // Adds a menu item, which can then be included in any menu via the menu/menubar configuration
    //   editor.ui.registry.addMenuItem('tools', {
    //     text: 'Example plugin',
    //     onAction() {
    //       // Open window
    //       openDialog();
    //     }
    //   });
    //
    //   return {
    //     getMetadata() {
    //       return  {
    //         name: 'Example plugin',
    //         url: 'http://exampleplugindocsurl.com'
    //       };
    //     }
    //   };
    // });
    // this.tinymce.init({
    //   inline: false,
    //   branding: false,
    //   min_height: 300,
    //   plugins: [
    //     'advlist autolink lists link image charmap print preview anchor',
    //     'searchreplace visualblocks code fullscreen',
    //     'insertdatetime media table paste template -example noneditable'
    //   ],
    //   toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | example'
    // });
    // console.log(this.tinymce);
  // }

}
