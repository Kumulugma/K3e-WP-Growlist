jQuery(document).ready(function ($) {

    jQuery('.btn-edit').click(function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let value = jQuery('#comment_' + id).html();
        let row = jQuery('#row_' + id);
        if (parseInt(row.data('form')) === 0) {
            row.data('form', 1);
            jQuery('#comment_' + id).html('<input type="text" name="comment" id="comment-data-' + id + '" value="' + value + '"> <button data-id="' + id + '" class="button button-primary btn-save"><i class="fa fa-save" aria-hidden="true"></i></button> <button data-id="' + id + '" class="button button-danger btn-close"><i class="fa fa-close" aria-hidden="true"></i></button>');
        }
    });

    jQuery('#files').on('click', '.btn-save', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let comment = jQuery('#comment-data-' + id).val();
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_list_comment", nonce: nonce, id: id, comment: comment},
            success: function (response) {
                if (response.type == "success") {
                    row.data('form', 0);
                    jQuery("#comment_" + id).html(response.comment);
                } else {
                    row.data('form', 0);
                    jQuery("#comment_" + id).html(response.comment);
                }
            }
        });
    });


    jQuery('#files').on('click', '.btn-close', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let row = jQuery('#row_' + id);
        let comment = jQuery('#comment-data-' + id).val();
        let nonce = jQuery('#row_' + id).data('nonce');
        if (parseInt(row.data('form')) === 1) {
            row.data('form', 0);
            jQuery.ajax({
                type: "post",
                dataType: "json",
                url: myAjax.ajaxurl,
                data: {action: "k3e_list_old_comment", nonce: nonce, id: id, comment: comment},
                success: function (response) {
                    if (response.type == "success") {
                        jQuery("#comment_" + id).html(response.comment);
                    } else {
                        jQuery("#comment_" + id).html();
                    }
                }
            });
        }
    });

    jQuery('#files').on('click', '.btn-remove', function (e) {
        e.preventDefault();
        let id = jQuery(this).data('id');
        let nonce = jQuery('#row_' + id).data('nonce');
        let row = jQuery('#row_' + id);

        jQuery.ajax({
            type: "post",
            dataType: "json",
            url: myAjax.ajaxurl,
            data: {action: "k3e_list_remove", nonce: nonce, id: id},
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