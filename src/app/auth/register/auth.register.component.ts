import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../../_services/auth.service';
import { LocalService } from '../../_services/local.service';
import { environment } from '../../../environments/environment';
import { Router } from '@angular/router';
import { CustomValidators } from '../../_etc/CustomValidators';

@Component({
  selector: '.registerComponent',
  templateUrl: './auth.register.component.html'
})

export class AuthRegisterComponent {
  public homeUrl: string;
  public registerForm: FormGroup;

  constructor(private _fb: FormBuilder,
              private _authService: AuthService,
              private _localService: LocalService,
              private _router: Router) {
    this.homeUrl = environment.homeUrl;

    if (this._localService.getCurrentUser()) {
      this._router.navigate(['/dashboard']);
    }

    this.registerForm = _fb.group({
      'firstName': [null, [Validators.required, Validators.min(3)]],
      'lastName': [null, [Validators.required, Validators.min(3)]],
      'username': [null, [Validators.required]],
      'email': [null, [Validators.required, Validators.email]],
      'password': [
        null, [
          Validators.required,
          Validators.pattern('^[a-z0-9_-]{8,15}$')
        ]
      ],
      'passwordConfirm': [null, [Validators.required, CustomValidators.passwordMatch]]
    });
  }
}
