AOS.init({
    duration: 1000,
    once: true
});
document.addEventListener("DOMContentLoaded", function() {


    const iframeModalEl = document.getElementById('iframeModal');
    document.addEventListener("click", function(e) {
        if (e.target.closest(".target-iframe")) {
            e.preventDefault();
            e.stopPropagation();

            let videoSlide = e.target.closest(".video-slide");
            if (!videoSlide) return;


            let iframe = videoSlide.querySelector("iframe");
            if (!iframe) return;

            let src = iframe.getAttribute("src");
            if (!src) return;


            let separator = src.includes("?") ? "&" : "?";
            let modalIframe = iframeModalEl.querySelector("iframe");
            modalIframe.src = src + separator + "autoplay=1";

            jQuery('#iframeModal').modal('show');
        }
    });
});
