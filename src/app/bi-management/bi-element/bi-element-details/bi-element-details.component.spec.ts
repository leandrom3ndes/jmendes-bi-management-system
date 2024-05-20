import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementDetailsComponent } from './bi-element-details.component';

describe('BiElementDetailsComponent', () => {
  let component: BiElementDetailsComponent;
  let fixture: ComponentFixture<BiElementDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
