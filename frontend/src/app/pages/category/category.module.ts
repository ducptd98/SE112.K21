import { CategoryService } from './../../../api/services/category.service';
import { SharedModule } from 'src/app/shared/shared.module';
import { RouterModule, Routes } from '@angular/router';
import { OwlModule } from 'ngx-owl-carousel';
import { CategoryComponent } from './category.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

const routes: Routes = [
  {
    path: '',
    children: [
      {
        path: '',
        component: CategoryComponent
      }
    ]
  }
];

@NgModule({
  declarations: [
    CategoryComponent
  ],
  imports: [
    CommonModule,
    OwlModule,
    RouterModule.forChild(routes),
    SharedModule
  ],
  providers: [
    CategoryService
  ]
})
export class CategoryModule { }
