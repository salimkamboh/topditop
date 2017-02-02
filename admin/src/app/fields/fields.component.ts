import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Field } from '../data/field';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-fields',
  templateUrl: './fields.component.html'
})
export class FieldsComponent implements OnInit {

  entity_url: string = 'fields/all';
  fields: Field[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService
        .getAll(this.entity_url)
        .subscribe(
          fields => this.fields = <Field[]>fields,
          error => { 
            this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading fields'); 
          }
        );
  }
}
