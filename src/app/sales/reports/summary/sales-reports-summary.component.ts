import { Component, OnInit } from '@angular/core';
import { User } from '../../../_models/User';
import { LocalService } from '../../../_services/local.service';
import { InvoiceService } from '../../../_services/invoice.service';
import { Invoice } from '../../../_models/Invoice';

@Component({
  selector: '.salessummarycomponent',
  templateUrl: './summary.component.html',
  styleUrls: ['../../../../assets/sass/summary.component.scss']
})
export class SalesReportsSummaryComponent implements OnInit {
  private currentUser: User;
  public grossSalesSales = 0.00;
  public invoices: Invoice[]= [];
  public grossSalesRefunds = 0.00;
  public grossSalesNet = 0.00;
  public discountSales = 0.00;
  public discountRefunds = 0.00;
  public discountNet = 0.00;
  public netSalesSales = 0.00;
  public netSalesRefunds = 0.00;
  public netSalesNet = 0.00;
  public taxSales = 0.00;
  public taxRefunds = 0.00;
  public taxNet = 0.00;
  public tipsSales = 0.00;
  public tipsRefunded = 0.00;
  public tipsNet = 0.00;
  public totalCollectedSales = 0.00;
  public totalCollectedRefunded = 0.00;
  public totalCollectedNet = 0.00;
  public merchantFeesSales = 0.00;
  public netTotalSales = 0.00;
  public netTotalRefunds = 0.00;
  public netTotalNet = 0.00;
  private _impersonating;

  constructor(
    public local: LocalService,
    private _invoiceService: InvoiceService
  ) {
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
          this.invoices.push(new Invoice(invoice));
        }

        this.invoicesParser();
      }
    );

  }

  public invoicesParser(): void {
    // Total Sales

    for (const invoice of this.invoices) {
      this.grossSalesNet += invoice.grossSale();
      this.grossSalesSales += invoice.grossSale();

      this.tipsNet += invoice.tips();
      this.tipsSales += invoice.tips();

      this.netTotalSales += invoice.totalPaid();
      this.netTotalNet += invoice.totalPaid();

      this.taxNet += invoice.fees();
      this.taxSales += invoice.fees();

      this.totalCollectedNet += invoice.totalCollected();

      this.merchantFeesSales += invoice.merchantFees();

      this.netSalesNet += invoice.net();
      this.netSalesSales += invoice.net();

    }

  }
}
