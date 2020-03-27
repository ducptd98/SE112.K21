import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, PRIMARY_OUTLET, NavigationEnd } from '@angular/router';
import {filter} from 'rxjs/operators';
import {map} from 'rxjs/internal/operators';

@Component({
  selector: 'app-breadcrumb',
  templateUrl: './breadcrumb.component.html',
  styleUrls: ['./breadcrumb.component.scss']
})
export class BreadcrumbComponent implements OnInit {
  breadcrumbs;

  constructor(
    private activatedRoute: ActivatedRoute,
    private router: Router) {
  }

  ngOnInit() {

    this.router.events
      .pipe(filter(event => event instanceof NavigationEnd))
      .pipe(map(() => this.activatedRoute))
      .pipe(filter(route => route.outlet === PRIMARY_OUTLET))
      .pipe(map((route) => {
        const routeArray = [];
        while (route.firstChild) {
          routeArray.push(route.firstChild.snapshot);
          route = route.firstChild;
        }
        return routeArray;
      }))
      .subscribe(routeArray => {
        const snapshot = this.router.routerState.snapshot;
        let stackUrl = '';
        this.breadcrumbs = [];
        for (const route of routeArray) {
          if (route.url.length === 0) {
            continue;
          }
          const routeData = route.data;
          const label = routeData.breadcrumb;
          const params = route.root.params;
          const url = route.url.length > 1 ? route.url.reduce((res, item) => {
            res += '/' + item.path;
            return res;
          }) : route.url[0].path;
          stackUrl += url + '/';
          this.breadcrumbs.push({
            url: stackUrl,
            label,
            params
          });
        }
      });

  }

}
