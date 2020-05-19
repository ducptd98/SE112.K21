import { Subscription } from 'rxjs';
import { ActivatedRoute } from '@angular/router';
import { Component, OnInit, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.scss']
})
export class ProductDetailComponent implements OnInit, OnDestroy {
  data = [
    {
      img: '../../../../assets/single-list-slider/1.jpg',
      caption: 'FOR SALE'
    },
    {
      img: '../../../../assets/single-list-slider/2.jpg',
      caption: 'FOR SALE'
    },
    {
      img: '../../../../assets/single-list-slider/3.jpg',
      caption: 'FOR RENT'
    },
    {
      img: '../../../../assets/single-list-slider/4.jpg',
      caption: 'FOR SALE'
    },
    {
      img: '../../../../assets/single-list-slider/5.jpg',
      caption: 'FOR RENT'
    },
  ];
  options = {
    items: 4,
    dots: true,
    nav: false,
    autoplay: true,
    loop: true,
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 3,
      },
      1000: {
        items: 4,
      }
    }
  };
  subscription: Subscription[] = [];

  constructor(private route: ActivatedRoute) { }
  ngOnDestroy(): void {
    this.subscription.forEach(item => item.unsubscribe());
  }

  ngOnInit() {
    // const routeSub = this.route.params.subscribe(routerParam => {
    // });
    // this.subscription.push(routeSub);
  }

}
