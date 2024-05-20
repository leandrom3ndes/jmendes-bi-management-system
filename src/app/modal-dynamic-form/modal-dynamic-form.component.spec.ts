import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalDynamicFormComponent } from './modal-dynamic-form.component';

describe('ModalDynamicFormComponent', () => {
  let component: ModalDynamicFormComponent;
  let fixture: ComponentFixture<ModalDynamicFormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalDynamicFormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalDynamicFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
