import { Subscription } from 'rxjs';
import { ProductService } from './../../../api/services/product.service';
import { Component, OnInit, OnDestroy, OnChanges } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.scss']
})
export class ProductComponent implements OnInit, OnDestroy {
  loading = false;
  subscription: Subscription[] = [];
  limit = 6;
  offset = 0;
  products = [];
  curPage = 1;
  cateId = '';

  constructor(private prodService: ProductService, private route: ActivatedRoute) {


  }
  ngOnDestroy(): void {
    this.subscription.forEach(item => item.unsubscribe());
  }

  ngOnInit() {
    const routeSub = this.route.params.subscribe(routerParam => {
      this.cateId = routerParam.cateId;
      this.getProductByCategory(routerParam.cateId, 25, 0);
    });
    this.subscription.push(routeSub);
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
        this.products = data.map(item => {
          const images = JSON.parse(item.images);
          const desc = JSON.parse(item.desc);
          return Object.assign(item, { images, desc });
        });
        console.log('ProductComponent -> getProductByCategory -> this.products', this.products);
      },
      err => console.log('@@@ getProductByCategory', err));
    this.subscription.push(prodSub);
  }
  changeCurPage(e) {
    // page 1: off = (1-1)*5 = 0
    // page 2: off = (2-1)*5 = 5
    // page 3: off = (3-1)*5 = 10
    // page 1: off = (1-1)*5 = 0
    const { pageNumber, limit, offset } = e;
    // const pageNumber = e;
    this.offset = (pageNumber - 1) * this.limit;
    console.log('ProductComponent -> changeCurPage -> this.offset', this.offset);
    this.curPage = pageNumber;
    this.getProductByCategory(this.cateId, this.limit, this.offset);
  }

}
