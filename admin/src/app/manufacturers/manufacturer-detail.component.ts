import { Category } from './../data/category';
import { ApiReferenceService } from './../service/api.reference.service';
import { BrandReference } from './../data/brand-reference';
import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Brand } from '../data/brand';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl, Validators } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-manufacturer-detail',
    templateUrl: './manufacturer-detail.component.html'
})
export class ManufacturerDetailComponent implements OnInit {
    private id: number;
    private entity: string = 'manufacturers';
    private manufacturer: Brand;
    private errorMessage: string;
    private base64: string = null;
    private disabled: boolean = false;
    private fileReader: FileReader;
    private manufacturerForm: FormGroup;
    private brandreferenceForm: FormGroup;
    private brandreferences: BrandReference[] = [];
    private categories: Category[] = [];

    constructor(
        private apiService: ApiService,
        private apiReferenceService: ApiReferenceService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.createbrandreferenceFormGroup();
        this.apiService.getAll('categories/all')
            .subscribe(
                categories => this.categories = <Category[]>categories,
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with loading categories'); }
            )
        if (this.id != -1) {
            this.apiService
                .get(this.entity, this.id)
                .subscribe(
                    manufacturer => {
                        this.manufacturer = <Brand>manufacturer;
                        this.createFormGroup();
                        this.loadBrandReferences();
                    },
                    error => {
                        this.errorMessage = <any>error;
                        this.toasterService.pop('error', 'Error', 'Manufacturer with given ID doesn`t exist!');
                        this.router.navigate(['/manufacturers']);
                    }
                );
        } else {
            this.manufacturer = {
                id: null,
                name: '',
                url: '',
                image_url: '',
                featured: ''
            };
            this.createFormGroup();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateManufacturer(this.id);
        } else {
            this.createManufacturer();
        }
    }

    createManufacturer() {
        let manufacturer = this.createDataObject();
        this.apiService
            .create(this.entity, manufacturer)
            .subscribe(
                manufacturer => {
                    this.manufacturer = <Brand>manufacturer;
                    this.toasterService.pop('success', 'Success', 'Manufacturer created!');
                    this.disabled = false; this.router.navigate(['/manufacturer', this.manufacturer.id]);
                    this.id = this.manufacturer.id;
                },
                error => {
                    this.errorMessage = <any>error;
                    this.toasterService.pop('error', 'Error', 'Error with creating manufacturer!');
                    this.disabled = false;
                    this.router.navigate(['/manufacturers']);
                }
            );
    }

    loadBrandReferences() {
        if (!this.manufacturer) {
            return;
        }
        this.apiReferenceService.getBrandReferences(this.manufacturer.id)
            .subscribe(
                brandreferences => {
                    this.brandreferences = <BrandReference[]>brandreferences;
                },
                error => {
                    this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with brand references');
                }
            );
    }

    updateManufacturer(id: number) {
        let manufacturer = this.createDataObject();
        this.apiService.update(this.entity, this.id, manufacturer)
            .subscribe(
            manufacturer => { this.manufacturer = <Brand>manufacturer; this.toasterService.pop('success', 'Success', 'Manufacturer updated!'); this.router.navigate(['/manufacturers']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating manufacturer!'); this.disabled = false; this.router.navigate(['/manufacturers']); }
            );
    }

    deleteManufacturer(id: number) {
        this.disabled = true;
        this.apiService
            .delete(this.entity, id)
            .subscribe(
                () => {
                    this.toasterService.pop('success', 'Success', 'Manufacturer deleted!');
                    this.disabled = false;
                    this.router.navigate(['/manufacturers']);
                },
                error => {
                    this.errorMessage = <any>error;
                    this.toasterService.pop('error', 'Error', 'Error with deleting manufacturer!');
                    this.disabled = false;
                    this.router.navigate(['/manufacturers']);
                }
            );
    }

    deleteBrandReference(br: BrandReference) {
        this.apiReferenceService.deleteBrandReference(br.manufacturer_id, br.id)
            .subscribe(
                success => this.brandreferences = this.brandreferences.filter(ref => ref.id !== br.id),
                error => this.toasterService.pop('error', 'Error', 'Error with deleting brand reference!'),
            );
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
            this.base64 = myReader.result;
            this.manufacturer.image_url = myReader.result;
        }
        myReader.readAsDataURL(file);
    }

    createFormGroup() {
        this.manufacturerForm = this.fb.group({
            name: this.manufacturer.name,
            featured: this.manufacturer.featured
        });
    }

    createbrandreferenceFormGroup() {
        this.brandreferenceForm = this.fb.group({
            title: new FormControl('', Validators.required),
            description: new FormControl('', Validators.required),
            category_id: new FormControl(null),
        });
    }

    createDataObject() {
        let manufacturer = {
            "name": this.manufacturerForm.value.name,
            "featured": this.manufacturerForm.value.featured ? '1': '',
        };
        if (this.base64 != null) {
            manufacturer['base64'] = this.base64;
        };
        return manufacturer;
    }
}
