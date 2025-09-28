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
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.copy').forEach(el => {
        el.addEventListener('click', async (e) => {
            e.stopPropagation();
            e.preventDefault();

            const link = el.dataset.link?.trim() || el.textContent.trim();
            if (!link) return;

            try {
                await navigator.clipboard.writeText(link);

                const originalText = el.textContent;
                el.textContent = 'Done!';
                setTimeout(() => {
                    el.textContent = originalText; 
                }, 1500);

            } catch (err) {
                alert('Error!');
            }
        });
    });
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
