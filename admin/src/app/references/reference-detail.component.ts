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
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';


@Component({
    selector: 'app-reference-detail',
    templateUrl: './reference-detail.component.html'
})
export class ReferenceDetailComponent implements OnInit {

    private id: number
    private reference: Reference;
    private stores: Store[];
    private myProducts: Product[];
    private myManufacturers: Brand[];
    private allProducts: Product[];
    private allManufacturers: Brand[];
    private myImages: Image[];
    private errorMessage: '';
    private disabled: boolean = false;
    private referenceForm: FormGroup;
    private newImages: string[] = [];
    private dirty: boolean = false;

    constructor(private apiService: ApiService, private apiReferenceService: ApiReferenceService, private apiProductService: ApiProductService,
        private apiStoreService: ApiStoreService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder,
        private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.apiReferenceService.get(this.id)
                .subscribe(
                reference => { this.reference = <Reference>reference; this.setFormGroup(); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading reference'); }
                );
            this.setStores();
            this.setProducts();
            this.setManufacturer();
            this.setImages();
        } else {
            this.reference = {
                id: null,
                title: '',
                status: '',
                description: '',
                video: '',
                store_id: '',
                views: '',
                html: '',
                store: null
            }
            this.setStores();
            this.setProducts();
            this.setManufacturer();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateReference(this.id);
        } else {
            this.createReference();
        }
    }

    createReference() {
        let reference = this.createDataObject();
        this.apiReferenceService.create(reference)
            .subscribe(
            reference => { this.reference = <Reference>reference; this.toasterService.pop('success', 'Success', 'Reference created!'); this.disabled = false; this.router.navigate(['/references']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating reference!'); this.disabled = false; this.router.navigate(['/references']); }
            );

    }

    updateReference(id: number) {
        let reference = this.createDataObject();
        this.apiReferenceService.update(this.id, reference)
            .subscribe(
            reference => { this.reference = <Reference>reference; this.toasterService.pop('success', 'Success', 'Reference updated!'); this.router.navigate(['/references']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating reference!'); this.disabled = false; this.router.navigate(['/references']); }
            );
    }

    deleteReference(id: number) {
        this.disabled = true;
        this.apiReferenceService.delete(this.id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Reference deleted!'); this.disabled = false; this.router.navigate(['/references']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting reference!'); this.disabled = false; this.router.navigate(['/references']); }
            );
    }

    deleteImage(id: number, index: number) {
        this.disabled = true;
        let ref = {
            "referenceId": this.id
        }
        this.apiReferenceService.deleteImage(id, ref)
            .subscribe(
            image => { this.toasterService.pop('success', 'Success', 'Image deleted!'); this.disabled = false; this.myImages.splice(index, 1); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting reference!'); }
            );
    }

    setStores() {
        this.apiStoreService.getAll().subscribe(
            stores => { this.stores = <Store[]>stores; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading reference'); }
        );
    }

    setProducts() {
        if (this.id != -1) {
            this.apiReferenceService.getProducts(this.id).subscribe(
                products => { this.myProducts = <Product[]>products; this.referenceForm.controls['selectedProducts'].setValue(this.getProductId()); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading products'); }
            );
        }
        this.apiProductService.getAll().subscribe(
            allProducts => { this.allProducts = <Product[]>allProducts; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading products'); }
        );
    }

    setManufacturer() {
        if (this.id != -1) {
            this.apiReferenceService.getManufacturers(this.id).subscribe(
                manufacturers => { this.myManufacturers = <Brand[]>manufacturers; this.referenceForm.controls['selectedManufacturers'].setValue(this.getManufacturerId()); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading manufacturers'); }
            );
        }
        this.apiService.getAll('manufacturers/all').subscribe(
            manufacturers => { this.allManufacturers = <Brand[]>manufacturers; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading manufacturers'); }
        );
    }

    setImages() {
        this.apiReferenceService.getImages(this.id).subscribe(
            images => { this.myImages = <Image[]>images; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading images'); }
        );
    }

    createFormGroup() {
        this.referenceForm = this.fb.group({
            title: '',
            description: '',
            video: '',
            store_id: '',
            selectedProducts: new FormControl([]),
            selectedManufacturers: new FormControl([])
        });
    }

    createDataObject() {
        let reference = {
            "title": this.referenceForm.value.title,
            "description": this.referenceForm.value.description,
            "video": this.referenceForm.value.video,
            "store_id": this.referenceForm.value.store_id,
            "products": this.referenceForm.value.selectedProducts,
            "manufacturers": this.referenceForm.value.selectedManufacturers,
        };
        if (this.dirty) {
            reference['newImages'] = this.newImages;
        }
        return reference;
    }

    setFormGroup() {
        this.referenceForm.controls['title'].setValue(this.reference.title);
        this.referenceForm.controls['description'].setValue(this.reference.description);
        this.referenceForm.controls['video'].setValue(this.reference.video);
        this.referenceForm.controls['store_id'].setValue(this.reference.store_id);
    }

    getProductId(): number[] {
        if (this.myProducts) {
            let productIds = [];
            for (let i = 0; i < this.myProducts.length; i++) {
                productIds.push(this.myProducts[i].id);
            }
            return productIds;
        }
    }
    getManufacturerId(): number[] {
        if (this.myManufacturers) {
            let manufacturerIds = [];
            for (let i = 0; i < this.myManufacturers.length; i++) {
                manufacturerIds.push(this.myManufacturers[i].id);
            }
            return manufacturerIds;
        }
    }

    changeListener($event): void {
        this.readThis($event.target);
    }

    readThis(inputValue: any): void {
        let file: File = inputValue.files[0];
        let myReader: FileReader = new FileReader();
        myReader.onloadend = (e) => {
            this.newImages.push(myReader.result);
            this.dirty = true;
        }
        myReader.readAsDataURL(file);
    }
}