// function loadOnlineGroupItems(groupId) {
//     let container = document.getElementById(`group-${groupId}`);

//     fetch(`/online/groups/${groupId}/items`)
//         .then(res => res.json())
//         .then(data => {
//             container.innerHTML = "";
//             groupItemsCache[groupId] = data.items
//             console.log('group: ', data);
//             if (data.items.length === 0) {
//                 container.innerHTML = "";
//             } else {
//                 data.items.forEach(item => {

//                     let tag = item.tags.length > 0 ? item.tags[0].name : "";

//                     container.insertAdjacentHTML("beforeend", `
//                         <div class="item-copy">
//                             <div class="item" 
//                                 data-bs-toggle="modal" 
//                                 data-bs-target="#itemModal"
//                                 data-item-id="${item.id}"
//                                 data-group-id="${item.group_id || item.default_group_id}">
//                                 <span class="tag">${tag}</span>
//                                 <span>${item.name}</span>
//                             </div>
//                             <button class="copy" data-link="${item.link}" type="button">copy</button>
//                         </div>
//                     `);
//                 });
//             }
//         })
//         .catch(err => console.error(err));
// }

export function initOnlineItems() {
    const containers = document.querySelectorAll('.items-container');
    containers.forEach(container => {
        if (container.dataset.initialized === "true") return;

        const groupId = container.dataset.groupId;
        container.dataset.page = 1;
        container.dataset.loading = "false";
        container.dataset.initialized = "true";

        loadMoreItems(groupId, container);

        container.addEventListener('scroll', async () => {
            if (container.dataset.loading === "true") return;
            if (container.dataset.noMore === "true") return;

            const nearBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 10;
            if (nearBottom) {
                await loadMoreItems(groupId, container);
            }
        });
    });
}

async function loadMoreItems(groupId, container) {
    const page = parseInt(container.dataset.page || "1");
    
    container.dataset.loading = "true";

    try {
        const res = await fetch(`/online/group/${groupId}/items?page=${page}`);
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const data = await res.json();
        if (!data.items || data.items.length === 0) {
            container.dataset.noMore = "true";
            return;
        }
        groupItemsCache[groupId] = data.items;
        console.log('gg', data);
        data.items.forEach(item => {
            if (container.querySelector(`[data-item-id="${item.id}"]`)) return;
            container.insertAdjacentHTML('beforeend', `
                <div class="item-copy">
                    <div class="item" data-bs-toggle="modal"
                         data-bs-target="#itemModal"
                         data-item-id="${item.id}" data-group-id="${groupId}">
                        <span class="tag">${item.tags.map(t => t.name).join(', ')}</span>
                        <span>${item.name}</span>
                    </div>
                    <button class="copy" data-link="${item.link}" type="button">copy</button>
                </div>
            `);
        });

        // Оновлюємо сторінку
        container.dataset.page = page + 1;

        // Якщо більше немає сторінок
        if (!data.has_more) container.dataset.noMore = "true";

    } catch (err) {
        console.error('Помилка при підвантаженні items:', err);
    } finally {
        container.dataset.loading = "false";
    }
}
