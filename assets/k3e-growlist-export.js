jQuery(document).ready(function ($) {

    jQuery('#files').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_export_remove", nonce: nonce, id: id},
            success: function (response) {
                if (response.type == "success") {
                    row.hide();
                } else {
                    console.log('Błąd podczas usuwania komentarza.');
                }
            }
        });
    });

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id) {
    var data = {
        action: 'labels_get_attachments',
        id: the_id
    };

    jQuery.get(ajaxurl, data, function (response) {

        if (response.success === true) {
            jQuery('#attachments-box').html("");
            jQuery.each(response.data.attachments, function (index, value) {
                jQuery('#attachments-box').append(value);
            });
        }
    });
}