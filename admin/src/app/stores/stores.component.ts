import { Component, OnInit } from '@angular/core';
import { ApiStoreService } from '../service/api.store.service';
import { ToasterService } from 'angular2-toaster';
import { Store } from '../data/store';

@Component({
  selector: 'app-stores',
  templateUrl: './stores.component.html'
})
export class StoresComponent implements OnInit {

  stores: Store[];
  errorMessage: string;

  constructor(private apiStoreService: ApiStoreService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiStoreService.getAllActive()
      .subscribe(
      stores => this.stores = <Store[]>stores,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading stores'); }
      );
  }

}
