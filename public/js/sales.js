document.addEventListener('DOMContentLoaded', function () {

    const productSelect = document.getElementById('product_id');
    const sellingPriceInput = document.getElementById('selling_price');

    // Kung wala ang mga element, huwag nang tumuloy
    if (!productSelect || !sellingPriceInput) {
        return;
    }

    function updateSellingPrice() {
        const selectedOption = productSelect.options[productSelect.selectedIndex];

        if (selectedOption.dataset.price) {
            sellingPriceInput.value = selectedOption.dataset.price;
        } else {
            sellingPriceInput.value = '';
        }
    }

    // Kapag nagpalit ng product
    productSelect.addEventListener('change', updateSellingPrice);

    // Para gumana rin ang old() value kapag validation error
    updateSellingPrice();

});