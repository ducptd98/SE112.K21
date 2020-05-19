import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-property-card',
  templateUrl: './property-card.component.html',
  styleUrls: ['./property-card.component.scss']
})
export class PropertyCardComponent implements OnInit {

  @Input() srcImage: string;
  // nên truyền Object

  constructor() { }

  ngOnInit() {
    // this.srcImage = '../../../assets/properties/'.concat(this.srcImage);
  }

}
