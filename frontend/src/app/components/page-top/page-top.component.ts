import { Component, OnInit, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

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
  constructor(private route: ActivatedRoute, private router: Router) { }

  ngOnInit() {
    if (this.header == null) {
      this.header = this.route.snapshot.data.breadcrumb;
    }
  }

}
