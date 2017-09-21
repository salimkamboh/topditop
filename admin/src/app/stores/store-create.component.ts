import { Component, OnInit } from '@angular/core';
import {Package} from "../data/package";
import {Location} from "../data/location";
import {ApiStoreService} from "../service/api.store.service";
import {ApiLocationService} from "../service/api.location.service";
import {ActivatedRoute, Router} from "@angular/router";
import {FormBuilder, FormGroup} from "@angular/forms";
import {ToasterService} from "angular2-toaster";
import {Observable} from "rxjs/Observable";
import {ApiService} from "../service/api.service";

interface StoreCreateRequest {
    email: string,
    company: string,
    location_id: number,
    package_id: number,
}

@Component({
    selector: 'app-store-create',
    templateUrl: './store-create.component.html'
})
export class StoreCreateComponent implements OnInit {

    private disabled: boolean = false;
    private store: StoreCreateRequest;
    private locations: Location[];
    private packages: Package[];
    private storeForm: FormGroup;
    private errorMessage: string;

    constructor(
        private apiService: ApiService,
        private storeService: ApiStoreService,
        private apiLocationService: ApiLocationService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }


    ngOnInit(): void {
        this.populationStore();
    }

    populationStore() {
        Observable.forkJoin(
            this.apiLocationService.getAll(),
            this.apiService.getAll('packages/all')
        ).subscribe(
            result => {
                this.locations = <Location[]>result[0];
                this.packages = <Package[]>result[1];
                this.createFormGroup();
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Something went wrong');
                //this.router.navigate(['/stores']);
            }
        );
    }

    onSubmit() {
        let newStore = this.createDataObject();

        this.disabled = true;

        this.storeService.create(newStore)
            .subscribe(
                store => {
                    this.toasterService.pop('success', 'Success', 'Store created!');
                    this.disabled = false;
                    this.router.navigate(['/stores']);
                },
                error => {
                    this.errorMessage = this.getErrorMessage(error);
                    this.toasterService.pop('error', 'Error', this.errorMessage);
                    this.disabled = false;
                }
            );
    }

    createFormGroup() {
        this.storeForm = this.fb.group({
            email: '',
            company: '',
            location_id: this.locations[0],
            package_id: this.packages[0],
        });
    }

    createDataObject() {
        return {
            'email': this.storeForm.value.email,
            'company': this.storeForm.value.company,
            'package_id': parseInt(this.storeForm.value.package_id, 10),
            'location_id': parseInt(this.storeForm.value.location_id, 10),
        };
    }

    private getErrorMessage(err: any) {
        let message: string = '';
        for (let key in err){
                if (err.hasOwnProperty(key)) {
                    message += err[key] + ' ';
            }
        }
        return message;
    }
}
