import { Component, OnInit } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators, AbstractControl, FormControl } from '@angular/forms';
import { CustomValidators } from '../../_etc/CustomValidators';
import { UserService } from '../../_services/user.service';

@Component({
  selector: '.personalsettingscomponent',
  templateUrl: './personal-settings.component.html'
})
export class PersonalSettingsComponent implements OnInit {
  public currentUser: User;
  private _impersonating;
  public personalInfoForm: FormGroup;
  constructor(
    private _local: LocalService,
    private _fb: FormBuilder,
    private _userService: UserService
  ) {
    this._impersonating = _local.getImpersotedUser();

    if (this._impersonating) {
      this.currentUser = new User(this._impersonating);
    } else {
      this.currentUser = new User(_local.getCurrentUser());
    }

    this.personalInfoForm = _fb.group({
      'name': [this.currentUser.name, [Validators.required]],
      'email': [this.currentUser.email, [Validators.email]],
      'password': [null, Validators.minLength(8)],
      'password_confirm': [null, CustomValidators.passwordMatch]
    });
  }

  ngOnInit() {
    this.personalInfoForm.controls.name.valueChanges.subscribe( (value: any) => {
      if (value === this.currentUser.name) {
          this.personalInfoForm.controls.name.markAsPristine();
      }
    });

    this.personalInfoForm.controls.email.valueChanges.subscribe( (value: any) => {
      if (value === this.currentUser.email) {
        this.personalInfoForm.controls.email.markAsPristine();
      }
    });

    const password = this.personalInfoForm.get('password');
    this.personalInfoForm.controls.password.valueChanges.subscribe( (value: any) => {
      if (!value) {
        password.markAsPristine();
      }

      if (value && password.valid) {
        this.personalInfoForm.controls.password_confirm.enable();
      } else {
        this.personalInfoForm.controls.password_confirm.disable();
      }
    });
  }

  updatePersonalSettings(input: any) {
    this.currentUser.name = input.name > 0 ? input.name : this.currentUser.name;
    this.currentUser.email = input.email > 0 ? input.email : this.currentUser.email;
    this.currentUser.password = input.password > 0 ? input.name : this.currentUser.password;

    this._userService.update(this.currentUser).subscribe(user => {
      this._local.setCurrentUser(user);
    });

    this.reset();
  }

  public reset() {
    this.personalInfoForm.reset({
      name: this.currentUser.name,
      email: this.currentUser.email
    });
  }
}
