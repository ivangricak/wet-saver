import './bootstrap';
import './groups';

// кеш для всіх груп
window.groupItemsCache = {};
console.log('con',groupItemsCache);


import { initNormItems } from './normItems';
import { initDefItems } from './defItems';
import { loadDataOfCategory } from './category';
import { RenderGroups } from './group/showGroups';
import { ShowItems } from './items';
import { CreateGroup } from './group/createGroups';
import { UpdateGroup } from './group/updateGroups';
import { DeleteGroup } from './group/deleteGroups';

//Groups
CreateGroup();
UpdateGroup();
DeleteGroup()

document.addEventListener("DOMContentLoaded", function () {
    initDefItems();
    loadDataOfCategory();
    ShowItems();
    RenderGroups().then(() => {
        // тепер групи і items вже у DOM і в кеші
        initNormItems();
    });
});