//SELECTION GROUP FOR ITEM
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_selector');
    const defInput = document.getElementById('def_group_id');
    const normalInput = document.getElementById('group_id');

    if (!select) {
        console.warn('Element #category_selector not found');
        return;
    }
    // Функція для встановлення hidden полів
    const setHiddenFields = () => {
        const selectedOption = select.selectedOptions[0];
        if (!selectedOption || !selectedOption.dataset.type) {
            defInput.value = '';
            normalInput.value = '';
            return;
        }
        if (selectedOption.dataset.type === 'def') {
            defInput.value = selectedOption.value;
            normalInput.value = '';
        } else {
            defInput.value = '';
            normalInput.value = selectedOption.value;
        }
    }

    // Виклик при завантаженні
    setHiddenFields();

    // Виклик при зміні select
    select.addEventListener('change', setHiddenFields);
});




//DEFGROUP ANIMATION
document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        card.addEventListener("click", (e) => {
            // Якщо клік був на елементі item, copy, dropdown або в меню — ігноруємо
            if (
                e.target.closest('.item') || 
                e.target.closest('.copy') || 
                e.target.closest('.dropdown') || 
                e.target.closest('.dropdown-menu')
            ) return;

            // Закриваємо всі інші карточки
            cards.forEach(c => c !== card && c.classList.remove("expanded"));

            // Тогл для поточної
            card.classList.toggle("expanded");
        });
    });
});


//GROUP ANIMATION
document.querySelector('.groups .main-container').addEventListener('click', (e) => {
    const card = e.target.closest('.card');
    if (!card) return;

    // Якщо клік був на item, copy, dropdown або в меню — ігноруємо
    if (
        e.target.closest('.item') || 
        e.target.closest('.copy') || 
        e.target.closest('.dropdown') || 
        e.target.closest('.dropdown-menu')
    ) return;

    // Закриваємо всі інші карточки
    document.querySelectorAll('.groups .main-container .card').forEach(c => {
        if (c !== card) c.classList.remove("expanded");
    });

    // Тогл для поточної
    card.classList.toggle("expanded");
});





































































// export function RenderGroups() {
//     return fetch('/groups')
//         .then(res => {
//             if (!res.ok) throw new Error('HTTP error ' + res.status);
//             return res.json();
//         })
//         .then(data => {
//             window.groups = data.groups;
//             const container = document.querySelector('.groups .main-container');
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
//                                 <ul class="dropdown-menu">
//                                     <li>
//                                         <button class="update-item" data-group-id="${group.id}">edit group</button>
//                                     </li>
//                                     <li>
//                                         <button type="submit" class="create-item" data-group-id="${group.id}">create item</button>
//                                     </li>
//                                     <li><hr class="dropdown-divider"></li>
//                                     <li>
//                                         <button type="submit" class="delete-btn-group" data-id="${group.id}">Delete Group</button>
//                                     </li>
//                                 </ul>
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


// //DELETE GROUP
// document.addEventListener('click', function(e) {
//     if(e.target.matches('.delete-btn-group')) {
//         const groupId = e.target.dataset.id;
//         console.log(groupId);
//         if(!confirm('Ви точно хочете видалити цей item?')) {
//             return;
//         }
        
//         const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         fetch(`/groups/${groupId}`, {
//             method: 'DELETE',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': csrfToken
//             }
//         })
//         .then(res => res.json())
//         .then(data => {
//             if(data.success){
//                 console.log(`Item ${groupId} deleted in DB`);

//                 // прибираємо сам item з DOM
//                 const listItemEl = document.querySelector(`.card .delete-btn-group[data-id="${groupId}"]`);
//                 if(listItemEl){
//                     const groupContainer = listItemEl.closest('.card');
//                     groupContainer?.remove();
//                 }

//             } else {
//                 alert('Помилка при видаленні: ' + data.message);
//             }
//         })
//         .catch(err => console.error(err));
//     }
// });


// //CREATE GROUP
// document.addEventListener('click', function(e) {

//     if (e.target.matches('.create-group')) {
//         // перевіряємо, чи форма вже відкрита
//         if (!document.querySelector('.created-div')) {
//             document.body.insertAdjacentHTML('beforeend', `
//                 <form class="created-div p-3 border bg-light rounded" style="max-width:400px; margin:20px auto;">
//                     <div class="mb-3">
//                         <label class="form-label">Name</label>
//                         <input type="text" class="form-control" name="name" placeholder="Group name">
//                     </div>
                    
//                     <div class="mb-3">
//                         <label class="form-label">State:</label>
//                         <select class="form-select" name="state">
//                             <option value="1">Public</option>
//                             <option value="0">Private</option>
//                         </select>
//                     </div>

//                     <div class="mb-3">
//                         <label class="form-label">Categories</label>
//                         <select class="form-select category-select" name="category_id"></select>
//                     </div>

//                     <button type="button" class="create btn btn-success m-2 create-group">Create</button>
//                     <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
//                 </form>
//             `);

//             // заповнюємо селект категоріями з бази
//             const select = document.querySelector('.category-select');
//             select.innerHTML = '';
//             if(window.listOfCategories && window.listOfCategories.length > 0) {
//                 window.listOfCategories.forEach(cat => {
//                     select.insertAdjacentHTML(
//                         "beforeend",
//                         `<option value="${cat.id}">${cat.name}</option>`
//                     );
//                 });
//             } else {
//                 select.insertAdjacentHTML(
//                     "beforeend",
//                     `<option disabled>Категорії не завантажено</option>`
//                 );
//             }


//             // беремо форму та токен
//             const formDiv = document.querySelector('.created-div');
//             const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//             // обробка створення групи
//             formDiv.querySelector('.create').addEventListener('click', function() {
//                 const formData = new FormData(formDiv);

//                 fetch('/group/create', {
//                     method: 'POST',
//                     headers: {
//                         'X-CSRF-TOKEN': csrfToken,
//                         'X-Requested-With': 'XMLHttpRequest'
//                     },
//                     body: formData
//                 })
//                 .then(res => res.json())
//                 .then(data => {
//                     console.log('JSON parsed:', data);

//                     if (data.success) {
//                         formDiv.remove();

//                         const newGroup = data.group;
//                         window.groups.push(newGroup);
//                         console.log('Додано у памʼять:', newGroup);

//                         const container = document.querySelector('.groups .main-container');
//                         container.insertAdjacentHTML('beforeend', `
//                             <div class="card">
//                                 <div class="title-row">
//                                     <h5 class="group-title">${newGroup.name}</h5>
//                                     <div class="dropdown">
//                                         <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
//                                             <i class="bi bi-three-dots-vertical"></i>
//                                         </button>
//                                         <ul class="dropdown-menu">
//                                             <li>
//                                                 <button onclick="window.location.href='/groups/${newGroup.id}/edit'">edit group</button>
//                                             </li>
//                                             <li>
//                                                 <button class="update-item" data-group-id="${newGroup.id}">edit group1</button>
//                                             </li>
//                                             <li>
//                                                 <button type="submit" class="create-item" data-group-id="${newGroup.id}">create item</button>
//                                             </li>
//                                             <li><hr class="dropdown-divider"></li>
//                                             <li>
//                                                 <button type="submit" class="delete-btn-group" data-id="${newGroup.id}">Delete Group</button>
//                                             </li>
//                                         </ul>
//                                     </div>
//                                 </div>
//                                 <div class="scroll items-container" id="group-${newGroup.id}" data-group-id="${newGroup.id}">
//                                     <!-- Тут JS підвантажить елементи -->
//                                 </div>
//                             </div>
//                         `);

//                         // TODO: Можна одразу додати нову групу на сторінку без перезавантаження
//                     } else {
//                         alert('Помилка при створенні групи');
//                     }
//                 })
//                 .catch(err => {
//                     console.error('Error:', err);
//                     alert('Сталася помилка при створенні групи');
//                 });
//             });
//         }
//     }

//     // Закриття форми
//     if (e.target.matches('.close-div')) {
//         const div = e.target.closest('.created-div');
//         if (div) div.remove();
//     }
// });



// //UPDATE GROUP
// document.addEventListener('click', function(e) {

//     if (e.target.matches('.update-item')) {
//         // перевіряємо, чи форма вже відкрита
//         const groupId = parseInt(e.target.dataset.groupId);
//         const group = window.groups.find(g => g.id === groupId);
//             // console.log("Знайдена група:", group);
//             // console.log("Її ID:", group.id);
//             // console.log("Її назва:", group.name);
//             // console.log("Її назва:", group.category_id);
//             // console.log("Її state:", group.state);
//             // console.log(groupId);

//         if (document.querySelector('.created-div')) return;
//             document.body.insertAdjacentHTML('beforeend', `
//                 <form class="created-div p-3 border bg-light rounded" style="max-width:400px; margin:20px auto;">
//                     <div class="mb-3">
//                         <label class="form-label">Name</label>
//                         <input type="text" class="form-control" name="name" placeholder="Group name" value="${group.name}">
//                     </div>
                    
//                     <div class="mb-3">
//                         <label class="form-label">State:</label>
//                         <select class="form-select" name="state">
//                             <option value="1" ${group.state == 1 ? 'selected' : ''}>Public</option>
//                             <option value="0" ${group.state == 0 ? 'selected' : ''}>Private</option>
//                         </select>
//                     </div>

//                     <div class="mb-3">
//                         <label class="form-label">Categories1</label>
//                         <select class="form-select category-select" name="category_id"></select>
//                     </div>

//                     <button type="button" class="btn btn-success m-2 update-group-btn" data-group-id="${group.id}">Update</button>
//                     <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
//                 </form>
//             `);

//             // заповнюємо селект категоріями з бази
//             const select = document.querySelector('.category-select');
//             select.innerHTML = '';
//             if(window.listOfCategories && window.listOfCategories.length > 0) {
//                 window.listOfCategories.forEach(cat => {
//                     select.insertAdjacentHTML(
//                         "beforeend",
//                         `<option value="${cat.id}" ${cat.id == group.category_id ? 'selected' : ''}>${cat.name}</option>`
//                     );
//                 });
//             } else {
//                 select.insertAdjacentHTML(
//                     "beforeend",
//                     `<option disabled>Категорії не завантажено</option>`
//                 );
//             }

//         }
//             // беремо форму та токен
//             if (e.target.matches('.update-group-btn')) {
//                 const formDiv = document.querySelector('.created-div');
//                 const groupId = e.target.dataset.groupId;
//                 const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
//                 const formData = new FormData(formDiv);
//                 formData.append('_method', 'PUT');
        
//                 fetch(`/groups/${groupId}`, {
//                     method: 'POST',
//                     headers: { 'X-CSRF-TOKEN': csrfToken },
//                     body: formData
//                 })
//                 .then(res => res.json())
//                 .then(data => {
                   
//                     if (data.success) {
//                         formDiv.remove();
//                         const updateGroup = data.group;
//                         const index = window.groups.findIndex(g => g.id === updateGroup.id);

//                         window.groups[index] = updateGroup;

//                         const card = document.querySelector(`#group-${groupId}`)?.closest('.card');
//                         if (card) {
//                             const title = card.querySelector('.group-title');
//                             if (title) title.textContent = updateGroup.name;
//                         }

//                     // console.log('Оновлено в пам’яті:', window.groups[index]);
//                     // console.log('groups new:', groups);
//                     } else {
//                         alert('❌ Помилка при оновленні групи');
//                     }
//                 })
//                 .catch(err => console.error('Error:', err));
//             }
        

//     // Закриття форми
//     if (e.target.matches('.close-div')) {
//         const div = e.target.closest('.created-div');
//         if (div) div.remove();
//     }
// });
