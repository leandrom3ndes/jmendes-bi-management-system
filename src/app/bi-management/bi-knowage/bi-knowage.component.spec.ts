import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiKnowageComponent } from './bi-knowage.component';

describe('BiKnowageComponent', () => {
    let component: BiKnowageComponent;
    let fixture: ComponentFixture<BiKnowageComponent>;

    beforeEach(async(() => {
        TestBed.configureTestingModule({
            declarations: [ BiKnowageComponent ]
        })
            .compileComponents();
    }));

    beforeEach(() => {
        fixture = TestBed.createComponent(BiKnowageComponent);
        component = fixture.componentInstance;
        fixture.detectChanges();
    });

    it('should create', () => {
        expect(component).toBeTruthy();
    });
});
