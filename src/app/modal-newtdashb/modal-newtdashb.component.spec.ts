import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalNewtdashbComponent } from './modal-newtdashb.component';

describe('ModalNewtdashbComponent', () => {
  let component: ModalNewtdashbComponent;
  let fixture: ComponentFixture<ModalNewtdashbComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalNewtdashbComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalNewtdashbComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
