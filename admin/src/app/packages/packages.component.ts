import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Package } from '../data/package';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-packages',
  templateUrl: './packages.component.html'
})
export class PackagesComponent implements OnInit {

  entity_url: string = 'packages/all';
  packages: Package[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService.getAll(this.entity_url)
      .subscribe(
      packages => this.packages = <Package[]>packages,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading packages'); }
      );
  }
}


