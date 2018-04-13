import { Component, EventEmitter, Input, OnChanges, Output } from '@angular/core';
import { Car } from '../../../_models/Car';
import { CarService } from '../../../_services/car.service';
import { ModalService } from '../../../_services/modal.service';

@Component({
  selector: 'delete-vehicle',
  templateUrl: './delete-vehicle.component.html',
})
export class DeleteVehicleComponent implements OnChanges {
  @Input() car: Car;
  @Output() onVehicleDeleted: EventEmitter<Car> = new EventEmitter<Car>();

  constructor(private _carService: CarService,
              private _modalService: ModalService
  ) { }

  ngOnChanges() {
  }

  confirm() {
    this._carService.destroy(this.car.id).subscribe( (res) => {
      if (res) {
        this.onVehicleDeleted.emit(this.car);
        this.cancel();
      }
    });
  }

  cancel(): void {
    this._modalService.close('deleteVehicleModal');
  }

}
