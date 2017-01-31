import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Category } from '../data/category';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-category-detail',
    templateUrl: './category-detail.component.html'
})
export class CategoryDetailComponent implements OnInit {
    private id: number;
    private entity: string = 'categories';
    private category: Category;
    private errorMessage: string;
    private disabled: boolean = false;
    private categoryForm: FormGroup;

    constructor(private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(
                category => { this.category = <Category>category; this.createFormGroup(); },
                error => this.errorMessage = <any>error
                );
        } else {
            this.category = {
                id: null,
                name: '',
                description: ''
            };
            this.createFormGroup();
        }

    }
    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateCategory(this.id);
        } else {
            this.createCategory();
        }
    }

    createCategory() {
        let category = this.createDataObject();
        this.apiService.create(this.entity, category)
            .subscribe(
            category => { this.category = <Category>category; this.toasterService.pop('success', 'Success', 'Category created!'); this.disabled = false; this.router.navigate(['/category', this.category.id]); this.id = this.category.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating category!'); this.disabled = false; this.router.navigate(['/categories']); }
            );

    }

    updateCategory(id: number) {
        let category = this.createDataObject();
        this.apiService.update(this.entity, this.id, category)
            .subscribe(
            category => { this.category = <Category>category; this.toasterService.pop('success', 'Success', 'Category updated!'); this.router.navigate(['/categories']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating category!'); this.disabled = false; this.router.navigate(['/categories']); }
            );
    }

    deleteCategory(id: number) {
        this.disabled = true;
        this.apiService.delete(this.entity, id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Category deleted!'); this.disabled = false; this.router.navigate(['/categories']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting category!'); this.disabled = false; this.router.navigate(['/categories']); }
            );
    }

    createDataObject() {
        let category = {
            "name": this.categoryForm.value.name,
            "description": this.categoryForm.value.description
        };
        return category;
    }

    createFormGroup() {
        this.categoryForm = this.fb.group({
            name: this.category.name,
            description: this.category.description
        });
    }
}