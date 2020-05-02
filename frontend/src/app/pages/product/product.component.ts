import { Subscription } from 'rxjs';
import { ProductService } from './../../../api/services/product.service';
import { Component, OnInit, OnDestroy } from '@angular/core';

@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.scss']
})
export class ProductComponent implements OnInit, OnDestroy {
  loading = false;
  subscription = new Subscription();
  limit = 6;
  offset = 0;
  products = [];
  curPage = 1;

  constructor(private prodService: ProductService) { }
  ngOnDestroy(): void {
    this.subscription.unsubscribe();
  }

  ngOnInit() {
  }

  getProducts(limit, offset) {
    const prodSub = this.prodService.getAll(limit, offset).subscribe(
      data => {
        this.products = data;
      },
      err => console.log('@@@ getProducts', err));
    this.subscription.add(prodSub);
  }
  getById(prodId: string) {
    const prodSub = this.prodService.getProduct(prodId).subscribe(
      data => {
        console.log('@@@ prod by Id', data);


      },
      err => console.log('@@@ getById', err));
    this.subscription.add(prodSub);
  }

  getProductByCategory(cateId: string, limit: number, offset: number) {
    const prodSub = this.prodService.getProductByCategory(cateId, limit, offset).subscribe(
      data => {
        // console.log('@@@ prod by cateId', data);
      },
      err => console.log('@@@ getProductByCategory', err));
    this.subscription.add(prodSub);
  }
  changeCurPage(page) {
    this.offset = (page - 1) * this.limit;
    // page 1: off = (1-1)*5 = 0
    // page 2: off = (2-1)*5 = 5
    // page 3: off = (3-1)*5 = 10
    // page 1: off = (1-1)*5 = 0
    this.getProducts(this.limit, this.offset);
  }

}
