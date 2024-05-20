import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiKnowageModalComponent } from './bi-knowage-modal.component';

describe('BiKnowageModalComponent', () => {
  let component: BiKnowageModalComponent;
  let fixture: ComponentFixture<BiKnowageModalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiKnowageModalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiKnowageModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
