import {async, ComponentFixture, TestBed} from '@angular/core/testing';

//Trigger template processType
import {ModalProcessTypeComponent} from './modal-processType.component';

describe('ModalProcessTypeComponent', () => {
    let component: ModalProcessTypeComponent;
    let fixture: ComponentFixture<ModalProcessTypeComponent>;

    beforeEach(async(() => {
        TestBed.configureTestingModule({
            declarations: [ModalProcessTypeComponent]
        })
            .compileComponents();
    }));

    beforeEach(() => {
        fixture = TestBed.createComponent(ModalProcessTypeComponent);
        component = fixture.componentInstance;
        fixture.detectChanges();
    });

    it('should create', () => {
        expect(component).toBeTruthy();
    });
});
