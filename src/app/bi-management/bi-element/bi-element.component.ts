import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../shared/rest-api/bi-management-api.service';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
    selector: 'app-bi-element',
    templateUrl: './bi-element.component.html',
    styleUrls: ['./bi-element.component.css']
})
export class BiElementComponent implements OnInit {
    page = 1;
    pageSize = 9;
    public allBiElements: any = [];
    public allBiElementsText: {id: any; preview: any; name: string; description: string }[] = [];
    public searchText: any;

    constructor(
        private biManagementApiService: BiManagementApiService,
        private domSanitizer: DomSanitizer,
    ) { }

    ngOnInit() {
        this.getBiElementDetailText();
    }

    getBiElementDetailText() {
        this.biManagementApiService.getAllBiElements().subscribe(data => {
            this.allBiElements = data.allBiElements;
            for (let i in this.allBiElements) {
                this.allBiElementsText.push({
                    id: this.allBiElements[i].id,
                    preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.allBiElements[i].preview),
                    name: this.allBiElements[i].name,
                    description: this.allBiElements[i].description});
            }
            console.log("---------- [BI ELEMENT TEXT] ----------:");
            console.table(this.allBiElementsText);
        });
    }

}
