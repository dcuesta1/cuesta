import { Component, OnInit } from '@angular/core';
import { LocalService } from '../../_services/local.service';
import { User } from '../../_models/User';
import { InvoiceService } from '../../_services/invoice.service';
import { Invoice } from '../../_models/Invoice';

@Component({
  selector: '.salestransactionscomponent',
  templateUrl: './transactions.component.html',
  styleUrls: ['../../../assets/sass/transactions.component.scss']
})
export class TransactionsComponent implements OnInit {
  public currentUser: User;
  public invoices: Invoice[] = [];
  public totalTransactions = 0;
  public totalCollected = 0.00;
  public netSales = 0.00;
  public transactions: Array<any>;
  public dates: Array<any> = [];
  private _impersonating;

  constructor(public local: LocalService,
              private _invoiceService: InvoiceService) {
    this._impersonating = local.getImpersotedUser();
    this.currentUser = new User(local.getCurrentUser());

    if (this._impersonating) {
      this.currentUser = new User(this._impersonating);
    }
  }

  ngOnInit() {
    this._invoiceService.userInvoices(this.currentUser.username).subscribe(
      (invoices) => {
        for (const invoice of invoices) {
          this.totalTransactions += invoice.payments.length;
          this.invoices.push(new Invoice(invoice));
        }

        const date = this.invoices[0].created_at;
        for (const invoice of this.invoices) {
          this.netSales += invoice.net();
          this.totalCollected += invoice.totalCollected();

          for (const payment of invoice.payments) {
            const dateRow = {
              date: invoice.created_at,
              total: payment.net
            };
            this.dates.push(dateRow);

            const invoiceRow = {
              total: payment.net,
              type: payment.type,
              customer: invoice.number,
            };
          }
        }

        console.log(this.dates);
      }
    );
  }


}
