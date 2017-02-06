import { Component, OnInit } from '@angular/core';
import { ApiPanelService } from '../service/api.panel.service';
import { ApiService } from '../service/api.service';
import { Panel } from '../data/panel';
import { Fieldgroup } from '../data/fieldgroup';
import { ActivatedRoute, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormArray } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';
import { Observable } from 'rxjs';

@Component({
    selector: 'app-panel-detail',
    templateUrl: './panel-detail.component.html'
})
export class PanelDetailComponent implements OnInit {

    private id: number;
    private panel: Panel;
    private allFieldGroups: Fieldgroup[];
    private fieldgroups: Fieldgroup[];
    private errorMessage: string;
    private disabled: boolean = false;
    private panelForm: FormGroup;

    constructor(
        private apiPanelService: ApiPanelService,
        private apiService: ApiService,
        private router: Router,
        private route: ActivatedRoute,
        private fb: FormBuilder,
        private toasterService: ToasterService
    ) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.populatePanel();
        } else {
            this.panel = {
                id: null,
                package_id: '',
                description: '',
                key: '',
                name: ''
            };
            this.createFormGroup();
            this.fieldgroups = [];
        };

        this.apiService
            .getAll('fieldgroups/all')
            .subscribe(
            allFieldGroups => {
                this.allFieldGroups = <Fieldgroup[]>allFieldGroups;
            },
            error => this.errorMessage = <any>error
            );
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updatePanel(this.id);
        } else {
            this.createPanel();
        }
    }

    createPanel() {
        let panel = this.createDataObject();
        this.apiPanelService.create(panel)
            .subscribe(
            panel => {
                this.panel = <Panel>panel;
                this.toasterService.pop('success', 'Success', 'Panel created!');
                this.disabled = false;
                this.router.navigate(['/panel', this.panel.id]);
                this.id = this.panel.id;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with creating panel!');
                this.disabled = false;
                this.router.navigate(['/panels']);
            }
            );

    }

    updatePanel(id: number) {
        let panel = this.createDataObject();
        this.apiPanelService.update(id, panel)
            .subscribe(
            panel => {
                this.panel = <Panel>panel;
                this.toasterService.pop('success', 'Success', 'Panel updated!');
                this.router.navigate(['/panels']);
                this.disabled = false;
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with updating panel!');
                this.disabled = false;
                this.router.navigate(['/panels']);
            }
            );
    }

    deletePanel(id: number) {
        this.disabled = true;
        this.apiPanelService.delete(id)
            .subscribe(
            () => {
                this.toasterService.pop('success', 'Success', 'Panel deleted!');
                this.disabled = false;
                this.router.navigate(['/panels']);
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Error with deleting panel!');
                this.disabled = false;
                this.router.navigate(['/panels']);
            }
            );
    }

    populatePanel() {
        Observable.forkJoin(
            this.apiPanelService.get(this.id),
            this.apiPanelService.getFieldGroups(this.id)
        ).subscribe(
            result => {
                this.panel = <Panel>result[0];
                this.fieldgroups = <Fieldgroup[]>result[1];

                this.createFormGroup();
                this.populateFieldGroups();
            },
            error => {
                this.errorMessage = <any>error;
                this.toasterService.pop('error', 'Error', 'Something went wrong!');
                this.router.navigate(['/panels']);
            });
    }

    createFormGroup() {
        this.panelForm = this.fb.group({
            name: this.panel.name,
            key: this.panel.key,
            selectedFieldGroups: this.fb.array([])
        });
    }

    initFieldGroup(value?) {
        return this.fb.group({
            id: ['' + value]
        });
    }

    populateFieldGroups() {
        const control = <FormArray>this.panelForm.controls['selectedFieldGroups'];
        for (let i = 0; i < this.fieldgroups.length; i++) {
            control.push(this.initFieldGroup(this.fieldgroups[i].id));
        }
    }

    addNewFieldGroup() {
        const control = <FormArray>this.panelForm.controls['selectedFieldGroups'];
        control.push(this.initFieldGroup());
    }

    createDataObject() {
        let panel = {
            'name': this.panelForm.value.name,
            'key': this.panelForm.value.key,
            'fieldGroups': this.panelForm.value.selectedFieldGroups
        };
        return panel;
    }

}