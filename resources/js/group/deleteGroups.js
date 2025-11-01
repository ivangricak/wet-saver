//DELETE GROUP
export function DeleteGroup () {
    document.addEventListener('click', function(e) {
        if(e.target.matches('.delete-btn-group')) {
            const groupId = e.target.dataset.id;
            console.log(groupId);
            if(!confirm('Ви точно хочете видалити цю group?')) {
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

                    //delete group from cash
                    delete window.groupItemsCache[groupId];
                    console.log('con>group>deleted: ', window.groupItemsCache);

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
}