import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiEngineBielementsComponent } from './bi-engine-bielements.component';

describe('BiEngineBielementsComponent', () => {
  let component: BiEngineBielementsComponent;
  let fixture: ComponentFixture<BiEngineBielementsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BiEngineBielementsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BiEngineBielementsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
