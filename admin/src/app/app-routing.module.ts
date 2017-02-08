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
  { path: 'logout', component: LogoutComponent, canActivate: [AuthGuard] },
  { path: 'advertisements', component: AdvertisementsComponent, canActivate: [AuthGuard] },
  { path: 'advertisement/:id', component: AdvertisementDetailComponent, canActivate: [AuthGuard] },
  { path: 'stores', component: StoresComponent, canActivate: [AuthGuard] },
  { path: 'store/:id', component: StoreDetailComponent, canActivate: [AuthGuard] },
  { path: 'slides', component: SlidesComponent, canActivate: [AuthGuard] },
  { path: 'slide/:id', component: SlideDetailComponent, canActivate: [AuthGuard] },
  { path: 'manufacturers', component: ManufacturersComponent, canActivate: [AuthGuard] },
  { path: 'manufacturer/:id', component: ManufacturerDetailComponent, canActivate: [AuthGuard] },
  { path: 'categories', component: CategoriesComponent, canActivate: [AuthGuard] },
  { path: 'category/:id', component: CategoryDetailComponent, canActivate: [AuthGuard] },
  { path: 'fieldtypes', component: FieldtypesComponent, canActivate: [AuthGuard] },
  { path: 'fieldtype/:id', component: FieldtypeDetailComponent, canActivate: [AuthGuard] },
  { path: 'fields', component: FieldsComponent, canActivate: [AuthGuard] },
  { path: 'field/:id', component: FieldDetailComponent, canActivate: [AuthGuard] },
  { path: 'fieldgroups', component: FieldgroupsComponent, canActivate: [AuthGuard] },
  { path: 'fieldgroup/:id', component: FieldgroupDetailComponent, canActivate: [AuthGuard] },
  { path: 'panels', component: PanelsComponent, canActivate: [AuthGuard] },
  { path: 'panel/:id', component: PanelDetailComponent, canActivate: [AuthGuard] },
  { path: 'packages', component: PackagesComponent, canActivate: [AuthGuard] },
  { path: 'package/:id', component: PackageDetailComponent, canActivate: [AuthGuard] },
  { path: 'locations', component: LocationsComponent, canActivate: [AuthGuard] },
  { path: 'location/:id', component: LocationDetailComponent, canActivate: [AuthGuard] },
  { path: 'registerfields', component: RegisterfieldsComponent, canActivate: [AuthGuard] },
  { path: 'registerfield/:id', component: RegisterfieldDetailComponent, canActivate: [AuthGuard] },
  { path: 'references', component: ReferencesComponent, canActivate: [AuthGuard] },
  { path: 'reference/:id', component: ReferenceDetailComponent, canActivate: [AuthGuard] },
  { path: 'products', component: ProductsComponent, canActivate: [AuthGuard] },
  { path: 'product/:id', component: ProductDetailComponent, canActivate: [AuthGuard] },
  { path: '', component: AdvertisementsComponent, canActivate: [AuthGuard] },
  { path: '**', component: PageNotFoundComponent }
];

export let declarations: Array<any> = [
  AppComponent
];

appRoutes.forEach((route: Route) => {
  declarations.push(route.component);
});

@NgModule({
  imports: [RouterModule.forRoot(appRoutes)],
  exports: [RouterModule],
  providers: []
})
export class AppRoutingModule { }
