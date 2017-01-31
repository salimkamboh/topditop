import { Component, OnInit } from '@angular/core';
import { ApiLocationService } from '../service/api.location.service';
import { Location } from '../data/location';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-locations',
  templateUrl: './locations.component.html',
})
export class LocationsComponent implements OnInit {

  locations: Location[];
  errorMessage: string;

  constructor(private apiLocationService: ApiLocationService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiLocationService.getAll()
      .subscribe(
      locations => this.locations = <Location[]>locations,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading locations'); }
      );
  }
}
