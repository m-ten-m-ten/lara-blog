import { Accordion } from '../modules/Accordion.js';
import { backTop } from '../modules/backTop.js';

export class App {
  ready() {

  backTop();

  // アコーディオンメニューの数だけインスタンス生成
  $('.accordion-wrapper').each(function() {
    new Accordion($(this));
  });

  }
}