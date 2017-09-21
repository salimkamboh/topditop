import { ExtendedHttpService } from './extended-http.service';
import { Injectable } from '@angular/core';
import { Response, Headers, RequestOptions } from '@angular/http';
import { Observable } from 'rxjs/Rx';
import { environment } from '../../environments/environment';

import 'rxjs/add/operator/map';
import 'rxjs/add/operator/catch';


@Injectable()
export class ApiStoreService {

    private apiUrl = `${environment.domain_url}api/stores/`;

    constructor(private http: ExtendedHttpService) { }

    getAll(): Observable<Object[]> {
        return this.http.get(this.apiUrl + 'all')
            .map((res: Response) => res.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    getAllActive(): Observable<Object[]> {
        return this.http.get(this.apiUrl + 'list/active')
            .map((res: Response) => res.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    get(id: number): Observable<Object> {
        return this.http.get(this.apiUrl + id)
            .map((res: Response) => res.json())
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    create(data: Object): Observable<Object> {
        let headers = new Headers({ 'Content-Type': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.post(this.apiUrl, data, options)
            .map((res: Response) => res.json())
            .catch((error: any) => Observable.throw(error.json() || 'Server error'));
    }

    activateStore(id: number, data: Object): Observable<Object> {
        let headers = new Headers({ 'Content-Type': 'application/json' });
        let options = new RequestOptions({ headers: headers });

        return this.http.post(this.apiUrl + 'activate/' + id, data, options)
            .map((res: Response) => { res.json(); })
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }

    delete(id: number): Observable<Object> {
        return this.http.delete(this.apiUrl + 'delete/' + id)
            .map((res: Response) => { })
            .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    }
}
