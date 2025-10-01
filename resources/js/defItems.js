import './bootstrap';

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
            console.log(data);
            if (data.items.length === 0) {
                container.innerHTML = "<div>this group has not got items!</div>";
            } else {
                data.items.forEach(item => {
                    let tag = item.tags.length > 0 ? item.tags[0].name : "";
                    
                    container.insertAdjacentHTML("beforeend", `
                        <div class="item-copy">
                            <div class="item" 
                                data-bs-toggle="modal" 
                                data-bs-target="#itemModal"
                                data-item-id="${item.id}">
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


export function initDefItems() {
    document.querySelectorAll(".def-items-container").forEach(div => {
        let defgroupId = div.dataset.defgroupId;
        loadDefGroupItems(defgroupId);
    });
};