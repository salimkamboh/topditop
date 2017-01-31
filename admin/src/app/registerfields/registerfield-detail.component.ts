import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Registerfield } from '../data/registerfield';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-registerfield-detail',
    templateUrl: './registerfield-detail.component.html'
})
export class RegisterfieldDetailComponent implements OnInit {

    private id: number;
    private entity: string = 'registerfields';
    private registerfield: Registerfield;
    private errorMessage: string;
    private disabled: boolean = false;
    private registerfieldForm: FormGroup;

    constructor(private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(
                registerfield => { this.registerfield = <Registerfield>registerfield; this.createFormGroup(); },
                error => this.errorMessage = <any>error
                );
        } else {
            this.registerfield = {
                id: null,
                key: '',
                name: '',
                values: '',
                fieldlocation: '',
                order: ''
            };
            this.createFormGroup();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateRegisterfield(this.id);
        } else {
            this.createRegisterfield();
        }
    }

    createRegisterfield() {
        let registerfield = this.createDataObject();
        this.apiService.create(this.entity, registerfield)
            .subscribe(
            registerfield => { this.registerfield = <Registerfield>registerfield; this.toasterService.pop('success', 'Success', 'Registerfield created!'); this.disabled = false; this.router.navigate(['/registerfield', this.registerfield.id]); this.id = this.registerfield.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating registerfield!'); this.disabled = false; this.router.navigate(['/registerfields']); }
            );

    }

    updateRegisterfield(id: number) {
        let registerfield = this.createDataObject();
        this.apiService.update(this.entity, this.id, registerfield)
            .subscribe(
            registerfield => { this.registerfield = <Registerfield>registerfield; this.toasterService.pop('success', 'Success', 'Registerfield updated!'); this.router.navigate(['/registerfields']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating registerfield!'); this.disabled = false; this.router.navigate(['/registerfields']); }
            );
    }

    deleteRegisterfield(id: number) {
        // this.disabled = true;
        // this.apiService.delete(this.entity, this.id)
        //     .subscribe(
        //     () => { this.toasterService.pop('success', 'Success', 'Registerfield deleted!'); this.disabled = false; this.router.navigate(['/registerfields']); },
        //     error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting registerfield!'); this.disabled = false; this.router.navigate(['/registerfields']); }
        //     );
    }

    createFormGroup() {
        this.registerfieldForm = this.fb.group({
            key: this.registerfield.key,
            name: this.registerfield.name,
            location: this.registerfield.fieldlocation,
        });
    }
    createDataObject() {
        let registerfield = {
            "key": this.registerfieldForm.value.key,
            "name": this.registerfieldForm.value.name,
            "fieldlocation": this.registerfieldForm.value.location,
        };
        console.log(registerfield)
        return registerfield;
    }
}