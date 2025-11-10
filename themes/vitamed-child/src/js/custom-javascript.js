// Add your custom JS here.
document.addEventListener("DOMContentLoaded", function () {
    Fancybox.getDefaults().zoomEffect = false;
    Fancybox.bind("[data-fancybox]", {
        Carousel: {
            Toolbar: {
                display: {
                    middle: [],
                    right: ["close"],
                },
            },
        },
        zoom: false
    });

    document.querySelectorAll('.section-title').forEach(el => {
        const text = el.textContent.trim();
        const words = text.split(/\s+/);

        if (words.length > 1) {
            words[0] = `<span class="text-gray">${words[0]}</span>`;
            el.innerHTML = words.join(' ');
        }
    });
    setTimeout(() => {
        document
            .querySelectorAll('.leaflet-marker-icon')
            .forEach(icon => icon.setAttribute('aria-label', 'Marker'));
    }, 500);


    const containers_swiper_services = document.querySelectorAll('.services-swiper');
    containers_swiper_services.forEach((element) => {
        const parent = element.closest('.services-section');
        const btn_prev = parent.querySelector('.services.swiper-button-prev');
        const btn_next = parent.querySelector('.services.swiper-button-next');

        const swiper_services = new Swiper(element, {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            navigation: {
                nextEl: btn_next,
                prevEl: btn_prev,
            },
            breakpoints: {
                1201: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
            }

        });
    });


    const containers_swiper_doctors = document.querySelectorAll('.doctors-swiper');
    containers_swiper_doctors.forEach((element) => {
        const parent = element.closest('.doctors-section');
        const btn_prev = parent.querySelector('.doctors.swiper-button-prev');
        const btn_next = parent.querySelector('.doctors.swiper-button-next');

        const swiper = new Swiper(element, {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            navigation: {
                nextEl: btn_next,
                prevEl: btn_prev,
            },
            breakpoints: {
                1201: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
            }
        });
    });


    const containers_swiper_testemonials = document.querySelectorAll('.testemonials-swiper');
    containers_swiper_testemonials.forEach((element) => {
        const parent = element.closest('.testemonials-section');
        const btn_prev = parent.querySelector('.testemonials.swiper-button-prev');
        const btn_next = parent.querySelector('.testemonials.swiper-button-next');

        const swiper_testemonials = new Swiper(element, {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            navigation: {
                nextEl: btn_next,
                prevEl: btn_prev,
            },
            breakpoints: {
                1201: {
                    slidesPerView: 2,
                },
            }

        });
    });


    const containers_swiper_gallery = document.querySelectorAll('.gallery-swiper');
    containers_swiper_gallery.forEach((element) => {
        const parent = element.closest('.gallery-section');
        const btn_prev = parent.querySelector('.gallery.swiper-button-prev');
        const btn_next = parent.querySelector('.gallery.swiper-button-next');

        const swiper_gallery = new Swiper(element, {
            direction: 'horizontal',
            loop: false,
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            navigation: {
                nextEl: btn_next,
                prevEl: btn_prev,
            },
            breakpoints: {
                1201: {
                    slidesPerView: 2,
                },
            }

        });
    });




    const iframeModalEl = document.getElementById('iframeModal');

    iframeModalEl.addEventListener('hidden.bs.modal', function () {

        let modalIframe = iframeModalEl.querySelector("iframe");
        if (modalIframe) {
            modalIframe.setAttribute("src", "");
        }
    });

    const containers_swiper_video = document.querySelectorAll('.video-swiper');
    containers_swiper_video.forEach((element) => {
        const parent = element.closest('.video-section');
        const btn_prev = parent.querySelector('.video.swiper-button-prev');
        const btn_next = parent.querySelector('.video.swiper-button-next');

        const swiper_video = new Swiper(element, {
            direction: 'horizontal',
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            autoHeight: true,
            navigation: {
                nextEl: btn_next,
                prevEl: btn_prev,
            },
            breakpoints: {
                1201: {
                    slidesPerView: 3,
                },
                991: {
                    slidesPerView: 2,
                },
                575: {
                    slidesPerView: 2,
                },
            }
        });

    });

    const holder = document.querySelectorAll('.bm-map');
    //const addr = document.getElementById('address');
    const addr = window.VitamedVar && VitamedVar.address ? VitamedVar.address : '';

    if (holder.length > 0 && addr && window.L) {
        fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(addr), {headers: {'Accept': 'application/json'}})
            .then(r => r.json())
            .then(list => {
                if (!list || !list[0]) return;
                const lat = parseFloat(list[0].lat), lon = parseFloat(list[0].lon);
                const containers_map = document.querySelectorAll('.bm-map');
                containers_map.forEach((element) => {
                    const myIcon = L.icon({
                        //iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                        iconUrl: '/wp-content/themes/vitamed-child/images/marker-icon.svg',
                        iconSize: [32, 32],
                    });
                    const map = L.map(element, {zoomControl: false}).setView([lat, lon], 16);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19, attribution: '&copy; OpenStreetMap'
                    }).addTo(map);
                    L.marker([lat, lon], {icon: myIcon}).addTo(map).bindPopup(VitamedVar.markerTitle || 'Location');


                });

            }).catch(() => {
        });
    }



if(jQuery('input.booking-date').length > 0){
    function pad(n) {
        return n < 10 ? '0' + n : n;
    }
    var booking_today = new Date();
    var day   = pad(booking_today.getDate());
    var month = pad(booking_today.getMonth() + 1);
    var year  = booking_today.getFullYear();
    var booking_date = year + '-' + month + '-' + day;
    jQuery('input.booking-date').val(booking_date);
}
    if(jQuery('input.doctor-id').length > 0 && jQuery('input#doctor_id').length > 0){

        jQuery('input.doctor-id').val(jQuery('input#doctor_id').val());
    }
});
