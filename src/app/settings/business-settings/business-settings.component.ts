import { Component, OnInit } from '@angular/core';
import { Settings } from '../../_models/Settings';
import { LocalService } from '../../_services/local.service';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { User } from '../../_models/User';
import { SettingsService } from '../../_services/settings.service';
import { DecimalPipe } from '@angular/common';

@Component({
  selector: '.businesssettingscomponent',
  templateUrl: './business-settings.component.html',
  providers: [DecimalPipe]
})

export class BusinessSettingsComponent implements OnInit {
  public businessInfoForm: FormGroup;
  public settings: Settings;
  public currentUser: User;
  private _impersonating;

  constructor(
    private _local: LocalService,
    private _settingsService: SettingsService,
    private _fb: FormBuilder,
    private _decimalPipe: DecimalPipe
  ) {
    this._impersonating = this._local.getImpersotedUser();

    if (this._impersonating) {
      this.currentUser = new User(this._impersonating);
    } else {
      this.currentUser = new User(_local.getCurrentUser());
    }

    this._settingsService.get(this.currentUser).subscribe((settings: Settings) => {
      this.settings = new Settings(settings);

      this.businessInfoForm = this._fb.group({
        'business_name': [this.settings.business_name, [Validators.required]],
        'business_email': [this.settings.business_email, [Validators.email]],
        'business_phone': [this.settings.business_phone, [Validators.required]],
        'tax': [this._decimalPipe.transform(this.settings.tax, '1.2-2'), [Validators.required]],
        'fee': [this._decimalPipe.transform(this.settings.fee, '1.2-2'), [Validators.required]]
      });
    });
  }

  ngOnInit() {
    if (this.businessInfoForm) {
      this.businessInfoForm.controls.business_name.valueChanges.subscribe((value: any) => {
        if (value === this.settings.business_name) {
          this.businessInfoForm.controls.business_name.markAsPristine();
        }
      });

      this.businessInfoForm.controls.business_email.valueChanges.subscribe((value: any) => {
        if (value === this.settings.business_email) {
          this.businessInfoForm.controls.business_email.markAsPristine();
        }
      });

      this.businessInfoForm.controls.business_phone.valueChanges.subscribe((value: any) => {
        if (value === this.settings.business_phone) {
          this.businessInfoForm.controls.business_phone.markAsPristine();
        }
      });

      this.businessInfoForm.controls.fee.valueChanges.subscribe((value: any) => {
        if (value === this.settings.fee) {
          this.businessInfoForm.controls.fee.markAsPristine();
        }
      });

      this.businessInfoForm.controls.tax.valueChanges.subscribe((value: any) => {
        if (value === this.settings.tax) {
          this.businessInfoForm.controls.tax.markAsPristine();
        }
      });

      // this.businessInfoForm.controls.plan.valueChanges.subscribe( (value: any) => {
      //     if (value === this.settings.plan) {
      //         this.businessInfoForm.controls.plan.markAsPristine();
      //     }
      // });
    }
  }

  public updateBusinessSettings(inputs: any) {
    const updatedSettings = new Settings(inputs);
    updatedSettings.plan = 0; // TODO: add payed and free subscription interface & handler

    this._settingsService.update(updatedSettings, this.currentUser).subscribe((settings: Settings) => {
      this.settings = new Settings(settings);
      this.reset();
    });
  }

  private reset() {
    this.businessInfoForm.reset({
      business_phone: this.settings.business_phone,
      business_email: this.settings.business_email,
      business_name: this.settings.business_name,
      tax: this._decimalPipe.transform(this.settings.tax, '1.2-2'),
      fee: this._decimalPipe.transform(this.settings.fee, '1.2-2')
    });
  }
}
