import { IProduct } from './../models/product.model';
import { Observable } from 'rxjs';
import { environment } from './../../environments/environment';
import { HttpHeaders, HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  protected basePath = environment.baseUrl;
  public defaultHeaders = new HttpHeaders();

  constructor(private http: HttpClient) { }

  getAll(limit, offset): Observable<Array<IProduct>> {
    let headers = this.defaultHeaders;
    headers = headers.set('Content-Type', 'application/json');
    return this.http.get<Array<IProduct>>(`${this.basePath}/api/product/${limit}/${offset}`, {
      headers
    });
  }
  getProduct(productId): Observable<IProduct> {
    let headers = this.defaultHeaders;
    headers = headers.set('Content-Type', 'application/json');
    return this.http.get<IProduct>(`${this.basePath}/api/product/${productId}`, {
      headers
    });
  }
  getProductByCategory(categoryId, limit, offset) {
    let headers = this.defaultHeaders;
    headers = headers.set('Content-Type', 'application/json');
    return this.http.get<Array<IProduct>>(`${this.basePath}/api/product/${categoryId}/${limit}/${offset}`, {
      headers
    });
  }
}
