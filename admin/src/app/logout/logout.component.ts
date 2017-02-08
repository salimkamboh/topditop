import { AuthenticationService } from './../service/authentication.service';
import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-logout',
    template: ''
})
export class LogoutComponent implements OnInit {
    constructor(private authenticationService: AuthenticationService) { }

    ngOnInit() {
        this.authenticationService.logout();
    }
}