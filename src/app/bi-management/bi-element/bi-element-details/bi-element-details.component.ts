import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { ActivatedRoute } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';
import { AlertToastService } from '../../../shared/common/alert-toast.service';

@Component({
    selector: 'app-bi-element-details',
    templateUrl: './bi-element-details.component.html',
    styleUrls: ['./bi-element-details.component.css']
})

export class BiElementDetailsComponent implements OnInit {
    biElementid: string;
    private radix: number;
    public disabled = true;
    public collected;
    public biElementDetail: any = [];
    public biElementDetailModel: { id: number; name: string; description: string; preview: any; embed: any; type_slug: string; engine_name: string; created_at: any; }[] = [];

    public allbiUserCollection: any = [];

    constructor(
        private biManagementApiService: BiManagementApiService,
        private route: ActivatedRoute,
        private domSanitizer: DomSanitizer,
        private alertToast: AlertToastService
    ) { }

    ngOnInit() {
        this.biElementid = this.route.snapshot.params.biElementid;
        this.checkBiUserCollection(this.biElementid);
        this.getBiElementDetailModel();
    }
    checkBiUserCollection(biElementid) {
        this.biManagementApiService.getBiUserCollection().subscribe(data => {
            this.allbiUserCollection = data;
            if (this.allbiUserCollection.biUserCollection.some(value => value.id === parseInt(biElementid, this.radix))) {
                console.log('✅ the object is contained in Collection');
                this.collected = true;
            } else {
                console.log('⛔️ the object is NOT contained in Collection');
                this.collected = false;
            }
        });
    }

    getBiElementDetailModel() {
        this.biManagementApiService.getBiElementDetail(this.biElementid).subscribe(data => {
            this.biElementDetail = data.biElementDetail;
            for (let i in this.biElementDetail) {
                this.biElementDetailModel.push({
                    id: parseInt(this.biElementid, this.radix),
                    name: this.biElementDetail[i].name,
                    description: this.biElementDetail[i].description,
                    preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.biElementDetail[i].preview),
                    embed: this.domSanitizer.bypassSecurityTrustResourceUrl(this.biElementDetail[i].embed),
                    type_slug: this.biElementDetail[i].type_slug,
                    engine_name: this.biElementDetail[i].engine_name,
                    created_at: this.biElementDetail[i].created_at
                });
            }
            console.log("---------- [BiElement detail TEXT] ----------:");
            console.table(this.biElementDetailModel );
        });
    }

    storeBiUserCollection(biElementid) {
        this.biManagementApiService.storeBiUserCollection(biElementid).subscribe(data => {
            this.collected = true;
            this.alertToast.showSuccess('O elemento foi adicionado à sua coleção.');
        }, error => {
            this.alertToast.showError('Não foi possível adicionar o elemento à sua coleção.');
        });
    }

}
