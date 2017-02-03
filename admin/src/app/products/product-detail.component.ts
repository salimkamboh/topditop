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
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';


@Component({
    selector: 'app-product-detail',
    templateUrl: './product-detail.component.html'
})
export class ProductDetailComponent implements OnInit {

    private id: number
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

    constructor(private apiService: ApiService, private apiReferenceService: ApiReferenceService, private apiProductService: ApiProductService,
        private apiStoreService: ApiStoreService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder,
        private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.apiProductService
                .get(this.id)
                .subscribe(
                    product => { 
                        this.product = <Product>product; 
                        this.setFormGroup(); 
                    },
                    error => { 
                        this.errorMessage = <any>error; 
                        this.toasterService.pop('error', 'Error', 'Product with given ID doesn`t exist!'); 
                        this.router.navigate(['/products']); 
                    }
                );
            this.setStore();
            this.setReferences();
            this.setCategories();
            this.setManufacturer();
            this.setImages();
        } else {
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
            }
            this.setStore();
            this.setReferences();
            this.setCategories();
            this.setManufacturer();
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
            "productId": this.id
        }
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

    setStore() {
        this.apiStoreService
            .getAll()
            .subscribe(
                stores => { this.stores = <Store[]>stores; },
                error => { 
                    this.errorMessage = <any>error; 
                    this.toasterService.pop('error', 'Error', 'Error with loading reference'); 
                }
            );
    }

    setCategories() {
        if (this.id != -1) {
            this.apiProductService
                .getCategories(this.id)
                .subscribe(
                    categories => { 
                        this.myCategories = <Category[]>categories; 
                        this.productForm.controls['selectedCategories'].setValue(this.getCategoryId()); 
                    },
                    error => { 
                        this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading categories'); 
                    }
            );
        }
        this.apiService
            .getAll('categories/all')
            .subscribe(
                categories => { 
                    this.allCategories = <Category[]>categories; 
                },
                error => { 
                    this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading categories'); 
                }
            );
    }

    setReferences() {
        if (this.id != -1) {
            this.apiProductService
                .getReferences(this.id)
                .subscribe(
                    references => { 
                        this.myReferences = <Reference[]>references; 
                        this.productForm.controls['selectedReferences'].setValue(this.getReferenceId()); 
                    },
                    error => { 
                        this.errorMessage = <any>error; 
                        this.toasterService.pop('error', 'Error', 'Error with loading references'); 
                    }
                );
        }
        this.apiReferenceService
            .getAll()
            .subscribe(
                allReferences => { 
                    this.allReferences = <Reference[]>allReferences; 
                },
                error => { 
                    this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading references'); 
                }
            );
    }

    setManufacturer() {
        this.apiService
            .getAll('manufacturers/all')
            .subscribe(
                manufacturers => { 
                    this.manufacturers = <Brand[]>manufacturers; 
                },
                error => { 
                    this.errorMessage = <any>error; 
                    this.toasterService.pop('error', 'Error', 'Error with loading manufacturers'); 
                }
        );
    }
    setImages() {
        this.apiProductService
            .getImages(this.id)
            .subscribe(
                images => { 
                    this.myImages = <Image[]>images; 
                },
                error => { 
                    this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading images'); 
                }
            );
    }

    createDataObject() {
        let reference = {
            "title": this.productForm.value.title,
            "description": this.productForm.value.description,
            "price": this.productForm.value.price,
            "store_id": this.productForm.value.store_id,
            "references": this.productForm.value.selectedReferences,
            "categories": this.productForm.value.selectedCategories,
            "manufacturer_id": this.productForm.value.manufacturer_id,
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
        if( !inputValue.files || inputValue.files.length === 0 ) {
            return;
        }
        myReader.onloadend = (e) => {
            this.newImages.push(myReader.result);
            this.dirty = true;
        }
        myReader.readAsDataURL(file);
    }

}