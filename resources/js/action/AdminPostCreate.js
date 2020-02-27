import { App } from './App';
import { Modal } from '../modules/Modal';
import { AjaxCategory } from '../modules/AjaxCategory';
import { AjaxTag } from '../modules/AjaxTag';

export class AdminPostCreate extends App {
  ready() {
    super.ready();
    $('.modal-wrapper').each(function() {
      new Modal($(this));
    });
    new AjaxCategory();
    new AjaxTag();
  }
}