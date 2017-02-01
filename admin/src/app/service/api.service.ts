import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import { environment } from '../../environments/environment';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';


@Injectable()
export class ApiService {

  private apiUrl = `https://${environment.domen_url}/api/`;

  constructor(private http: Http) { }

  getAll(entity: string): Observable<Object[]> {
    return this.http.get(this.apiUrl + entity)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  get(entity: string, id: number): Observable<Object> {
    return this.http.get(this.apiUrl + entity + '/' + id)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  create(entity: string, data: Object): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.post(this.apiUrl + entity + '/', data, options)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  update(entity: string, id: number, data: Object): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.post(this.apiUrl + entity + '/' + id, data, options)
      .map((res: Response) => { res.json(); })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  delete(entity: string, id: number): Observable<Object> {
    return this.http.delete(this.apiUrl + entity + '/delete/' + id)
      .map((res: Response) => { })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }
}
