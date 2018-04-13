import { Component, OnInit } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';
import { CustomerService } from '../../_services/customer.service';
import { Customer } from '../../_models/Customer';
import { ModalService } from '../../_services/modal.service';
import { Invoice } from '../../_models/Invoice';
import { toInteger } from '@ng-bootstrap/ng-bootstrap/util/util';
import { Car } from '../../_models/Car';

@Component({
  selector: '.userscustomerscomponent',
  templateUrl: './user-customers.component.html',
  styleUrls: ['../../../assets/sass/user-customers.component.scss']
})

export class UserCustomersComponent implements OnInit {
  private _currentUser: User;
  public customerPane = false;
  public customer: Customer;
  public deleteCustomers = [];
  private _impersonating;
  public car;
  public searchInput;
  public customers: Array<Customer> = [];

  constructor(public local: LocalService,
              private _modalService: ModalService,
              private _customerService: CustomerService) {
    this._impersonating = local.getImpersotedUser();
    this._currentUser = new User(local.getCurrentUser());

    if (this._impersonating) {
      this._currentUser = new User(this._impersonating);
    }
  }

  ngOnInit() {
    // Grab Customers
    this._customerService.userCustomers(this._currentUser.username).subscribe((customers) => {
      for (const customer of customers) {
        for (let i = 0; i < customer.invoices.length; i++) {
          customer.invoices[i] = new Invoice(customer.invoices[i]);
        }
        this.customers.push(new Customer(customer));
      }
    });

    // Search Filter
  }

  public addCustomer(customer: Customer) {
    this.customers.push(customer);
  }

  public updateCustomer(customer: Customer): void {
    this.customer = customer;
  }

  public addVehicle(car): void {
    this.customer.cars.push(car);
  }

  public updateVehicle(car): void {
    for (const i in this.customer.cars) {
      if (car.id === this.customer.cars[i].id) {
        this.customer.cars[i] = new Car(car);
      }
    }
  }

  public removeVehicle(car): void {
    for (const i in this.customer.cars) {
      if (car.id === this.customer.cars[i].id) {
        this.customer.cars.splice(toInteger(i), 1);
      }
    }
  }

  public viewCustomer(customer: Customer): void {
    this.customer = customer;
    this.customerPane = true;
  }

  public closeCustomerPane(): void {
    this.customerPane = false;
  }

  public toggleSelection(customer) {
    const idx = this.deleteCustomers.indexOf(customer);
    if (idx > -1) {
      this.deleteCustomers.splice(idx, 1);
    } else {
      this.deleteCustomers.push(customer);
    }
    console.log(this.deleteCustomers);
  }

  public cancelDeleteCustomers() {
    this._modalService.close('deleteCustomersModal');
  }

  public confirmDeleteCustomers() {
    this._customerService.destroyMultiple(this.deleteCustomers, this._currentUser.username).subscribe( (res) => {
      if (res) {
        for (const customer of this.deleteCustomers) {
          const idx = this.customers.indexOf(customer);
          this.customers.splice(idx, 1);
        }

        this.cancelDeleteCustomers();
      }
    });
  }

  public openEditVehicleModal(car) {
    this.car = car;
    this.openModal('editVehicleModal');
  }

  public openDeleteVehicleModal(car) {
    this.car = car;
    this.openModal('deleteVehicleModal');
  }

  public openModal(id: string) {
    this._modalService.open(id);
  }
}
