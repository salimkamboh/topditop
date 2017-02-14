import { Component } from '@angular/core';
import { Router } from '@angular/router';

import { AuthenticationService } from '../service/authentication.service';

@Component({
    selector: 'app-login',
    templateUrl: 'login.component.html'
})

export class LoginComponent {
    model: any = {};
    loading = false;
    error = '';

    constructor(private router: Router, private authenticationService: AuthenticationService) { }

    login() {
        this.loading = true;
        this.authenticationService.login(this.model.username, this.model.password)
            .subscribe(
            result => {
                this.loading = false;
                let url = this.authenticationService.redirectUrl;
                this.router.navigate([url]);
            },
            error => {
                this.error = 'The email or password you have entered is invalid.';
                this.loading = false;
            }
            );
    }
}
