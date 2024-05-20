import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalFormDashboardComponent } from './modal-form-dashboard.component';

describe('ModalFormDashboardComponent', () => {
  let component: ModalFormDashboardComponent;
  let fixture: ComponentFixture<ModalFormDashboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalFormDashboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalFormDashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
