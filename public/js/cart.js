$(document).ready(function () {
    $('.btn-plus').click(function () {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#price').html().replace('MMK', ''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + "MMK");
        summaryCaculation();
    });

    $('.btn-minus').click(function () {
        $parentNode = $(this).parents('tr');
        $price = Number($parentNode.find('#price').html().replace('MMK', ''));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty;
        $parentNode.find('#total').html($total + "MMK");
        summaryCaculation();
    })

    //calculate final price for order
    function summaryCaculation() {
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function (index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('MMK', ''))
        })
        $('#subTotalPrice').html(`${$totalPrice} MMK`);
        $('#finalPrice').html(`${$totalPrice + 3000} MMK`)
    }
})
