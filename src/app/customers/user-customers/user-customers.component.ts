import { Component, OnInit } from '@angular/core';
import { User } from '../../_models/User';
import { LocalService } from "../../_services/local.service"
import { CustomerService } from '../../_services/customer.service';
import { Customer } from '../../_models/Customer';
import { ModalService } from '../../_services/modal.service';
import { Invoice } from '../../_models/Invoice';
import { toInteger } from '@ng-bootstrap/ng-bootstrap/util/util';
import { Car } from '../../_models/Car';

@Component({
  selector: '.userscustomerscomponent',
  templateUrl: './user-customers.component.html',
  styleUrls: ['./user-customers.component.scss']
})

export class UserCustomersComponent implements OnInit{
  private _currentUser: User;
  public customerPane: boolean = false;
  public deleteCustomers = [];
  public customer :Customer;
  public car;
  public searchInput;
  public customers: Array<Customer> = [];

  constructor(
    private _local :LocalService,
    private _modalService: ModalService,
    private _customerService :CustomerService
  ) { 
    this._currentUser = new User(_local.getCurrentUser());
  }

  ngOnInit() {
    //Grab Customers
    this._customerService.userCustomers(this._currentUser.username).subscribe((customers) => {
      for(let customer of customers) {
        for (let i = 0; i < customer.invoices.length; i++){
          customer.invoices[i] = new Invoice(customer.invoices[i]);
        }
        this.customers.push(new Customer(customer));
      }
    });

    //Search Filter
  }

  public addCustomer(customer :Customer) {
    this.customers.push(customer);
  }

  public updateCustomer(customer: Customer) :void{
    this.customer = customer;
  }

  public addVehicle(car) :void {
    this.customer.cars.push(car);
  }

  public updateVehicle(car) :void {
    for(let i in this.customer.cars) {
      if(car.id == this.customer.cars[i].id) {
        this.customer.cars[i] = new Car(car);
      }
    }
  }

  public removeVehicle(car) :void {
    for(let i in this.customer.cars) {
      if(car.id === this.customer.cars[i].id){
        this.customer.cars.splice(toInteger(i), 1); 
      }
    }
  }

  public viewCustomer(customer: Customer) :void {
    this.customer = customer;
    this.customerPane = true;
  }

  public closeCustomerPane() :void {
    this.customerPane = false;
  }

  public toggleSelection(customer){
    let idx = this.deleteCustomers.indexOf(customer);
    if(idx > -1) {
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
      if(res) {
        for(let customer of this.deleteCustomers) {
          let idx = this.customers.indexOf(customer);
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

  public openModal(id: string){
    this._modalService.open(id);
  }
}
