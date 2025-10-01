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


