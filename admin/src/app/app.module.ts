import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { RouterModule, Routes, Route } from '@angular/router';
import { ToasterModule, ToasterService } from 'angular2-toaster';

import { ApiService } from './service/api.service';
import { ApiEnService } from './service/api.en.service';
import { ApiPanelService } from './service/api.panel.service';
import { ApiStoreService } from './service/api.store.service';
import { ApiLocationService } from './service/api.location.service';
import { ApiReferenceService } from './service/api.reference.service';
import { ApiProductService } from './service/api.product.service';

import { AppComponent } from './app.component';
import { AdvertisementsComponent } from './advertisements/advertisements.component';
import { AdvertisementDetailComponent } from './advertisements/advertisement-detail.component';
import { PageNotFoundComponent } from './not-found.component';
import { StoresComponent } from './stores/stores.component';
import { StoreDetailComponent } from './stores/store-detail.component';
import { SlidesComponent } from './slides/slides.component';
import { SlideDetailComponent } from './slides/slide-detail.component';
import { ManufacturersComponent } from './manufacturers/manufacturers.component';
import { ManufacturerDetailComponent } from './manufacturers/manufacturer-detail.component';
import { CategoriesComponent } from './categories/categories.component';
import { CategoryDetailComponent } from './categories/category-detail.component';
import { FieldtypesComponent } from './fieldtypes/fieldtypes.component';
import { FieldtypeDetailComponent } from './fieldtypes/fieldtype-detail.component';
import { FieldsComponent } from './fields/fields.component';
import { FieldDetailComponent } from './fields/field-detail.component';
import { FieldgroupsComponent } from './fieldgroups/fieldgroups.component';
import { FieldgroupDetailComponent } from './fieldgroups/fieldgroup-detail.component';
import { PanelsComponent } from './panels/panels.component';
import { PanelDetailComponent } from './panels/panel-detail.component';
import { PackagesComponent } from './packages/packages.component';
import { PackageDetailComponent } from './packages/package-detail.component';
import { LocationsComponent } from './locations/locations.component';
import { LocationDetailComponent } from './locations/location-detail.component';
import { RegisterfieldsComponent } from './registerfields/registerfields.component';
import { RegisterfieldDetailComponent } from './registerfields/registerfield-detail.component';
import { ReferencesComponent } from './references/references.component';
import { ReferenceDetailComponent } from './references/reference-detail.component';
import { ProductsComponent } from './products/products.component';


const appRoutes: Routes = [
  { path: 'advertisements', component: AdvertisementsComponent },
  { path: 'advertisement/:id', component: AdvertisementDetailComponent },
  { path: 'stores', component: StoresComponent },
  { path: 'store/:id', component: StoreDetailComponent },
  { path: 'slides', component: SlidesComponent },
  { path: 'slide/:id', component: SlideDetailComponent },
  { path: 'manufacturers', component: ManufacturersComponent },
  { path: 'manufacturer/:id', component: ManufacturerDetailComponent },
  { path: 'categories', component: CategoriesComponent },
  { path: 'category/:id', component: CategoryDetailComponent },
  { path: 'fieldtypes', component: FieldtypesComponent },    
  { path: 'fieldtype/:id', component: FieldtypeDetailComponent },
  { path: 'fields', component: FieldsComponent }, 
  { path: 'field/:id', component: FieldDetailComponent },
  { path: 'fieldgroups', component: FieldgroupsComponent },
  { path: 'fieldgroup/:id', component: FieldgroupDetailComponent },
  { path: 'panels', component: PanelsComponent },
  { path: 'panel/:id', component: PanelDetailComponent },
  { path: 'packages', component: PackagesComponent },  
  { path: 'package/:id', component: PackageDetailComponent },  
  { path: 'locations', component: LocationsComponent },
  { path: 'location/:id', component: LocationDetailComponent },
  { path: 'registerfields', component: RegisterfieldsComponent },
  { path: 'registerfield/:id', component: RegisterfieldDetailComponent },
  { path: 'references', component: ReferencesComponent },
  { path: 'reference/:id', component: ReferenceDetailComponent },
  { path: 'products', component: ProductsComponent },
  { path: '', component: AdvertisementsComponent },
  { path: '**', component: PageNotFoundComponent }

];

let declarations: Array<any> = [
  AppComponent
];

appRoutes.forEach((route: Route) => {
  declarations.push(route.component);
});

@NgModule({
  declarations: declarations,
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpModule,
    RouterModule.forRoot(appRoutes),
    ToasterModule
  ],
  providers: [
    ApiService, 
    ApiEnService, 
    ApiPanelService, 
    ApiLocationService, 
    ApiStoreService,
    ApiReferenceService,
    ApiProductService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
