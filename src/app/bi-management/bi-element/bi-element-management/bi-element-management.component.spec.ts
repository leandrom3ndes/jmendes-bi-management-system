import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementManagementComponent } from './bi-element-management.component';

describe('BiElementManagementComponent', () => {
  let component: BiElementManagementComponent;
  let fixture: ComponentFixture<BiElementManagementComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementManagementComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementManagementComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
