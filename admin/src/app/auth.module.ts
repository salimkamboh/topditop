import { NgModule } from '@angular/core';
import { Http, RequestOptions } from '@angular/http';
import { AuthHttp, AuthConfig } from 'angular2-jwt';
import { ExtendedHttpService } from './service/extended-http.service';
import { AuthenticationService } from './service/authentication.service';
import { Router } from '@angular/router';

export function authHttpServiceFactory(http: Http, router: Router, authenticationService: AuthenticationService, options: RequestOptions) {
    return new ExtendedHttpService(new AuthConfig({
            tokenName: 'token',
            globalHeaders: [{'Content-Type':'application/json'},{'Accept':'application/json'}],
        }), http, router, authenticationService, options);
}

@NgModule({
    providers: [
        {
            provide: ExtendedHttpService,
            useFactory: authHttpServiceFactory,
            deps: [Http, Router, AuthenticationService, RequestOptions]
        },
        AuthenticationService
    ]
})
export class AuthModule {}