import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { User } from '../_models/User';

@Injectable()
export class LocalService {
  public getLocationPath() {
    return window.location.pathname.substr(1).split('/');
  }

  public getImpersotedUser(): User {
    return JSON.parse(localStorage.getItem(environment.local.impersonate));
  }

  public setImpersotedUser(user: User): void {
    localStorage.setItem(environment.local.impersonate, JSON.stringify(user));
  }

  public getCurrentUser(): string | null {
    return JSON.parse(localStorage.getItem(environment.local.currentUser));
  }

  public setCurrentUser(user: User): void {
    localStorage.setItem(environment.local.currentUser, JSON.stringify(user));
  }

  public getDeviceId(): string | null {
    return localStorage.getItem(environment.local.deviceId);
  }

  public setDeviceId(deviceId: string): void {
    localStorage.setItem(environment.local.deviceId, deviceId);
  }

  public getAuthToken(): string | null {
    return localStorage.getItem(environment.local.authToken);
  }

  public setAuthToken(authToken: string): void {
    localStorage.setItem(environment.local.authToken, authToken);
  }

  public clear(): void {
    localStorage.clear();
  }
}
