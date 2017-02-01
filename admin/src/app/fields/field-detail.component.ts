import { Component, OnInit } from '@angular/core';
import { ApiEnService } from '../service/api.en.service';
import { ApiService } from '../service/api.service';
import { Field } from '../data/field';
import { Fieldtype } from '../data/fieldtype';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-field-detail',
    templateUrl: './field-detail.component.html',
    styleUrls: ['./field-detail.component.css']
})
export class FieldDetailComponent implements OnInit {

    private id: number;
    private entity: string = 'fields';
    private field: Field;
    private fieldtypes: Fieldtype[];
    private errorMessage: string;
    private disabled: boolean = false;
    private fieldForm: FormGroup;

    constructor(private apiEnService: ApiEnService, private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiEnService.get(this.entity, this.id)
                .subscribe(
                field => { this.field = <Field>field; this.createFormGroup(); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Field with given ID doesn`t exist!'); this.router.navigate(['/fields']); }
                );
        } else {
            this.field = {
                id: null,
                key: '',
                fieldtype_id: '',
                field_group_id: '',
                cssclass: '',
                active: '',
                order: '',
                name: '',
                values: ''
            };
            this.createFormGroup();
        }
        this.apiService.getAll('fieldtypes/all')
            .subscribe(
            fieldtypes => { this.fieldtypes = <Fieldtype[]>fieldtypes; },
            error => this.errorMessage = <any>error
            );
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateField(this.id);
        } else {
            this.createField();
        }
    }

    createField() {
        let field = this.createDataObject();
        this.apiEnService.create(this.entity, field)
            .subscribe(
            field => { this.field = <Field>field; this.toasterService.pop('success', 'Success', 'Field created!'); this.disabled = false; this.router.navigate(['/field', this.field.id]); this.id = this.field.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating field!'); this.disabled = false; this.router.navigate(['/fields']); }
            );

    }

    updateField(id: number) {
        let field = this.createDataObject();
        this.apiEnService.update(this.entity, this.id, field)
            .subscribe(
            field => { this.field = <Field>field; this.toasterService.pop('success', 'Success', 'Field updated!'); this.router.navigate(['/fields']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating field!'); this.disabled = false; this.router.navigate(['/fields']); }
            );
    }

    deleteField(id: number) {
        this.disabled = true;
        this.apiService.delete(this.entity, this.id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Field deleted!'); this.disabled = false; this.router.navigate(['/fields']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting field!'); this.disabled = false; this.router.navigate(['/fields']); }
            );
    }

    createFormGroup() {
        this.fieldForm = this.fb.group({
            key: this.field.key,
            name: this.field.name,
            cssclass: this.field.cssclass,
            fieldtype_id: this.field.fieldtype_id,
            values: this.field.values,
        });
    }

    createDataObject() {
        let field = {
            "key": this.fieldForm.value.key,
            "name": this.fieldForm.value.name,
            "cssclass": this.fieldForm.value.cssclass,
            "fieldtype_id": this.fieldForm.value.fieldtype_id,
            "values": this.fieldForm.value.values            
        };
        return field;
    }
}