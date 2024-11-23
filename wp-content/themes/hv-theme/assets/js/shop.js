
/*ajax update category without reload*/
// Основная логика обработки смены категории
document.addEventListener('DOMContentLoaded', () => {
    const defaultCategory = "29"; // ID категории по умолчанию

    // Функция для обработки переключения категории
    function handleCategoryChange(selectedCategory) {
        fetch(hv_theme.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'filter_products',
                categories: selectedCategory,
                nonce: hv_theme.nonce,
            }),
        })
            .then(response => response.json())
            .then(data => {
                const productsContainer = document.querySelector('.products-content');
                const sidebarContainer = document.querySelector('.sidebar-container');

                if (productsContainer && data.data.products_html) {
                    productsContainer.innerHTML = data.data.products_html;
                } else {
                    console.error('Products container not found or no products_html returned.');
                }

                if (sidebarContainer && data.data.sidebar_html) {
                    sidebarContainer.innerHTML = data.data.sidebar_html;
                    initializeSidebarEvents();
                }

                // Обновляем видимость фильтра "Фасовані/Вагові"
                const packageFilter = document.querySelector('.filter-content-box[data-filter-type="package"]');
                if (packageFilter) {
                    packageFilter.style.display = (selectedCategory === "29") ? '' : 'none';
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Загрузка товаров по умолчанию
    handleCategoryChange(defaultCategory);

    // Привязка событий к фильтрам в сайдбаре
    function initializeSidebarEvents() {
        document.querySelectorAll('.category-filter').forEach(input => {
            if (!input.dataset.eventBound) {
                input.addEventListener('change', () => {
                    const selectedCategory = document.querySelector('.category-filter:checked')?.dataset.categoryId || null;
                    if (selectedCategory) {
                        handleCategoryChange(selectedCategory);
                    }
                });
                input.dataset.eventBound = true;
            }
        });
    }

    initializeSidebarEvents();
});






