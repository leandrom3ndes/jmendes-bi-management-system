import {Component} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
import {ModalProcessTypeComponent} from '../modal-processtype/modal-processtype.component';
import {BsModalService} from 'ngx-bootstrap/modal';
import {ProcessTypeApiService} from '../shared/rest-api/processtype-api.service';
import {ProcessTypeComponent} from './processtype.component';

@Component({
    selector: 'app-processtype',
    template: '<button type="button" class="btn-info" (click)="editRow()">Editar</button>' +
        '<button type="button" class="btn-warning" (click)="deleteRow()">Apagar</button>',
    styleUrls: ['./processtype.component.css']
})
export class ProcessTypeCellCustomComponent {

    data: any;
    params: any;

    constructor(private http: HttpClient,
                private router: Router,
                private modal: ModalProcessTypeComponent,
                private modalService: BsModalService,
                private restApi: ProcessTypeApiService,
                private processTypeComp: ProcessTypeComponent
    ) {
    }

    agInit(params) {
        this.params = params;
        this.data = params.value;
    }

    editRow() {
        let rowData = this.params;
        let i = rowData.rowIndex;
        console.log(rowData.data);
        this.processTypeComp.openModal(rowData.data);
    }

    deleteRow() {
        let rowData = this.params;
        this.processTypeComp.deleteProcessType(rowData.data.id);
    }


}
