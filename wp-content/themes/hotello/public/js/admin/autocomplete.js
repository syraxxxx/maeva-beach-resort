"use strict";

$(function () {
  var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];

  function split(val) {
    return val.split(/,\s*/);
  }

  function extractLast(term) {
    return split(term).pop();
  }

  var element = '.vc_ui-panel-window .stm_autocomplete_vc';

  $(element).on("keydown", function (event) {
    if (event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) {
      event.preventDefault();
    }
  }).autocomplete({
    minLength: 0,
    source: function source(request, response) {
      response($.ui.autocomplete.filter(availableTags, extractLast(request.term)));
    },
    focus: function focus() {
      return false;
    },
    select: function select(event, ui) {
      var terms = split(this.value);
      terms.pop();
      terms.push(ui.item.value);
      terms.push("");
      this.value = terms.join(", ");
      return false;
    }
  });
});