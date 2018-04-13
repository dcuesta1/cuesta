import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { User } from '../_models/User';

@Injectable()
export class LocalService {
  getLocationPath() {
    return window.location.pathname.substr(1).split('/');
  }

  getImpersotedUser(): User {
    return JSON.parse(localStorage.getItem(environment.local.impersonate));
  }

  setImpersotedUser(user: User): void {
    localStorage.setItem(environment.local.impersonate, JSON.stringify(user));
  }

  getCurrentUser(): string | null {
    return JSON.parse(localStorage.getItem(environment.local.currentUser));
  }

  public SetCurrentUser(user: User): void {
    localStorage.setItem(environment.local.currentUser, JSON.stringify(user));
  }

  getDeviceId(): string | null {
    return localStorage.getItem(environment.local.deviceId);
  }

  SetDeviceId(deviceId: string): void {
    localStorage.setItem(environment.local.deviceId, deviceId);
  }

  getAuthToken(): string | null {
    return localStorage.getItem(environment.local.authToken);
  }

  SetAuthToken(authToken: string): void {
    localStorage.setItem(environment.local.authToken, authToken);
  }

  clear(): void {
    localStorage.clear();
  }
}
