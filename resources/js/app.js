import './bootstrap';
import './groups';

// // кеш для всіх груп
window.groupItemsCache = {};
console.log('con',groupItemsCache);

window.defGroupItemsCache = {};
console.log('def con', defGroupItemsCache);

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

import { CheckOnFollow } from './online/profile/script';

import { FollowGroup } from './groups';

import { SaveLink } from './items';

document.addEventListener("DOMContentLoaded", function () {
    const path = window.location.pathname;
    loadDataOfCategory();

    if (path.startsWith('/profile')) {
        CheckOnFollow();
    }

    if (path === '/home') {
        initDefItems();
        ShowItems();
        RenderGroups().then(() => {
            initNormItems();
        });

        //Groups
        CreateGroup();
        UpdateGroup();
        DeleteGroup();

        //Normal Item
        CreateNormItem();
        DeleteItem();
        UpdateItem();
    } 
    if (path === '/online') {
        RenderOnlineGroups().then(() => {
            initOnlineItems();
            ShowOnlineItems();
            FollowGroup();
            
        });
        button.addEventListener('click', async () => {
            await RenderOnlineGroups();
            initOnlineItems();
            ShowOnlineItems();
        });
    }
});

SaveLink();


// {
//     "name": "пп",
//     "category_id": 1,
//     "state": 0,
//     "updated_at": "2025-11-21T16:01:51.000000Z",
//     "created_at": "2025-11-21T16:01:51.000000Z",
//     "id": 164,
//     "items": [
//         {
//             "id": 639,
//             "group_id": 164,
//             "default_group_id": null,
//             "name": "аіф",
//             "description": null,
//             "link": "мвфі",
//             "state": 1,
//             "created_at": "2025-11-21T16:01:51.000000Z",
//             "updated_at": "2025-11-21T16:01:51.000000Z",
//             "deleted_at": null
//         }
//     ],
//     "users": [
//         {
//             "id": 3,
//             "nick": "user",
//             "login": "ivan",
//             "login_verified_at": null,
//             "created_at": "2025-09-02T16:38:51.000000Z",
//             "updated_at": "2025-11-15T18:46:44.000000Z",
//             "pivot": {
//                 "group_id": 164,
//                 "user_id": 3
//             }
//         }
//     ]
// }








// {
//     "group": {
//         "name": "пп",
//         "category_id": 1,
//         "state": 0,
//         "updated_at": "2025-11-21T16:07:37.000000Z",
//         "created_at": "2025-11-21T16:07:37.000000Z",
//         "id": 166,
//         "items": [
//             {
//                 "id": 641,
//                 "group_id": 166,
//                 "default_group_id": null,
//                 "name": "аіф",
//                 "description": null,
//                 "link": "мвфі",
//                 "state": 1,
//                 "created_at": "2025-11-21T16:07:37.000000Z",
//                 "updated_at": "2025-11-21T16:07:37.000000Z",
//                 "deleted_at": null
//             }
//         ],
//         "users": [
//             {
//                 "id": 3,
//                 "nick": "user",
//                 "login": "ivan",
//                 "login_verified_at": null,
//                 "created_at": "2025-09-02T16:38:51.000000Z",
//                 "updated_at": "2025-11-15T18:46:44.000000Z",
//                 "pivot": {
//                     "group_id": 166,
//                     "user_id": 3
//                 }
//             }
//         ]
//     },
//     "me": {
//         "id": 3,
//         "nick": "user",
//         "login": "ivan",
//         "login_verified_at": null,
//         "created_at": "2025-09-02T16:38:51.000000Z",
//         "updated_at": "2025-11-15T18:46:44.000000Z"
//     }
// }