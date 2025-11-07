//SHOW GROUPS
export function RenderGroups() {
    return fetch('/groups')
        .then(res => {
            if (!res.ok) throw new Error('HTTP error ' + res.status);
            return res.json();
        })
        .then(data => {
            window.groups = data.groups;
            const container = document.querySelector('.groups .main-container');
            container.innerHTML = '';
            console.log('group1: ', groups);
            
            groups.forEach(group => {
                const conEdit = group.role == 0 || group.role === null;

                const dropdown = conEdit ? 
                ` 
                    <ul class="dropdown-menu">
                        <li>
                            <button class="update-item" data-group-id="${group.id}">edit group</button>
                        </li>
                        <li>
                            <button type="submit" class="create-item" data-group-id="${group.id}">create item</button>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button type="submit" class="delete-btn-group" data-id="${group.id}">Delete Group</button>
                        </li>
                    </ul>
                `
                :
                `
                    <ul class="dropdown-menu"></ul>
                `;

                // console.log('group1: ', group.role);
                container.insertAdjacentHTML('beforeend', `
                    <div class="card">
                        <div class="title-row">
                            <h5 class="group-title">${group.name}</h5>
                            <div class="dropdown">
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>

                               ${dropdown}

                            </div>
                        </div>
                        <div class="scroll items-container" id="group-${group.id}" data-group-id="${group.id}">
                            <!-- Тут JS підвантажить елементи -->
                        </div>
                    </div>
                `);
            });
        })
        .catch(err => console.error('Помилка при завантаженні груп:', err));
}