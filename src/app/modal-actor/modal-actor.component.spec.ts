import {async, ComponentFixture, TestBed} from '@angular/core/testing';

//Trigger template actor
import {ModalActorComponent} from './modal-actor.component';

describe('ModalActorComponent', () => {
    let component: ModalActorComponent;
    let fixture: ComponentFixture<ModalActorComponent>;

    beforeEach(async(() => {
        TestBed.configureTestingModule({
            declarations: [ModalActorComponent]
        })
            .compileComponents();
    }));

    beforeEach(() => {
        fixture = TestBed.createComponent(ModalActorComponent);
        component = fixture.componentInstance;
        fixture.detectChanges();
    });

    it('should create', () => {
        expect(component).toBeTruthy();
    });
});
