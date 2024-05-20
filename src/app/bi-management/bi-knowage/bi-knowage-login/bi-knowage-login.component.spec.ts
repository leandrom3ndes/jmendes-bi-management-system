import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiKnowageLoginComponent } from './bi-knowage-login.component';

describe('BiKnowageLoginComponent', () => {
  let component: BiKnowageLoginComponent;
  let fixture: ComponentFixture<BiKnowageLoginComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiKnowageLoginComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiKnowageLoginComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
