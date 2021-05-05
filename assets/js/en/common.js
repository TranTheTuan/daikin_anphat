'use strict';

(function ($) {
  var $html = $('html');
  var isIE8 = $html.hasClass('ie8');

  $(function() {
    /**
     * ã‚«ãƒ†ã‚´ãƒªãƒ¼ãƒŠãƒ“ã®å‡¦ç†
     */
    $('.g-page-categoryNav').each(function() {
      var $HeaderShrinking = $('#HeaderShrinking');
      var $HeaderSubstitution = $('#HeaderSubstitution');
      $HeaderShrinking.css('position', 'relative');
      $HeaderSubstitution.remove();
    });
  })

}(jQuery));
