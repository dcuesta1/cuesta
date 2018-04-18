import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { GLobalEventsManager } from '../../_etc/GlobalEventsManager';
import { AuthService } from '../../_services/auth.service';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { environment } from '../../../environments/environment';

@Component({
  selector: '.loginComponent',
  templateUrl: './auth.login.component.html'
})
export class AuthLoginComponent {
  homeUrl: string;
  loginForm: FormGroup;
  private _currentUser: User;

  constructor(
    private router: Router,
    private fb: FormBuilder,
    private authService: AuthService,
    private globalEventsManager: GLobalEventsManager,
    private local: LocalService
  ) {
    this.homeUrl = environment.homeUrl;
    this._currentUser = new User(this.local.getCurrentUser());

    if (local.getCurrentUser()) {
      if (this._currentUser.isSuperUser()) {
        this.router.navigate(['/mod/dashboard']);
      } else {
        this.router.navigate(['/dashboard']);
      }
    }

    this.loginForm = fb.group({
      'email': [null, Validators.required],
      'password': [null, Validators.required]
    });
  }

  login(inputs: any): void {
    this.authService.authenticate(inputs.email, inputs.password)
      .subscribe(
        (user: User) => {
          this.globalEventsManager.showNavigations(true);
          this.local.setCurrentUser(user);
          this._currentUser = new User(user);

          if (this._currentUser.isSuperUser()) {
            this.router.navigate(['/mod/dashboard']);
          } else {
            this.router.navigate(['/dashboard']);
          }
        }
      );
  }
}
