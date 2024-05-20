import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalTemplateEditorComponent } from './modal-template-editor.component';

describe('ModalTemplateEditorComponent', () => {
  let component: ModalTemplateEditorComponent;
  let fixture: ComponentFixture<ModalTemplateEditorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalTemplateEditorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalTemplateEditorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
