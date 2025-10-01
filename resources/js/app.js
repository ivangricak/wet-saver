import './bootstrap';
import './groups';

// кеш для всіх груп
window.groupItemsCache = {};


import { initNormItems } from './normItems';
import { initDefItems } from './defItems';
import { ShowItems } from './items';

document.addEventListener("DOMContentLoaded", function () {
    initNormItems();
    initDefItems();
    ShowItems();
});