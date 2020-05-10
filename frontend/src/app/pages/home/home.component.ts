import { Subscription } from 'rxjs';
import { ProductService } from './../../../api/services/product.service';
import { Component, OnInit, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit, OnDestroy {

  bindDescriptionsToPagetop = 'Tìm kiếm nhà đất, thông tin bất động sản ở từng khu vực trọng điểm';
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

  products = [];
  subscription: Subscription[] = [];
  cateId = '7c913ae0c059165bc22efb1d0aad70a9';

  limit = 6;
  offset = 0;

  constructor(private prodService: ProductService) { }
  ngOnDestroy(): void {
    this.subscription.forEach(item => item.unsubscribe());
  }

  ngOnInit() {
    // this.getProductByCategory(this.cateId, this.limit, this.offset);
  }
  getProducts(limit, offset) {
    const prodSub = this.prodService.getAll(limit, offset).subscribe(
      data => {
        this.products = data;
      },
      err => console.log('@@@ getProducts', err));
    this.subscription.push(prodSub);
  }
  getById(prodId: string) {
    const prodSub = this.prodService.getProduct(prodId).subscribe(
      data => {
        console.log('@@@ prod by Id', data);


      },
      err => console.log('@@@ getById', err));
    this.subscription.push(prodSub);
  }

  getProductByCategory(cateId: string, limit: number, offset: number) {
    const prodSub = this.prodService.getProductByCategory(cateId, limit, offset).subscribe(
      data => {
        // console.log('@@@ prod by cateId', data);
      },
      err => console.log('@@@ getProductByCategory', err));
    this.subscription.push(prodSub);
  }
  changeCurPage(page: number) {
    this.offset = (page - 1) * this.limit;
    // page 1: off = (1-1)*5 = 0
    // page 2: off = (2-1)*5 = 5
    // page 3: off = (3-1)*5 = 10
    // page 1: off = (1-1)*5 = 0
    this.getProducts(this.limit, this.offset);
  }

}
