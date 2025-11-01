import { initOnlineItems } from '../item/item';
import { ShowOnlineItems } from '../item/showItems';
//SHOW GROUPS
let allGroups = [];
let offset = 0;
const limit = 10;
let loading = false;
let buttonInitialized = false;

export async function RenderOnlineGroups() {

    if (loading) return;
    loading = true;

    try {
        const res = await fetch(`/online/groups?offset=${offset}&limit=${limit}`);
        if(!res.ok) throw new Error('HTTP err: ', res.status);

        const data = await res.json();
        const groups = data.groups;
        
        const container = document.querySelector('.online-groups .main-container');

        if (!buttonInitialized && groups.length === limit) {
            setupLoadMoreButton(container);
            buttonInitialized = true;
        }

        renderNextGroups(container, groups);

        allGroups = [...allGroups, ...groups];

        offset += groups.length;

        if (groups.length < limit) {
        document.querySelector('.load-more-groups')?.remove();
        }
    }
    catch(err) {
        console.error('Помилка при завантаженні груп:', err);
    } finally {
        loading = false;
    }
}

function renderNextGroups(container, groups) {
    
    groups.forEach(group => {

      const owner = group.users && group.users.length > 0 ? group.users[0] : null;
      const profileUrl = owner ? `/online/profile/${owner.id}` : '#';

        container.insertAdjacentHTML('beforeend', `
        <div class="card">
          <div class="title-row">
            <h5 class="group-title">${group.name}</h5>
            <div class="dropdown">
              <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu">
               <li class="nav-item">
                    <a class="nav-link" href="${profileUrl}">Profile</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="scroll items-container" id="group-${group.id}" data-group-id="${group.id}">
          </div>
        </div>
      `);
    });
}

function setupLoadMoreButton(container) {
    let button = document.querySelector('.load-more-groups');
  
    if (!button) {
      button = document.createElement('button');
      button.className = 'load-more-groups btn btn-primary mt-3';
      button.textContent = 'Показати ще';
      container.insertAdjacentElement('afterend', button);
    }
  
    button.addEventListener('click', async () => {
        await RenderOnlineGroups();
        initOnlineItems();
        ShowOnlineItems();
    });
  }


















// //SHOW GROUPS
// let allGroups = [];
// let shownCount = 0;
// const limit = 10;
// let loading = false;

// export async function RenderOnlineGroups() {

//     if (loading) return;
//     loading = true;

//     try {
//     const res = await fetch(`/online/groups?offset=${shownCount}&limit=${limit}`);
//     if(!res.ok) throw new Error('HTTP err: ', res.status);

//     const data = await res.json();
//     allGroups = data.groups;
//     shownCount = 0;
    
//     const container = document.querySelector('.online-groups .main-container');
//     container.innerHTML = '';

//     renderNextGroups(container);
//     setupLoadMoreButton(container);
//     }
//     catch(err) {
//         console.error('Помилка при завантаженні груп:', err);
//     }
// }

// function renderNextGroups(container) {
//     const nextGroups = allGroups.slice(shownCount, shownCount + limit);

//     nextGroups.forEach(group => {
//         container.insertAdjacentHTML('beforeend', `
//         <div class="card">
//           <div class="title-row">
//             <h5 class="group-title">${group.name}</h5>
//             <div class="dropdown">
//               <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
//                 <i class="bi bi-three-dots-vertical"></i>
//               </button>
//               <ul class="dropdown-menu"></ul>
//             </div>
//           </div>
//           <div class="scroll items-container" id="group-${group.id}" data-group-id="${group.id}">
//           </div>
//         </div>
//       `);
//     });

//     shownCount += nextGroups.length;
// }

// function setupLoadMoreButton(container) {
//     let button = document.querySelector('.load-more-groups');
  
//     if (!button) {
//       button = document.createElement('button');
//       button.className = 'load-more-groups btn btn-primary mt-3';
//       button.textContent = 'Показати ще';
//       container.insertAdjacentElement('afterend', button);
//     }
  
//     button.addEventListener('click', () => {
//       renderNextGroups(container);
//       if (shownCount >= allGroups.length) {
//         button.remove();
//       }
//     });
//   }














// export function RenderOnlineGroups() {
//     return fetch('/online/groups')
//         .then(res => {
//             if (!res.ok) throw new Error('HTTP error ' + res.status);
//             return res.json();
//         })
//         .then(data => {
//             window.groups = data.groups;
//             const container = document.querySelector('.online-groups .main-container');
//             container.innerHTML = '';
//             console.log('group: ', groups);

//             groups.forEach(group => {
//                 container.insertAdjacentHTML('beforeend', `
//                     <div class="card">
//                         <div class="title-row">
//                             <h5 class="group-title">${group.name}</h5>
//                             <div class="dropdown">
//                                 <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
//                                     <i class="bi bi-three-dots-vertical"></i>
//                                 </button>
//                                 <ul class="dropdown-menu"></ul>
//                             </div>
//                         </div>
//                         <div class="scroll items-container" id="group-${group.id}" data-group-id="${group.id}">
//                             <!-- Тут JS підвантажить елементи -->
//                         </div>
//                     </div>
//                 `);
//             });
            
//         })
//         .catch(err => console.error('Помилка при завантаженні груп:', err));
// }