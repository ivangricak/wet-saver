import './bootstrap';
import './groups';

// // кеш для всіх груп
window.groupItemsCache = {};
console.log('con',groupItemsCache);

import { initOnlineItems } from './online/item/item';

import { initNormItems } from './normItems';
import { initDefItems } from './defItems';
import { loadDataOfCategory } from './category';
import { RenderGroups } from './group/showGroups';
import { ShowItems } from './item/showItem';

import { RenderOnlineGroups } from './online/group/showGroups';
import { ShowOnlineItems } from './online/item/showItems';

import { CreateGroup } from './group/createGroups';
import { UpdateGroup } from './group/updateGroups';
import { DeleteGroup } from './group/deleteGroups';

import { CreateNormItem } from './item/normal/createItem';
import { DeleteItem } from './item/deleteItem';
import { UpdateItem } from './item/updateItem';

import { SaveLink } from './items';


//Groups
CreateGroup();
UpdateGroup();
DeleteGroup();

//Normal Item
CreateNormItem();
DeleteItem();
UpdateItem();

SaveLink();

document.addEventListener("DOMContentLoaded", function () {
    const path = window.location.pathname;
    loadDataOfCategory();

    if (path === '/home') {
        initDefItems();
        ShowItems();
        RenderGroups().then(() => {
            // тепер групи і items вже у DOM і в кеші
            initNormItems();
            
        });
    } if (path === '/online') {
        RenderOnlineGroups().then(() => {
            ShowOnlineItems();
            initOnlineItems();
        });
        
    }
});