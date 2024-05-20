import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementTypeModalComponent } from './bi-element-type-modal.component';

describe('BiElementTypeModalComponent', () => {
  let component: BiElementTypeModalComponent;
  let fixture: ComponentFixture<BiElementTypeModalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementTypeModalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementTypeModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
