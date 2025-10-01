import './bootstrap';
import './groups';

import { initNormItems } from './normItems';
import { initDefItems } from './defitems';
import { ShowItems } from './items';

document.addEventListener("DOMContentLoaded", function () {
    initNormItems();
    initDefItems();
    ShowItems();
});