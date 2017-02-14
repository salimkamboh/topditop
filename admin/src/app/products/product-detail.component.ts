import { Observable } from 'rxjs';
import { Component, OnInit } from '@angular/core';
import { ApiReferenceService } from '../service/api.reference.service';
import { ApiStoreService } from '../service/api.store.service';
import { ApiProductService } from '../service/api.product.service';
import { ApiService } from '../service/api.service';
import { Reference } from '../data/reference';
import { Store } from '../data/store';
import { Product } from '../data/product';
import { Brand } from '../data/brand';
import { Image } from '../data/image';
import { Category } from '../data/category';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';


@Component({
    selector: 'app-product-detail',
    templateUrl: './product-detail.component.html'
})
export class ProductDetailComponent implements OnInit {

    private id: number;
    private product: Product;
    private stores: Store[];
    private manufacturers: Brand[];
    private myReferences: Reference[];
    private myCategories: Category[];
    private allReferences: Reference[];
    private allCategories: Category[];
    private myImages: Image[];
    private errorMessage: '';
    private disabled: boolean = false;
    private productForm: FormGroup;
    private newImages: string[] = [];
    private dirty: boolean = false;

    constructor(
        private apiService: ApiService,
        private apiReferenceService: ApiReferenceService,
        private apiProductService: ApiProductService,
        private apiStoreService: ApiStoreService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.populateProduct();
        } else {
            this.initializeProduct();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateProduct(this.id);
        } else {
            this.createProduct();
        }
    }

    createProduct() {
        let product = this.createDataObject();
        this.apiProductService
            .create(product)
            .subscribe(
            product => {
                this.product = <Product>product; this.toasterService.pop('success', 'Success', 'Product created!');
                this.disabled = false;
                this.router.navigate(['/products']);
            },
            error => {
                this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating product!');
                this.disabled = false; this.router.navigate(['/products']);
            }
            );
    }

    updateProduct(id: number) {
        let product = this.createDataObject();
        this.apiProductService
            .update(this.id, product)
            .subscribe(
            product => {
                this.product = <Product>product;
                this.toasterService.pop('success', 'Success', 'Product updated!');
                this.router.navigate(['/products']); this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with updating product!');
                this.disabled = false; this.router.navigate(['/products']);
            }
            );
    }

    deleteProduct(id: number) {
        this.disabled = true;
        this.apiProductService
            .delete(this.id)
            .subscribe(
            () => {
                this.toasterService.pop('success', 'Success', 'Product deleted!');
                this.disabled = false; this.router.navigate(['/products']);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with deleting product!');
                this.disabled = false; this.router.navigate(['/products']);
            }
            );
    }

    deleteImage(id: number, index: number) {
        this.disabled = true;
        let product = {
            'productId': this.id
        };
        this.apiProductService
            .deleteImage(id, product)
            .subscribe(
            image => {
                this.toasterService.pop('success', 'Success', 'Image deleted!');
                this.disabled = false; this.myImages.splice(index, 1);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with deleting image!');
            }
            );
    }

    populateProduct() {
        Observable.forkJoin(
            this.apiProductService.get(this.id),
            this.apiStoreService.getAll(),
            this.apiProductService.getReferences(this.id),
            this.apiReferenceService.getAll(),
            this.apiProductService.getCategories(this.id),
            this.apiService.getAll('categories/all'),
            this.apiService.getAll('manufacturers/all'),
            this.apiProductService.getImages(this.id)
        ).subscribe(
            result => {
                this.product = <Product>result[0];
                this.stores = <Store[]>result[1];
                this.myReferences = <Reference[]>result[2];
                this.allReferences = <Reference[]>result[3];
                this.myCategories = <Category[]>result[4];
                this.allCategories = <Category[]>result[5];
                this.manufacturers = <Brand[]>result[6];
                this.myImages = <Image[]>result[7];
                this.setFormGroup();
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Something went wrong with loading product!');
                this.router.navigate(['/products']);
            }
            );
    }

    initializeProduct() {
        this.product = {
            id: null,
            title: '',
            description: '',
            SKU: '',
            category_ids: '',
            short_description: '',
            weight: '',
            news_from_date: '',
            news_to_date: '',
            country_of_manufacture: '',
            price: '',
            url_key: '',
            mag_product_id: '',
            image_id: '',
            store_id: '',
            manufacturer_id: '',
            views: '',
            productImage: '',
            categoriesNice: ''
        };
        Observable.forkJoin(
            this.apiStoreService.getAll(),
            this.apiReferenceService.getAll(),
            this.apiService.getAll('categories/all'),
            this.apiService.getAll('manufacturers/all'),
        ).subscribe(
            result => {
                this.stores = <Store[]>result[0];
                this.allReferences = <Reference[]>result[1];
                this.allCategories = <Category[]>result[2];
                this.manufacturers = <Brand[]>result[3];
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Something went wrong!');
                this.router.navigate(['/products']);
            }
            );
    }

    createDataObject() {
        let reference = {
            'title': this.productForm.value.title,
            'description': this.productForm.value.description,
            'price': this.productForm.value.price,
            'store_id': this.productForm.value.store_id,
            'references': this.productForm.value.selectedReferences,
            'categories': this.productForm.value.selectedCategories,
            'manufacturer_id': this.productForm.value.manufacturer_id,
        };
        if (this.dirty) {
            reference['newImages'] = this.newImages;
        }
        return reference;
    }

    createFormGroup() {
        this.productForm = this.fb.group({
            title: '',
            description: '',
            price: '',
            store_id: '',
            selectedReferences: new FormControl([]),
            selectedCategories: new FormControl([]),
            manufacturer_id: ''
        });
    }

    setFormGroup() {
        this.productForm.controls['title'].setValue(this.product.title);
        this.productForm.controls['description'].setValue(this.product.description);
        this.productForm.controls['price'].setValue(this.product.price);
        this.productForm.controls['store_id'].setValue(this.product.store_id);
        this.productForm.controls['manufacturer_id'].setValue(this.product.manufacturer_id);
        this.productForm.controls['selectedCategories'].setValue(this.getCategoryId());
        this.productForm.controls['selectedReferences'].setValue(this.getReferenceId());
    }

    getCategoryId(): number[] {
        if (this.myCategories) {
            let categoryIds = [];
            for (let i = 0; i < this.myCategories.length; i++) {
                categoryIds.push(this.myCategories[i].id);
            }
            return categoryIds;
        }
    }

    getReferenceId(): number[] {
        if (this.myReferences) {
            let referenceIds = [];
            for (let i = 0; i < this.myReferences.length; i++) {
                referenceIds.push(this.myReferences[i].id);
            }
            return referenceIds;
        }
    }

    changeListener($event): void {
        this.readThis($event.target);
    }

    readThis(inputValue: any): void {
        let file: File = inputValue.files[0];
        let myReader: FileReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            return;
        }
        myReader.onloadend = (e) => {
            this.newImages.push(myReader.result);
            this.dirty = true;
        };
        myReader.readAsDataURL(file);
    }

}
