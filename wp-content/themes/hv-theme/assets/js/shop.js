
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
    const plusButton = document.querySelector('.button-control.plus');
    const minusButton = document.querySelector('.button-control.minus');
    plusButton.disabled = true;
    minusButton.disabled = true;

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

    // обработчик для переключателя в блоке MIX
    if (mixFilterBox) {
        const mixSwitch = mixFilterBox.querySelector('input[type="checkbox"]');
        if (mixSwitch) {
            mixSwitch.addEventListener('change', () => {
                if (mixSwitch.checked) {
                    plusButton.disabled = false;
                    minusButton.disabled = false;
                    if (productNumber) productNumber.textContent = '2';
                } else {
                    plusButton.disabled = true;
                    minusButton.disabled = true;
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

//работа кнопок плюс и минус в сайдбаре
document.addEventListener('DOMContentLoaded', () => {
    // Делегирование событий для кнопок + и -
    document.addEventListener('click', (event) => {
        const plusButton = event.target.closest('.button-control.plus');
        const minusButton = event.target.closest('.button-control.minus');
        const productNumberElement = document.querySelector('.filter-content-count .product-number');

        if (!productNumberElement) {
            return;
        }

        let currentValue = parseInt(productNumberElement.textContent.trim(), 10);

        if (isNaN(currentValue)) {
            currentValue = 1; // Устанавливаем значение по умолчанию
        }

        // Обработка нажатия кнопки +
        if (plusButton) {
            if (currentValue < 14) {
                currentValue = currentValue === 1 ? 2 : currentValue + 2; // Первый шаг +1, далее +2
                productNumberElement.textContent = currentValue; // Обновляем значение
            }
        }

        // Обработка нажатия кнопки -
        if (minusButton) {
            if (currentValue > 1) {
                currentValue = currentValue === 2 ? 1 : currentValue - 2; // Уменьшение: сначала -1, потом -2
                productNumberElement.textContent = currentValue; // Обновляем значение
            }
        }
    });
});

//select sub-categories
document.addEventListener('DOMContentLoaded', () => {
    const productNumberElement = document.querySelector('.product-number'); // Поле с количеством
    const subCategoryContainer = document.querySelector('.filter-content-box.sub-categories'); // Контейнер подкатегорий
    const subCategoryCheckboxes = subCategoryContainer?.querySelectorAll('input[type="checkbox"]');

    if (!productNumberElement || !subCategoryContainer || !subCategoryCheckboxes) {
        console.error('Не удалось найти необходимые элементы для управления подкатегориями.');
        return;
    }

    // Функция для ограничения выбора чекбоксов
    function enforceCheckboxLimit() {
        const maxSelected = parseInt(productNumberElement.textContent, 10) || 1; // Максимальное количество
        const selectedCount = subCategoryContainer.querySelectorAll('input[type="checkbox"]:checked').length;

        subCategoryCheckboxes.forEach(checkbox => {
            if (!checkbox.checked && selectedCount >= maxSelected) {
                checkbox.disabled = true; // Отключаем выбор новых чекбоксов, если лимит достигнут
            } else {
                checkbox.disabled = false; // Включаем незачеканные, если лимит позволяет
            }
        });
    }

    // Обновляем лимит при изменении количества в .product-number
    const observer = new MutationObserver(() => {
        enforceCheckboxLimit();
    });

    observer.observe(productNumberElement, { childList: true, subtree: true });

    // Слушаем изменения состояния чекбоксов
    subCategoryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', enforceCheckboxLimit);
    });

    // Инициализируем ограничения при загрузке
    enforceCheckboxLimit();
});































