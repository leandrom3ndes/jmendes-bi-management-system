import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { AlertToastService } from '../../../shared/common/alert-toast.service';

@Component({
  selector: 'app-bi-element-collection',
  templateUrl: './bi-element-collection.component.html',
  styleUrls: ['./bi-element-collection.component.css']
})

export class BiElementCollectionComponent implements OnInit {
    public allbiUserCollection: any = [];
    public searchText: any;

  constructor(
      private biManagementApiService: BiManagementApiService,
      private alertToast: AlertToastService
  ) { }

  ngOnInit() {
      this.getBiUserCollection();
  }

    getBiUserCollection() {
        this.biManagementApiService.getBiUserCollection().subscribe(data => {
            this.allbiUserCollection = data;
        });
    }

    deleteBiUserCollection(biElementid) {
        if (window.confirm('Tem a certeza que pretende eliminar o elemento BI da sua coleção?')) {
            this.biManagementApiService.deleteBiUserCollection(biElementid).subscribe(data => {
                this.getBiUserCollection();
                this.alertToast.showSuccess('O elemento foi removido da sua coleção.');
            }, error => {
                this.alertToast.showError('Não foi possível remover o elemento da sua coleção.');
            });
        }
    }

}
