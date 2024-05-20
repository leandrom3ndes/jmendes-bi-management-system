import { Component } from '@angular/core';

@Component({
  selector: 'app-bi-knowage-login',
  templateUrl: './bi-knowage-login.component.html',
  styleUrls: ['./bi-knowage-login.component.css']
})
export class BiKnowageLoginComponent  {
    private username: string;
    private password: string;
    biKnowageSession: any;
  constructor() { }
    saveDataLocal() {
        let data = [{ username: this.username, password: this.password }];
        localStorage.setItem('biKnowageSession', JSON.stringify(data));

    }
}
