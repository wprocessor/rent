
jQuery(document).ready(function ($) {
  jQuery('.property-city-item').each(function (index, element) {
    $(element).on('click', function (e) {
      e.preventDefault();
      
      var data = {
        action: 'property_filter_action',
        term_id: $(this).data('term-id'),
      };
      
      jQuery.post(property_ajax_data.url, data, function (response) {
        jQuery('#property-items-list').replaceWith(response.items);
      });
    });
  });
});