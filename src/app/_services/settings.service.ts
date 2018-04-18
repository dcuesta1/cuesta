import { Injectable } from '@angular/core';
import { Settings } from '../_models/Settings';
import { HttpClient } from '@angular/common/http';
import { User } from '../_models/User';


@Injectable()
export class SettingsService {
    constructor(
        private api: HttpClient
    ) {}

    get(user: User) {
        return this.api.get<Settings>('/users/' + user.username + '/settings/');
    }

    update(settings: Settings, user: User) {
        return this.api.put<Settings>('/users/' + user.username + '/settings/', settings);
    }
}
