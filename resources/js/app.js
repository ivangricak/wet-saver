import './bootstrap';

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

//COPY LINK FUNCTION
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.copy').forEach(el => {
        el.addEventListener('click', async (e) => {
            e.stopPropagation();
            e.preventDefault();

            const link = el.dataset.link?.trim() || el.textContent.trim();
            if (!link) return;

            try {
                await navigator.clipboard.writeText(link);

                const originalText = el.textContent;
                el.textContent = 'Done!';
                setTimeout(() => {
                    el.textContent = originalText; 
                }, 1500);

            } catch (err) {
                alert('Error!');
            }
        });
    });
});


//SELECTION GROUP FOR ITEM
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('category_selector');
    const defInput = document.getElementById('def_group_id');
    const normalInput = document.getElementById('group_id');

    select.addEventListener('change', () => {
        const selectedOption = select.selectedOptions[0];

        if (!selectedOption || !selectedOption.dataset.type) {
            defInput.value = '';
            normalInput.value = '';
            return;
        }

        if (selectedOption.dataset.type === 'def') {
            defInput.value = selectedOption.value;
            normalInput.value = '';
        } else if (selectedOption.dataset.type === 'normal') {
            defInput.value = '';
            normalInput.value = selectedOption.value;
        }
    });
});
