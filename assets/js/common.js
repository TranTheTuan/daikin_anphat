'use strict';

(function ($) {
  var $html = $('html');
  var $win = $(window);
  var isIE8 = $html.hasClass('ie8');
  var isLegacyAndroid = (function () {
    var ua = navigator.userAgent;
    switch (true) {
      case /Android 4\.[0123]/i.test(ua):
        return true;
      case /Android 4\.4/i.test(ua) && /Linux; U;/i.test(ua) && !/Chrome/i.test(ua):
        return true;
      default:
        return false;
    }
  }());

  /**
   * throttle
   */
  function throttle(func, wait) {
    var timeout;
    var prev = +new Date;
    // func();
    return function () {
      var now = +new Date;
      var diff = now - prev;
      clearTimeout(timeout);
      if (diff >= wait) {
        func();
        prev = now;
      } else {
        timeout = setTimeout(func, diff);
      }
    };
  }

  /**
   * debounce
   */
  function debounce(func, wait) {
    var timeout;
    // func();
    return function () {
      clearTimeout(timeout);
      timeout = setTimeout(func, wait);
    };
  }

  /**
   * ã‚¦ã‚£ãƒ³ãƒ‰ã‚¦å¹…ã‚’å–å¾—ï¼ˆIE8ã¯ã‚¹ã‚¯ãƒ­ãƒ¼ãƒ«ãƒãƒ¼ã‚’å«ã¾ãªã„å¹…ï¼‰
   * @returns {Number} ã‚¦ã‚£ãƒ³ãƒ‰ã‚¦å¹…
   */
  function getWinWidth() {
    var w = window.innerWidth;
    return (w !== undefined) ? w : $win.width();
  }

  /**
   * ã‚¢ã‚³ãƒ¼ãƒ‡ã‚£ã‚ªãƒ³
   */
  $('.g-acc_item').each(function () {
    var $btn = $(this);
    var $body = $($btn.data('body'));
    if ($body.length === 0) $body = $btn.next();

    $body.css('overflow', 'hidden');

    $btn.on('click', function (e, immediate) {
      $btn.toggleClass('g-acc_item-on');
      $body.stop().slideToggle(immediate ? 0 : 400);
      $win.triggerHandler('resize.height');
      return false;
    });
  })
  .trigger('click', [true]);

  /**
   * ã‚«ãƒ«ãƒ¼ã‚»ãƒ«
   */
  $('.g-carousel').each(function () {
    var count = $(this).data('carousel') || 4;
    var rspConf = [{
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        centerPadding: '23px'
      }
    }];
    if (count > 3) {
      rspConf.unshift({
        breakpoint: 769,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      });
    }
    $('.g-carousel_inner', this).slick({
      slidesToShow: count,
      slidesToScroll: count,
      appendArrows: '.g-carousel',
      prevArrow: '<div class="g-slider_nav g-slider_prev"></div>',
      nextArrow: '<div class="g-slider_nav g-slider_next"></div>',
      dots: true,
      customPaging: function (slick, i) {
        return (i + 1) + '/' + slick.slideCount;
      },
      responsive: isIE8 ? null : rspConf
    });
  });

  /**
   * PCãƒ­ãƒ¼ã‚«ãƒ«ãƒŠãƒ“ã®å‡¦ç†
   */
  $('.g-lnav').each(function () {
    var noAnim = $(this).hasClass('g-lnav-anime') === false;
    var $wrapper = $('.g-wrapper');
    var $curLv2;

    $('.g-lnav_lv2', this).each(function () {
      var active = 'g-lnav-active';
      var $lv2 = $(this);

      if (Modernizr.touchevents) {
        $lv2.parent()
          .on('click', function (e) {
            if (getWinWidth() < 960) return undefined;
            if (e.target.tagName === 'A') return true;
            if ($curLv2 && $curLv2[0] !== this) $curLv2.trigger('click');
            var $el = $(this);
            var clickNs = 'click.lnav';
            var scrollNs = 'scroll.lnav';
            $wrapper.off(clickNs);
            $win.off(scrollNs);
            $el.toggleClass(active);
            $lv2.stop().slideToggle(noAnim ? 0 : 400);
            if ($el.hasClass(active)) {
              var fn = function () { $el.trigger('click'); };
              $curLv2 = $el;
              $wrapper.one(clickNs, fn);
              $win.one(scrollNs, fn);
            } else {
              $curLv2 = null;
            }
            return false;
          });
      } else {
        $lv2.parent()
          .on('mouseenter', function () {
            if (!isIE8 && getWinWidth() < 960) return;
            $(this).addClass(active);
            $lv2.stop().slideDown(noAnim ? 0 : 400);
          })
          .on('mouseleave', function () {
            if (!isIE8 && getWinWidth() < 960) return;
            $(this).removeClass(active);
            $lv2.stop().slideUp(noAnim ? 0 : 400);
          });
      }
    });

    /**
     * ãƒ­ãƒ¼ã‚«ãƒ«ãƒŠãƒ“ã®PC/SPåˆ‡ã‚Šæ›¿ãˆå‡¦ç†
     */
    (function () {
      var isSpView = false;

      function deactivateLnav() {
        $html.removeClass('g-lnav-sticky');
        $('.g-lnav').removeClass('g-lnav-on');
        $('.g-wrapper, .g-lnav_lv1').removeAttr('style');
        $('.g-lnav-active').removeClass('g-lnav-active');
        $('.g-lnav_accBtn').removeClass('g-lnav_accBtn-on g-lnav_lv1_hd-on')
          .next('.g-lnav_accBody').width('auto').height('auto').hide();
        $win.add($wrapper).off('.lnav');
      }

      $win.on('resize', debounce(function () {
        if (isIE8) return;
        $curLv2 = null;
        var w = getWinWidth();
        if (w < 960 && !isSpView) {
          isSpView = true;
          deactivateLnav();
        } else if (w >= 960 && isSpView) {
          isSpView = false;
          deactivateLnav();
        }
      }, 100))
      .trigger('resize');
    }());
  });

  /**
   * SPãƒ­ãƒ¼ã‚«ãƒ«ãƒŠãƒ“ã®å‡¦ç†
   */
  (function () {
    var ON = 'g-lnav-on';
    var $wrapper = $('.g-wrapper');
    var $main = $('.g-main');
    var $lnavLv1 = $('.g-lnav_lv1');
    var $btn = $('.g-lnav_hd');
    var $lnav = $('.g-lnav');
    var $header = $('.g-header').length ? $('.g-header') : $('#HeaderArea');
    var $hnav = $('.g-hnav').length ? $('.g-hnav') : $('#GlobalNavWrap');
    var $body = $('body');
    var y;

    if ($lnav.length !== 1) return;

    function deactivate() {
      $wrapper.css({ overflow: 'visible', height: 'auto' });
      $win.scrollTop(y);
      $lnav.removeClass(ON);
      $lnavLv1.hide();
      $body.removeClass('subnav-open'); // EN
    }

    function activate() {
      if (isIE8 || getWinWidth() > 959) return;
      y = $win.scrollTop();
      $win.scrollTop(0);
      $wrapper.css({ overflow: 'hidden', height: $win.height() });
      $lnav.addClass(ON);
      $lnavLv1.show();
      $body.addClass('subnav-open'); // EN
    }

    $btn.on('click', function () {
      if ($lnav.hasClass(ON)) deactivate();
      else activate();
      if (isLegacyAndroid) $main.before($lnav);
    });

    $win.on('scroll', function () {
      if (isIE8 || $lnav.hasClass(ON)) return;
      var y1 = $win.scrollTop();
      var y2 = (getWinWidth() > 959) ?
        ($header.outerHeight() + $hnav.outerHeight()) : $header.height();
      $html.toggleClass('g-lnav-sticky', y1 >= y2);
      if (isLegacyAndroid) $main.before($lnav);
    })
    .trigger('scroll');
  }());

  /**
   * SPãƒ­ãƒ¼ã‚«ãƒ«ãƒŠãƒ“å†…ã‚¢ã‚³ãƒ¼ãƒ‡ã‚£ã‚ªãƒ³ã®å‡¦ç†
   */
  $('.g-lnav_accBtn').on('click', function (e) {
    if (isIE8 || getWinWidth() > 959 || e.target.tagName === 'A') return;
    $(this).toggleClass('g-lnav_accBtn-on').next('.g-lnav_accBody').slideToggle();
    e.preventDefault();
  });

  /**
   * å‹•ç”»
   */
  $('.g-video').each(function () {
    var $el = $(this);
    var w = $el.data('video') || '100%';
    var $iframe = $('iframe', this);
    var per = (100 * $iframe[0].height) / $iframe[0].width;
    $('.g-video_el', this).css('padding-bottom', per + '%');
    $(this).width(w).addClass('g-video-init');
  });

  /**
   * Google Map
   */
  $('.g-map').each(function () {
    var $el = $(this);
    var w = $el.data('map') || '100%';
    var $iframe = $('iframe', this);
    var per = (100 * $iframe[0].height) / $iframe[0].width;
    $('.g-map_el', this).css('padding-bottom', per + '%');
    $(this).width(w).addClass('g-map-init');
  });

  /**
   * ãƒ¢ãƒ¼ãƒ€ãƒ«
   */
  (function () {
    var timer;
    var $group;
    var $wrapper;
    var $modal;
    var $inner;
    var $box;
    var $body;
    var $close;
    var $print;
    var $prev;
    var $next;
    var $pagination;
    var $ctrlInner;
    var load = function ($anchor) {
      $html.removeClass('g-modal-init g-modal-multi g-modal-prev g-modal-next');
      $('.g-modal_el', $body).remove();
      var uri = $anchor[0].href;
      var $iframe = $('<iframe src="' + uri + '" class="g-modal_if"/>').appendTo($body)
        .one('load', function () {
          var win = this.contentWindow;
          var isSp = getWinWidth() <= 480;
          var duration = (isIE8 || !isSp) ? 500 : 0;
          var $el = win.jQuery(win.document).find('.g-modal_el');
          var y;
          if (isSp || Modernizr.touchevents) {
            y = $win.scrollTop();
            $wrapper.css({ overflow: 'hidden', height: $win.height() });
            $win.scrollTop(0);
          }
          $(this).replaceWith($el);
          $box.animate({ height: $body.outerHeight() }, duration, function () {
            $html.addClass('g-modal-init');
            if ($group.length > 0) {
              var index = $group.index($anchor);
              $pagination.html('<b>' + (index + 1) + '</b>/' + $group.length);
              $html.toggleClass('g-modal-prev', index !== 0);
              $prev.off().on('click', function () { load($group.eq(index - 1)); });
              $html.toggleClass('g-modal-next', index !== $group.length - 1);
              $next.off().on('click', function () { load($group.eq(index + 1)); });
              $ctrlInner.css('marginRight', $win.width() - $inner.width());
              $html.addClass('g-modal-multi');
            }
          });
          $modal.off().on('click', function (e2) {
            var el = e2.target;
            if (el === $box[0] || $.contains($box[0], el)) return;
            $modal.remove();
            $html.removeClass('g-modal g-modal-init g-modal-multi g-modal-prev g-modal-next');
            if (isSp || Modernizr.touchevents) {
              $wrapper.css({ overflow: 'visible', height: 'auto' });
              $win.scrollTop(y);
            }
          });
          $close.off().on('click', function () { $modal.trigger('click'); });
          $print.off().on('click', function () {
            var param = (uri.indexOf('?') === -1 ? '?' : '&') + 'print';
            window.open(uri + param, '_blank');
          });
        });
      clearTimeout(timer);
      timer = setTimeout(function () { $iframe.trigger('load'); }, 5000);
      return $iframe;
    };

    $('.j-modal').on('click', function (e) {
      e.preventDefault();
      var $el = $(this);
      var group = $el.data('modal');
      $group = group ? $('.j-modal[data-modal="' + group + '"]') : [];
      $html.addClass('g-modal');
      $wrapper = $('.g-wrapper');
      $modal = $('<div class="g-modal_wrapper"><div class="g-modal_outer"><div class="g-modal_inner"><div class="g-modal_box"><div class="g-modal_body"/><div class="g-modal_close"/><div class="g-modal_print"/><div class="g-modal_ctrl"><div class="g-modal_ctrlInner"><div class="g-modal_prev"/><div class="g-modal_next"/></div></div><div class="g-modal_pagination"/></div></div></div></div>').appendTo('body');
      $inner = $('.g-modal_inner');
      $box = $('.g-modal_box');
      $body = $('.g-modal_body');
      $close = $('.g-modal_close');
      $print = $('.g-modal_print');
      $prev = $('.g-modal_prev');
      $next = $('.g-modal_next');
      $pagination = $('.g-modal_pagination');
      $ctrlInner = $('.g-modal_ctrlInner');
      load($el);
    });
  }());

  /**
   * ãƒ†ãƒ¼ãƒ–ãƒ«ãŒã‚¹ã‚¯ãƒ­ãƒ¼ãƒ«ã§ãã‚‹ã“ã¨ã‚’ç¤ºã™ã‚¤ãƒ³ãƒ‡ã‚£ã‚±ãƒ¼ã‚¿ãƒ¼
   */
  if (Modernizr.touchevents) {
    (function () {
      var $els = $('.g-table-scroll.g-table-fixed');
      if ($els.length === 0) return;
      $els.each(function (i) {
        var $el = $(this);
        var ename = 'scroll.indicator.' + i;
        $win.on(ename, throttle(function () {
          if ($el.is(':hidden')) return;
          var bottom = $win.scrollTop() + $win.height();
          var y = $el.offset().top;
          if (bottom > y + 200) {
            $win.off(ename);
            if ($el.outerWidth() >= $('.g-table_el', $el).outerWidth()) return;
            var $indicator = $('<div class="g-table-indicator"/>').appendTo($el)
              .fadeIn(300).delay(5000).fadeOut(300);
            $el.one('scroll', function () { $indicator.remove(); });
          }
        }, 100))
        .trigger(ename);
      });
    }());
  }

  /**
   * ã‚µã‚¤ãƒ‰ãƒãƒ¼ã®PC/SPåˆ‡ã‚Šæ›¿ãˆå‡¦ç†
   */
  $('.g-sidebar').each(function () {
    var isSpView = false;

    function deactivateSidebar(display) {
      $html.removeClass('g-sidebar-sticky');
      $('.g-sidebar').removeClass('g-sidebar-on');
      $('.g-wrapper, .g-sidebar_lv1').removeAttr('style');
      $('.g-sidebar-active').removeClass('g-sidebar-active');
      $('.g-sidebar_accBtn').removeClass('g-sidebar_accBtn-on g-sidebar_lv1_hd-on')
        .next('.g-sidebar_accBody').width('auto').height('auto').toggle(display);
    }

    $win.on('resize', debounce(function () {
      if (isIE8) return;
      var w = getWinWidth();
      if (w <= 769 && !isSpView) {
        isSpView = true;
        deactivateSidebar(false);
      } else if (w > 769 && isSpView) {
        isSpView = false;
        deactivateSidebar(true);
      }
    }, 100))
    .trigger('resize');
  });

  /**
   * SPã‚µã‚¤ãƒ‰ãƒãƒ¼ã®å‡¦ç†
   */
  (function () {
    var ON = 'g-sidebar-on';
    var $wrapper = $('.g-wrapper');
    var $contents = $('.g-contents');
    var $sidebarLv1 = $('.g-sidebar_lv1');
    var $btn = $('.g-sidebar_hd');
    var $sidebar = $('.g-sidebar');
    //var $header = $('.g-header');
    //var $hnav = $('.g-hnav');
    var $header = $('.g-header').length ? $('.g-header') : $('#HeaderArea');
    var $hnav = $('.g-hnav').length ? $('.g-hnav') : $('#GlobalNavWrap');
    var $body = $('body');
    var y;

    if ($sidebar.length !== 1) return;

    function deactivate() {
      $wrapper.css({ overflow: 'visible', height: 'auto' });
      $win.scrollTop(y);
      $sidebar.removeClass(ON);
      $sidebarLv1.hide();
      $body.removeClass('subnav-open'); // EN
    }

    function activate() {
      if (isIE8 || getWinWidth() > 769) return;
      y = $win.scrollTop();
      $win.scrollTop(0);
      $wrapper.css({ overflow: 'hidden', height: $win.height() });
      $sidebar.addClass(ON);
      $sidebarLv1.show();
      $body.addClass('subnav-open'); // EN
    }

    $btn.on('click', function () {
      if ($sidebar.hasClass(ON)) deactivate();
      else activate();
      if (isLegacyAndroid) $contents.after($sidebar);
    });

    $win.on('scroll', function () {
      if (isIE8 || $sidebar.hasClass(ON)) return;
      var y1 = $win.scrollTop();
      var y2 = (getWinWidth() > 769) ?
        ($header.outerHeight() + $hnav.outerHeight()) : $header.height();
      $html.toggleClass('g-sidebar-sticky', y1 >= y2);
      if (isLegacyAndroid) $contents.after($sidebar);
    })
    .trigger('scroll');
  }());

  /**
   * SPã‚µã‚¤ãƒ‰ãƒãƒ¼å†…ã‚¢ã‚³ãƒ¼ãƒ‡ã‚£ã‚ªãƒ³ã®å‡¦ç†
   */
  $('.g-sidebar_accBtn').on('click', function (e) {
    if (isIE8 || getWinWidth() > 769 || e.target.tagName === 'A') return;
    $(this).toggleClass('g-sidebar_accBtn-on').next('.g-sidebar_accBody').slideToggle();
    e.preventDefault();
  });

  /**
   * SPæ™‚ã«ã‚¿ãƒ–ã‚’ãƒ—ãƒ«ãƒ€ã‚¦ãƒ³ã«å¤‰æ›´
   */
  var glTabLabel = (function () {
    var elem;
    var elemLink;
    var elemSelect;

    function createSelectOption() {
      var item = '';
      elemLink.find('a').each(function (i) {
        var $this = $(this);
        item += '<option value="' + i + '" data-url="' + $this.attr('href') + '" ' + ($this.parent().hasClass('is-Selected') ? 'selected="selected"' : '') + '>' + $this.text() + '</option>';
      });
      elemSelect.find('select').append($.parseHTML(item));
    }

    function setEventToSelect() {
      elemSelect.find('select').on('change', function () {
        window.location = $(this).find('option:selected').data('url');
      });
    }

    function init() {
      elem = $('.g-tabMenu-rwd .g-tabMenu_head');
      if (!elem.length) return;
      elemLink = $('.g-tabMenu-rwd .g-tabMenu_list');
      elemSelect = $('.g-tabMenu-rwd .g-tabMenu_select');
      createSelectOption();
      setEventToSelect();
    }

    return { init: init };
  }());

  glTabLabel.init();

  /**
   * ã‚«ãƒ«ãƒ¼ã‚»ãƒ«ï¼ˆãƒ¡ã‚¤ãƒ³ãƒ“ã‚¸ãƒ¥ã‚¢ãƒ«ï¼‰
   */
  (function () {
    var $sliders = $('.g-poster_main');
    $sliders.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      arrows: true,
      appendArrows: '.g-poster_nav',
      autoplaySpeed: 7000,
      speed: 700,
      fade: true,
      cssEase: 'ease-out',
      prevArrow: '<div class="g-slider_nav g-slider_prev"></div>',
      nextArrow: '<div class="g-slider_nav g-slider_next"></div>',
      appendDots: '.g-poster_inner',
      dots: true,
      responsive: isIE8 ? null : [
          {
            breakpoint: 481,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: true,
              centerPadding: 0,
              autoplay: true,
              speed: 700
            }
          }
        ]
    });
    $(document).on('navopen', function () { $sliders.slick('slickPause'); })
      .on('navclose', function () { $sliders.slick('slickPlay'); });
  }());

  /**
   * é«˜ã•ã‚’æƒãˆã‚‹
   */
  (function () {

    var items = $('.j-height').get();
    var sets = _.groupBy(items, function (el) { return $(el).data('height'); });

    $win.on('resize.height', _.debounce(function () {
      var w = getWinWidth();
      var device = (w <= 480) ? 'sp' : (w <= 768) ? 'touch' : 'pc';
      var isSpView = w <= 480;

      _.forEach(sets, function (set, key) {
        var h = 0;
        var arr = [];
        for (var i = 0; i < set.length; i++) {
          var $el = (device ==='touch') ? $(set[i]).not('[data-height-touch-clear]') :ã€€(device === 'sp') ? $(set[i]).not('[data-height-sp-clear], [data-height-touch-clear]') :  $(set[i]);
          $(set[i]).css('height', 'auto').css('min-height', 0);
          h = Math.max(h, $el.outerHeight());
          arr.push($el);
        }

        for (var i = 0; i < arr.length; i++) {
          $(arr[i]).css($(arr[i]).css('display') === 'table-cell' ? 'height' : 'min-height', h);
        }

        // var $els = $(set);
        // $els.css($els.css('display') === 'table-cell' ? 'height' : 'min-height', h);
      });
    }, 100))
      .trigger('resize.height');
  }());

  /**
   * ã‚¹ãƒ ãƒ¼ã‚ºã‚¹ã‚¯ãƒ­ãƒ¼ãƒ«
   */
  $('.j-scroll').on('click', function (e) {
    e.stopImmediatePropagation();

    var id = $(this).attr('href');

    var w = getWinWidth();
    var device = (w <= 768) ? 'sp' : (w <= 960) ? 'touch' : 'pc';

    // var diff = $('body').hasClass('g-page-dept') ? -70 : 0;

    // ãƒšãƒ¼ã‚¸ä¸Šéƒ¨ã«å›ºå®šã•ã‚Œã‚‹ãƒ˜ãƒƒãƒ€ãƒ¼ã®é«˜ã•åˆ†ã€ã‚¢ãƒ³ã‚«ãƒ¼ãƒã‚¤ãƒ³ãƒˆã®ã‚ªãƒ•ã‚»ãƒƒãƒˆã‚’ãšã‚‰ã™
    // ãƒ†ãƒ³ãƒ—ãƒ¬æ¯Žã«é«˜ã•ãŒé•ã†ã®ã§ã€å›ºå®šå€¤45ã¨ã™ã‚‹
    var diff = 0;
    if($('body').hasClass('g-page-categoryNav')){
      // glocal A / B
      diff = $('body').hasClass('g-page-sidebar') && device !== 'sp' ? 0 : 45;
    }else if(!$('body').hasClass('g-page-sidebar')){
      // å›½å†… A
      diff = 45;
    }else{
      if($('#MegaMenu_Overlay').length){
        // global C
        diff = (device === 'pc') ? 125 : (device === 'touch') ? 0 : 45;
      }else{
        // å›½å†… B
        diff = (device === 'sp') ? 45 : 0;
      }
    }

    // accordion
    var accordion = '.g-acc_item';
    if($(id).closest(accordion)){
      var $btn = $(accordion);
      var $body = $($btn.data('body'));
      if ($body.length === 0) $body = $btn.next();
      if($body.css('display') !== 'block'){
        $btn.trigger('click', [true]);
      }
    }

    $('html, body').animate({ scrollTop: $(id).offset().top - diff }, 700);
    e.preventDefault();
  });

  /**
   * ã‚¿ãƒ–UI
   */
  $('.g-tabMenu-js').each(function () {
    var css = 'g-tabMenu-on';
    var $btns = $('.g-tabMenu_list', this).find('a');
    var $bodies = $('.g-tabMenu_body', this);
    var hash = window.location.hash;

    $btns.on('click', function (e, immediate) {
      var $el = $(this);
      var $body = $($el.attr('href'));

      $btns.parent().removeClass(css);
      $el.parent().addClass(css);
      $bodies.hide();
      $body.show();
      $win.triggerHandler('resize.height');
      return false;
    });

    $btns.eq(0).trigger('click', [true]);

    if(hash && $(hash).length){
      $('.g-tabMenu_list').find('a[href="'+hash+'"]').trigger('click', [true]);
    }
  });

}(jQuery));