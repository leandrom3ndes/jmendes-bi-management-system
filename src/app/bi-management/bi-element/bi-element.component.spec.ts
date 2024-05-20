import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementComponent } from './bi-element.component';

describe('BiElementComponent', () => {
  let component: BiElementComponent;
  let fixture: ComponentFixture<BiElementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
