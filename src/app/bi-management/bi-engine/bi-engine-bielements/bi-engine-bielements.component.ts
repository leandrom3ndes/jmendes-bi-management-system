import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { ActivatedRoute } from "@angular/router";
import {DomSanitizer} from "@angular/platform-browser";

@Component({
    selector: 'app-bi-engine-bielements',
    templateUrl: './bi-engine-bielements.component.html',
    styleUrls: ['./bi-engine-bielements.component.css']
})

export class BiEngineBielementsComponent implements OnInit {
    biEngineId: any;
    public biEngBiElement: any = [];
    public biEngBiElementText: { engId: number; id: number; preview: any; name: string; description: string; }[] = [];
    public engineName: string;
    public totalEngBiElements: number;

    constructor(private biManagementApiService: BiManagementApiService, private route: ActivatedRoute, private domSanitizer: DomSanitizer ) { }

    ngOnInit() {
        this.biEngineId = this.route.snapshot.params.biEngineId;
        this.getEngineName();
        this.getTotalEngBiElements();
        this.getEngBiElementsText();
    }

    getEngineName() {
        this.biManagementApiService.getEngBiElements(this.biEngineId).subscribe(data => {
            this.engineName = data.eng_name;

            console.log("---------- [ENGINE NAME] ----------:");
            console.table(this.engineName);
        });
    }

    getTotalEngBiElements() {
        this.biManagementApiService.getEngBiElements(this.biEngineId).subscribe(data => {
            this.totalEngBiElements = data.totalEngBiElements;

            console.log("---------- [TOTAL ENGINE BI ELEMENTS] ----------:");
            console.table(this.totalEngBiElements);
        });
    }

    getEngBiElementsText() {
        this.biManagementApiService.getEngBiElements(this.biEngineId).subscribe(data => {
            this.biEngBiElement = data.allEngBiElements;
            for (let i in this.biEngBiElement) {
                this.biEngBiElementText.push({
                    engId: this.id,
                    id: this.biEngBiElement[i].id,
                    preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.biEngBiElement[i].preview),
                    name: this.biEngBiElement[i].name,
                    description: this.biEngBiElement[i].description
                });
            }
            console.log("---------- [ENG BI ELEMENT TEXT] ----------:");
            console.table(this.biEngBiElementText );
        });
    }

}
