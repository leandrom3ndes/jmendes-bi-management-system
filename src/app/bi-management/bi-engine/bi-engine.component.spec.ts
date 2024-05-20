import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiEngineComponent } from './bi-engine.component';

describe('BiEngineComponent', () => {
  let component: BiEngineComponent;
  let fixture: ComponentFixture<BiEngineComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiEngineComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiEngineComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
