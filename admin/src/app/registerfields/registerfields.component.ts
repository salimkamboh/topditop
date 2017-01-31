import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Registerfield } from '../data/registerfield';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-registerfields',
  templateUrl: './registerfields.component.html'
})
export class RegisterfieldsComponent implements OnInit {

  entity_url: string = 'registerfields/all';
  registerfields: Registerfield[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService.getAll(this.entity_url)
      .subscribe(
      registerfields => this.registerfields = <Registerfield[]>registerfields,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading registerfields'); }
      );
  }

}
