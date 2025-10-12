//SHOW GROUPS
export function RenderOnlineGroups() {
    return fetch('/online/groups')
        .then(res => {
            if (!res.ok) throw new Error('HTTP error ' + res.status);
            return res.json();
        })
        .then(data => {
            window.groups = data.groups;
            const container = document.querySelector('.online-groups .main-container');
            container.innerHTML = '';
            console.log('group: ', groups);

            groups.forEach(group => {
                container.insertAdjacentHTML('beforeend', `
                    <div class="card">
                        <div class="title-row">
                            <h5 class="group-title">${group.name}</h5>
                            <div class="dropdown">
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu"></ul>
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