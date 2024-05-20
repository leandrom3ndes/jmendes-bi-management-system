import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { FormTranslatorComponent } from './form-translator.component';

describe('FormTranslatorComponent', () => {
  let component: FormTranslatorComponent;
  let fixture: ComponentFixture<FormTranslatorComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ FormTranslatorComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(FormTranslatorComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
