import { Router } from '@angular/router';
import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs';
import { environment } from '../../environments/environment';
import 'rxjs/add/operator/map';


@Injectable()
export class AuthenticationService {
    public token: string;
    public user: Object;

    constructor(private http: Http, private router: Router) {
        // set token if saved in local storage
        this.user = JSON.parse(localStorage.getItem('user'));
        this.token = localStorage.getItem('token');
    }

    login(username: string, password: string): Observable<any> {
        return this.http.post(`${environment.domain_url}api/auth/login`, { email: username, password: password })
            .map((response: Response) => {
                this.user = response.json().user;
                this.token = response.json().token;
                
                localStorage.setItem('user', JSON.stringify({ Object: this.user }));
                localStorage.setItem('token', this.token);
            })
            .catch((error: any) => Observable.throw(error || 'Server error'));
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        this.user = null;
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.router.navigate(['/login']);
    }
}
