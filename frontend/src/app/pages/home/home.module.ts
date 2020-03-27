import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HomeComponent } from './home.component';
import { Routes, RouterModule } from '@angular/router';
import { FilterSectionComponent } from 'src/app/components/filter-section/filter-section.component';
import { PropertyCardComponent } from 'src/app/components/property-card/property-card.component';
import { OwlModule } from 'ngx-owl-carousel';
import { SharedModule } from 'src/app/shared/shared/shared.module';

const routes: Routes = [
  {
    path: '',
    component: HomeComponent
  },
];

@NgModule({
  declarations: [
    HomeComponent,
    FilterSectionComponent,
  ],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    OwlModule,
    SharedModule
  ]
})
export class HomeModule { }
