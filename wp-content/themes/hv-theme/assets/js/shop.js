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

jQuery(document).ready(function ($) {
    $('#filter-form .category-filter').on('change', function () {
        var selectedCategories = [];
        $('#filter-form .category-filter:checked').each(function () {
            selectedCategories.push($(this).data('category-id'));
        });

        $.ajax({
            url: hv_theme.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_products',
                categories: selectedCategories
            },
            beforeSend: function () {
                $('.products-content').html('<p>Loading...</p>');
            },
            success: function (response) {
                if (response.success) {
                    $('.products-content').html(response.data);
                }
            }
        });
    });
});



