import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DynamicFormFormioComponent } from './dynamic-form-formio.component';

describe('DynamicFormFormioComponent', () => {
  let component: DynamicFormFormioComponent;
  let fixture: ComponentFixture<DynamicFormFormioComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DynamicFormFormioComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DynamicFormFormioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
