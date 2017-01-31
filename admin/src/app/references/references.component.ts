import { Component, OnInit } from '@angular/core';
import { ApiReferenceService } from '../service/api.reference.service';
import { Reference } from '../data/reference';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-references',
  templateUrl: './references.component.html'
})
export class ReferencesComponent implements OnInit {

  references: Reference[];
  errorMessage: string;

  constructor(private apiReferenceService: ApiReferenceService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiReferenceService.getAll()
      .subscribe(
      references => this.references = <Reference[]>references,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading references'); }
      );
  }
}
