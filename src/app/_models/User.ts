import { BaseModel } from './BaseModel';
import { Invoice } from './Invoice';
import { Customer } from './Customer';

export class User extends BaseModel {
  static readonly SUPERUSER: number = 1;
  static readonly ADMIN: number = 2;

  id: number;
  name: string;
  username: string;
  email: string;
  role: number;
  createdAt: string;
  invoices: Invoice[];
  customers: Customer[];
  password: string = null;

  constructor(model: any = null) {
    super(model);

    if (this.invoices) {
      let i = 0;
      for (const invoice of this.invoices) {
        this.invoices[i] = new Invoice(invoice);
        i++;
      }
    }

    if ( this.customers) {
      let j = 0;
      for (const customer of this.customers) {
        this.customers[j] = new Customer(customer);
        j++;
      }
    }
  }

  isSuperUser() {
    return (this.role === User.SUPERUSER);
  }

  isAdmin() {
    return (this.role === User.ADMIN);
  }
}
