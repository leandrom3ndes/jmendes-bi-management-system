import { Component, OnInit, AfterViewInit, OnDestroy, ViewChild } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService } from 'ngx-bootstrap/modal';
import { AlertToastService } from '../../../shared/common/alert-toast.service';
import { Subject } from 'rxjs';
import { DataTableDirective } from 'angular-datatables';
import { BiElementTypeModalComponent } from '../bi-element-type-modal/bi-element-type-modal.component';

@Component({
  selector: 'app-bi-element-type',
  templateUrl: './bi-element-type.component.html',
  styleUrls: ['./bi-element-type.component.css'],
    providers: [BiElementTypeModalComponent]
})
export class BiElementTypeComponent implements OnInit {
    @ViewChild(DataTableDirective, {static: false})
    dtElement: DataTableDirective;
    datatableElement: DataTableDirective;
    dtOptions: DataTables.Settings = {};
    public allBiElementType: any = [];
    // This trigger is used because fetching the list of biElements can be quite long,
    // thus we ensure the data is fetched before rendering
    dtTrigger: Subject<any> = new Subject<any>();

    constructor(
        private biManagementApiService: BiManagementApiService,
        private modalService: BsModalService,
        private alertToast: AlertToastService
    ) {}

  ngOnInit() {
      this.setDatatablesOptions();
      this.getBiElementsTypes();
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
                targets: [4],
                orderable: false
            } ]
        };
    }
    getBiElementsTypes() {
        this.biManagementApiService.getBiElementsTypes().subscribe(data => {
            this.allBiElementType = data.allBiElementType;
            this.dtTrigger.next();
        });
    }
    destroyDtInstance() {
        this.dtElement.dtInstance.then((dtInstance: DataTables.Api) => {
            // Destroy the table first
            dtInstance.destroy();
        });
    }
    openModal(params = {}) {
        const modalRef = this.modalService.show(BiElementTypeModalComponent, {class: 'modal-lg', initialState: params});
        modalRef.content.passEntry.subscribe((receivedEntry) => {
            console.log(receivedEntry);
            if (receivedEntry === 'SUCESSO') {
                this.destroyDtInstance();
                this.getBiElementsTypes();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            } else {
                this.alertToast.showError('Operação não realizada');
            }
        });
    }
    deleteBiElementType(biElementTypeId) {
        if (window.confirm('Tem a certeza que pretende eliminar este tipo?')) {
            this.biManagementApiService.deleteBiElementType(biElementTypeId).subscribe(data => {
                this.destroyDtInstance();
                this.getBiElementsTypes();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            }, error => {
                this.alertToast.showError('Operação não realizada');
            });
        }
    }

}
