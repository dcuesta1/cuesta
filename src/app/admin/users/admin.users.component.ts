import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { Router } from '@angular/router';

@Component({
  selector: '.userscomponent',
  templateUrl: './admin.users.component.html',
  styleUrls: ['../../../assets/sass/users.component.scss']
})
export class AdminUsersComponent implements OnInit {
  users: User[] = [];

  constructor(private api: HttpClient, public local: LocalService, private _router: Router) {

  }

  ngOnInit() {
    this.api.get('/users').subscribe(
      (users: User[]) => {
        for (let user of users) {
          user = new User(user);
          this.users.push(user);
        }
      }
    );
  }

  // #TODO: do not allow superusers to impersonate each other
  impersonate(user: User) {
    this.local.setImpersotedUser(user);
    // this._router.navigate(['/dashboard']);
    window.location.href = '/dashboard';
  }

}
