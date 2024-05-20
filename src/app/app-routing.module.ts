import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {DashboardComponent} from './dashboard/dashboard.component';
import {LanguageComponent} from './language/language.component';
import {ActorComponent} from './actor/actor.component';
import {LoginComponent} from './login/login.component';
import {LogoutComponent} from './logout/logout.component';
import {RegisterComponent} from './register/register.component';
import {ProcessTypeComponent} from './processtype/processtype.component';
import { DynamicFormComponent } from './dynamic-form/dynamic-form.component';
import { AuthGuard } from './_helpers/auth_guard';
import { BlocklyComponent } from './blockly/blockly.component';

import {DynamicFormFormioComponent} from './dynamic-form-formio/dynamic-form-formio.component';
import {DynamicFormRenderComponent} from './dynamic-form-render/dynamic-form-render.component';
import {DynamicFormRenderedComponent} from './dynamic-form-render/dynamic-form-rendered/dynamic-form-rendered.component';
import {FormTranslatorComponent} from './form-translator/form-translator.component';
import {TemplateEditorComponent} from './template-editor/template-editor.component';

import { BiElementComponent } from './bi-management/bi-element/bi-element.component';
import { BiElementDetailsComponent } from './bi-management/bi-element/bi-element-details/bi-element-details.component';
import { BiElementCollectionComponent } from './bi-management/bi-element/bi-element-collection/bi-element-collection.component';
import { BiEngineComponent } from './bi-management/bi-engine/bi-engine.component';
import { BiEngineBielementsComponent } from './bi-management/bi-engine/bi-engine-bielements/bi-engine-bielements.component';
import { BiKnowageComponent } from './bi-management/bi-knowage/bi-knowage.component';
import { BiKnowageDetailsComponent } from './bi-management/bi-knowage/bi-knowage-details/bi-knowage-details.component';
import { BiDashboardComponent } from './bi-management/bi-dashboard/bi-dashboard.component';
import { BiElementManagementComponent } from './bi-management/bi-element/bi-element-management/bi-element-management.component';
import { BiKnowageManagementComponent } from './bi-management/bi-knowage/bi-knowage-management/bi-knowage-management.component';
import { BiElementTypeComponent } from './bi-management/bi-element/bi-element-type/bi-element-type.component';
import { BiEngineManagementComponent } from './bi-management/bi-engine/bi-engine-management/bi-engine-management.component';
import { BiKnowageLoginComponent } from './bi-management/bi-knowage/bi-knowage-login/bi-knowage-login.component';

const routes: Routes = [
  { path: 'dashboard', component: DashboardComponent, canActivate: [AuthGuard] },
  { path: 'languages', component: LanguageComponent, canActivate: [AuthGuard] },
  { path: 'actors', component: ActorComponent, canActivate: [AuthGuard] },
  { path: 'processtypes', component: ProcessTypeComponent, canActivate: [AuthGuard] },
  { path: 'login', component: LoginComponent },
  { path: 'logout', component: LogoutComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'formsManagement', component: DynamicFormComponent, canActivate: [AuthGuard] },
  { path: 'formsRender', component: DynamicFormRenderComponent, canActivate: [AuthGuard] },
  { path: 'formRendered/:id', component: DynamicFormRenderedComponent},
  { path: 'formsManagement/formio', component: DynamicFormFormioComponent},
  { path: 'formsTranslator', component: FormTranslatorComponent, canActivate: [AuthGuard] },
  { path: 'blockly', component: BlocklyComponent, canActivate: [AuthGuard]},
  { path: 'templateManagement', component: TemplateEditorComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biElement', component: BiElementComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biElementDetails/:biElementid', component: BiElementDetailsComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biElementCollection', component: BiElementCollectionComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biEngines', component: BiEngineComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biEngineBielements/:biEngineId', component: BiEngineBielementsComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biKnowage', component: BiKnowageComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biKnowageDetails/:biKnowageId', component: BiKnowageDetailsComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/biDashboard', component: BiDashboardComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/BiElementManagement', component: BiElementManagementComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/BiKnowageManagement', component: BiKnowageManagementComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/BiElementTypeManagement', component: BiElementTypeComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/BiEngineManagement', component: BiEngineManagementComponent, canActivate: [AuthGuard]},
    { path: 'biManagement/BiKnowageLogin', component: BiKnowageLoginComponent, canActivate: [AuthGuard]},
  { path: '**', redirectTo: 'login', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
