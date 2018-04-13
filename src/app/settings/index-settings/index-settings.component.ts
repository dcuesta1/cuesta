import { Component } from '@angular/core';
import { LocalService } from '../../_services/local.service';

@Component({
  selector: '.indexsettingscomponent',
  templateUrl: './index-settings.component.html'
})
export class IndexSettingsComponent {

  constructor(public local: LocalService) {
  }
}
