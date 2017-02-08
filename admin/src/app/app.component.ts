import { AuthenticationService } from './service/authentication.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit{
  title = 'TopdiTop Admin';
  public isLoggedIn: boolean;

  constructor(private authenticationService: AuthenticationService) {
      this.authenticationService.isLoggedIn().subscribe(
          status => {
              this.isLoggedIn = status;
          }
      );
  }

  ngOnInit() {
      if (this.authenticationService.tokenStillActive()) {
          console.log("gonna try auth check");
          this.authenticationService.check().subscribe(
              response => {
                },
              error => {
                  this.authenticationService.logout();
                }
          );    
      } else {
          this.authenticationService.logout();
      }
  }
}
