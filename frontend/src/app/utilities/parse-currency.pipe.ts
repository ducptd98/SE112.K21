import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'parseCurrency'
})
export class ParseCurrencyPipe implements PipeTransform {

  transform(value: any, ...args: any[]): any {
    const temp = value.split(' ');
    let curr = '';
    let thoathuan = false;
    switch (temp[2]) {
      case 't':
        curr = 'tỷ';
        break;
      case 'triu':
        curr = 'triệu';
        break;
      case 'thun':
        curr = 'thỏa thuận';
        thoathuan = true;
        break;
      default:
        curr = 'triệu/m';
        break;
    }
    return !thoathuan ? `${temp[0]} ${curr}` : curr;
  }

}
