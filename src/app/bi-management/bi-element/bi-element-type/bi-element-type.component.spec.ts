import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementTypeComponent } from './bi-element-type.component';

describe('BiElementTypeComponent', () => {
  let component: BiElementTypeComponent;
  let fixture: ComponentFixture<BiElementTypeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementTypeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementTypeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
