import { Component } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';

@Component({
  selector: '.sidebar',
  templateUrl: './sidebar.component.html'
})
export class SidebarComponent  {
  public currentUser; // Raw JSON from local
  public impersonate; // Raw JSON from local
  public impersonating: User; // Impersonated User
  public user: User; // Switch Helper

  constructor(private _local: LocalService) {
    // Grab users as JSON
    this.impersonate = _local.getImpersotedUser();
    this.currentUser = _local.getCurrentUser();

    this.currentUser = new User(_local.getCurrentUser());
    this.impersonating = new User(_local.getImpersotedUser());
    this.user = this.currentUser;

    if (this.impersonate) {
      this.user = this.impersonating;
    }
  }
}
