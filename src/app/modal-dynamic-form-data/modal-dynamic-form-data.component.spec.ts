import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalDynamicFormDataComponent } from './modal-dynamic-form-data.component';

describe('ModalDynamicFormDataComponent', () => {
  let component: ModalDynamicFormDataComponent;
  let fixture: ComponentFixture<ModalDynamicFormDataComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalDynamicFormDataComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalDynamicFormDataComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
