import { AuthenticationService } from './authentication.service';
import { Injectable } from '@angular/core';
import { AuthHttp, AuthConfig } from 'angular2-jwt';
import { Http, RequestOptions, Request, Response, RequestOptionsArgs } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { Router } from '@angular/router';
import 'rxjs/add/operator/catch';
import 'rxjs/add/observable/throw';

@Injectable()
export class ExtendedHttpService extends AuthHttp {

  constructor(
    options: AuthConfig,
    http: Http,
    private router: Router,
    private authenticationService: AuthenticationService,
    defOpts?: RequestOptions
  ) {
    super(options, http, defOpts);
  }

  request(url: string | Request, options?: RequestOptionsArgs): Observable<Response> {
    return super.request(url, options).catch(this.catchErrors());
  }

  private catchErrors() {
    return (res: Response) => {
      if (res.status === 401) {
        this.authenticationService.logout();
      }
      return Observable.throw(res);
    };
  }

}