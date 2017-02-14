import { Observable } from 'rxjs/Rx';
import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Fieldgroup } from '../data/fieldgroup';
import { Field } from '../data/field';
import { ActivatedRoute, Router } from '@angular/router';
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

    constructor(
        private apiService: ApiService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        this.createFormGroup();
        if (this.id != -1) {
            this.populateFieldGroup();
        } else {
            this.initializeFieldGroup();
            // this.fieldgroup = {
            //     id: null,
            //     cssclass: '',
            //     active: '',
            //     tableorder: '',
            //     name: '',
            //     fields: []
            // };
            // this.apiService
            //     .getAll('fields/all/free')
            //     .subscribe(
            //     fields => {
            //         this.fields = <Field[]>fields;
            //     },
            //     error => this.errorMessage = <any>error
            //     );
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
        this.apiService
            .create(this.entity, fieldgroup)
            .subscribe(
            fieldgroup => {
                this.fieldgroup = <Fieldgroup>fieldgroup;
                this.toasterService.pop('success', 'Success', 'Fieldgroup created!');
                this.disabled = false; this.router.navigate(['/fieldgroup', this.fieldgroup.id]);
                this.id = this.fieldgroup.id;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with creating fieldgroup!');
                this.disabled = false;
                this.router.navigate(['/fieldgroups']);
            }
            );

    }

    updateFieldgroup(id: number) {
        let fieldgroup = this.createDataObject();
        this.apiService
            .update(this.entity, this.id, fieldgroup)
            .subscribe(
            fieldgroup => {
                this.fieldgroup = <Fieldgroup>fieldgroup;
                this.toasterService.pop('success', 'Success', 'Fieldgroup updated!');
                this.router.navigate(['/fieldgroups']);
                this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with updating fieldgroup!');
                this.disabled = false;
                this.router.navigate(['/fieldgroups']);
            }
            );
    }

    deleteFieldgroup(id: number) {
        this.disabled = true;
        this.apiService
            .delete(this.entity, this.id)
            .subscribe(
            () => {
                this.toasterService.pop('success', 'Success', 'Fieldgroup deleted!');
                this.disabled = false; this.router.navigate(['/fieldgroups']);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with deleting fieldgroup!');
                this.disabled = false; this.router.navigate(['/fieldgroups']);
            }
            );
    }

    initializeFieldGroup() {
        this.fieldgroup = {
            id: null,
            cssclass: '',
            active: '',
            tableorder: '',
            name: '',
            fields: []
        };
        this.apiService
            .getAll('fields/all/free')
            .subscribe(
            fields => {
                this.fields = <Field[]>fields;
            },
            error => this.errorMessage = <any>error
            );
    }

    populateFieldGroup() {
        Observable.forkJoin(
            this.apiService.get(this.entity, this.id),
            this.apiService.getAll('fields/all/free/' + this.id)
        ).subscribe(
            result => {
                this.fieldgroup = <Fieldgroup>result[0];
                this.fields = <Field[]>result[1];
                this.setFormGroup();
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Something went wrong!');
                this.router.navigate(['/fieldgroups']);
            }
            );
    }

    setFormGroup() {
        this.fieldgroupForm.controls['name'].setValue(this.fieldgroup.name);
        this.fieldgroupForm.controls['cssclass'].setValue(this.fieldgroup.cssclass);
        this.fieldgroupForm.controls['selectedFields'].setValue(this.getFieldId());
    }

    createFormGroup() {
        this.fieldgroupForm = this.fb.group({
            name: '',
            cssclass: '',
            selectedFields: new FormControl([])
        });
    }

    createDataObject() {
        let fieldgroup = {
            'name': this.fieldgroupForm.value.name,
            'cssclass': this.fieldgroupForm.value.cssclass,
            'fields': this.fieldgroupForm.value.selectedFields,
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