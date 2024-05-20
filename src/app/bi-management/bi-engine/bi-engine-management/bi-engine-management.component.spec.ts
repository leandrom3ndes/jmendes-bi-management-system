import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiEngineManagementComponent } from './bi-engine-management.component';

describe('BiEngineManagementComponent', () => {
  let component: BiEngineManagementComponent;
  let fixture: ComponentFixture<BiEngineManagementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiEngineManagementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiEngineManagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
