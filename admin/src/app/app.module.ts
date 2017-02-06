import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { ToasterModule } from 'angular2-toaster';

import { AppRoutingModule } from './app-routing.module';
import { declarations } from './app-routing.module';

import { ApiService } from './service/api.service';
import { ApiEnService } from './service/api.en.service';
import { ApiPanelService } from './service/api.panel.service';
import { ApiStoreService } from './service/api.store.service';
import { ApiLocationService } from './service/api.location.service';
import { ApiReferenceService } from './service/api.reference.service';
import { ApiProductService } from './service/api.product.service';


@NgModule({
  declarations: declarations,
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpModule,
    AppRoutingModule,
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
  bootstrap: [declarations[0]]
})
export class AppModule { }
