import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { ToasterService } from 'angular2-toaster';
import { Slide } from '../data/slide'; 

@Component({
  selector: 'app-slides',
  templateUrl: './slides.component.html'
})
export class SlidesComponent implements OnInit {
  slides: Slide[];
  entity_url: string = 'slides/all';
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService
        .getAll(this.entity_url)
        .subscribe(
            slides => this.slides = <Slide[]>slides,
            error => { 
              this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading slides'); 
            }
        );
  }
  
}
