import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { ProductService } from './../../../api/services/product.service';
import { SharedModule } from 'src/app/shared/shared.module';
import { OwlModule } from 'ngx-owl-carousel';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductRoutingModule } from './product-routing.module';
import { ProductComponent } from './product.component';
import HttpConfigInterceptor from 'src/app/utilities/httpconfig.interceptor';
import { ProductDetailComponent } from './product-detail/product-detail.component';


@NgModule({
  declarations: [ProductComponent, ProductDetailComponent],
  imports: [
    CommonModule,
    ProductRoutingModule,
    OwlModule,
    SharedModule
  ],
  providers: [
    ProductService,
    { provide: HTTP_INTERCEPTORS, useClass: HttpConfigInterceptor, multi: true }
  ]
})
export class ProductModule { }
