import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiWidgetsChartsComponent } from './bi-widgets-charts.component';

describe('BiWidgetsChartsComponent', () => {
  let component: BiWidgetsChartsComponent;
  let fixture: ComponentFixture<BiWidgetsChartsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiWidgetsChartsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiWidgetsChartsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
