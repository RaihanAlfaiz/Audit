"use strict";
var quill = new Quill("#full-editor", {
    bounds: "#full-editor",
    placeholder: "Ketik Sesuatu...",
    modules: {
        formula: !0,
        toolbar: [
            [{
                font: []
            }, {
                size: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
                color: []
            }, {
                background: []
            }],
            [{
                script: "super"
            }, {
                script: "sub"
            }],
            [{
                header: "1"
            }, {
                header: "2"
            }, "blockquote", "code-block"],
            [{
                list: "ordered"
            }, {
                list: "bullet"
            }, {
                indent: "-1"
            }, {
                indent: "+1"
            }],
            ["direction", {
                align: []
            }],
            ["link", "image", "video", "formula"],
            ["clean"]
        ]
    },
    theme: "snow"
});
