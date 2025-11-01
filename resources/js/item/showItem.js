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
            <div class="item-data">
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
                <button class="btn btn-danger delete-btn" data-id-group="${item.group_id}" data-id="${item.id}">Delete</button>
            </div>
            `;
        }
    });
};