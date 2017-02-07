import { AuthenticationService } from './service/authentication.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'TopdiTop Admin';
  loggedIn = false;

  constructor(private authenticationService: AuthenticationService) {

  }

  ngOnInit() {
      if (this.authenticationService.tokenStillActive()) {
          console.log("gonna try auth check");
          this.authenticationService.check().subscribe(
              response => {
                  console.log("login check is OK");
                  this.loggedIn = true;
                },
              error => {
                  console.log("login check FAIL");
                  this.loggedIn = false;
                }
          );
      } else {
          console.log("will not try auth check");
          this.authenticationService.logout();
          this.loggedIn = false;
      }
  }

  logged() {
        if (localStorage.getItem('user')) {
            return true;
        }
        return false;
  }
}
