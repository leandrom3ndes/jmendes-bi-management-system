import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalFormTranslatorComponent } from './modal-form-translator.component';

describe('ModalFormTranslatorComponent', () => {
  let component: ModalFormTranslatorComponent;
  let fixture: ComponentFixture<ModalFormTranslatorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalFormTranslatorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalFormTranslatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
