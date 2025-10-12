function loadOnlineGroupItems(groupId) {
    let container = document.getElementById(`group-${groupId}`);

    fetch(`/online/groups/${groupId}/items`)
        .then(res => res.json())
        .then(data => {
            container.innerHTML = "";
            groupItemsCache[groupId] = data.items
            console.log('group: ', data);
            if (data.items.length === 0) {
                container.innerHTML = "";
            } else {
                data.items.forEach(item => {

                    let tag = item.tags.length > 0 ? item.tags[0].name : "";

                    container.insertAdjacentHTML("beforeend", `
                        <div class="item-copy">
                            <div class="item" 
                                data-bs-toggle="modal" 
                                data-bs-target="#itemModal"
                                data-item-id="${item.id}"
                                data-group-id="${item.group_id || item.default_group_id}">
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


export function initOnlineItems() {
    document.querySelectorAll(".items-container").forEach(div => {
        let groupId = div.dataset.groupId;
        loadOnlineGroupItems(groupId);
    });
};