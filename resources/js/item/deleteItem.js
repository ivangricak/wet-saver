//DELETE ITEMS
export function DeleteItem() {
    document.addEventListener('click', function(e) {
        if(e.target.matches('.delete-btn')) {
            const itemId = e.target.dataset.id;
            const groupId = e.target.dataset.idGroup;

            if(!confirm('Ви точно хочете видалити цей item?')) {
                return;
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
                    // console.log(`Item ${itemId} deleted in DB`);

                    const arr = window.groupItemsCache[groupId];
                    const index = arr.findIndex(item => item.id == itemId);
                    arr.splice(index, 1);

                    console.log('con>item>deleted: ', window.groupItemsCache);

                    const modalEl = document.getElementById('itemModal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    modalInstance.hide();

                    // прибираємо сам item з DOM
                    const listItemEl = document.querySelector(`.item-copy .item[data-item-id="${itemId}"]`);
                    if(listItemEl){
                        const itemCopy = listItemEl.closest('.item-copy');
                        itemCopy?.remove();
                    }

                } else {
                    alert('Помилка при видаленні: ' + data.message);
                }
            })
            .catch(err => console.error(err));
        }
    });
}