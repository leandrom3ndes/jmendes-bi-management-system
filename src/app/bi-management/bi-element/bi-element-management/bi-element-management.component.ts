import { Component, OnInit, ViewChild } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BiElementModalComponent } from '../bi-element-modal/bi-element-modal.component';
import { AlertToastService } from '../../../shared/common/alert-toast.service';
import { Subject } from 'rxjs';
import { DataTableDirective } from 'angular-datatables';

class DataTablesResponse {
    data: any[];
    draw: number;
    recordsFiltered: number;
    recordsTotal: number;
}

@Component({
  selector: 'app-bi-element-management',
  templateUrl: './bi-element-management.component.html',
  styleUrls: ['./bi-element-management.component.css'],
  providers: [BiElementModalComponent]
})
export class BiElementManagementComponent implements OnInit {
    @ViewChild(DataTableDirective, {static: false})
    dtElement: DataTableDirective;
    dtOptions: DataTables.Settings = {};
    public biElements: any = [];
    // This trigger is used because fetching the list of biElements can be quite long,
    // thus we ensure the data is fetched before rendering
    dtTrigger: Subject<any> = new Subject<any>();

    constructor(
        private biManagementApiService: BiManagementApiService,
        private modalService: BsModalService,
        private modal: BiElementModalComponent,
        private alertToast: AlertToastService
    ) {}

    ngOnInit(): void {
        this.setDatatablesOptions();
        this.getAllBiElementsDetail();
    }

    setDatatablesOptions() {
        this.dtOptions = {
            language: {
                url: 'assets/i18n/pt.json'
            },
            pagingType: 'full_numbers',
            pageLength: 10,
            paging: true,
            deferRender: true,
            columnDefs: [ {
                targets: [1, 7],
                orderable: false
            } ]
        };
    }
    getAllBiElementsDetail() {
        this.biManagementApiService.getAllBiElementsDetail().subscribe(data => {
            this.biElements = data.allBiElementsDetail;
            this.dtTrigger.next();
        } );
    }
    destroyDtInstance() {
        this.dtElement.dtInstance.then((dtInstance: DataTables.Api) => {
            // Destroy the table first
            dtInstance.destroy();
        });
    }
    openModal(params = {}) {
        const modalRef = this.modalService.show(BiElementModalComponent, {class: 'modal-lg', initialState: params});
        modalRef.content.passEntry.subscribe((receivedEntry) => {
            console.log(receivedEntry);
            if (receivedEntry === 'SUCESSO') {
                this.destroyDtInstance();
                this.getAllBiElementsDetail();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            } else {
                this.alertToast.showError('Operação não realizada');
            }

        });
    }
    deleteBiElement(biElementid) {
        if (window.confirm('Tem a certeza que pretende eliminar este elemento BI')) {
            this.biManagementApiService.deleteBiElement(biElementid).subscribe(data => {
                this.destroyDtInstance();
                this.getAllBiElementsDetail();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            }, error => {
                this.alertToast.showError('Operação não realizada');
            });
        }
    }

}
