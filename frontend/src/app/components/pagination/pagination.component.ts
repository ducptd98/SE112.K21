import { Component, OnInit, Output, Input, EventEmitter } from '@angular/core';

@Component({
  selector: 'app-pagination',
  templateUrl: './pagination.component.html',
  styleUrls: ['./pagination.component.scss']
})
export class PaginationComponent implements OnInit {

  page = 1;
  totalRecord: number;
  limit = 6;
  offset = 0;

  @Output() changePage: EventEmitter<any> = new EventEmitter<any>();
  @Input() data: Array<any>;
  @Input() curPage: number;
  constructor() {

  }

  ngOnInit() {
    this.totalRecord = this.data.length;
    this.page = Math.ceil(this.totalRecord / this.limit);

  }

  PageChanged(pageNumber) {
    const l = this.limit;
    const o = this.offset;
    this.changePage.emit({ pageNumber, limit: l, offset: o });
  }
}
