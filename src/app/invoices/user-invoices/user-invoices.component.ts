import { Component, OnInit } from '@angular/core';
import { InvoiceService } from '../../_services/invoice.service';
import { Invoice } from '../../_models/Invoice';
import { User } from '../../_models/User';
import { LocalService } from '../../_services/local.service';

/**
 *  FIGURE OUT SHOP SETTINGS AND BUSINESS MODEL BEFORE CONTINUING
 */


@Component({
  selector: '.userinvoicescomponent',
  templateUrl: './user-invoices.component.html',
  styleUrls: ['../../../assets/sass/user-invoices.component.scss']
})
export class UserInvoicesComponent implements OnInit {
  public invoices: Invoice[] = [];
  public currentUser: User;
  public _impersonating;

  public paid = 0;
  public outstanding = 0;
  public estimates = 0;

  public invoicePane = false;
  public selectedInvoice: Invoice;

  constructor(
    private _invoiceService: InvoiceService,
    public local: LocalService
  ) {
    this._impersonating = local.getImpersotedUser();
    this.currentUser = new User(local.getCurrentUser());

    if (this._impersonating) {
      this.currentUser = new User(this._impersonating);
    }
  }

  ngOnInit() {
    const username = this.currentUser.username;
    this._invoiceService.userInvoices(username).subscribe(
      (invoices) => {
        for (const invoice of invoices) {
          this.invoices.push(new Invoice(invoice));
          switch (invoice.status) {
            case Invoice.CLOSED:
                this.paid += invoice.cost;
                break;
            case Invoice.PENDING_PAYMENT:
              this.outstanding += invoice.cost;
              break;
            case Invoice.ESTIMATE:
              this.estimates += invoice.cost;
              break;
          }
        }
      }
    );
  }

  public viewInvoice(invoice: Invoice) {
    this.selectedInvoice = invoice;
  }

  public closeInvoicePane() {
    this.selectedInvoice = null;
    this.invoicePane = false;
  }

}
