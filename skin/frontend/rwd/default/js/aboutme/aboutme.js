function runPexedelicCamera () {
    jQuery('.camera_wrap').camera({
        alignment: 'center',
        fx: 'scrollLeft',
        hover: true,
        navigation: false,
        navigationHover: true,
        pagination: false,
        portrait: true,
        thumbnails: true,
        time: 3000
    });
}

function updateMaxHeight () {
    var elementToUpdateMaxHeight = ["div#banner"];
    elementToUpdateMaxHeight.each(function (element) {
        jQuery(element).css({
            "max-height": jQuery(window).height()
        });
    });
}

function scrollToTop () {
    jQuery('.pageToTop').click(function () {
        jQuery("html, body").animate({scrollTop:0}, 500, 'swing');
    });

    jQuery(window).scroll(function (event) {
        if (jQuery(window).scrollTop() > 10) {
            jQuery('.pageToTop').show();
        } else {
            jQuery('.pageToTop').hide();
        }
    });
}

jQuery(document).ready(function () {
    runPexedelicCamera();
    updateMaxHeight();
    //If the User resizes the window, adjust the #container height
    jQuery(window).on("resize", updateMaxHeight);
    scrollToTop();
});
