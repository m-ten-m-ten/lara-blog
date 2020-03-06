window.$ = window.jQuery = require('jquery');
import { App } from './action/App';
import { Post } from './action/Post';
import { AdminIndex } from './action/AdminIndex';
import { AdminPostCreate } from './action/AdminPostCreate';
import { UserPaymentCreate } from './action/UserPaymentCreate';

const app = new App();
const routes = {
  'post' : new Post(),
  'adminIndex' : new AdminIndex(),
  'adminPostCreate' : new AdminPostCreate(),
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
