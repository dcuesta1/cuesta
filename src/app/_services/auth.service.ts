import { Injectable } from '@angular/core';
import { User } from '../_models/User';
import { LocalService } from './local.service';
import { HttpClient } from '@angular/common/http';

@Injectable()
export class AuthService {

  private device: string;
  public currentUser: User;

  constructor(
    private local: LocalService,
    private http: HttpClient
  ) {}

  setDevice(): void {
    // TODO: modify for cordova device id
    this.device =  (Math.random() + +new Date).toString(36).replace('.', '');
    this.local.setDeviceId(this.device);
  }

  authenticate(email, password) {
    this.setDevice();
    const device = this.device;

    return this.http.post<User>('/authenticate', { email, password, device});
  }

  register(user: User) {
    this.setDevice();
    const device = this.device;

    return this.http.post<User>('/register', {user, device});
  }
}
