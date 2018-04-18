import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable()
export class CarService {
  constructor(private _api: HttpClient) {}

  index() {
    return this._api.get('/cars');
  }

  create(car) {
    return this._api.post('/cars', car);
  }

  update(car) {
    return this._api.put('/cars/' + car.id, car);
  }

  destroy(id: number) {
    return this._api.delete<boolean>('/cars/' + id);
  }
}
