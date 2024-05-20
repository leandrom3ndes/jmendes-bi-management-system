import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DynamicFormRenderedComponent } from './dynamic-form-rendered.component';

describe('DynamicFormRenderedComponent', () => {
  let component: DynamicFormRenderedComponent;
  let fixture: ComponentFixture<DynamicFormRenderedComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DynamicFormRenderedComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DynamicFormRenderedComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
