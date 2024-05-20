import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalinitTDashbComponent } from './modal-inittdashb.component';

describe('ModalinitTDashbComponent', () => {
  let component: ModalinitTDashbComponent;
  let fixture: ComponentFixture<ModalinitTDashbComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalinitTDashbComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalinitTDashbComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
