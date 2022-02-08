$(document).ready(function(){
    if(checkCookie('sidebar')){
        if(getCookie('sidebar') === 'vertical-collpsed'){
            $('body').removeClass('sidebar-enable').addClass('vertical-collpsed');
        } else {
            $('body').removeClass('vertical-collpsed').addClass('sidebar-enable');
        }
    }

    document.onkeyup=function(e){
        var e = e || window.event; // for IE to cover IEs window event-object
        if(e.altKey && e.which === 49) {
            $('#vertical-menu-btn').trigger('click');
            return false;
        }

        if(e.altKey && e.which === 78) {
            $('#page-header-notifications-dropdown').trigger('click');
            return false;
        }

        if(e.altKey && e.which === 82) {
            $('.right-bar-toggle').trigger('click');
            return false;
        }
    }


    !(function (t) {
        "use strict";
        function e() {
            document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || (t("body").removeClass("fullscreen-enable"));
        }
        t("#side-menu").metisMenu(),
            t("#vertical-menu-btn").on("click", function (e) {
                e.preventDefault(), t("body").toggleClass("sidebar-enable"), 992 <= t(window).width() ? t("body").toggleClass("vertical-collpsed") : t("body").removeClass("vertical-collpsed");
                let bodyclass = $('body').attr('class');
                setCookie('sidebar',bodyclass,1);
            }),
            t("#sidebar-menu a").each(function () {
                var e = window.location.href.split(/[?#]/)[0];
                this.href == e &&
                (t(this).addClass("active"),
                    t(this).parent().addClass("mm-active"),
                    t(this).parent().parent().addClass("mm-show"),
                    t(this).parent().parent().prev().addClass("mm-active"),
                    t(this).parent().parent().parent().addClass("mm-active"),
                    t(this).parent().parent().parent().parent().addClass("mm-show"),
                    t(this).parent().parent().parent().parent().parent().addClass("mm-active"));
            }),
            t(".navbar-nav a").each(function () {
                var e = window.location.href.split(/[?#]/)[0];
                this.href == e &&
                (t(this).addClass("active"),
                    t(this).parent().addClass("active"),
                    t(this).parent().parent().addClass("active"),
                    t(this).parent().parent().parent().parent().addClass("active"),
                    t(this).parent().parent().parent().parent().parent().addClass("active"));
            }),
            t('[data-toggle="fullscreen"]').on("click", function (e) {
                e.preventDefault(),
                    t("body").toggleClass("fullscreen-enable"),
                    document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                        ? document.cancelFullScreen
                            ? document.cancelFullScreen()
                            : document.mozCancelFullScreen
                                ? document.mozCancelFullScreen()
                                : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                        : document.documentElement.requestFullscreen
                            ? document.documentElement.requestFullscreen()
                            : document.documentElement.mozRequestFullScreen
                                ? document.documentElement.mozRequestFullScreen()
                                : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }),
            document.addEventListener("fullscreenchange", e),
            document.addEventListener("webkitfullscreenchange", e),
            document.addEventListener("mozfullscreenchange", e),
            t(".right-bar-toggle").on("click", function (e) {
                t("body").toggleClass("right-bar-enabled");
            }),
            t(document).on("click", "body", function (e) {
                0 < t(e.target).closest(".right-bar-toggle, .right-bar").length || t("body").removeClass("right-bar-enabled");
            }),
            t(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
                return t(this).next().hasClass("show") || t(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), t(this).next(".dropdown-menu").toggleClass("show"), !1;
            }),
            t(function () {
                t('[data-toggle="tooltip"]').tooltip();
            }),
            t(function () {
                t('[data-toggle="popover"]').popover();
            }),
            Waves.init();
    })(jQuery);

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie(cname) {
        let name = getCookie(cname);
        if (name !== "") {
            return true;
        } else {
            return false;
        }
    }



    $('.delete-notif').on('click',e=>{
        e.preventDefault();
        $('.notification-dropdown').addClass('show');
        let notification = e.target.getAttribute('data-content');
        e.target.closest('.media').style.opacity = '0.5';
        $.ajax({
            method: 'get',
            url: '/profile/notification-remove/'+notification,
            success: response => {
                successResponse('Notification removed.');
                $('.notification-dropdown').addClass('show');
                e.target.closest('.media').remove();
            },
            error: response => {
                errorResponse('Notification couldn\'t be removed.');
                $('.notification-dropdown').addClass('show');
                e.target.closest('.media').style.opacity = '1';
            }
        })
    });

    $('.read-notif').on('click',e=>{
        e.preventDefault();
        let notification = e.target.getAttribute('data-content');
        e.target.closest('.media').style.backgroundColor = 'white';
        $.ajax({
            method: 'get',
            url: '/profile/notification-read/'+notification,
            success: response => {
                successResponse('Notification marked as read.');
                $('.notification-dropdown').addClass('show');
            },
            error: response => {
                errorResponse('Notification couldn\'t marked as read.');
                $('.notification-dropdown').addClass('show');
                e.target.closest('.media').style.backgroundColor = 'aliceblue';
            }
        })
    })

    window.onbeforeunload = ()=>{
        $('#loader').show();
    }

});


