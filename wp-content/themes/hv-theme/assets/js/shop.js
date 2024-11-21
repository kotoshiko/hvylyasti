document.addEventListener('DOMContentLoaded', function() {
    const minusButton = document.querySelector('.button-control.minus');
    const plusButton = document.querySelector('.button-control.plus');
    const productNumber = document.querySelector('.product-number');

    // Функция для обновления количества
    function updateCount(change) {
        let currentValue = parseInt(productNumber.textContent, 10);
        let newValue = currentValue + change;

        // Не допускаем отрицательных значений
        if (newValue < 0) {
            newValue = 0;
        }

        productNumber.textContent = newValue;

        // Обновление состояния кнопки "минус"
        if (newValue <= 0) {
            minusButton.classList.add('disabled');
        } else {
            minusButton.classList.remove('disabled');
        }
    }

    // Обработчик нажатия на "минус"
    minusButton.addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            updateCount(-2);
        }
    });

    // Обработчик нажатия на "плюс"
    plusButton.addEventListener('click', function() {
        updateCount(2);
    });
});

/*ajax update category without reload*/

document.querySelectorAll('.category-filter').forEach(input => {
    input.addEventListener('change', () => {
        const selectedCategory = document.querySelector('.category-filter:checked')?.dataset.categoryId || null;

        if (selectedCategory) {
            fetch(hv_theme.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'filter_products',
                    categories: selectedCategory, // Передаем просто ID
                }),
            })
                .then(response => response.text())
                .then(html => {
                    const productsContainer = document.querySelector('.products-content');
                    if (productsContainer) {
                        productsContainer.innerHTML = html;
                    } else {
                        console.error('Products container not found.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
});

// Устанавливаем категорию по умолчанию на странице загрузки
document.addEventListener('DOMContentLoaded', () => {
    const defaultCategory = document.querySelector('input[data-category-id="29"]');
    if (defaultCategory) {
        defaultCategory.checked = true;
        const event = new Event('change');
        defaultCategory.dispatchEvent(event);
    }
});






