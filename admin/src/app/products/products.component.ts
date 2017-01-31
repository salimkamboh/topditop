import { Component, OnInit } from '@angular/core';
import { ApiProductService } from '../service/api.product.service';
import { Product } from '../data/product';
import { ToasterService } from 'angular2-toaster';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html'
})
export class ProductsComponent implements OnInit {

  products: Product[];
  errorMessage: string;

  constructor(private apiProductService: ApiProductService, private toasterService: ToasterService) { }

  ngOnInit() {
    this.apiProductService.getAll()
      .subscribe(
      products => this.products = <Product[]>products,
      error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading products'); }
      );
  }
}
