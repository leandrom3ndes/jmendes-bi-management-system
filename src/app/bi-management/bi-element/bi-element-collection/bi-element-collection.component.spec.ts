import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiElementCollectionComponent } from './bi-element-collection.component';

describe('BiElementCollectionComponent', () => {
  let component: BiElementCollectionComponent;
  let fixture: ComponentFixture<BiElementCollectionComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiElementCollectionComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiElementCollectionComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
