import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import { environment } from '../../environments/environment';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';


@Injectable()
export class ApiPanelService {

    private apiUrl = `${environment.domain_url}/en/api/panels/`;

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
    
    getFieldGroups(id: number): Observable<Object> {
        return this.http.get(this.apiUrl + 'fieldgroups/' + id)
            .map((res: Response) => res.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    getPanelsByPackage(id: number): Observable<Object> {
        return this.http.get(this.apiUrl + 'package/' + id)
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

        return this.http.post(this.apiUrl + id, data, options)
            .map((res: Response) => { res.json(); })
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    delete(id: number): Observable<Object> {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map((res: Response) => { })
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }
}