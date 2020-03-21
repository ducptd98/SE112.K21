import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-page-top',
  templateUrl: './page-top.component.html',
  styleUrls: ['./page-top.component.scss']
})
export class PageTopComponent implements OnInit {

  @Input() header: string;
  @Input() imgPageTop: string;
  @Input() descriptions: string;
  @Input() isHomePage: boolean;
  constructor() { }

  ngOnInit() {
  }

}
