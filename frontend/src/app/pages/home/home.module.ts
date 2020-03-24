import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home.component';
import { Routes, RouterModule } from '@angular/router';
import { PageTopComponent } from 'src/app/components/page-top/page-top.component';
import { FilterSectionComponent } from 'src/app/components/filter-section/filter-section.component';
import { PropertyCardComponent } from 'src/app/components/property-card/property-card.component';
import { FeaturedCardComponent } from 'src/app/components/featured-card/featured-card.component';
import { BrandLogoComponent } from 'src/app/components/brand-logo/brand-logo.component';
import { OwlModule } from 'ngx-owl-carousel';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  },
];

@NgModule({
  declarations: [
    HomeComponent,
    PageTopComponent,
    FilterSectionComponent,
    PropertyCardComponent,
    FeaturedCardComponent,
    BrandLogoComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    OwlModule
  ]
})
export class HomeModule { }
