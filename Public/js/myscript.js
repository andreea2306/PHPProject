$( document ).ready(function() {

    $('#nrOfPortions').change(function (ev) {
        $('#totalPrice').text = "";
        var price = $('#price').text();
        var pieces = $('#nrOfPortions').val();
        $('#totalPrice').html(price * pieces);
    })

});