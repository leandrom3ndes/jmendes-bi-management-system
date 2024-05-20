import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementModalComponent } from './bi-element-modal.component';

describe('BiElementModalComponent', () => {
  let component: BiElementModalComponent;
  let fixture: ComponentFixture<BiElementModalComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementModalComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementModalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
