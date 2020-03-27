import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PageTopComponent } from 'src/app/components/page-top/page-top.component';
import { FeaturedCardComponent } from 'src/app/components/featured-card/featured-card.component';
import { PaginationComponent } from 'src/app/components/pagination/pagination.component';



@NgModule({
  declarations: [
    PageTopComponent,
    FeaturedCardComponent,
    PaginationComponent
  ],
  imports: [
    CommonModule
  ],
  exports: [
    PageTopComponent,
    FeaturedCardComponent,
    PaginationComponent
  ]
})
export class SharedModule { }
