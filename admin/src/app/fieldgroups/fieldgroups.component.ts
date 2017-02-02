import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Fieldgroup } from '../data/fieldgroup';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-fieldgroups',
  templateUrl: './fieldgroups.component.html'
})
export class FieldgroupsComponent implements OnInit {

  entity_url: string = 'fieldgroups/all';
  fieldgroups: Fieldgroup[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService
        .getAll(this.entity_url)
        .subscribe(
            fieldgroups => this.fieldgroups = <Fieldgroup[]>fieldgroups,
            error => { 
              this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading fieldgroups'); 
            }
        );
  }
}
