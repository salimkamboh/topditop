import { Component, OnInit } from '@angular/core';
import { ApiEnService } from '../service/api.en.service';
import { ApiService } from '../service/api.service';
import { Fieldgroup } from '../data/fieldgroup';
import { Fieldtype } from '../data/fieldtype';
import { Field } from '../data/field';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-fieldgroup-detail',
    templateUrl: './fieldgroup-detail.component.html'
})
export class FieldgroupDetailComponent implements OnInit {

    private id: number;
    private entity: string = 'fieldgroups';
    private fieldgroup: Fieldgroup;
    private fields: Field[];
    private errorMessage: string;
    private disabled: boolean = false;
    private fieldgroupForm: FormGroup;

    constructor(private apiEnService: ApiEnService, private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiEnService.get(this.entity, this.id)
                .subscribe(
                fieldgroup => { this.fieldgroup = <Fieldgroup>fieldgroup; },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Fieldgroup with given ID doesn`t exist!'); this.router.navigate(['/fieldgroups']); }
                );
            this.apiEnService.getAll('fields/all/free/' + this.id)
                .subscribe(
                fields => { this.fields = <Field[]>fields; this.createFormGroup(); },
                error => this.errorMessage = <any>error
                );
        } else {
            this.fieldgroup = {
                id: null,
                cssclass: '',
                active: '',
                tableorder: '',
                name: '',
                fields: []
            };
            this.apiEnService.getAll('fields/all/free')
                .subscribe(
                fields => { this.fields = <Field[]>fields; },
                error => this.errorMessage = <any>error
                );

            this.createFormGroup();
        }

    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateFieldgroup(this.id);
        } else {
            this.createFieldgroup();
        }
    }

    createFieldgroup() {
        let fieldgroup = this.createDataObject();
        this.apiEnService.create(this.entity, fieldgroup)
            .subscribe(
            fieldgroup => { this.fieldgroup = <Fieldgroup>fieldgroup; this.toasterService.pop('success', 'Success', 'Fieldgroup created!'); this.disabled = false; this.router.navigate(['/fieldgroup', this.fieldgroup.id]); this.id = this.fieldgroup.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating fieldgroup!'); this.disabled = false; this.router.navigate(['/fieldgroups']); }
            );

    }

    updateFieldgroup(id: number) {
        let fieldgroup = this.createDataObject();
        this.apiEnService.update(this.entity, this.id, fieldgroup)
            .subscribe(
            fieldgroup => { this.fieldgroup = <Fieldgroup>fieldgroup; this.toasterService.pop('success', 'Success', 'Fieldgroup updated!'); this.router.navigate(['/fieldgroups']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating fieldgroup!'); this.disabled = false; this.router.navigate(['/fieldgroups']); }
            );
    }

    deleteFieldgroup(id: number) {
        this.disabled = true;
        this.apiEnService.delete(this.entity, this.id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Fieldgroup deleted!'); this.disabled = false; this.router.navigate(['/fieldgroups']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting fieldgroup!'); this.disabled = false; this.router.navigate(['/fieldgroups']); }
            );
    }


    createFormGroup() {
        this.fieldgroupForm = this.fb.group({
            name: this.fieldgroup.name,
            cssclass: this.fieldgroup.cssclass,
            selectedFields: new FormControl(this.getFieldId())
        });
    }

    createDataObject() {
        let fieldgroup = {
            "name": this.fieldgroupForm.value.name,
            "cssclass": this.fieldgroupForm.value.cssclass,
            "fields": this.fieldgroupForm.value.selectedFields,
        };
        return fieldgroup;
    }

    getFieldId(): number[] {
        if (this.fields) {
            let fieldIds = [];
            for (let i = 0; i < this.fields.length; i++) {
                if (this.id == +this.fields[i].field_group_id) {
                    fieldIds.push(this.fields[i].id);
                }
            }
            return fieldIds;
        }
    }
}