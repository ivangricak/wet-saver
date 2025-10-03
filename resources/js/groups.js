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


//DELETE GROUP
document.addEventListener('click', function(e) {
    if(e.target.matches('.delete-btn-group')) {
        const groupId = e.target.dataset.id;
        console.log(groupId);
        if(!confirm('Ви точно хочете видалити цей item?')) {
            return;
        }
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/groups/${groupId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                console.log(`Item ${groupId} deleted in DB`);

                // прибираємо сам item з DOM
                const listItemEl = document.querySelector(`.card .delete-btn-group[data-id="${groupId}"]`);
                if(listItemEl){
                    const groupContainer = listItemEl.closest('.card');
                    groupContainer?.remove();
                }

            } else {
                alert('Помилка при видаленні: ' + data.message);
            }
        })
        .catch(err => console.error(err));
    }
});








//CREATE GROUP
document.addEventListener('click', function(e) {

    if (e.target.matches('.create-group')) {
        // перевіряємо, чи форма вже відкрита
        if (!document.querySelector('.created-div')) {
            document.body.insertAdjacentHTML('beforeend', `
                <form class="created-div p-3 border bg-light rounded" style="max-width:400px; margin:20px auto;">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Group name">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">State:</label>
                        <select class="form-select" name="state">
                            <option value="1">Public</option>
                            <option value="0">Private</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select class="form-select category-select" name="category_id"></select>
                    </div>

                    <button type="button" class="create btn btn-success m-2">Create</button>
                    <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
                </form>
            `);

            // заповнюємо селект категоріями з бази
            const select = document.querySelector('.category-select');
            window.categories.forEach(cat => {
                select.insertAdjacentHTML("beforeend", `<option value="${cat.id}">${cat.name}</option>`);
            });

            // беремо форму та токен
            const formDiv = document.querySelector('.created-div');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // обробка створення групи
            formDiv.querySelector('.create').addEventListener('click', function() {
                const formData = new FormData(formDiv);

                fetch('/group/create', {
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

                    if (data.success) {
                        alert('Групу успішно створено!');
                        formDiv.remove();
                        // TODO: Можна одразу додати нову групу на сторінку без перезавантаження
                    } else {
                        alert('Помилка при створенні групи');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Сталася помилка при створенні групи');
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
