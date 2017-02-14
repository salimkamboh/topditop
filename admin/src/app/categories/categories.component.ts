import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Category } from '../data/category';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html'
})
export class CategoriesComponent implements OnInit {
  entity_url: string = 'categories/all';
  categories: Category[];
  errorMessage: string;

  constructor(private apiService: ApiService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiService.getAll(this.entity_url)
      .subscribe(
      categories => this.categories = <Category[]>categories,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading categories'); }
      );
  }
}
