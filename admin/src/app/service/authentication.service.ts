import { tokenNotExpired } from 'angular2-jwt';
import { Router } from '@angular/router';
import { Injectable, Output, EventEmitter } from '@angular/core';
import { Http, Response, Headers, RequestOptions } from '@angular/http';
import { Observable, Subject, BehaviorSubject } from 'rxjs';
import { environment } from '../../environments/environment';
import 'rxjs/add/operator/map';


@Injectable()
export class AuthenticationService {
    public token: string;
    public user: Object;
    private loggedIn: Subject<boolean> = new BehaviorSubject<boolean>(false);

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
                this.loggedIn.next(true);

                localStorage.setItem('user', JSON.stringify({ Object: this.user }));
                localStorage.setItem('token', this.token);
            })
            .catch((error: any) => Observable.throw(error || 'Server error'));
    }

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        this.user = null;
        this.loggedIn.next(false);
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.router.navigate(['/login']);
    }

    check(): Observable<any> {
        let headers = new Headers({ 'Content-Type': 'application/json' });
        headers.append('Authorization', `Bearer ${this.token}`);
        headers.append('Accept', 'application/json');
        let options = new RequestOptions({ headers: headers });

        return this.http.get(`${environment.domain_url}api/auth/check`, options)
            .map((response: Response) => {
                this.user = response.json().user;
                this.token = response.json().token;
                this.loggedIn.next(true);

                localStorage.setItem('user', JSON.stringify({ Object: this.user }));
                localStorage.setItem('token', this.token);
            })
            .catch((error: any) => Observable.throw(error || 'Server error'));
    }

    isLoggedIn() {
        return this.loggedIn.asObservable();
    }


    tokenStillActive(): boolean {
        return tokenNotExpired('token');
    }

    tokenExpired(): boolean {
        return !this.tokenStillActive();
    }
}
