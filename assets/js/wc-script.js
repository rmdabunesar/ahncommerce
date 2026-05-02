jQuery(document).ready(function ($) {
    // Style WooCommerce buttons
    $(".single_add_to_cart_button").removeClass("button").addClass("primary-btn");
    $(".checkout-button").removeClass("button").addClass("primary-btn");

    // Quantity buttons
    $(document).on('click', '.qty-minus', function(e) {
        e.preventDefault();
        var $input = $(this).closest('.qty-wrapper').find('.qty');
        var val = parseInt($input.val()) || 1;
        var min = parseInt($input.attr('min')) || 1;
        if (val > min) $input.val(val - 1).trigger('change');
    });
    
    $(document).on('click', '.qty-plus', function(e) {
        e.preventDefault();
        var $input = $(this).closest('.qty-wrapper').find('.qty');
        var val = parseInt($input.val()) || 0;
        var max = parseInt($input.attr('max'));
        if (!max || val < max) $input.val(val + 1).trigger('change');
    });
});
