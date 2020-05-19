import { ProductDetailComponent } from './product-detail/product-detail.component';
import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ProductComponent } from './product.component';


const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: ':id',
        component: ProductComponent
      },
      {
        path: ':id/detail/:productId',
        component: ProductDetailComponent,
        data: { breadcrumb: 'Chi tiết' },
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProductRoutingModule { }
