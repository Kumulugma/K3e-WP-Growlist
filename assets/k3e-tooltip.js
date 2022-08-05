jQuery(document).ready(function () {
    
    tippy('[data-toggle="tooltip"]', {
        content: (reference) => reference.getAttribute('title'),
    });
});