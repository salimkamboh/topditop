import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Adverts } from '../data/adverts';
import { Brand } from '../data/brand';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';
import { environment } from '../../environments/environment';

@Component({
    selector: 'app-advertisement-detail',
    templateUrl: './advertisement-detail.component.html'
})
export class AdvertisementDetailComponent implements OnInit {
    private id: number;
    private entity: string = 'adverts';
    private advert: Adverts;
    private brands: Brand[];
    private errorMessage: string;
    private disabled: boolean = false;
    private filename_scanned_image_url_base64: string = null;
    private filename_brand_logo_url_base64: string = null;
    private filename_reference_image_url_base64: string = null;
    private advertForm: FormGroup;
    private domain: string = environment.domain_url;

    constructor(
        private apiService: ApiService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService
                .get(this.entity, this.id)
                .subscribe(
                advert => {
                    this.advert = <Adverts>advert;
                    this.createFormGroup();
                },
                error => {
                    this.errorMessage = <any>error;
                    this.toasterService.pop('error', 'Error', 'Advertisement with given ID doesn`t exist!');
                    this.router.navigate(['/advertisements']);
                }
                );
        } else {
            this.advert = {
                id: null,
                scanned_image_url: '',
                brand_logo_url: '',
                reference_image_url: '',
                manufacturer_id: '',
                name: ''
            };
            this.createFormGroup();
        }

        this.apiService
            .getAll('manufacturers/all')
            .subscribe(
            brands => this.brands = <Brand[]>brands,
            error => this.errorMessage = <any>error
            );
    }

    changeListener($event): void {
        this.readThis($event.target);
    }

    readThis(inputValue: any): void {
        let file: File = inputValue.files[0];
        let myReader: FileReader = new FileReader();
        if (!inputValue.files || inputValue.files.length === 0) {
            if (inputValue.id == 'filename_scanned_image_url') {
                this.filename_scanned_image_url_base64 = null;
            }
            if (inputValue.id == 'filename_brand_logo_url') {
                this.filename_brand_logo_url_base64 = null;
            }
            if (inputValue.id == 'filename_reference_image_url') {
                this.filename_reference_image_url_base64 = null;
            }
            return;
        }
        myReader.onloadend = (e) => {
            if (inputValue.id == 'filename_scanned_image_url') {
                this.filename_scanned_image_url_base64 = myReader.result;
                this.advert.scanned_image_url = myReader.result;
            }
            if (inputValue.id == 'filename_brand_logo_url') {
                this.filename_brand_logo_url_base64 = myReader.result;
                this.advert.brand_logo_url = myReader.result;
            }
            if (inputValue.id == 'filename_reference_image_url') {
                this.filename_reference_image_url_base64 = myReader.result;
                this.advert.reference_image_url = myReader.result;
            }
        };
        myReader.readAsDataURL(file);
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateAdvert(this.id);
        } else {
            this.createAdvert();
        }
    }

    createAdvert() {
        let advert = this.createDataObject();
        this.apiService.create(this.entity, advert)
            .subscribe(
            advert => {
                this.advert = <Adverts>advert;
                this.id = this.advert.id;
                this.updateImages();
                this.toasterService.pop('success', 'Success', 'Advertisement created!');
                this.disabled = false;
                this.router.navigate(['/advertisements']);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with creating advertisement!');
                this.disabled = false;
                this.router.navigate(['/advertisements']);
            }
            );

    }

    updateAdvert(id: number) {
        let advert = this.createDataObject();
        console.log(advert);
        this.updateImages();
        this.apiService
            .update(this.entity, this.id, advert)
            .subscribe(
            advert => {
                this.advert = <Adverts>advert;
                this.toasterService.pop('success', 'Success', 'Advertisement updated!');
                this.router.navigate(['/advertisements']);
                this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with updating advertisement!');
                this.disabled = false;
                this.router.navigate(['/advertisements']);
            }
            );

    }

    deleteAdvert(id: number) {
        this.disabled = true;
        this.apiService
            .delete(this.entity, id)
            .subscribe(
            advert => {
                this.toasterService.pop('success', 'Success', 'Advertisement deleted!');
                this.router.navigate(['/advertisements']);
                this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with deleting advertisement!');
                this.disabled = false;
                this.router.navigate(['/advertisements']);
            }
            );
    }

    createFormGroup() {
        this.advertForm = this.fb.group({
            name: this.advert.name,
            manufacturer_id: this.advert.manufacturer_id
        });
    }

    createDataObject(): Object {
        let advert = {
            'manufacturer_id': this.advertForm.value.manufacturer_id,
            'name': this.advertForm.value.name
        };
        return advert;
    }

    updateImages() {
        if (this.filename_brand_logo_url_base64 != null) {
            let image = {
                'base64': this.filename_brand_logo_url_base64,
                'type': 'brand_logo'
            };
            this.apiService.create(`${this.entity}/${this.id}/images`, image).subscribe();
        };
        if (this.filename_reference_image_url_base64 != null) {
            let image = {
                'base64': this.filename_reference_image_url_base64,
                'type': 'reference_image'
            };
            this.apiService.create(`${this.entity}/${this.id}/images`, image).subscribe();
        };
        if (this.filename_scanned_image_url_base64 != null) {
            let image = {
                'base64': this.filename_scanned_image_url_base64,
                'type': 'scanned_image'
            };
            this.apiService.create(`${this.entity}/${this.id}/images`, image).subscribe();
        };
    }

}

