import { Component, OnInit } from '@angular/core';
import { ApiPanelService } from '../service/api.panel.service';
import { Panel } from '../data/panel';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-panels',
  templateUrl: './panels.component.html',
  styleUrls: ['./panels.component.css']
})
export class PanelsComponent implements OnInit {

  entity_url: string = 'panels/all';
  panels: Panel[];
  errorMessage: string;

  constructor(private apiPanelService: ApiPanelService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiPanelService.getAll()
      .subscribe(
      panels => this.panels = <Panel[]>panels,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading panels'); }
      );
  }

}
