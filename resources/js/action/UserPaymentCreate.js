import { App } from './App';
import { Payment } from '../modules/Payment';

export class UserPaymentCreate extends App {
  ready() {
    super.ready();
    new Payment();
  }
}