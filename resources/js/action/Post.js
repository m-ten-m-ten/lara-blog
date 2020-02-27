import { App } from './App';
import { fixSidebar } from '../modules/fixSidebar';

export class Post extends App {
  ready() {
    super.ready();
    fixSidebar();
  }
}