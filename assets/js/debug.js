/*global bootlint: false*/
"use strict";

$(document).ready(function() {
    bootlint.lintCurrentDocument(reporter, []);
});

function reporter(lint) {
    console.log(lint.id, lint.message);
}
