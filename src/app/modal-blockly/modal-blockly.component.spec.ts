import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalBlocklyComponent } from './modal-blockly.component';

describe('ModalBlocklyComponent', () => {
  let component: ModalBlocklyComponent;
  let fixture: ComponentFixture<ModalBlocklyComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalBlocklyComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalBlocklyComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
