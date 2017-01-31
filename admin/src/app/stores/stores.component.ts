import { Component, OnInit } from '@angular/core';
import { ApiStoreService } from '../service/api.store.service';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-stores',
  templateUrl: './stores.component.html'
})
export class StoresComponent implements OnInit {

  stores: Object[]
  errorMessage: string;

  constructor(private apiStoreService: ApiStoreService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiStoreService.getAllActive()
      .subscribe(
      stores => this.stores = stores,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading advertisements'); }
      );
  }

}
