import './bootstrap';


//DELETE ITEMS
document.addEventListener('click', function(e) {
    if(e.target.matches('.delete-btn')) {
        const itemId = e.target.dataset.id;

        if(!confirm('Ви точно хочете видалити цей item?')) {
            return;
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

                const modalEl = document.getElementById(`itemModal${itemId}`);
                modalEl?.remove();

                document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());

                const listItemEl = document.querySelector(`.item-copy .item[data-bs-target="#itemModal${itemId}"]`);
                if(listItemEl){
                    const itemCopy = listItemEl.closest('.item-copy');
                    if(itemCopy){

                        const cardEl = itemCopy.closest('.card');
                        cardEl?.classList.remove('expanded');

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



//SHOW ITEM
export function ShowItems() {
    const modal = document.getElementById('itemModal');
    const modalTitle = document.getElementById('itemModalTitle');
    const modalBody = document.getElementById('itemModalBody');

    modal.addEventListener('show.bs.modal', event => {
        const trigger = event.relatedTarget;
        const itemId = parseInt(trigger.dataset.itemId);
        const groupId = parseInt(trigger.dataset.groupId);
        const itemsInGroup = window.groupItemsCache[groupId];

        modalTitle.textContent = "Завантаження...";
        modalBody.innerHTML = '<p>Завантаження даних...</p>';

        let item = itemsInGroup?.find(i => parseInt(i.id) === itemId);

        if(item) {
            console.log("used cash: ", item);
            renderModal(item);
        } else {
            fetch(`/items/${itemId}`)
                .then(res => res.json())
                .then(data => {
                    console.log("used fetch: ", data);
                    
                    if(!window.groupItemsCache[groupId]) window.groupItemsCache[groupId] = [];
                    window.groupItemsCache[groupId].push(data);
                    
                    renderModal(data);
                });
        }
        function renderModal(item) {
            console.log(item);
            modalTitle.textContent = item.name;
            modalBody.innerHTML = `
                <div class="input-group mb-3">
                    <input type="text" class="form-control item-field" data-field="tags" value="${item.tags.join(', ')}" readonly>
                </div>
                <select class="form-select mb-2 item-field" data-field="state" disabled>
                    <option value="1" ${item.state == 1 ? 'selected' : ''}>Public</option>
                    <option value="0" ${item.state == 0 ? 'selected' : ''}>Private</option>
                </select>
                <div class="input-group mb-3">
                    <input type="text" class="form-control item-field" data-field="link" value="${item.link}" readonly>
                    <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('${item.link}')">📋 Копіювати</button>
                </div>
                <div class="input-group mb-3">
                    <textarea class="form-control item-field" rows="3" data-field="description" readonly>${item.description}</textarea>
                </div>
                <button class="btn btn-primary edit-save-btn" data-id="${item.id}">Edit</button>
                <button class="btn btn-danger delete-btn" data-id="${item.id}">Delete</button>
            `;
        }
    });
};


// UPDATE ITEM
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.edit-save-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            let itemId = this.getAttribute('data-id');
            let modal = document.getElementById('itemModal' + itemId);
            let fields = modal.querySelectorAll('.item-field[data-field]:not([data-field="tags"])');

            if(this.textContent === "Edit") {
                fields.forEach(field => {
                    if(field.tagName === 'SELECT') {
                        field.removeAttribute('disabled');
                    } else {
                        field.removeAttribute('readonly');
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



//COPY LINK FUNCTION
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("copy")) {
        let btn = e.target;
        let link = btn.getAttribute("data-link");

        navigator.clipboard.writeText(link).then(() => {
            let originalText = btn.textContent;
            btn.textContent = "Done";

            setTimeout(() => {
                btn.textContent = originalText;
            }, 1000);
        });
    }
});