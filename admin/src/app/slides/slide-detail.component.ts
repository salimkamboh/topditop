import { Component, OnInit } from '@angular/core';
import { ApiService } from '../service/api.service';
import { Slide } from '../data/slide';
import { Store } from '../data/store';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ToasterService } from 'angular2-toaster';

@Component({
    selector: 'app-slide-detail',
    templateUrl: './slide-detail.component.html'
})
export class SlideDetailComponent implements OnInit {

    id: number;
    slide: Slide;
    stores: Store[];
    entity: string = 'slides';
    errorMessage: string;
    private disabled: boolean = false;
    private fileReader: FileReader;
    base64: string = null;
    slideForm: FormGroup;

    constructor(private apiService: ApiService, private router: Router, private route: ActivatedRoute, private fb: FormBuilder, private toasterService: ToasterService) { }

    ngOnInit() {
        this.id = this.route.snapshot.params['id'];
        if (this.id != -1) {
            this.apiService.get(this.entity, this.id)
                .subscribe(
                slide => { this.slide = <Slide>slide; this.createFormGroup(); },
                error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Slide with given ID doesn`t exist!'); this.router.navigate(['/slides']); }
                );
        } else {
            this.createNewSlide();
            this.createFormGroup();
        }
        this.apiService.getAll('stores/all').subscribe(
            stores => { this.stores = <Store[]>stores; },
            error => this.errorMessage = <any>error
        );
        this.base64 = null;
    }

    onSubmit() {
        this.disabled = true;
        if (this.id != -1) {
            this.updateSlide(this.id);
        } else {
            this.createSlide();
        }
    }

    createSlide() {
        let slide = this.createDataObject();
        this.apiService.create(this.entity, slide)
            .subscribe(
            slide => { this.slide = <Slide>slide; this.toasterService.pop('success', 'Success', 'Slide created!'); this.disabled = false; this.router.navigate(['/slide', this.slide.id]); this.id = this.slide.id },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with creating slide!'); this.disabled = false; this.router.navigate(['/slides']); }
            );

    }

    updateSlide(id: number) {
        let slide = this.createDataObject();
        this.apiService.update(this.entity, this.id, slide)
            .subscribe(
            slide => { this.slide = <Slide>slide; this.toasterService.pop('success', 'Success', 'Slide updated!'); this.router.navigate(['/slides']); this.disabled = false; },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with updating slides!'); this.disabled = false; this.router.navigate(['/slides']); }
            );

    }

    deleteSlide(id: number) {
        this.disabled = true;
        this.apiService.delete(this.entity, id)
            .subscribe(
            () => { this.toasterService.pop('success', 'Success', 'Slide deleted!'); this.disabled = false; this.router.navigate(['/slides']); },
            error => { this.errorMessage = <any>error; this.toasterService.pop('error', 'Error', 'Error with deleting slide!'); this.disabled = false; this.router.navigate(['/slides']); }
            );
    }

    changeListener($event): void {
        this.readThis($event.target);
    }

    readThis(inputValue: any): void {
        let file: File = inputValue.files[0];
        let myReader: FileReader = new FileReader();
        myReader.onloadend = (e) => {
            this.base64 = myReader.result;
            this.slide.image_url = myReader.result;
        }
        myReader.readAsDataURL(file);
    }

    createNewSlide() {
        this.slide = {
            id: null,
            title: '',
            image_url: '',
            slot1_store_id: '',
            slot1_width: '',
            slot1_valid_until: '',
            slot2_store_id: '',
            slot2_width: '',
            slot2_valid_until: '',
            slot3_store_id: '',
            slot3_width: '',
            slot3_valid_until: '',
            slot4_store_id: '',
            slot4_width: '',
            slot4_valid_until: '',
            slot5_store_id: '',
            slot5_width: '',
            slot5_valid_until: ''
        };
    }

    createFormGroup() {
        this.slideForm = this.fb.group({
            id: null,
            title: this.slide.title,
            slot1_store_id: this.slide.slot1_store_id,
            slot1_width: this.slide.slot1_width,
            slot1_valid_until: this.slide.slot1_valid_until,
            slot2_store_id: this.slide.slot2_store_id,
            slot2_width: this.slide.slot2_width,
            slot2_valid_until: this.slide.slot2_valid_until,
            slot3_store_id: this.slide.slot3_store_id,
            slot3_width: this.slide.slot3_width,
            slot3_valid_until: this.slide.slot3_valid_until,
            slot4_store_id: this.slide.slot4_store_id,
            slot4_width: this.slide.slot4_width,
            slot4_valid_until: this.slide.slot4_valid_until,
            slot5_store_id: this.slide.slot5_store_id,
            slot5_width: this.slide.slot5_width,
            slot5_valid_until: this.slide.slot5_valid_until
        });
    }
    createDataObject(): Object {
        let slide = {
            "title": this.slideForm.value.title,
            "slot1_store_id": this.slideForm.value.slot1_store_id,
            "slot1_width": this.slideForm.value.slot1_width,
            "slot1_valid_until": this.slideForm.value.slot1_valid_until,
            "slot2_store_id": this.slideForm.value.slot2_store_id,
            "slot2_width": this.slideForm.value.slot2_width,
            "slot2_valid_until": this.slideForm.value.slot2_valid_until,
            "slot3_store_id": this.slideForm.value.slot3_store_id,
            "slot3_width": this.slideForm.value.slot3_width,
            "slot3_valid_until": this.slideForm.value.slot3_valid_until,
            "slot4_store_id": this.slideForm.value.slot4_store_id,
            "slot4_width": this.slideForm.value.slot4_width,
            "slot4_valid_until": this.slideForm.value.slot4_valid_until,
            "slot5_store_id": this.slideForm.value.slot5_store_id,
            "slot5_width": this.slideForm.value.slot5_width,
            "slot5_valid_until": this.slideForm.value.slot5_valid_until
        };
        if (this.base64 != null) {
            slide['base64'] = this.base64;
        };
        return slide;
    }
}