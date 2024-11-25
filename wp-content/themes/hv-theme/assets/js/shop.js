
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
                handleFilters(selectedCategory);
            })
            .catch(error => console.error('Error:', error));
    }

    // Загрузка товаров по умолчанию
    handleCategoryChange(defaultCategory);
    handleFilters(defaultCategory);

    // Привязка событий к фильтрам в сайдбаре
    function initializeSidebarEvents() {
        document.querySelectorAll('.category-filter').forEach(input => {
            if (!input.dataset.eventBound) {
                input.addEventListener('change', () => {
                    const selectedCategory = document.querySelector('.category-filter:checked')?.dataset.categoryId || null;
                    if (selectedCategory) {
                        handleCategoryChange(selectedCategory);
                        handleFilters(selectedCategory);
                    }
                });
                input.dataset.eventBound = true;
            }
        });
    }

    initializeSidebarEvents();
});
//show mix filter part
function handleFilters(selectedCategory) {
    const packageFilterBox = document.querySelector('[data-filter-type="package"]');
    const mixFilterBox = document.querySelector('[data-filter-type="mix"]');
    const flavorCountBox = document.querySelector('.filter-content-count');
    const productNumber = flavorCountBox?.querySelector('.product-number');

    // видимость блоков в зависимости от категории
    if (selectedCategory === "29") { // категория grinky
        if (packageFilterBox) packageFilterBox.style.display = '';
        const selectedPackageValue = document.querySelector('[data-filter-type="package"] input:checked')?.value;

        if (selectedPackageValue === 'packaged') {
            if (mixFilterBox) mixFilterBox.style.display = '';
            if (flavorCountBox) {
                flavorCountBox.style.display = '';
                const mixSwitch = mixFilterBox.querySelector('input[type="checkbox"]');
                if (mixSwitch?.checked) {
                    if (productNumber) productNumber.textContent = '14';
                } else {
                    if (productNumber) productNumber.textContent = '1';
                }
            }
        } else if (selectedPackageValue === 'weight') {
            if (mixFilterBox) mixFilterBox.style.display = 'none';
            if (flavorCountBox) {
                flavorCountBox.style.display = '';
                if (productNumber) productNumber.textContent = '14';
            }
        } else {
            if (mixFilterBox) mixFilterBox.style.display = 'none';
            if (flavorCountBox) flavorCountBox.style.display = 'none';
        }
    } else if (selectedCategory === "30") { // категория vergosy
        if (packageFilterBox) packageFilterBox.style.display = 'none';
        if (mixFilterBox) mixFilterBox.style.display = '';
        if (flavorCountBox) {
            flavorCountBox.style.display = '';
            const mixSwitch = mixFilterBox.querySelector('input[type="checkbox"]');
            if (mixSwitch?.checked) {
                if (productNumber) productNumber.textContent = '14';
            } else {
                if (productNumber) productNumber.textContent = '1';
            }
        }
    } else { //другая категория или неактивные
        if (packageFilterBox) packageFilterBox.style.display = 'none';
        if (mixFilterBox) mixFilterBox.style.display = 'none';
        if (flavorCountBox) flavorCountBox.style.display = 'none';
    }

    // обработчик изменений для Фасовані/Вагові
    if (packageFilterBox) {
        packageFilterBox.querySelectorAll('input').forEach(input => {
            input.addEventListener('change', () => {
                const selectedValue = document.querySelector('[data-filter-type="package"] input:checked')?.value;

                if (selectedValue === 'packaged') {
                    if (mixFilterBox) mixFilterBox.style.display = '';
                    if (flavorCountBox) {
                        flavorCountBox.style.display = '';
                        const mixSwitch = mixFilterBox.querySelector('input[type="checkbox"]');
                        if (mixSwitch?.checked) {
                            if (productNumber) productNumber.textContent = '14';
                        } else {
                            if (productNumber) productNumber.textContent = '1';
                        }
                    }
                } else if (selectedValue === 'weight') {
                    if (mixFilterBox) mixFilterBox.style.display = 'none';
                    if (flavorCountBox) {
                        flavorCountBox.style.display = '';
                        if (productNumber) productNumber.textContent = '14';
                    }
                }
            });
        });
    }

    //обработчик для переключателя в блоке MIX
    if (mixFilterBox) {
        const mixSwitch = mixFilterBox.querySelector('input[type="checkbox"]');
        if (mixSwitch) {
            mixSwitch.addEventListener('change', () => {
                if (mixSwitch.checked) {
                    if (productNumber) productNumber.textContent = '14';
                } else {
                    if (productNumber) productNumber.textContent = '1';
                }
            });
        }
    }
}




// вызов функции при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    const defaultCategory = document.querySelector('.category-filter:checked')?.dataset.categoryId || null;
    handleFilters(defaultCategory);
});





