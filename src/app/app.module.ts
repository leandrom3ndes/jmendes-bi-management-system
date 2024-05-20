import { BrowserModule } from '@angular/platform-browser';
import {NgModule, NO_ERRORS_SCHEMA} from '@angular/core';
import { NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {AlertModule} from 'ngx-bootstrap/alert';
import {ModalModule} from 'ngx-bootstrap/modal';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { BsDatepickerModule} from 'ngx-bootstrap/datepicker';
import { AgGridModule } from 'ag-grid-angular';
import { NgSelectModule } from '@ng-select/ng-select';
import { FormsModule } from '@angular/forms'; // <-- NgModel lives here
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { ToastrModule } from 'ngx-toastr';
import { TranslateModule, TranslateLoader } from '@ngx-translate/core';
import { TranslateHttpLoader} from '@ngx-translate/http-loader';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormioModule} from 'angular-formio';
import { ActorComponent } from './actor/actor.component';
import { ActorCellCustomComponent } from './actor/actor_cell.component';
import { ModalActorComponent } from './modal-actor/modal-actor.component';

import { LanguageComponent } from './language/language.component';
import { LanguageCellCustomComponent } from './language/language_cell.component';
import { ModalLanguageComponent } from './modal-language/modal-language.component';

import { ProcessTypeComponent } from './processtype/processtype.component';
import { ProcessTypeCellCustomComponent } from './processtype/processtype_cell.component';
import { ModalProcessTypeComponent } from './modal-processtype/modal-processtype.component';


import { DashboardComponent } from './dashboard/dashboard.component';
import { ModalinitTDashbComponent } from './modal-inittdashb/modal-inittdashb.component';
import { InitTDashbCellCustomComponent } from './dashboard/inittdashb_cell.component';
import {TestCellCustomComponent} from './dashboard/test_cell.component';

import {LoginComponent} from './login/login.component';
import {LogoutComponent} from './logout/logout.component';
import {RegisterComponent} from './register/register.component';

import { ModalNewtdashbComponent } from './modal-newtdashb/modal-newtdashb.component';
import { BlocklyComponent } from './blockly/blockly.component';
import { ModalBlocklyComponent } from './modal-blockly/modal-blockly.component';

import { DynamicFormComponent } from './dynamic-form/dynamic-form.component';
import { DynamicFormCellCustomComponent } from './dynamic-form/dynamic-form_cell.component';
import { DynamicFormFormioComponent } from './dynamic-form-formio/dynamic-form-formio.component';
import { ModalDynamicFormComponent } from './modal-dynamic-form/modal-dynamic-form.component';
import { ModalDynamicFormDataComponent } from './modal-dynamic-form-data/modal-dynamic-form-data.component';
import { DynamicFormRenderComponent } from './dynamic-form-render/dynamic-form-render.component';
import { DynamicFormRenderCellCustomComponent } from './dynamic-form-render/dynamic-form-render-cell.component';
import { DynamicFormRenderedComponent } from './dynamic-form-render/dynamic-form-rendered/dynamic-form-rendered.component';
import { FormTranslatorComponent } from './form-translator/form-translator.component';
import { TranslatorFormCellComponent} from './form-translator/translator-form-cell';
import { ModalFormTranslatorComponent } from './form-translator/modal-form-translator/modal-form-translator.component';
import { ModalFormDashboardComponent } from './modal-form-dashboard/modal-form-dashboard.component';
import { ModalUserOutputDashboardComponent } from './modal-user-output-dashboard/modal-user-output-dashboard.component';
import { TemplateEditorComponent } from './template-editor/template-editor.component';
import { ModalTemplateEditorComponent } from './modal-template-editor/modal-template-editor.component';
import { TemplateEditorCellComponent } from './template-editor/template-editor_cell.component';
import { EditorModule} from '../assets/tinymce/tinymce-angular';

import { Ng2SearchPipeModule } from 'ng2-search-filter';
import { DataTablesModule } from 'angular-datatables';
import { NgxEchartsModule } from 'ngx-echarts';
import { BiElementComponent } from './bi-management/bi-element/bi-element.component';
import { BiElementDetailsComponent } from './bi-management/bi-element/bi-element-details/bi-element-details.component';
import { BiElementCollectionComponent } from './bi-management/bi-element/bi-element-collection/bi-element-collection.component';
import { BiEngineComponent } from './bi-management/bi-engine/bi-engine.component';
import { BiEngineBielementsComponent } from './bi-management/bi-engine/bi-engine-bielements/bi-engine-bielements.component';
import { BiKnowageComponent } from './bi-management/bi-knowage/bi-knowage.component';
import { BiKnowageDetailsComponent } from './bi-management/bi-knowage/bi-knowage-details/bi-knowage-details.component';
import { BiDashboardComponent } from './bi-management/bi-dashboard/bi-dashboard.component';
import { BiWidgetsCounterComponent } from './bi-management/bi-widgets/bi-widgets-counter/bi-widgets-counter.component';
import { BiElementManagementComponent } from './bi-management/bi-element/bi-element-management/bi-element-management.component';
import { BiKnowageManagementComponent } from './bi-management/bi-knowage/bi-knowage-management/bi-knowage-management.component';
import { BiElementModalComponent } from './bi-management/bi-element/bi-element-modal/bi-element-modal.component';
import { BiElementTypeComponent } from './bi-management/bi-element/bi-element-type/bi-element-type.component';
import { BiElementTypeModalComponent } from './bi-management/bi-element/bi-element-type-modal/bi-element-type-modal.component';
import { BiEngineManagementComponent } from './bi-management/bi-engine/bi-engine-management/bi-engine-management.component';
import { BiEngineModalComponent } from './bi-management/bi-engine/bi-engine-modal/bi-engine-modal.component';
import { BiKnowageModalComponent } from './bi-management/bi-knowage/bi-knowage-modal/bi-knowage-modal.component';
import { BiWidgetsChartsComponent } from './bi-management/bi-widgets/bi-widgets-charts/bi-widgets-charts.component';
import { BiKnowageLoginComponent } from './bi-management/bi-knowage/bi-knowage-login/bi-knowage-login.component';

export function HttpLoaderFactory(http: HttpClient) {
  return new TranslateHttpLoader(http);
}

@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    LanguageComponent,
    LanguageCellCustomComponent,
    ModalLanguageComponent,
    InitTDashbCellCustomComponent,
    TestCellCustomComponent,
    ModalinitTDashbComponent,
    LoginComponent,
    LogoutComponent,
    RegisterComponent,
    ModalNewtdashbComponent,
    ActorComponent,
    ActorCellCustomComponent,
    ModalActorComponent,
    ProcessTypeComponent,
    ProcessTypeCellCustomComponent,
    ModalProcessTypeComponent,
    BlocklyComponent,
    ModalBlocklyComponent,
    ModalProcessTypeComponent,
    DynamicFormComponent,
    DynamicFormCellCustomComponent,
    DynamicFormFormioComponent,
    ModalDynamicFormComponent,
    ModalDynamicFormDataComponent,
    DynamicFormRenderComponent,
    DynamicFormRenderCellCustomComponent,
    DynamicFormRenderedComponent,
    FormTranslatorComponent,
    TranslatorFormCellComponent,
    ModalFormTranslatorComponent,
    ModalFormDashboardComponent,
    ModalUserOutputDashboardComponent,
    TemplateEditorComponent,
    ModalTemplateEditorComponent,
    TemplateEditorCellComponent,
    BiElementComponent,
    BiElementDetailsComponent,
    BiElementCollectionComponent,
    BiEngineComponent,
    BiEngineBielementsComponent,
    BiKnowageComponent,
    BiKnowageDetailsComponent,
    BiDashboardComponent,
    BiWidgetsCounterComponent,
    BiElementManagementComponent,
    BiKnowageManagementComponent,
    BiElementModalComponent,
    BiElementTypeComponent,
    BiElementTypeModalComponent,
    BiEngineManagementComponent,
    BiEngineModalComponent,
    BiKnowageModalComponent,
    BiWidgetsChartsComponent,
    BiKnowageLoginComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    ModalModule.forRoot(),
    AgGridModule.withComponents([]),
    NgSelectModule,
    FormsModule,
    HttpClientModule,
    BrowserAnimationsModule,
    BsDatepickerModule.forRoot(),
    AlertModule.forRoot(),
    ToastrModule.forRoot(),
    FormioModule,
    HttpClientModule,
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient]
      }
    }),
    EditorModule,
    DataTablesModule,
    Ng2SearchPipeModule,
    NgxEchartsModule
  ],
  providers: [
    BsModalRef,
    ModalinitTDashbComponent,
    ModalNewtdashbComponent
  ],
  bootstrap: [AppComponent],
  entryComponents: [
    ModalLanguageComponent,
    LanguageCellCustomComponent,
    ModalActorComponent,
    ActorCellCustomComponent,
    ModalProcessTypeComponent,
    ProcessTypeCellCustomComponent,
    ModalinitTDashbComponent,
    InitTDashbCellCustomComponent,
    TestCellCustomComponent,
    ModalNewtdashbComponent,
    DynamicFormCellCustomComponent,
    ModalDynamicFormComponent,
    DynamicFormRenderCellCustomComponent,
    FormTranslatorComponent,
    TranslatorFormCellComponent,
    ModalFormTranslatorComponent,
    ModalBlocklyComponent,
    ModalFormDashboardComponent,
    ModalUserOutputDashboardComponent,
    ModalTemplateEditorComponent,
    TemplateEditorCellComponent,
    BiElementModalComponent,
    BiElementTypeModalComponent,
    BiEngineModalComponent,
    BiKnowageModalComponent
  ],
  schemas: [NO_ERRORS_SCHEMA],
})
export class AppModule { }
