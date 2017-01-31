import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Adverts } from '../data/adverts';
import { ToasterService } from 'angular2-toaster';


@Component({
  selector: 'app-advertisement',
  templateUrl: './advertisements.component.html'
})
export class AdvertisementsComponent implements OnInit {
  entity_url: string = 'adverts/all';
  adverts: Adverts[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService.getAll(this.entity_url)
      .subscribe(
      adverts => this.adverts = <Adverts[]>adverts,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading advertisements'); }
      );
  }

}
