import { Component, OnInit } from '@angular/core';
import { ApiStoreService } from '../service/api.store.service';
import { ApiLocationService } from '../service/api.location.service';
import { Store } from '../data/store';
import { Location } from '../data/location';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-store-detail',
    templateUrl: './store-detail.component.html'
})
export class StoreDetailComponent implements OnInit {

    private id: number;
    private store: Store;
    private locations: Location[];
    private errorMessage: string;
    private disabled: boolean = false;
    private storeForm: FormGroup;

    constructor(private apiStoreService: ApiStoreService, private apiLocationService: ApiLocationService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiStoreService.get(this.id)
                .subscribe(
                store => { this.store = <Store>store; this.createFormGroup(); },
                error => this.errorMessage = <any>error
                );
            this.apiLocationService.getAll()
                .subscribe(
                locations => { this.locations = <Location[]>locations; },
                error => this.errorMessage = <any>error
                )
        } else {
            this.store = {
                id: null,
                store_name: '',
                mag_store_id: '',
                mag_cat_id: '',
                user_email: '',
                status: '',
                image_id: '',
                location_id: '',
                cover_url: '',
                user: {
                    registerfields: []
                },
                registerfields: []
            };
            this.createFormGroup();
        }
    }

    onSubmit() {
        // this.disabled = true;
        // if (this.id != -1) {
        //     this.updateStore(this.id);
        // } else {
        //     this.createStore();
        // }
    }

    createFormGroup() {
        this.storeForm = this.fb.group({
            email: this.store.user_email,
            name: this.store.store_name,
            status: this.store.status,
            location: this.store.location_id,
            selectedFieldAndValues: this.store.registerfields
        });
    }
}