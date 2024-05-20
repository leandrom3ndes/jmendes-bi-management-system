import {Component, OnInit} from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';

@Component({
  selector: 'app-bi-widgets-counter',
  templateUrl: './bi-widgets-counter.component.html',
  styleUrls: ['./bi-widgets-counter.component.css']
})
export class BiWidgetsCounterComponent implements OnInit  {

    biElementsCount = 0;
    biKnowageCount = 0;
    biEnginesCount = 0;
    biElementTypesCount = 0;

    biElementsCountStop: any;
    biKnowageCountStop: any;
    biEnginesCountStop: any;
    biElementTypesCountStop: any;

    totalBiElements: any;
    totalBiKnowage: any;
    totalBiEngine: any;
    totalBiElementTypes: any;

    constructor(
        private biManagementApiService: BiManagementApiService,
    ) { }

    ngOnInit() {
        this.getBiElementTotal();
        this.getBiKnowageTotal();
        this.getBiEngineTotal();
        this.getBiElementTypesTotal();
    }

    getTest() {
        this.biElementsCountStop = setInterval(() => {
            this.biElementsCount++;
            if (this.biElementsCount === this.totalBiElements) {
                clearInterval(this.biElementsCountStop);
            }
        }, 10);
    }

    getBiElementTotal() {
        this.biManagementApiService.getAllBiElements().subscribe(data => {
            this.totalBiElements = data.totalBiElements;
            this.biElementsCountStop = setInterval(() => {
                this.biElementsCount++;
                if (this.biElementsCount === this.totalBiElements) {
                    clearInterval(this.biElementsCountStop);
                }
            }, 150);
        });
    }
    getBiKnowageTotal() {
        this.biManagementApiService.getAllBiKnowage().subscribe(data => {
            this.totalBiKnowage = data.totalBiKnowage;
            this.biKnowageCountStop = setInterval(() => {
                this.biKnowageCount++;
                if (this.biKnowageCount === this.totalBiKnowage) {
                    clearInterval(this.biKnowageCountStop);
                }
            }, 150);
        });
    }
    getBiEngineTotal() {
        this.biManagementApiService.getAllEngines().subscribe(data => {
            this.totalBiEngine = data.totalBiEngines;
            this.biEnginesCountStop = setInterval(() => {
                this.biEnginesCount++;
                if (this.biEnginesCount === this.totalBiEngine) {
                    clearInterval(this.biEnginesCountStop);
                }
            }, 200);
        });
    }
    getBiElementTypesTotal() {
        this.biManagementApiService.getBiElementsTypes().subscribe(data => {
            this.totalBiElementTypes = data.totalBiElementTypes;
            this.biElementTypesCountStop = setInterval(() => {
                this.biElementTypesCount++;
                if (this.biElementTypesCount === this.totalBiElementTypes) {
                    clearInterval(this.biElementTypesCountStop);
                }
            }, 200);
        });
    }

}
