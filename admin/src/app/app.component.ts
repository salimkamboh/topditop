import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'TopdiTop Admin';

  logged() {
        if (localStorage.getItem('user')) {
            return true;
        }
        return false;
    }
}
