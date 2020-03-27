import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FeaturedComponent } from './featured.component';
import { Routes, RouterModule } from '@angular/router';
import { SharedModule } from 'src/app/shared/shared/shared.module';
import { BreadcrumbComponent } from 'src/app/components/breadcrumb/breadcrumb.component';

const routes: Routes = [
  {
    path: '',
    component: FeaturedComponent
  },
];


@NgModule({
  declarations: [
    FeaturedComponent,
    BreadcrumbComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    SharedModule
  ]
})
export class FeaturedModule { }
