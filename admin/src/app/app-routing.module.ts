import { LogoutComponent } from './logout/logout.component';
import { AuthGuard } from './service/auth.guard';
import { NgModule } from '@angular/core';
import { Routes, RouterModule, Route } from '@angular/router';

import { AppComponent } from './app.component';
import { AdvertisementsComponent } from './advertisements/advertisements.component';
import { AdvertisementDetailComponent } from './advertisements/advertisement-detail.component';
import { PageNotFoundComponent } from './not-found.component';
import { StoresComponent } from './stores/stores.component';
import { StoreDetailComponent } from './stores/store-detail.component';
import { StoreCreateComponent } from './stores/store-create.component';
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
import { ProductDetailComponent } from './products/product-detail.component';
import { LoginComponent } from './login/login.component';

const appRoutes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: '', canActivate: [AuthGuard], children: [
      { path: 'logout', component: LogoutComponent },
      { path: 'advertisements', component: AdvertisementsComponent },
      { path: 'advertisement/:id', component: AdvertisementDetailComponent },
      { path: 'stores', component: StoresComponent },
      { path: 'store/create', component: StoreCreateComponent },
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
      { path: 'product/:id', component: ProductDetailComponent },
      { path: '', component: AdvertisementsComponent },
      { path: '**', component: PageNotFoundComponent }
    ]
  }
];

export let declarations: Array<any> = [
  AppComponent,
  LoginComponent
];

appRoutes[1].children.forEach((route: Route) => {
  declarations.push(route.component);
});

@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule],
  providers: []
})
export class AppRoutingModule { }
