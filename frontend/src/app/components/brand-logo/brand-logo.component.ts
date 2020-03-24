import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-brand-logo',
  templateUrl: './brand-logo.component.html',
  styleUrls: ['./brand-logo.component.scss']
})
export class BrandLogoComponent implements OnInit {

  data = [
    '../../../assets/partner/1.png',
    '../../../assets/partner/2.png',
    '../../../assets/partner/3.png',
    '../../../assets/partner/4.png',
    '../../../assets/partner/5.png',
  ];
  constructor() { }

  ngOnInit() {

  }

}
