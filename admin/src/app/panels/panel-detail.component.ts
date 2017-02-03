import { Component, OnInit } from '@angular/core';
import { ApiPanelService } from '../service/api.panel.service';
import { ApiService } from '../service/api.service';
import { Panel } from '../data/panel';
import { Fieldgroup } from '../data/fieldgroup';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

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
    private dirty: boolean;

    constructor(private apiPanelService: ApiPanelService, private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiPanelService.get(this.id)
                .subscribe(
                panel => { this.panel = <Panel>panel; this.createFormGroup(); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Panel with given ID doesn`t exist!'); this.router.navigate(['/panels']); }
                );
            this.apiPanelService.getFieldGroups(this.id)
                .subscribe(
                fieldgroups => { this.fieldgroups = <Fieldgroup[]>fieldgroups; },
                error => this.errorMessage = <any>error
                );
        } else {
            this.panel = {
                id: null,
                package_id: '',
                description: '',
                key: '',
                name: ''
            }
            this.fieldgroups = [];
            this.createFormGroup();
        };
        this.apiService.getAll('fieldgroups/all')
            .subscribe(
            allFieldGroups => { this.allFieldGroups = <Fieldgroup[]>allFieldGroups; },
            error => this.errorMessage = <any>error
            );
        this.dirty = false;
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
            panel => { this.panel = <Panel>panel; this.toasterService.pop('success', 'Success', 'Panel created!'); this.disabled = false; this.router.navigate(['/panel', this.panel.id]); this.id = this.panel.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating panel!'); this.disabled = false; this.router.navigate(['/panels']); }
            );

    }

    updatePanel(id: number) {
        let panel = this.createDataObject();
        this.apiPanelService.update(id, panel)
            .subscribe(
            panel => { this.panel = <Panel>panel; this.toasterService.pop('success', 'Success', 'Panel updated!'); this.router.navigate(['/panels']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating panel!'); this.disabled = false; this.router.navigate(['/panels']); }
            );
    }

    deletePanel(id: number) {
        this.disabled = true;
        this.apiPanelService.delete(id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Panel deleted!'); this.disabled = false; this.router.navigate(['/panels']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting panel!'); this.disabled = false; this.router.navigate(['/panels']); }
            );
    }


    createFormGroup() {
        this.panelForm = this.fb.group({
            name: this.panel.name,
            key: this.panel.key
        });
    }

    changeFieldGroups(current_id: number, next_id: number) {
        this.dirty = true;
        for (var i = 0; i < this.allFieldGroups.length; i++) {
            if (this.allFieldGroups[i].id == next_id) {
                this.fieldgroups[current_id] = this.allFieldGroups[i];
            }
        }
    }

    addNewFieldGroup() {
        if (this.fieldgroups.length == 0) {
            this.fieldgroups[0] = this.allFieldGroups[0];
        } else {
            this.fieldgroups.unshift(this.allFieldGroups[0]);
        }
        this.dirty = true;
    }

    createDataObject() {
        let panel = {
            "name": this.panelForm.value.name,
            "key": this.panelForm.value.key,
        };
        if (this.dirty) {
            panel['fieldGroups'] = this.getFieldGroupId();
        }
        return panel;
    }

    getFieldGroupId(): number[] {
        if (this.fieldgroups) {
            let fieldgroupIds = [];
            for (let i = 0; i < this.fieldgroups.length; i++) {
                fieldgroupIds.push(this.fieldgroups[i].id);
            }
            return fieldgroupIds;
        }
    }
}