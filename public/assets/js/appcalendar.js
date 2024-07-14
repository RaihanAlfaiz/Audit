"use strict";
let direction = "ltr";
let isRtl = false;
isRtl && (direction = "rtl"),
document.addEventListener("DOMContentLoaded", function () {
    const v = document.getElementById("calendar"),
        m = document.querySelector(".app-calendar-sidebar"),
        f = document.querySelector(".app-overlay"),
        g = { Business: "primary", Holiday: "success", Personal: "danger", Family: "warning", ETC: "info" },
        b = document.querySelector(".modal-title"),
        y = document.querySelector('button[type="submit"]'),
        S = document.querySelector(".btn-delete-event"),
        L = document.querySelector(".btn-cancel"),
        E = document.querySelector("#eventTitle"),
        X = document.querySelector("#eventTenant"),
        k = document.querySelector("#eventStartDate"),
        w = document.querySelector("#eventEndDate"),
        x = document.querySelector("#eventURL"),
        q = $("#eventLabel"),
        D = $("#eventGuests"),
        P = document.querySelector("#eventLocation"),
        z = document.querySelector("#eventPhone"),
        Z = document.querySelector("#eventCapacity"),
        M = document.querySelector("#eventDescription"),
        T = document.querySelector(".allDay-switch"),
        A = document.querySelector(".select-all"),
        F = [].slice.call(document.querySelectorAll(".input-filter")),
        Y = document.querySelector(".inline-calendar");

    let a, l = events, r = !1, e;

    function t(e) {
        return e.id ? "<span class='badge badge-dot bg-" + $(e.element).data("label") + " me-2'> </span>" + e.text : e.text;
    }

    function n(e) {
        return e.id ? "<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-xs me-2'><img src='" + assetsPath + "img/avatars/" + $(e.element).data("avatar") + "' alt='avatar' class='rounded-circle' /></div>" + e.text + "</div>" : e.text;
    }

    var d, o;

    function s() {
        var e = document.querySelector(".fc-sidebarToggle-button");
        for (e.classList.remove("fc-button-primary"), e.classList.add("d-lg-none", "d-inline-block", "ps-0"); e.firstChild;) e.firstChild.remove();
        e.setAttribute("data-bs-toggle", "sidebar"), e.setAttribute("data-overlay", ""), e.setAttribute("data-target", "#app-calendar-sidebar"), e.insertAdjacentHTML("beforeend", '<i class="bx bx-menu bx-sm text-heading"></i>');
    }

    q.length && q.wrap('<div class="position-relative"></div>').select2({ placeholder: "Select value", dropdownParent: q.parent(), templateResult: t, templateSelection: t, minimumResultsForSearch: -1, escapeMarkup: function (e) { return e } }),
    D.length && D.wrap('<div class="position-relative"></div>').select2({ placeholder: "Select value", dropdownParent: D.parent(), closeOnSelect: !1, templateResult: n, templateSelection: n, escapeMarkup: function (e) { return e } }),
    k && (d = k.flatpickr({ enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, n) { n.isMobile && n.mobileInput.setAttribute("step", null) } })),
    w && (o = w.flatpickr({ enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, n) { n.isMobile && n.mobileInput.setAttribute("step", null) } })),
    Y && (e = Y.flatpickr({ monthSelectorType: "static", inline: !0 }));

    let i = new Calendar(v, {
        initialView: "dayGridMonth",
        events: function (e, t) {
            let n = function () {
                let t = [], e = [].slice.call(document.querySelectorAll(".input-filter:checked"));
                return e.forEach(e => { t.push(e.getAttribute("data-value")) }), t;
            }();
            t(l.filter(function (e) { return n.includes(e.extendedProps.calendar.toLowerCase()) }));
        },
        plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
        editable: !0,
        dragScroll: !0,
        dayMaxEvents: 2,
        eventResizableFromStart: !0,
        customButtons: { sidebarToggle: { text: "Sidebar" } },
        headerToolbar: { start: "sidebarToggle, prev,next, title", end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth" },
        direction: direction,
        initialDate: new Date,
        navLinks: !0,
        eventClassNames: function ({ event: e }) { return ["fc-event-" + g[e._def.extendedProps.calendar]] },
        dateClick: function (e) {
            e = moment(e.date).format("YYYY-MM-DD");
            u(), $('#addEventModal').modal('show'), b && (b.innerHTML = "Add Event"), y.innerHTML = "Add", y.classList.remove("btn-update-event"), y.classList.add("btn-add-event"), S.classList.add("d-none"), k.value = e, w.value = e;
        },
        eventClick: function (e) {
            e = e, (a = e.event).url && (e.jsEvent.preventDefault(), window.open(a.url, "_blank")),
            $('#addEventModal').modal('show'), b && (b.innerHTML = "Event Detail"), y.innerHTML = "Update", y.classList.add("btn-update-event"), y.classList.remove("btn-add-event"), S.classList.remove("d-none"), E.value = a.title, d.setDate(a.start, !0, "Y-m-d"), !0 === a.allDay ? T.checked = !0 : T.checked = !1, null !== a.end ? o.setDate(a.end, !0, "Y-m-d") : o.setDate(a.start, !0, "Y-m-d"), q.val(a.extendedProps.calendar).trigger("change"), void 0 !== a.extendedProps.location && (P.value = a.extendedProps.location), void 0 !== a.extendedProps.guests && D.val(a.extendedProps.guests).trigger("change"), void 0 !== a.extendedProps.phone && (z.value = a.extendedProps.phone), void 0 !== a.extendedProps.capacity && (Z.value = a.extendedProps.capacity), void 0 !== a.extendedProps.capacity && (X.value = a.extendedProps.tenant_name);
        },
        datesSet: function () { s() },
        viewDidMount: function () { s() }
    });

    i.render(), s();

    var c = document.getElementById("eventForm");

    function u() {
        w.value = "", x.value = "", k.value = "", E.value = "", P.value = "", T.checked = !1, D.val("").trigger("change"), M.value = "",  z.value = "",  Z.value = "", X.value = "";
    }

    

   

    A && A.addEventListener("click", e => {
        e.currentTarget.checked ? document.querySelectorAll(".input-filter").forEach(e => e.checked = 1) : document.querySelectorAll(".input-filter").forEach(e => e.checked = 0), i.refetchEvents();
    });

    F && F.forEach(e => {
        e.addEventListener("click", () => {
            document.querySelectorAll(".input-filter:checked").length < document.querySelectorAll(".input-filter").length ? A.checked = !1 : A.checked = !0, i.refetchEvents();
        });
    });

    e.config.onChange.push(function (e) {
        i.changeView(i.view.type, moment(e[0]).format("YYYY-MM-DD")), s(), m.classList.remove("show"), f.classList.remove("show");
    });
});
