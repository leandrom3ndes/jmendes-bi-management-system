import {async, ComponentFixture, TestBed} from '@angular/core/testing';

import {ProcessTypeComponent} from './processtype.component';

describe('ProcessTypeComponent', () => {
    let component: ProcessTypeComponent;
    let fixture: ComponentFixture<ProcessTypeComponent>;

    beforeEach(async(() => {
        TestBed.configureTestingModule({
            declarations: [ProcessTypeComponent]
        })
            .compileComponents();
    }));

    beforeEach(() => {
        fixture = TestBed.createComponent(ProcessTypeComponent);
        component = fixture.componentInstance;
        fixture.detectChanges();
    });

    it('should create', () => {
        expect(component).toBeTruthy();
    });
});
