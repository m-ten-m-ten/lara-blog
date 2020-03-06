import { Accordion } from '../modules/Accordion.js';
import { backToTop } from '../modules/backToTop.js';

export class App {
  ready() {

  backToTop();

  // アコーディオンメニューの数だけインスタンス生成
  $('.accordion-wrapper').each(function() {
    new Accordion($(this));
  });

  }
}