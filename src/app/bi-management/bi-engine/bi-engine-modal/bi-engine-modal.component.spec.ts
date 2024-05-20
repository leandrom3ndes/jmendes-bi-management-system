import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiEngineModalComponent } from './bi-engine-modal.component';

describe('BiEngineModalComponent', () => {
  let component: BiEngineModalComponent;
  let fixture: ComponentFixture<BiEngineModalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiEngineModalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiEngineModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
