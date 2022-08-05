jQuery(function ($) {
    // on upload button click
    $('body').on('click', '.k3e-groups-upload', function (event) {
        event.preventDefault(); // prevent default link click and page refresh

        const button = $(this)
        const imageId = button.next().next().val();

        const k3e_uploader = wp.media({
            title: 'Wstaw obrazek', // modal window title
            library: {
                // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
                type: 'image'
            },
            button: {
                text: 'Użyj tego obrazka' // button label text
            },
            multiple: false
        }).on('select', function () { // it also has "open" and "close" events
            const attachment = k3e_uploader.state().get('selection').first().toJSON();
            button.removeClass('button').html('<img src="' + attachment.url + '">'); // add image instead of "Upload Image"
            button.next().show(); // show "Remove image" link
            jQuery('#k3e_groups_img_form').val(attachment.id); // Populate the hidden field with image ID
        })

        // already selected images
        k3e_uploader.on('open', function () {

            if (imageId) {
                const selection = k3e_uploader.state().get('selection')
                attachment = wp.media.attachment(imageId);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);
            }

        })

        k3e_uploader.open()

    });
    // on remove button click
    $('body').on('click', '.k3e-groups-remove', function (event) {
        event.preventDefault();
        const button = $(this);
        button.next().val(''); // emptying the hidden field
        button.hide().prev().addClass('button').html('Wgraj obrazek'); // replace the image with text
    });
});