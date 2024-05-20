import { Component, OnInit, ViewChild } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BiEngineModalComponent } from '../bi-engine-modal/bi-engine-modal.component';
import { AlertToastService } from '../../../shared/common/alert-toast.service';
import { Subject } from 'rxjs';
import { DataTableDirective } from 'angular-datatables';

@Component({
  selector: 'app-bi-engine-management',
  templateUrl: './bi-engine-management.component.html',
  styleUrls: ['./bi-engine-management.component.css'],
  providers: [BiEngineModalComponent]
})
export class BiEngineManagementComponent implements OnInit {
    @ViewChild(DataTableDirective, {static: false})
    dtElement: DataTableDirective;
    datatableElement: DataTableDirective;
    dtOptions: DataTables.Settings = {};
    public biEngines: any = [];
    // This trigger is used because fetching the list of biElements can be quite long,
    // thus we ensure the data is fetched before rendering
    dtTrigger: Subject<any> = new Subject<any>();

    constructor(
        private biManagementApiService: BiManagementApiService,
        private modalService: BsModalService,
        private modal: BiEngineModalComponent,
        private alertToast: AlertToastService
    ) {}

  ngOnInit() {
        this.setDatatablesOptions();
        this.getAllEngines();
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
                targets: [1, 4],
                orderable: false
            } ]
        };
    }
    getAllEngines() {
        this.biManagementApiService.getAllEngines().subscribe(data => {
            this.biEngines = data.allEngines;
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
        const modalRef = this.modalService.show(BiEngineModalComponent, {class: 'modal-lg', initialState: params});
        modalRef.content.passEntry.subscribe((receivedEntry) => {
            console.log(receivedEntry);
            if (receivedEntry === 'SUCESSO') {
                this.destroyDtInstance();
                this.getAllEngines();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            } else {
                this.alertToast.showError('Operação não realizada');
            }
        });
    }
    deleteBiEngine(biEngineId) {
        if (window.confirm('Tem a certeza que pretende eliminar esta ferramenta BI')) {
            this.biManagementApiService.deleteBiEngine(biEngineId).subscribe(data => {
                this.destroyDtInstance();
                this.getAllEngines();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            }, error => {
                this.alertToast.showError('Operação não realizada');
            });
        }
    }

}
