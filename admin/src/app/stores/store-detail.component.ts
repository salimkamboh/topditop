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
    private base64: string;
    private dirty: boolean = false;

    constructor(private apiStoreService: ApiStoreService, private apiLocationService: ApiLocationService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.apiStoreService.get(this.id).subscribe(
            store => { this.store = <Store>store; this.createFormGroup(); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Store with given ID doesn`t exist!'); this.router.navigate(['/stores']); } 
        );
        this.apiLocationService.getAll().subscribe(
            locations => { this.locations = <Location[]>locations; },
            error => this.errorMessage = <any>error
        )
    }

    onSubmit() {
        this.disabled = true;
        this.updateStore(this.id);
    }

    updateStore(id: number) {
        let store = this.createDataObject();
        this.apiStoreService.activateStore(this.id, store).subscribe(
            store => { this.store = <Store>store; this.toasterService.pop('success', 'Success', 'Store updated!'); this.disabled = false; this.router.navigate(['/stores']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating store!'); this.disabled = false; this.router.navigate(['/stores']); }
        );

    }

      deleteStore(id: number) {
        this.disabled = true;
        this.apiStoreService.delete(this.id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Store deleted!'); this.disabled = false; this.router.navigate(['/stores']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting store!'); this.disabled = false; this.router.navigate(['/stores']); }
            );
    }

    createFormGroup() {
        this.storeForm = this.fb.group({
            email: this.store.user_email,
            store: this.store.store_name,
            status: this.store.status,
            location: this.store.location_id,
        });
    }

    createDataObject() {
        let store = {
            "user_email": this.storeForm.value.email,
            "store_name": this.storeForm.value.store,
            "status": this.storeForm.value.status,
            "location_id": this.storeForm.value.location,
        };
        if (this.dirty) {
            store['base64'] = this.base64;
            this.dirty = false;
        }
        return store;
    }

    changeListener($event): void {
        this.readThis($event.target);
    }

    readThis(inputValue: any): void {
        let file: File = inputValue.files[0];
        let myReader: FileReader = new FileReader();
        myReader.onloadend = (e) => {
            this.base64 = myReader.result;
            this.store.cover_url = myReader.result;
            this.dirty = true;
        }
        myReader.readAsDataURL(file);
    }
}