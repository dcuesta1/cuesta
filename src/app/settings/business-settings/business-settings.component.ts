import { Component, OnInit } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { ReactiveFormsModule, FormBuilder, FormGroup, Validators, AbstractControl, FormControl } from '@angular/forms';
import { CustomValidators } from '../../_etc/CustomValidators'
import { UserService } from '../../_services/user.service';

@Component({
  selector: '.businesssettingscomponent',
  templateUrl: './business-settings.component.html',
  styleUrls: ['./business-settings.component.scss']
})
export class BusinessSettingsComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

}
