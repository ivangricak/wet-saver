import './bootstrap';

//GROUP ANIMATION
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

//COPY LINK FUNCTION
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("copy")) {
        let btn = e.target;
        let link = btn.getAttribute("data-link");

        navigator.clipboard.writeText(link).then(() => {
            let originalText = btn.textContent;
            btn.textContent = "Done";

            // через 2 секунди повертаємо назад "copy"
            setTimeout(() => {
                btn.textContent = originalText;
            }, 1000);
        });
    }
});


//SELECTION GROUP FOR ITEM
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_selector');
    const defInput = document.getElementById('def_group_id');
    const normalInput = document.getElementById('group_id');

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


// UPDATE ITEM
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-save-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            let itemId = this.getAttribute('data-id');
            let modal = document.getElementById('itemModal' + itemId);
            // Вибираємо лише link і description
            let fields = modal.querySelectorAll('.item-field[data-field]:not([data-field="tags"])');

            if(this.textContent === "Edit") {
                fields.forEach(field => {
                    if(field.tagName === 'SELECT') {
                        field.removeAttribute('disabled'); // select можна змінювати
                    } else {
                        field.removeAttribute('readonly'); // input/textarea
                    }
                });
                this.textContent = "Save";
            } else if(this.textContent === "Save") {
                let data = {};
                fields.forEach(field => {
                    let key = field.getAttribute('data-field');
                    data[key] = field.value;
                });

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/items/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(res => {
                    if(res.success){
                        fields.forEach(field => {
                                if(field.tagName === 'SELECT' && field.getAttribute('data-field') === 'state') {
                                    field.setAttribute('disabled', true);
                                } else {
                                    field.setAttribute('readonly', true);
                                }
                            });
                            button.textContent = "Edit";
                    } else {
                        alert('Error updating item');
                    }
                })
                .catch(err => console.error(err));
            }
        });
    });
});




document.addEventListener('click', function(e) {
    if(e.target.matches('.delete-btn')) {
        const itemId = e.target.dataset.id;

        if(!confirm('Ви точно хочете видалити цей item?')) {
            return; // якщо користувач натиснув "Cancel", нічого не робимо
        }
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/items/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                console.log(`Item ${itemId} deleted in DB`);

                // 1️⃣ Видаляємо модалку
                const modalEl = document.getElementById(`itemModal${itemId}`);
                modalEl?.remove();

                // 2️⃣ Видаляємо backdrop (якщо є)
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());

                // 3️⃣ Видаляємо елемент списку item-copy
                const listItemEl = document.querySelector(`.item-copy .item[data-bs-target="#itemModal${itemId}"]`);
                if(listItemEl){
                    const itemCopy = listItemEl.closest('.item-copy');
                    if(itemCopy){
                        // Прибираємо expanded з батьківської card
                        const cardEl = itemCopy.closest('.card');
                        cardEl?.classList.remove('expanded');

                        // Видаляємо item-copy
                        itemCopy.remove();
                    }
                }

            } else {
                alert('Помилка при видаленні: ' + data.message);
            }
        })
        .catch(err => console.error(err));
    }
});



// CREATE ITEM
document.addEventListener('click', function(e) {

    // Відкриття форми
    if (e.target.matches('.create-item')) {
        const groupId = e.target.dataset.groupId;

        // Перевіряємо, чи форма вже існує
        if (!document.querySelector('.created-div')) {
            document.body.insertAdjacentHTML('beforeend', `
                <form class="created-div">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">State:</label>
                        <select class="form-select" name="state">
                            <option value="1">Public</option>
                            <option value="0">Private</option>
                        </select>
                    </div>

                    <input type="hidden" name="default_group_id" value="">
                    <input type="hidden" name="group_id" value="${groupId}">

                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" class="form-control" name="link" placeholder="link">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>

                    <button type="button" class="create btn btn-success m-2">Create</button>
                    <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
                </form>
            `);

            const formDiv = document.querySelector('.created-div');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            formDiv.querySelector('.create').addEventListener('click', function() {
                const formData = new FormData(formDiv);

                fetch('/item/create', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    console.log('JSON parsed:', data);

                    const groupId = formData.get('group_id');

                    loadGroupItems(groupId);

                    formDiv.remove();
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Сталася помилка при створенні item-а');
                });
            });
        }
    }

    // Закриття форми
    if (e.target.matches('.close-div')) {
        const div = e.target.closest('.created-div');
        if (div) div.remove();
    }
});


function loadGroupItems(groupId) {
    let container = document.getElementById(`group-${groupId}`);

    fetch(`/groups/${groupId}/items`)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = "";

            if (data.items.length === 0) {
                container.innerHTML = "<div>this group has not got items!</div>";
            } else {
                data.items.forEach(item => {
                    let tag = item.tags.length > 0 ? item.tags[0].name : "";
                    container.insertAdjacentHTML("beforeend", `
                        <div class="item-copy">
                            <div class="item" data-bs-toggle="modal" data-bs-target="#itemModal${item.id}">
                                <span class="tag">${tag}</span>
                                <span>${item.name}</span>
                            </div>
                            <button class="copy" data-link="${item.link}" type="button">copy</button>
                        </div>
                    `);
                });
            }
        })
        .catch(err => console.error(err));
}


document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".items-container").forEach(div => {
        let groupId = div.dataset.groupId;
        loadGroupItems(groupId);
    });
});












//DEFAULT GROUPS 


// CREATE ITEM
document.addEventListener('click', function(e) {

    // Відкриття форми
    if (e.target.matches('.def-create-item')) {
        const defgroupId = e.target.dataset.defgroupId;

        // Перевіряємо, чи форма вже існує
        if (!document.querySelector('.created-div')) {
            document.body.insertAdjacentHTML('beforeend', `
                <form class="created-div">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">State:</label>
                        <select class="form-select" name="state">
                            <option value="1">Public</option>
                            <option value="0">Private</option>
                        </select>
                    </div>

                    <input type="hidden" name="default_group_id" value="${defgroupId}">
                    <input type="hidden" name="group_id" value="">

                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" class="form-control" name="link" placeholder="link">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>

                    <button type="button" class="create btn btn-success m-2">Create</button>
                    <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
                </form>
            `);

            const formDiv = document.querySelector('.created-div');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            formDiv.querySelector('.create').addEventListener('click', function() {
                const formData = new FormData(formDiv);

                fetch('/item/create', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    console.log('JSON parsed:', data);

                    const defgroupId = formData.get('default_group_id');

                    loadDefGroupItems(defgroupId);

                    formDiv.remove();
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Сталася помилка при створенні item-а');
                });
            });
        }
    }

    // Закриття форми
    if (e.target.matches('.close-div')) {
        const div = e.target.closest('.created-div');
        if (div) div.remove();
    }
});

function loadDefGroupItems(defgroupId) {
    let container = document.getElementById(`defgroup-${defgroupId}`);
    
    fetch(`/defgroups/${defgroupId}/items`)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = "";

            if (data.items.length === 0) {
                container.innerHTML = "<div>this group has not got items!</div>";
            } else {
                data.items.forEach(item => {
                    let tag = item.tags.length > 0 ? item.tags[0].name : "";
                    console.log(data);
                    container.insertAdjacentHTML("beforeend", `
                        <div class="item-copy">
                            <div class="item" data-bs-toggle="modal" data-bs-target="#itemModal${item.id}">
                                <span class="tag">${tag}</span>
                                <span>${item.name}</span>
                            </div>
                            <button class="copy" data-link="${item.link}" type="button">copy</button>
                        </div>
                    `);
                
                });
            }
        })
        .catch(err => console.error(err));
}


document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".def-items-container").forEach(div => {
        let defgroupId = div.dataset.defgroupId;
        loadDefGroupItems(defgroupId);
    });
});