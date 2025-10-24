//CREATE GROUP
export function CreateGroup () {
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

                    <button type="button" class="create btn btn-success m-2 create-group">Create</button>
                    <button type="button" class="close-div btn btn-danger m-2">Закрити</button>
                </form>
            `);

            // заповнюємо селект категоріями з бази
            const select = document.querySelector('.category-select');
            select.innerHTML = '';
            if(window.listOfCategories && window.listOfCategories.length > 0) {
                window.listOfCategories.forEach(cat => {
                    select.insertAdjacentHTML(
                        "beforeend",
                        `<option value="${cat.id}">${cat.name}</option>`
                    );
                });
            } else {
                select.insertAdjacentHTML(
                    "beforeend",
                    `<option disabled>Категорії не завантажено</option>`
                );
            }


            // беремо форму та токен
            const formDiv = document.querySelector('.created-div');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // обробка створення групи
            formDiv.querySelector('.create').addEventListener('click', function() {
                const btn = this;
                btn.disabled = true;

                const formData = new FormData(formDiv);
                console.log(Object.fromEntries(formData));

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
                        formDiv.remove();

                        const newGroup = data.group;
                        window.groups.push(newGroup);
                        const groupKey = newGroup.id;

                        if (!window.groupItemsCache[groupKey]) {
                          window.groupItemsCache[groupKey] = [];
                        }
                        
                        console.log('con:', window.groupItemsCache);

                        const container = document.querySelector('.groups .main-container');
                        container.insertAdjacentHTML('beforeend', `
                            <div class="card">
                                <div class="title-row">
                                    <h5 class="group-title">${newGroup.name}</h5>
                                    <div class="dropdown">
                                        <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="update-item" data-group-id="${newGroup.id}">edit group</button>
                                            </li>
                                            <li>
                                                <button type="submit" class="create-item" data-group-id="${newGroup.id}">create item</button>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button type="submit" class="delete-btn-group" data-id="${newGroup.id}">Delete Group</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="scroll items-container" id="group-${newGroup.id}" data-group-id="${newGroup.id}">
                                    <!-- Тут JS підвантажить елементи -->
                                </div>
                            </div>
                        `);

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
}