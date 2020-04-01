import { App } from './App';
import { fixSidebar } from '../modules/fixSidebar';
import { highlight } from '../modules/highlight';
import { Toc } from '../modules/Toc';

export class Page extends App {
  ready() {
    super.ready();
    highlight();
    new Toc('.page__body', '.toc__body');
    fixSidebar();
  }
}