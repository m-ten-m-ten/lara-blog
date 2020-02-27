import { App } from './App';
import { confirmDelete } from '../modules/confirmDelete';
import { CheckAll } from '../modules/CheckAll';

export class AdminIndex extends App {
  ready() {
    super.ready();
    confirmDelete();
    new CheckAll($('.checkAll-wrapper'));
  }
}