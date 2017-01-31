import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Rx';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';


@Injectable()
export class ApiReferenceService {

  private apiUrl = 'https://topditop.foundcenter.com/api/references/';

  constructor(private http: Http) { }

  getAll(): Observable<Object[]> {
    return this.http.get(this.apiUrl + 'all')
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  get(id: number): Observable<Object> {
    return this.http.get(this.apiUrl + id)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }
  
  getProducts(id: number): Observable<Object[]> {
    return this.http.get(this.apiUrl + id + '/products')
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  getManufacturers(id: number): Observable<Object[]> {
    return this.http.get(this.apiUrl + id + '/manufacturers')
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  getImages(id: number): Observable<Object[]> {
    return this.http.get(this.apiUrl + id + '/images')
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  create(data: Object): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.post(this.apiUrl, data, options)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  update(id: number, data: Object): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.post(this.apiUrl + 'update/' + id, data, options)
      .map((res: Response) => { res.json(); console.log(res.json()); })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  delete(id: number): Observable<Object> {
    return this.http.delete(this.apiUrl + 'delete/' + id)
      .map((res: Response) => { })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }
}
