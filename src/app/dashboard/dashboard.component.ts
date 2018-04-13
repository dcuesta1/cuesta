import { Component, OnInit } from '@angular/core';
import { User } from '../_models/User';
import { LocalService } from '../_services/local.service';

@Component({
  selector: '#dashboard',
  templateUrl: './dashboard.component.html',
  styles: []
})
export class DashboardComponent implements OnInit {
  public currentUser: User;
  private _impersonating;

  constructor(private _local: LocalService) {
    this._impersonating = _local.getImpersotedUser();
    this.currentUser = new User(_local.getCurrentUser());

    if (this._impersonating) {
      this.currentUser = new User(this._impersonating);
    }
  }

  ngOnInit() {
  }

}
