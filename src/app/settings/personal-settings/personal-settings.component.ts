import { Component, OnInit } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators, AbstractControl, FormControl } from '@angular/forms';
import { CustomValidators } from '../../_etc/CustomValidators'
import { UserService } from '../../_services/user.service';

@Component({
  selector: '.personalsettingscomponent',
  templateUrl: './personal-settings.component.html',
  styleUrls: ['./personal-settings.component.scss']
})
export class PersonalSettingsComponent implements OnInit {
  public currentUser: User;
  public personalInfoForm: FormGroup;
  constructor(
    private _local: LocalService,
    private _fb: FormBuilder,
    private _userService: UserService
  ) { 
    this.currentUser = new User(_local.getCurrentUser());

    var emailRegex = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';

    this.personalInfoForm = _fb.group({
      'name': [this.currentUser.name, [Validators.required]],
      'email': [this.currentUser.email, [Validators.email]],
      'password':[null, Validators.minLength(8)],
      'password_confirm': [null, CustomValidators.passwordMatch]
    });
  }

  ngOnInit() {
    this.personalInfoForm.controls.name.valueChanges.subscribe( (value:any) => {
      if(value == this.currentUser.name) {
          this.personalInfoForm.controls.name.markAsPristine();
      }
    });

    this.personalInfoForm.controls.email.valueChanges.subscribe( (value:any) => {
      if(value == this.currentUser.email) {
        this.personalInfoForm.controls.email.markAsPristine();
      }
    });

    var password = this.personalInfoForm.get('password');
    this.personalInfoForm.controls.password.valueChanges.subscribe( (value:any) => {
      if(!value) {
        password.markAsPristine();
      }

      if(value && password.valid) {
        this.personalInfoForm.controls.password_confirm.enable();
      } else {
        this.personalInfoForm.controls.password_confirm.disable();
      }
    });
  }

  updatePersonalSettings(input: any) {
    this.currentUser.name = input.name > 0 ? input.name : this.currentUser.name;
    this.currentUser.email = input.email > 0 ? input.email : this.currentUser.email 
    this.currentUser.password = input.password > 0 ? input.name : this.currentUser.password;

    this._userService.update(this.currentUser).subscribe(user => {
      this._local.SetCurrentUser(user);
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
