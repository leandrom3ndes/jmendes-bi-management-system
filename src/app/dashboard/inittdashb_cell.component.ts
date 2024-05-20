import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { ModalinitTDashbComponent } from '../modal-inittdashb/modal-inittdashb.component';
import { BsModalService } from 'ngx-bootstrap/modal';
import { InitTDashbApiService} from '../shared/rest-api/initTDashb-api.service';
import { DashboardComponent } from './dashboard.component';

@Component({
  selector: 'app-dashboard',
  template: '<button type="button" class="btn-info"  id="viewTransaction" (click)="viewtransaction()">Ver tarefa</button>',
  styleUrls: ['./dashboard.component.css']
})
export class InitTDashbCellCustomComponent {

  data: any;
  params: any;
  constructor(private http: HttpClient,
              private router: Router,
              private modal: ModalinitTDashbComponent,
              private modalService: BsModalService,
              private restApi: InitTDashbApiService,
              private dashboardComp: DashboardComponent
  ) { }

  agInit(params) {
    this.params = params;
    this.data =  params.value;
  }

  viewtransaction() {
    // console.log('Estou Aqui viewtransaction');
    let rowData = this.params;
    let i = rowData.rowIndex;
    // console.log(rowData.data);
    this.dashboardComp.openModal(rowData.data);
  }
}
