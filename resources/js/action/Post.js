import { App } from './App';
import { fixSidebar } from '../modules/fixSidebar';
import { highlight } from '../modules/highlight';

export class Post extends App {
  ready() {
    super.ready();
    fixSidebar();
    highlight();
  }
}