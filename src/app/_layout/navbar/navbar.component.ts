import { Component } from '@angular/core';
import { User } from '../../_models/User';
import { Router } from '@angular/router';
import { LocalService } from '../../_services/local.service';
import { GLobalEventsManager } from '../../_etc/GlobalEventsManager';

@Component({
  selector: '.navbarComp',
  templateUrl: './navbar.component.html'
})
export class NavbarComponent {
  impersonating;
  impersonatedUser: User;
  currentUser: User;
  notification = 0;

  constructor(private _router: Router,
              private _local: LocalService,
              private _globalEventsManager: GLobalEventsManager) {
    this.impersonating = _local.getImpersotedUser();
    this.impersonatedUser = new User(_local.getImpersotedUser());
    this.currentUser = new User(_local.getCurrentUser());
  }

  stopImpersonating() {
    this._local.setImpersotedUser(null);
    this.impersonatedUser = new User();
    this.impersonating = null;
    // this._router.navigate(['/mod/dashboard']);
    window.location.href = '/mod/dashboard';
  }

  logout(): void {
    this._local.clear();
    this._globalEventsManager.showNavigations(false);
    this._router.navigate(['/']);
  }
}
