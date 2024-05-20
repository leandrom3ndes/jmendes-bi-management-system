import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from "../../shared/rest-api/bi-management-api.service";
import { DomSanitizer } from "@angular/platform-browser";

@Component({
    selector: 'app-bi-knowage',
    templateUrl: './bi-knowage.component.html',
    styleUrls: ['./bi-knowage.component.css']
})
export class BiKnowageComponent implements OnInit {
    public allBiKnowage: any = [];
    public allBiKnowageText: {id: any; preview: any; name: string; description: string }[] = [];
    page = 1;
    pageSize = 9;
    public searchText: any;

    constructor(
        private biManagementApiService: BiManagementApiService, private domSanitizer: DomSanitizer) { }

    ngOnInit() {
        this.getAllBiKnowage();
    }

    getAllBiKnowage() {
        this.biManagementApiService.getAllBiKnowage().subscribe(data => {
            this.allBiKnowage = data.allBiKnowage;
            for (let i in this.allBiKnowage) {
                this.allBiKnowageText.push({
                    id: this.allBiKnowage[i].id,
                    preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.allBiKnowage[i].preview),
                    name: this.allBiKnowage[i].name,
                    description: this.allBiKnowage[i].description});
            }

            console.log("---------- [BI KNOWAGE] ----------:");
            console.table(this.allBiKnowageText);
        });
    }

}
