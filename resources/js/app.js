window.$ = window.jQuery = require('jquery');
import '@firstandthird/toc';
import { App } from './action/App';
import { Post } from './action/Post';
import { AdminIndex } from './action/AdminIndex';
import { AdminPostCreate } from './action/AdminPostCreate';

const app = new App();
const routes = {
  'post' : new Post(),
  'admin-index' : new AdminIndex(),
  'admin/post/create' : new AdminPostCreate(),
  'admin/post/edit' : new AdminPostCreate(),
};
const route = path =>{
  if (routes.hasOwnProperty(path)) {
    return routes[path];
  }
  return app;
};
const action = route($('#main').data('action'));
action.ready();
