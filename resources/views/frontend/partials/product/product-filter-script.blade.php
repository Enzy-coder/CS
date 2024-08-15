<script>
    (function ($) {
        "use strict";
        let sort_form = $('#sort_form');

        $(document).ready(function () {
            $("#slider-range" ).slider({
                range: true,
                min: 0,
                max: "{{$maximum_available_price}}",
                values: [ "{{$min_price}}", "{{$max_price}}" ],
                slide: function( event, ui ) {
                    let min_price = ui.values[0];
                    let max_price = ui.values[1];
                    let siteGlobalCurrency = "{{site_currency_symbol()}}";

                    $("#amount").val(siteGlobalCurrency + min_price + " - " + siteGlobalCurrency + max_price);
                    $('#pr_min').val(min_price);
                    $('#pr_max').val(max_price);
                    sort_form.trigger('submit');
                }
            });

            $('#search_query').on('change', function () {
                let val = $(this).val();
                $('#q').val(val);
            });

            $('input[name=product_cat]').on('change', function (e) {
                let val = $(this).val();
                $('#cat').val(val);
                sort_form.trigger('submit');
            });

            $('input[name=product_subcat]').on('change', function (e) {
                let val = $(this).val();
                $('#subcat').val(val);
                sort_form.trigger('submit');
            });

            $('input[name=product_unit]').on('change', function (e) {
                let val = $(this).val();
                $('#unt').val(val);
                sort_form.trigger('submit');
            });

            $('#set_item_to_show').on('change', function () {
                let val = $(this).val();
                $('#count').val(val);
                sort_form.trigger('submit');
            });

            $('#set_item_sort_by').on('change', function () {
                let val = $(this).val();
                $('#sort').val(val);
                sort_form.trigger('submit');
            });

            $('.attribute_item').on('change', function () {
                let selected_attributes = $('.attribute_item:checked');
                let selected_attributes_arr = [];
                let selected_attributes_json = '';
                for (let i = 0; i < selected_attributes.length; i++) {
                    selected_attributes_arr.push({
                        id: $(selected_attributes[i]).data('attr-type'),
                        attribute: $(selected_attributes[i]).val()
                    });
                }
                selected_attributes_json = JSON.stringify(selected_attributes_arr);
                $('#attr').val(selected_attributes_json);
                sort_form.trigger('submit');
            });

            $('.single-rating-item .radio-btn-wrapper').on('change', function () {
                let selected_rating = $(this).find('input').data('value');
                $('#rt').val(selected_rating);
                sort_form.trigger('submit');
            });

            $('.tag-btn').on('click', function (e) {
                e.preventDefault();
                let selected_tag = $(this).text();
                $('#t').val(selected_tag);
                sort_form.trigger('submit');
            });

            $('.grid-layout').on('click', function (e) {
                e.preventDefault();
                let display_style = $(this).data('style')
                $('#s').val(display_style);
                sort_form.trigger('submit');
            });

            $('.list-layout').on('click', function (e) {
                e.preventDefault();
                let display_style = $(this).data('style')
                $('#s').val(display_style);
                sort_form.trigger('submit');
            });

            $('#search_form').on('submit', function (e) {
                e.preventDefault();
                sort_form.trigger('submit');
            });

            $('.widget-search-btn').on('click', function (e) {
                e.preventDefault();
                sort_form.trigger('submit');
            });
        });
    })(jQuery)
</script>
