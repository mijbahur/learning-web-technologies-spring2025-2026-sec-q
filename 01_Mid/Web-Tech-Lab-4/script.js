const unitPrice = 1000;

const quantityInput = document.getElementById("quantity");
const totalPriceInput = document.getElementById("totalPrice");

quantityInput.addEventListener("input", function () {

    let quantity = parseInt(quantityInput.value);

    if (quantity < 0) {
        alert("Quantity cannot be negative");
        quantityInput.value = "";
        totalPriceInput.value = 0;
        return;
    }

    if (isNaN(quantity)) {
        totalPriceInput.value = 0;
        return;
    }

    let total = unitPrice * quantity;
    totalPriceInput.value = total;

    if (total > 1000) {
        alert("You are eligible for a gift coupon!");
    }
});