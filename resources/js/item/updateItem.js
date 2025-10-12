export function UpdateItem() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('edit-save-btn')) {
            let button = e.target;
            let itemId = parseInt(button.getAttribute('data-id'));

            let modal = document.getElementById('itemModal');
            let fields = modal.querySelectorAll('.item-field[data-field]:not([data-field="tags"])');

            if (button.textContent === "Edit") {
                fields.forEach(field => {
                    if (field.tagName === 'SELECT') {
                        field.removeAttribute('disabled');
                    } else {
                        field.removeAttribute('readonly');
                    }
                });
                button.textContent = "Save";
            } else if (button.textContent === "Save") {
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
                    if (res.success) {

                        // робимо поля знову readonly
                        fields.forEach(field => {
                            if (field.tagName === 'SELECT' && field.getAttribute('data-field') === 'state') {
                                field.setAttribute('disabled', true);
                            } else {
                                field.setAttribute('readonly', true);
                            }
                        });
                        button.textContent = "Edit";

                        // Оновлення кешу (як і раніше)
                        const groupId = res.item.group_id || res.item.default_group_id;
                        if (window.groupItemsCache[groupId]) {
                            const cachedItem = window.groupItemsCache[groupId].find(i => i.id === itemId);
                            if (cachedItem) {
                                Object.assign(cachedItem, res.item);
                            }
                        }

                        // 🟢 ОНОВЛЕННЯ ЕЛЕМЕНТА В СПИСКУ
                        const itemDiv = document.querySelector(`.item[data-item-id="${itemId}"]`);
                        if (itemDiv) {
                            const tagSpan = itemDiv.querySelector('.tag');
                            const nameSpan = itemDiv.querySelector('span:not(.tag)');
                            const copyBtn = itemDiv.parentElement.querySelector('.copy');

                            if (tagSpan) tagSpan.textContent = res.item.tag || '';
                            if (nameSpan) nameSpan.textContent = res.item.name || '';
                            if (copyBtn) copyBtn.setAttribute('data-link', res.item.link || '');
                        }

                    } else {
                        alert('Error updating item');
                    }
                })
                .catch(err => console.error(err));
            }
        }
    });
}
