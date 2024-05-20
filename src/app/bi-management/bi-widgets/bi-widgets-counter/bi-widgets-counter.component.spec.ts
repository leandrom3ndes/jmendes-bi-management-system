import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiWidgetsCounterComponent } from './bi-widgets-counter.component';

describe('BiWidgetsCounterComponent', () => {
  let component: BiWidgetsCounterComponent;
  let fixture: ComponentFixture<BiWidgetsCounterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiWidgetsCounterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiWidgetsCounterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
