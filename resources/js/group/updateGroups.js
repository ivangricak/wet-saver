//UPDATE GROUP
export function UpdateGroup () {
document.addEventListener('click', function(e) {

    if (e.target.matches('.update-item')) {
        // перевіряємо, чи форма вже відкрита
        const groupId = parseInt(e.target.dataset.groupId);
        const group = window.groups.find(g => g.id === groupId);
        console.log('state: ', group);
            // console.log("Знайдена група:", group);
            // console.log("Її ID:", group.id);
            // console.log("Її назва:", group.name);
            // console.log("Її назва:", group.category_id);
            // console.log("Її state:", group.state);
            // console.log(groupId);

        if (document.querySelector('.created-div')) return;
            document.body.insertAdjacentHTML('beforeend', `
                <form class="created-div p-3 border bg-light rounded" style="max-width:400px; margin:20px auto;">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Group name" value="${group.name}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">State:</label>
                        <select class="form-select" name="state">
                            <option value="1" ${group.state == 1 ? 'selected' : ''}>Public</option>
                            <option value="0" ${group.state == 0 ? 'selected' : ''}>Private</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categories</label>
                        <select class="form-select category-select" name="category_id"></select>
                    </div>

                    <button type="button" class="btn btn-success m-2 update-group-btn" data-group-id="${group.id}">Update</button>
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
                        `<option value="${cat.id}" ${cat.id == group.category_id ? 'selected' : ''}>${cat.name}</option>`
                    );
                });
            } else {
                select.insertAdjacentHTML(
                    "beforeend",
                    `<option disabled>Категорії не завантажено</option>`
                );
            }

        }
            // беремо форму та токен
            if (e.target.matches('.update-group-btn')) {
                const formDiv = document.querySelector('.created-div');
                const groupId = e.target.dataset.groupId;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
                const formData = new FormData(formDiv);
                formData.append('_method', 'PUT');
        
                fetch(`/groups/${groupId}`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                   
                    if (data.success) {
                        formDiv.remove();
                        const updateGroup = data.group;
                        const index = window.groups.findIndex(g => g.id === updateGroup.id);

                        window.groups[index] = updateGroup;

                        const card = document.querySelector(`#group-${groupId}`)?.closest('.card');
                        if (card) {
                            const title = card.querySelector('.group-title');
                            if (title) title.textContent = updateGroup.name;
                        }

                    // console.log('Оновлено в пам’яті:', window.groups[index]);
                    // console.log('groups new:', groups);
                    } else {
                        alert('Помилка при оновленні групи');
                    }
                })
                .catch(err => console.error('Error:', err));
            }
        

    // Закриття форми
    if (e.target.matches('.close-div')) {
        const div = e.target.closest('.created-div');
        if (div) div.remove();
    }
});
}