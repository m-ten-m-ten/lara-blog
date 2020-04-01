window.$ = window.jQuery = require('jquery');
import { App } from './action/App';
import { Post } from './action/Post';
import { Page } from './action/Page';
import { AdminIndex } from './action/AdminIndex';
import { AdminPostCreate } from './action/AdminPostCreate';
import { AdminPageCreate } from './action/AdminPageCreate';
import { UserPaymentCreate } from './action/UserPaymentCreate';

const app = new App();
const routes = {
  'post' : new Post(),
  'page' : new Page(),
  'adminIndex' : new AdminIndex(),
  'adminPostCreate' : new AdminPostCreate(),
  'adminPageCreate' : new AdminPageCreate(),
  'userPaymentCreate' : new UserPaymentCreate(),
};
const route = path =>{
  if (routes.hasOwnProperty(path)) {
    return routes[path];
  }
  return app;
};
const action = route($('#main').data('action'));
action.ready();
