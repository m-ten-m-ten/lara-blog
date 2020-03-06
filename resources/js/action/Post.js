import { App } from './App';
import { fixSidebar } from '../modules/fixSidebar';
import { highlight } from '../modules/highlight';
import { Toc } from '../modules/Toc';

export class Post extends App {
  ready() {
    super.ready();
    fixSidebar();
    highlight();
    new Toc('.article', '.toc__body');
  }
}