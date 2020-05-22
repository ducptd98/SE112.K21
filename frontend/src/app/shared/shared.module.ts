import { LoadingComponent } from './../components/loading/loading.component';
import { ParseCurrencyPipe } from './../utilities/parse-currency.pipe';
import { ReactiveFormsModule } from '@angular/forms';
import { LoopNumberPipe } from '../utilities/loop-number.pipe';
import { BreadcrumbComponent } from 'src/app/components/breadcrumb/breadcrumb.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PageTopComponent } from 'src/app/components/page-top/page-top.component';
import { FeaturedCardComponent } from 'src/app/components/featured-card/featured-card.component';
import { PaginationComponent } from 'src/app/components/pagination/pagination.component';
import { BrandLogoComponent } from 'src/app/components/brand-logo/brand-logo.component';
import { OwlModule } from 'ngx-owl-carousel';
import { PropertyCardComponent } from 'src/app/components/property-card/property-card.component';
import { LoadingBarModule, LoadingBarComponent } from '@ngx-loading-bar/core';
import { LoadingBarHttpClientModule } from '@ngx-loading-bar/http-client';
import { LoadingBarRouterModule } from '@ngx-loading-bar/router';
import { NgbPaginationModule, NgbAlertModule } from '@ng-bootstrap/ng-bootstrap';
import { ToastrModule } from 'ngx-toastr';


@NgModule({
  declarations: [
    PageTopComponent,
    FeaturedCardComponent,
    PaginationComponent,
    BrandLogoComponent,
    PropertyCardComponent,
    BreadcrumbComponent,
    LoopNumberPipe,
    ParseCurrencyPipe,
    LoadingComponent
  ],
  imports: [
    CommonModule,
    OwlModule,
    LoadingBarModule,
    LoadingBarRouterModule,
    LoadingBarHttpClientModule,
    NgbPaginationModule,
    NgbAlertModule,
    ToastrModule.forRoot({
      timeOut: 3000,
      positionClass: 'toast-top-right',
      preventDuplicates: true,
    }),

  ],
  exports: [
    PageTopComponent,
    FeaturedCardComponent,
    PaginationComponent,
    BrandLogoComponent,
    PropertyCardComponent,
    BreadcrumbComponent,
    LoadingBarComponent,
    LoopNumberPipe,
    ParseCurrencyPipe,
    LoadingComponent
  ]
})
export class SharedModule { }
