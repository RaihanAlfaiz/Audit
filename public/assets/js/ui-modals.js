"use strict";
! function () {
    [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]')).map(function (e) {
        e.onclick = function () {
            var e = this.getAttribute("data-bs-target"),
                t = this.getAttribute("data-theVideo") + "?autoplay=1",
                e = document.querySelector(e + " iframe");
            e && e.setAttribute("src", t)
        }
    }), document.querySelectorAll(".carousel").forEach(t => {
        t.addEventListener("slide.bs.carousel", e => {
            e = $(e.relatedTarget).height();
            $(t).find(".active.carousel-item").parent().animate({
                height: e
            }, 500)
        })
    })
}();
