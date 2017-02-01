import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { ApiPanelService } from '../service/api.panel.service';
import { Package } from '../data/package';
import { Panel } from '../data/panel';
import { Fieldtype } from '../data/fieldtype';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup, FormControl } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-package-detail',
    templateUrl: './package-detail.component.html'
})
export class PackageDetailComponent implements OnInit {
    private id: number;
    private entity: string = 'packages';
    private pack: Package;
    private panels: Panel[];
    private errorMessage: string;
    private disabled: boolean = false;
    private packageForm: FormGroup;

    constructor(private apiPanelService: ApiPanelService, private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id).subscribe(
                pack => { this.pack = <Package>pack; },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Package with given ID doesn`t exist!'); this.router.navigate(['/packages']); }
            );
            this.apiPanelService.getAll().subscribe(
                panels => { this.panels = <Panel[]>panels; this.createFormGroup(); },
                error => this.errorMessage = <any>error
                );
        } else {
            this.pack = {
                id: null,
                name: '',
                description: ''
            };
            this.apiPanelService.getAll().subscribe(
                panels => { this.panels = <Panel[]>panels; },
                error => this.errorMessage = <any>error
                );
            this.createFormGroup();
        }

    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updatePackage(this.id);
        } else {
            this.createPackage();
        }
    }

    createPackage() {
        let pack = this.createDataObject();
        this.apiService.create(this.entity, pack)
            .subscribe(
            pack => { this.pack = <Package>pack; this.toasterService.pop('success', 'Success', 'Package created!'); this.disabled = false; this.router.navigate(['/package', this.pack.id]); this.id = this.pack.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating package!'); this.disabled = false; this.router.navigate(['/packages']); }
            );

    }

    updatePackage(id: number) {
        let pack = this.createDataObject();
        this.apiService.update(this.entity, this.id, pack)
            .subscribe(
            pack => { this.pack = <Package>pack; this.toasterService.pop('success', 'Success', 'Package updated!'); this.router.navigate(['/packages']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating pack!'); this.disabled = false; this.router.navigate(['/packages']); }
            );
    }

    deletePackage(id: number) {
        this.disabled = true;
        this.apiService.delete(this.entity, this.id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Package deleted!'); this.disabled = false; this.router.navigate(['/packages']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting package!'); this.disabled = false; this.router.navigate(['/packages']); }
            );
    }

    createFormGroup() {
        this.packageForm = this.fb.group({
            name: this.pack.name,
            selectedPanels: new FormControl(this.getPanelId())
        });
    }

    createDataObject() {
        let pack = {
            "name": this.packageForm.value.name,
            "panels": this.packageForm.value.selectedPanels,
        };
        return pack;
    }

    getPanelId(): number[] {
        if (this.panels) {
            let panelIds = [];
            for (let i = 0; i < this.panels.length; i++) {
                if (this.id == +this.panels[i].package_id) {
                    panelIds.push(this.panels[i].id);
                }
            }
            return panelIds;
        }
    }
}