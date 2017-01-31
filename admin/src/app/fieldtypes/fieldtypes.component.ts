import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Fieldtype } from '../data/fieldtype';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-fieldtypes',
  templateUrl: './fieldtypes.component.html',
  styleUrls: ['./fieldtypes.component.css']
})
export class FieldtypesComponent implements OnInit {

  entity_url: string = 'fieldtypes/all';
  fieldtypes: Fieldtype[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService.getAll(this.entity_url)
      .subscribe(
      fieldtypes => this.fieldtypes = <Fieldtype[]>fieldtypes,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading fieldtypes'); }
      );
  }

}
