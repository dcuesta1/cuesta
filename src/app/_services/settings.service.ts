import { Injectable } from '@angular/core';
import { Settings } from '../_models/Settings';
import { HttpClient } from '@angular/common/http';


@Injectable()
export class SettingsService {
    constructor(
        private api: HttpClient
    ) {}

    get(userId: number) {
        return this.api.get<Settings>('/users/' + userId + '/settings/');
    }

    update(settings: Settings, userId: number) {
        return this.api.put<Settings>('/users/' + userId + '/settings/', settings);
    }
}
