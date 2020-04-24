import { ICategory } from './../../../api/models/category.model';
import { CategoryService } from './../../../api/services/category.service';
import { Component, OnInit } from '@angular/core';
import { LoadingBarService } from '@ngx-loading-bar/core';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.scss']
})
export class CategoryComponent implements OnInit {
  lstCate = new Array<ICategory>();
  filterCase = new Array<ICategory>();
  loading = false;
  curPage = 1;

  constructor(private cateService: CategoryService, private loadingBar: LoadingBarService) {
  }

  ngOnInit() {
    this.loadData();
  }
  loadData() {
    this.loading = true;
    // this.loadingBar.start();
    this.cateService.getAllNotPaging().subscribe(
      data => {
        data.forEach(item => this.lstCate.push(item));
        // this.loadingBar.complete();
        this.loading = false;
      },
      err => console.error('@@@ getAllNotPaging err ', err),
      () => this.filterCase = this.lstCate.slice(0, 6)
    );
  }

  changeCurPage(e) {
    const { pageNumber, limit, offset } = e;
    const begin = limit * (pageNumber - 1);
    this.curPage = pageNumber;
    const end = begin + limit;
    this.filterCase = this.lstCate.slice(begin, end);
  }
}
