import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../shared/rest-api/bi-management-api.service';
import { DomSanitizer } from '@angular/platform-browser';


@Component({
    selector: 'app-bi-engine',
    templateUrl: './bi-engine.component.html',
    styleUrls: ['./bi-engine.component.css']
})
export class BiEngineComponent implements OnInit {
    public allEnginesDetail: any = [];
    public allEnginesDetailText: { id: any; logo_preview: any; name: string; }[] = [];
    constructor(
        private biManagementApiService: BiManagementApiService, private domSanitizer: DomSanitizer) { }

    ngOnInit() {
        this.getAllEnginesText();
    }

    getAllEnginesText() {
        this.biManagementApiService.getAllEngines().subscribe(data => {
            this.allEnginesDetail = data.allEngines;
            for (let i in this.allEnginesDetail) {
                this.allEnginesDetailText.push({
                    id: this.allEnginesDetail[i].id,
                    logo_preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.allEnginesDetail[i].logo_preview),
                    name: this.allEnginesDetail[i].name
                });
            }
            console.log("---------- [BI ENGINES TEXT] ----------:");
            console.table(this.allEnginesDetailText);
        });
    }
}
