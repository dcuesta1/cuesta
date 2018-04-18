import { Component, EventEmitter, OnInit, Output } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { st, states } from '../../_etc/formHelpers';
import { Customer } from '../../_models/Customer';
import { CustomerService } from '../../_services/customer.service';
import { ModalService } from '../../_services/modal.service';
import { LocalService } from '../../_services/local.service';
import { User } from '../../_models/User';

@Component({
  selector: 'new-customer',
  templateUrl: './new-customer.component.html'
})
export class NewCustomerComponent implements OnInit {
  @Output() onCustomerCreated: EventEmitter<Customer> = new EventEmitter<Customer>();
  public customer: Customer = new Customer();
  public addCustomerForm: FormGroup;
  public states;
  public st;
  public _currentUser: User;

  constructor(
    private _customerService: CustomerService,
    private _modalService: ModalService,
    private _fb: FormBuilder,
    private _local: LocalService
  ) {
    this.states = states;
    this.st = st;
    this._currentUser = new User(_local.getCurrentUser());
  }

  ngOnInit() {
    this.addCustomerForm = this._fb.group({
      'first_name': [null, [Validators.required, Validators.minLength(3)]],
      'last_name': [null, [Validators.required, Validators.minLength(3)]],
      'phone': [null, [Validators.required]],
      'email': [null, [Validators.email, Validators.required]],
      'address_one': [null],
      'address_two': [null],
      'city': [null],
      'state': [null]
    });
  }

  public reset(): void {
    this.customer = new Customer();
    this.addCustomerForm.reset();
  }

  public cancel(): void {
    this.reset();
    this._modalService.close('addCustomerModal');
  }

  public submit(): void {
    if (this.addCustomerForm.valid) {
      const newCustomer = new Customer(this.addCustomerForm.value);
      newCustomer.user_id = this._currentUser.id;
      this._customerService.create(newCustomer).subscribe( (customer) => {
        customer = new Customer(customer);
        this.onCustomerCreated.emit(customer);
        this.cancel();
      });
    }
  }

}
