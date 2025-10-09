export function loadDataOfCategory() {
    fetch('/categories')
        .then(c => c.json())
        .then(data => {
            window.listOfCategories = data;
            console.log("Дані про категорію збережені:", listOfCategories);
        })
        .catch(err => console.error("Помилка при завантаженні категорій:", err));
}