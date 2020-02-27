import { Accordion } from '../modules/Accordion.js';

export class App {
  ready() {

  // スライドメニューの数だけインスタンス生成
  $('.accordion-wrapper').each(function() {
    new Accordion($(this));
  });

  }
}