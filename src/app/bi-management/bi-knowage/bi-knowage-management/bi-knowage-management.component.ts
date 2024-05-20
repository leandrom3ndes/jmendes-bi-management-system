import { Component, OnInit, ViewChild, Injectable  } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { BsModalService } from 'ngx-bootstrap/modal';
import { BiKnowageModalComponent } from '../bi-knowage-modal/bi-knowage-modal.component';
import { AlertToastService } from '../../../shared/common/alert-toast.service';
import { Subject } from 'rxjs';
import { DataTableDirective } from 'angular-datatables';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-bi-knowage-management',
  templateUrl: './bi-knowage-management.component.html',
  styleUrls: ['./bi-knowage-management.component.css'],
    providers: [BiKnowageModalComponent]
})
@Injectable()
export class BiKnowageManagementComponent implements OnInit {

    @ViewChild(DataTableDirective, {static: false})
    dtElement: DataTableDirective;
    datatableElement: DataTableDirective;
    dtOptions: DataTables.Settings = {};
    // This trigger is used because fetching the list of biElements can be quite long,
    // thus we ensure the data is fetched before rendering
    dtTrigger: Subject<any> = new Subject<any>();


    private biKnowageDetails: any = [];
    biKnowageSession: any;
    private getKnowageDocumentsUrlAPI = 'http://localhost:8080/knowage/restful-services/2.0/documents/';

    constructor(
        private biManagementApiService: BiManagementApiService,
        private modalService: BsModalService,
        private biKnowageModalComponent: BiKnowageModalComponent,
        private alertToast: AlertToastService,
        private httpClient: HttpClient
    ) {}
    ngOnInit() {
        this.biKnowageSession = this.biKnowageModalComponent.readLocalStorageValue('biKnowageSession');
        this.setDatatablesOptions();
        this.getAllBiKnowageDetail();
    }
    setDatatablesOptions() {
        this.dtOptions = {
            language: {
                url: 'assets/i18n/pt.json'
            },
            pagingType: 'full_numbers',
            pageLength: 10,
            scrollX: true,
            paging: true,
            deferRender: true,
            columnDefs: [ {
                targets: [9],
                orderable: false
            } ]
        };
    }
    getAllBiKnowageDetail() {
        this.biManagementApiService.getAllBiKnowageDetail().subscribe(data => {
            this.biKnowageDetails = data.allBiKnowageDetail;
            this.dtTrigger.next();
        } );
    }
    readLocalStorageValue(key: string): string {
        return JSON.parse(localStorage.getItem(key));
    }
    getBiKnowageDocumets() {
        this.biKnowageSession = this.readLocalStorageValue('biKnowageSession');
        const authorizationData = 'Basic ' + btoa(this.biKnowageSession[0].username + ':' + this.biKnowageSession[0].password);
        const httpOptions = {
            headers: new HttpHeaders({
                'Content-Type': 'application/json',
                Authorization: authorizationData
            })
        };
        return this.httpClient.get(this.getKnowageDocumentsUrlAPI, httpOptions)
            .subscribe(
                data => { // json data
                    console.log('Success: ', data);
                },
                error => {
                    console.log('Error: ', error);
                });
    }
    destroyDtInstance() {
        this.dtElement.dtInstance.then((dtInstance: DataTables.Api) => {
            // Destroy the table first
            dtInstance.destroy();
        });
    }
    openModal(params = {}) {
        const modalRef = this.modalService.show(BiKnowageModalComponent, {class: 'modal-lg', initialState: params});
        modalRef.content.passEntry.subscribe((receivedEntry) => {
            console.log(receivedEntry);
            if (receivedEntry === 'SUCESSO') {
                this.destroyDtInstance();
                this.getAllBiKnowageDetail();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            } else {
                this.alertToast.showError('Operação não realizada');
            }

        });
    }
    deleteBiKnowage(biKnowageId) {
        if (window.confirm('Tem a certeza que pretende eliminar este elemento do Knowage?')) {
            this.biManagementApiService.deleteBiKnowage(biKnowageId).subscribe(data => {
                this.destroyDtInstance();
                this.getAllBiKnowageDetail();
                this.alertToast.showSuccess('Operação realizada com sucesso');
            }, error => {
                this.alertToast.showError('Operação não realizada');
            });
        }
    }

}
