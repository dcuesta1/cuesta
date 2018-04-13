import { Component, EventEmitter, Input, OnChanges, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Car } from '../../../_models/Car';
import { ModalService } from '../../../_services/modal.service';
import { CarService } from '../../../_services/car.service';
import { MakeModels } from '../../../_etc/makeModels';

@Component({
  selector: 'edit-vehicle',
  templateUrl: './edit-vehicle.component.html'
})
export class EditVehicleComponent implements OnChanges {
  @Input('car') car: Car;
  @Output() onVehicleEdited: EventEmitter<Car> = new EventEmitter<Car>();

  public editVehicleForm: FormGroup;
  public makeModels: any;
  public models = [];
  public years = [];

  constructor(
    private _modalService: ModalService,
    private _fb: FormBuilder,
    private _carService: CarService
  ) {
    this.makeModels = MakeModels;
    const year = new Date().getFullYear();

    for (let i = 1970; i < year + 2; i++) {
      this.years.push(i);
    }
   }

  ngOnChanges() {
    this.editVehicleForm = this._fb.group({
      make: [this.car.make, [Validators.required]],
      model: [this.car.model, [Validators.required]],
      year: [this.car.year, [Validators.required, Validators.minLength(4), Validators.maxLength(4)]],
      number: [this.car.number, [Validators.minLength(17), Validators.maxLength(17)]],
    });

    this.editVehicleForm.controls.make.valueChanges.subscribe( (val) => {
      if (val) {
        for (const make of this.makeModels) {
          if (make.title.toLowerCase() === val.toLowerCase()) {
            for (const model of make.models) {
              this.models.push(model.title);
            }
          }
        }
      }
    });

    this.editVehicleForm.controls.make.valueChanges.subscribe((value: any) => {
      if (value === this.car.make) {
          this.editVehicleForm.controls.make.markAsPristine();
      }
    });

    this.editVehicleForm.controls.model.valueChanges.subscribe((value: any) => {
      if (value === this.car.model) {
          this.editVehicleForm.controls.model.markAsPristine();
      }
    });

    this.editVehicleForm.controls.year.valueChanges.subscribe((value: any) => {
      if (value === this.car.year) {
          this.editVehicleForm.controls.year.markAsPristine();
      }
    });

    this.editVehicleForm.controls.number.valueChanges.subscribe((value: any) => {
      if (value === this.car.number) {
          this.editVehicleForm.controls.number.markAsPristine();
      }
    });
  }

  closeModal() {
    this._modalService.close('editVehicleModal');
  }

  reset() {
    this.editVehicleForm.reset({
      make: this.car.make,
      model: this.car.model,
      number: this.car.number,
      year: this.car.year
    });
    this.car = null;
  }

  cancel() {
    this.reset();
    this.closeModal();
  }

  submit() {
    const editedCar = new Car(this.editVehicleForm.value);
    editedCar.customer_id = this.car.customer_id;
    editedCar.id = this.car.id;

    this._carService.update(editedCar).subscribe( (car) => {
      const updatedCar = new Car(car);
      this.onVehicleEdited.emit(updatedCar);
      this.cancel();
    });
  }

}
