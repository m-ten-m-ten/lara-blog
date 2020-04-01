import { App } from './App';
import { Tinymce } from '../modules/Tinymce';

export class AdminPageCreate extends App {
  ready() {

    super.ready();
    new Tinymce();

  }
}