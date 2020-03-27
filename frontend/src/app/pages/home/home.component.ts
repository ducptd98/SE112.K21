import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  bindDescriptionsToPagetop: string;
  constructor() { }

  ngOnInit() {
    this.bindDescriptionsToPagetop = 'Search real estate property records, houses, condos, land and more on leramiz.com®.' +
      'Find property info from the most comprehensive source data.';
  }

}
