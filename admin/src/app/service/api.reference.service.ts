import { ExtendedHttpService } from './extended-http.service';
import { Injectable } from '@angular/core';
import { Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import { environment } from '../../environments/environment';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';


@Injectable()
export class ApiReferenceService {

  private apiUrl = `${environment.domain_url}api/references/`;

  constructor(private http: ExtendedHttpService) { }

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
      .map((res: Response) => { res.json(); })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  delete(id: number): Observable<Object> {
    return this.http.delete(this.apiUrl + 'delete/' + id)
      .map((res: Response) => { })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  deleteImage(id: number, data: Object): Observable<Object> {
    return this.http.post(this.apiUrl + 'images/delete/' + id, data)
      .map((res: Response) => { res.json(); })
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  getBrandReferences(brandId: number): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.get(`${environment.domain_url}api/brands/${brandId}/references`, options)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  createBrandReferences(data: Object): Observable<Object> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.post(this.apiUrl, data, options)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }

  deleteBrandReference(brandId: number, brandreferenceId: number): Observable<boolean> {
    let headers = new Headers({ 'Content-Type': 'application/json' });
    let options = new RequestOptions({ headers: headers });

    return this.http.delete(`${environment.domain_url}api/brands/${brandId}/references/${brandreferenceId}`, options)
      .map((res: Response) => res.status === 204 ? true : false)
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
  }
}
