import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {

  bindDescriptionsToPagetop: string;
  mySlideOptions = { items: 1, dots: true, nav: false, autoplay: true, loop: true };
  data = [
    {
      descriptions: '“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism' +
        'and warmth made the process of finding a suitable home a lot less stressful than it could have been.' +
        'Thanks, agent Tony Holland.”',
      name: 'Stacy Mc',
      title: 'CEP’s Director',
      img: 'review/1.jpg'
    },
    {
      descriptions: '“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism' +
        'and warmth made the process of finding a suitable home a lot less stressful than it could have been.' +
        'Thanks, agent Tony Holland.”',
      name: 'Stacy Mc Neeley',
      title: 'CEP’s Director',
      img: 'review/1.jpg'
    },
    {
      descriptions: '“Leramiz was quick to understand my needs and steer me in the right direction. Their professionalism' +
        'and warmth made the process of finding a suitable home a lot less stressful than it could have been.' +
        'Thanks, agent Tony Holland.”',
      name: 'Mc Neeley',
      title: 'CEP’s Director',
      img: 'review/1.jpg'
    },
  ];
  constructor() { }

  ngOnInit() {
    this.bindDescriptionsToPagetop = 'Search real estate property records, houses, condos, land and more on leramiz.com®.' +
      'Find property info from the most comprehensive source data.';
  }

}
