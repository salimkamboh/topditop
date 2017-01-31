import { Component, OnInit } from '@angular/core';
import { ApiEnService } from '../service/api.en.service';
import { Field } from '../data/field';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-fields',
  templateUrl: './fields.component.html',
  styleUrls: ['./fields.component.css']
})
export class FieldsComponent implements OnInit {

  entity_url: string = 'fields/all';
  fields: Field[];
  errorMessage: string;

  constructor(private apiEnService: ApiEnService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiEnService.getAll(this.entity_url)
      .subscribe(
      fields => this.fields = <Field[]>fields,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading fields'); }
      );
  }


}
