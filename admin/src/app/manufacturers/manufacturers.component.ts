import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Brand } from '../data/brand';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-manufacturers',
  templateUrl: './manufacturers.component.html'
})
export class ManufacturersComponent implements OnInit {

  entity_url: string = 'manufacturers/all';
  manufacturers: Brand[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService
        .getAll(this.entity_url)
        .subscribe(
            manufacturers => this.manufacturers = <Brand[]>manufacturers,
            error => { 
              this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading manufacturers'); 
            }
        );
  }
}
