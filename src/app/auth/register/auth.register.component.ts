import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../../_services/auth.service';
import { LocalService } from '../../_services/local.service';
import { environment } from '../../../environments/environment';
import { Router } from '@angular/router';
import { CustomValidators } from '../../_etc/CustomValidators';
import { User } from '../../_models/User';
import { GLobalEventsManager } from '../../_etc/GlobalEventsManager';

@Component({
  selector: '.registerComponent',
  templateUrl: './auth.register.component.html'
})

export class AuthRegisterComponent {
  public homeUrl: string;
  public registerForm: FormGroup;

  constructor(
    private _fb: FormBuilder,
    private _authService: AuthService,
    private _localService: LocalService,
    private _router: Router,
    private _globalEventsManager: GLobalEventsManager
  ) {
    this.homeUrl = environment.homeUrl;

    if (this._localService.getCurrentUser()) {
      this._router.navigate(['/dashboard']);
    }

    this.registerForm = _fb.group({
      'firstName': [null, [Validators.required, Validators.min(3)]],
      'lastName': [null, [Validators.required, Validators.min(3)]],
      'username': [null, [Validators.required]],
      'email': [null, [Validators.required, Validators.email]],
      'password': [null, [Validators.required, Validators.pattern('^[a-z0-9_-]{8,15}$')]], // #TODO: establish a regex
      'passwordConfirm': [null, [Validators.required, CustomValidators.passwordMatch]]
    });
  }

  public register( inputs: any) {
    const newUser = new User();
    newUser.name = inputs.firstName + ' ' + inputs.lastName;
    newUser.username = inputs.username;
    newUser.email = inputs.email;
    newUser.password = inputs.password;

    this._authService.register(newUser).subscribe((user: User) => {
      this._localService.setCurrentUser(user);
      this._globalEventsManager.showNavigations(true);

      if (this._localService.getCurrentUser()) {
        this._router.navigate(['/settings/business']);
      }
    });
  }
}
