import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CustomFormsModule } from 'ng2-validation';
/*
  Components
*/
// Global
import { AppComponent } from './app.component';
import { AuthLoginComponent } from './auth/login/auth.login.component';
import { AuthRegisterComponent } from './auth/register/auth.register.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { NavbarComponent } from './_layout/navbar/navbar.component';
import { SidebarComponent } from './_layout/sidebar/sidebar.component';
import { LoadingSpinnerComponent } from './_layout/loading-spinner/loading-spinner.component';
import { ModalDirective } from './_directives/modal.directive';

import { SettingsModule } from './settings/settings.module';
// Super
import { AdminUsersComponent } from './admin/users/admin.users.component';
import { AdminDashboardComponent } from './admin/dashboard/admin.dashboard.component';
import { AdminInvoicesComponent } from './admin/invoices/admin.invoices.component';
import { AdminSettingsComponent } from './admin/settings/admin.settings.component';
import { CustomersComponent } from './customers/admin.customers.component';
// Admin
import { SalesReportsSummaryComponent } from './sales/reports/summary/sales-reports-summary.component';
import { EditVehicleComponent } from './customers/user-customers/edit-vehicles/edit-vehicles.component';
import { UserCustomersComponent } from './customers/user-customers/user-customers.component';
import { NewCustomerComponent } from './customers/new-customer/new-customer.component';
import { EditUserComponent } from './customers/user-customers/edit-customer/edit-customer.component';
import { NewVehicleComponent } from './customers/user-customers/new-vehicle/new-vehicle.component';
import { DeleteVehicleComponent } from './customers/user-customers/delete-vehicle/delete-vehicle.component';
import { TransactionsComponent } from './sales/transactions/transactions.component';
import { UserInvoicesComponent } from './invoices/user-invoices/user-invoices.component';
/*
  Services
*/
import { LocalService } from './_services/local.service';
import { GLobalEventsManager } from './_etc/GlobalEventsManager';
import { UserService } from './_services/user.service';
import { AuthService } from './_services/auth.service';
import { InvoiceService } from './_services/invoice.service';
import { SettingsService } from './_services/settings.service';
import { CarService } from './_services/car.service';
import { ModalService } from './_services/modal.service';
import { AutoTelematicService } from './_services/auto-telematic.service';
import { CustomerService } from './_services/customer.service';
/*
  Guards & Stuff
*/
import { AuthGuard } from './_guards/auth.guard';
import { SuperUserGuard } from './_guards/superUser.guard';
import { AuthInterceptorProvider } from './_etc/AuthInterceptor';

/*
  Routes
*/
const routes: Routes = [
  {
    path: '',
    component: AuthLoginComponent
  },
  {
    path: 'login',
    component: AuthLoginComponent
  },
  {
    path: 'register',
    component: AuthRegisterComponent
  }
  ,
  {
    path: 'dashboard',
    component: DashboardComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'sales/reports/summary',
    component: SalesReportsSummaryComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'sales/transactions',
    component: TransactionsComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'customers',
    component: UserCustomersComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'invoices',
    component: UserInvoicesComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'customers',
    component: CustomersComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'settings',
    loadChildren: 'app/settings/settings.module#SettingsModule',
    canActivate: [AuthGuard]
  },
  {
    path: 'mod/dashboard',
    component: AdminDashboardComponent,
    canActivate: [AuthGuard]
  },
  {
    path: 'mod/invoices',
    component: AdminInvoicesComponent,
    canActivate: [SuperUserGuard]
  },
  {
    path: 'mod/users',
    component: AdminUsersComponent,
    canActivate: [SuperUserGuard]
  },
  {
    path: 'mod/settings',
    component: AdminSettingsComponent,
    canActivate: [AuthGuard]
  }
];

@NgModule({
  declarations: [
    AppComponent,
    AuthLoginComponent,
    AuthRegisterComponent,
    DashboardComponent,
    NavbarComponent,
    SidebarComponent,
    AdminInvoicesComponent,
    AdminSettingsComponent,
    AdminDashboardComponent,
    CustomersComponent,
    AdminUsersComponent,
    UserCustomersComponent,
    UserInvoicesComponent,
    SalesReportsSummaryComponent,
    TransactionsComponent,
    LoadingSpinnerComponent,
    EditUserComponent,
    ModalDirective,
    EditVehicleComponent,
    NewVehicleComponent,
    DeleteVehicleComponent,
    NewCustomerComponent,
  ],
  imports: [
    BrowserModule,
    ReactiveFormsModule,
    FormsModule,
    CustomFormsModule,
    HttpClientModule,
    NgbModule.forRoot(),
    SettingsModule,
    RouterModule.forRoot(routes)
  ],
  providers: [
    AuthInterceptorProvider,
    LocalService,
    UserService,
    AuthService,
    InvoiceService,
    CustomerService,
    CarService,
    AutoTelematicService,
    SettingsService,
    GLobalEventsManager,
    ModalService,
    AuthGuard,
    SuperUserGuard
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}

