import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BiKnowageDetailsComponent } from './bi-knowage-details.component';

describe('BiKnowageDetailsComponent', () => {
    let component: BiKnowageDetailsComponent;
    let fixture: ComponentFixture<BiKnowageDetailsComponent>;

    beforeEach(async(() => {
        TestBed.configureTestingModule({
            declarations: [ BiKnowageDetailsComponent ]
        })
            .compileComponents();
    }));

    beforeEach(() => {
        fixture = TestBed.createComponent(BiKnowageDetailsComponent);
        component = fixture.componentInstance;
        fixture.detectChanges();
    });

    it('should create', () => {
        expect(component).toBeTruthy();
    });
});
