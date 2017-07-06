import { Component, OnInit } from '@angular/core';
import { ApiLocationService } from '../service/api.location.service';
import { Location } from '../data/location';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';


@Component({
    selector: 'app-location-detail',
    templateUrl: './location-detail.component.html',
})
export class LocationDetailComponent implements OnInit {
    private id: number;
    private location: Location;
    private errorMessage: string;
    private disabled: boolean = false;
    private locationForm: FormGroup;

    constructor(
        private apiLocationService: ApiLocationService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiLocationService.get(this.id)
                .subscribe(
                location => {
                    this.location = <Location>location;
                    this.createFormGroup();
                },
                error => {
                    this.errorMessage = <any>error;
                    this.toasterService.pop('error', 'Error', 'Location with given ID doesn`t exist!');
                    this.router.navigate(['/locations']);
                }
                );
        } else {
            this.location = {
                id: null,
                key: '',
                name: '',
                latitude: '',
                longitude: '',
                is_featured: false,
            };
            this.createFormGroup();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateLocation(this.id);
        } else {
            this.createLocation();
        }
    }

    createLocation() {
        let location = this.createDataObject();
        this.apiLocationService.create(location)
            .subscribe(
            location => {
                this.location = <Location>location;
                this.toasterService.pop('success', 'Success', 'Location created!');
                this.disabled = false;
                this.router.navigate(['/location', this.location.id]);
                this.id = this.location.id;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with creating location!');
                this.disabled = false;
            }
            );

    }

    updateLocation(id: number) {
        let location = this.createDataObject();
        this.apiLocationService.update(this.id, location)
            .subscribe(
            location => {
                this.location = <Location>location;
                this.toasterService.pop('success', 'Success', 'Location updated!');
                this.router.navigate(['/locations']);
                this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with updating location!');
                this.disabled = false; this.router.navigate(['/locations']);
            }
            );
    }

    deleteLocation(id: number) {
        this.disabled = true;
        this.apiLocationService.delete(id)
            .subscribe(
            () => {
                this.toasterService.pop('success', 'Success', 'Location deleted!');
                this.disabled = false;
                this.router.navigate(['/locations']);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', `Error with deleting location! ${error.message}`);
                this.disabled = false; this.router.navigate(['/locations']);
            }
            );
    }

    createDataObject() {
        let location = {
            'key': this.locationForm.value.key,
            'name': this.locationForm.value.name,
            'latitude': this.locationForm.value.latitude,
            'longitude': this.locationForm.value.longitude,
            'is_featured': this.locationForm.value.is_featured,
        };
        return location;
    }

    createFormGroup() {
        this.locationForm = this.fb.group({
            key: this.location.key,
            name: this.location.name,
            latitude: this.location.latitude,
            longitude: this.location.longitude,
            is_featured: this.location.is_featured,
        });
    }
}