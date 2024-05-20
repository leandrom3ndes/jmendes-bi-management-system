import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalUserOutputDashboardComponent } from './modal-user-output-dashboard.component';

describe('ModalUserOutputDashboardComponent', () => {
  let component: ModalUserOutputDashboardComponent;
  let fixture: ComponentFixture<ModalUserOutputDashboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalUserOutputDashboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalUserOutputDashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
