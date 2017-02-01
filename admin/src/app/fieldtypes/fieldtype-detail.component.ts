import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Fieldtype } from '../data/fieldtype';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-fieldtype-detail',
    templateUrl: './fieldtype-detail.component.html',
    styleUrls: ['./fieldtype-detail.component.css']
})
export class FieldtypeDetailComponent implements OnInit {

    private id: number;
    private entity: string = 'fieldtypes';
    private fieldtype: Fieldtype;
    private errorMessage: string;
    private disabled: boolean = false;
    private fieldtypeForm: FormGroup;

    constructor(private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(
                fieldtype => { this.fieldtype = <Fieldtype>fieldtype; this.createFormGroup(); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Fieldtype with given ID doesn`t exist!'); this.router.navigate(['/fieldtypes']); }
                );
        } else {
            this.fieldtype = {
                id: null,
                name: '',
                template: '',
                active: ''
            };
            this.createFormGroup();
        }
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateFieldtype(this.id);
        } else {
            this.createFieldtype();
        }
    }

    createFieldtype() {
        let fieldtype = this.createDataObject();
        this.apiService.create(this.entity, fieldtype)
            .subscribe(
            fieldtype => { this.fieldtype = <Fieldtype>fieldtype; this.toasterService.pop('success', 'Success', 'Fieldtype created!'); this.disabled = false; this.router.navigate(['/fieldtype', this.fieldtype.id]); this.id = this.fieldtype.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating fieldtype!'); this.disabled = false; this.router.navigate(['/fieldtypes']); }
            );

    }

    updateFieldtype(id: number) {
        let fieldtype = this.createDataObject();
        this.apiService.update(this.entity, this.id, fieldtype)
            .subscribe(
            fieldtype => { this.fieldtype = <Fieldtype>fieldtype; this.toasterService.pop('success', 'Success', 'Fieldtype updated!'); this.router.navigate(['/fieldtypes']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating fieldtype!'); this.disabled = false; this.router.navigate(['/fieldtypes']); }
            );
    }

    deleteFieldtype(id: number) {
        this.disabled = true;
        this.apiService.delete(this.entity, id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Fieldtype deleted!'); this.disabled = false; this.router.navigate(['/fieldtypes']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting fieldtype!'); this.disabled = false; this.router.navigate(['/fieldtypes']); }
            );
    }

    createFormGroup() {
        this.fieldtypeForm = this.fb.group({
            name: this.fieldtype.name
        });
    }
    createDataObject() {
        let fieldtype = {
            "name": this.fieldtypeForm.value.name,
        };
        return fieldtype;
    }
}