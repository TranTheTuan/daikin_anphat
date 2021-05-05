/* =========================================================== */
/* Script Execution List
/* =========================================================== */
// |- 00.Settings
// |- 01.Smooth Scroll
// |- 02.Rollover Script
// |- 03.Fixation Header
// |- 04.Tooltip Type Balloon
// |- 05.Tooltip Type Content
// |- 06.Tab Changer
// |- 07.Search Input Effect
// |- 08.Side Floating Navigation
// |- 09.Navigation Highlight
// |- 10.Footer Accordion
// |- 11.Header Accordion
// |- 12.LocalNav

// After Window Object Loaded
// |- *00.Settings
// |- *01.Accordion
// |- *02.Colorbox
// |- *03.Tab Viewer
// |- *04.Carousels
// |- *05.Hash Scroll (+Tab Block)
// |- *06.Excerpt Roll Up Layer
// |- *07.Mega Menu
// |- *08.KeyVisual Print Dummy Background

// |- 99.IE7,IE8 png Bug Fix

/* =========================================================== */
/* end Script Execution List
/* =========================================================== */


$dg(function ($) {

    /* 00.Settings
     ---------------------------------------------------------------- */

    var $PageHash = location.hash;
    var $dgCurrentPath = location.pathname.split('/');
    var $dgCurrentFolder = $dgCurrentPath[1];
    var $dgWindow = $(window);
    var $dgHtml = $('html');
    var $dgBody = $('body');
    var $dgHeaderWrap = $('#HeaderWrap');
    var $dgSearchWrap = $('#SearchWrap');
    var $dgGlobalNavWrap = $('#GlobalNavWrap');
    var $dgGlobalNavArea = $('#GlobalNavArea');
    var $dgHeaderHeight = $dgHeaderWrap.height() + $dgGlobalNavWrap.height();
    var $dgShowClass = 'is-Show';
    var $dgHoverClass = 'is-Hover';
    var $dgCurrentClass = 'is-Current';
    var $dgRollOverSuffix = '_on';

    var $dgConstrainHeaderCheck = true;
    if ($dgBody.hasClass('is-Constrain')) {
        $dgConstrainHeaderCheck = false;
    }

    var $dgFooterWrap = $('#FooterWrap');

    /* end Settings
     ---------------------------------------------------------------- */


    /* 01.Smooth Scroll
     ---------------------------------------------------------------- */

    $('area[href^=#],a[href^=#]').click(function (e) {
        e.preventDefault();
        var hash = this.hash;
        var TargetTop = 0;
        hash = hash.replace(/^#/, '');
        if ($('#' + hash).length) {
            var Target = $(hash == 'HeaderWrap' ? 'body' : '#' + hash);
            if (Target.size()) {
                TargetTop = Target.offset().top;
            }
        } else if ($('a[name=' + hash + ']').length) {
            TargetTop = $('a[name=' + hash + ']').offset().top;
        } else {
            TargetTop = $('body').offset().top;
        }
        if ($dgBody.hasClass('set-responsiveWebDesign') && $dgWindow.width() < 961) {
            var getHeight = 0;
        } else {
            var getHeight = $dgHeaderWrap.height() + $dgGlobalNavWrap.height();
        }
        if (TargetTop > 0) {
            TargetTop = TargetTop - getHeight;
        }
        $('html, body').stop(false, false).animate({scrollTop: TargetTop}, 1200, 'easeInOutQuart');
        return false;
    });

    /* end Smooth Scroll
     ---------------------------------------------------------------- */


    /* 02.Rollover Script
     ---------------------------------------------------------------- */

    $($dgHoverClass).each(function () {
        var $Classes = $(this).attr("class");
        if ($Classes.indexOf("png") == -1) {
            var $ImgOut = $(this).attr("src");
            var $ImgOver = $ImgOut.replace('.gif', $dgRollOverSuffix + '.gif').replace('.jpg', $dgRollOverSuffix + '.jpg').replace('.png', $dgRollOverSuffix + '.png');
            $(this).hover(
                function () {
                    $(this).attr("src", $ImgOver);
                },
                function () {
                    $(this).attr("src", $ImgOut);
                }
            );
        }
    });

    /* end Rollover Script
     ---------------------------------------------------------------- */


    /* 03.Fixation Header
     ---------------------------------------------------------------- */

    if ($dgConstrainHeaderCheck) {

        $('#HeaderWrap,#SearchWrap,#GlobalNavWrap').wrapAll('<div id="HeaderShrinking"></div>');

        var dgHeaderFunction = {
            HeaderShrinking: $('#HeaderShrinking')
            , SearchArea: $('#SearchArea')
            , HeaderHeightDefault: $('#HeaderShrinking').height()
            , PageTop: $('#Pagetop')
            , PagetopAppChk: $('#main').length
            , HeaderSubstitution: ''
            , OpenCloseButton: $('.Search a', $dgHeaderWrap)
            , SearchWrapHeight: $dgSearchWrap.height()
            , SearchObjectStates: 0
            , ScrollCheck: 0
            , init: function () {
                dgHeaderFunction.HeaderShrinking.css('width', '100%');
                dgHeaderFunction.HeaderShrinking.after('<div id="HeaderSubstitution"></div>');
                dgHeaderFunction.HeaderSubstitution = $('#HeaderSubstitution');
                dgHeaderFunction.HeaderSubstitution.css({
                    'display': 'none',
                    'height': dgHeaderFunction.HeaderHeightDefault + 'px'
                });
                $dgSearchWrap.css('height', '0');
                $('img', dgHeaderFunction.PageTop).each(function () {
                    if ($(this).hasClass('Pagetop-showSp')) return false;
                    var $Classes = $(this).attr("class");
                    if ($Classes.indexOf("png") == -1) {
                        var $ImgOut = $(this).attr("src");
                        var $ImgOver = $ImgOut.replace('.gif', $dgRollOverSuffix + '.gif').replace('.jpg', $dgRollOverSuffix + '.jpg').replace('.png', $dgRollOverSuffix + '.png');
                        $(this).hover(
                            function () {
                                $(this).attr("src", $ImgOver);
                            },
                            function () {
                                $(this).attr("src", $ImgOut);
                            }
                        );
                    }
                });
                dgHeaderFunction.PageTop.hide();
                if ($dgSafariCheck() == 'safari') dgHeaderFunction.PageTop.css('right', '15px');
                dgHeaderFunction.HeaderShrinking.css('position', 'fixed');
                dgHeaderFunction.HeaderSubstitution.css('display', 'block');

                $dgWindow.scroll(function () {
                    var OpenCloseCheck = $dgSearchWrap.hasClass($dgShowClass);
                    if ($dgWindow.scrollTop() > 0) {
                        // Pagetop
                        if (!dgHeaderFunction.PagetopAppChk) {
                            dgHeaderFunction.PageTop.show().stop(true, false).animate({
                                opacity: '1'
                            }, 300);
                        }
                    } else {
                        // Pagetop
                        if (!dgHeaderFunction.PagetopAppChk) {
                            dgHeaderFunction.PageTop.stop(true, false).animate({
                                opacity: '0'
                            }, 300, function () {
                                dgHeaderFunction.PageTop.hide();
                            });
                        }
                    }

                    if ($dgWindow.scrollTop() > dgHeaderFunction.HeaderHeightDefault) {
                        if (dgHeaderFunction.ScrollCheck == 0) {
                            $dgGlobalNavWrap.stop(true, false).animate({
                                backgroundColor: 'rgba(0, 0, 0, 0.9)'
                            }, 300);
                            dgHeaderFunction.ScrollCheck = 1;
                        }
                    } else {
                        if (dgHeaderFunction.ScrollCheck == 1) {
                            $dgGlobalNavWrap.stop(true, false).animate({
                                backgroundColor: 'rgba(0, 0, 0, 1)'
                            }, 300);
                            dgHeaderFunction.ScrollCheck = 0;
                        }
                    }
                });

                dgHeaderFunction.OpenCloseButton.attr('href', '');

                dgHeaderFunction.OpenCloseButton.click(function (e) {
                    e.preventDefault();
                    var OpenCloseCheck = $dgSearchWrap.hasClass($dgShowClass);
                    var SearchWrapHeightLocal = 0;

                    if (OpenCloseCheck) {
                        SearchWrapHeightLocal = 0;
                    } else {
                        $dgSearchWrap.addClass($dgShowClass);
                        SearchWrapHeightLocal = dgHeaderFunction.SearchWrapHeight;
                    }

                    if (dgHeaderFunction.SearchObjectStates == 0) {
                        dgHeaderFunction.SearchObjectStates = 1;
                        $dgSearchWrap.animate({
                                height: SearchWrapHeightLocal + 'px'
                            }, 300,
                            function () {
                                if (SearchWrapHeightLocal < dgHeaderFunction.SearchWrapHeight) {
                                    $dgSearchWrap.removeClass($dgShowClass);
                                }
                                $('.InputTxt input', dgHeaderFunction.SearchArea).focus();
                                dgHeaderFunction.SearchObjectStates = 0;

                                $dgHeaderHeight = dgHeaderFunction.HeaderShrinking.height();// Header Height
                            });
                        var ShadowHeight = dgHeaderFunction.HeaderHeightDefault + SearchWrapHeightLocal;
                        dgHeaderFunction.HeaderSubstitution.animate({
                            height: ShadowHeight + 'px'
                        }, 300);
                    }
                    return false;
                });

                $('.closeButton a').click(function () {
                    dgHeaderFunction.SearchObjectStates = 1;
                    $dgSearchWrap.animate({
                            height: '0'
                        }, 300,
                        function () {
                            $dgSearchWrap.removeClass($dgShowClass);
                            dgHeaderFunction.SearchObjectStates = 0;
                        });
                    dgHeaderFunction.HeaderSubstitution.animate({
                        height: dgHeaderFunction.HeaderHeightDefault + 'px'
                    }, 300);
                    return false;
                });
            }
        };
        dgHeaderFunction.init();
    } else {
        $('#Pagetop').hide();
    }

    /* end Fixation Header
     ---------------------------------------------------------------- */


    /* 04.Tooltip Type Balloon
     ---------------------------------------------------------------- */

    var $TooltipTypeBalloon = $('.Tooltip--TypeBalloon');
    if ($TooltipTypeBalloon.length) {
        var TooltipTypeBalloonFunction = {
            ToolTipsBalloonLi: $('ul li', $TooltipTypeBalloon)
            , ToolTipsContent: $('.Tooltip__Content', $TooltipTypeBalloon)
            , init: function () {
                $('a[href^=#]', TooltipTypeBalloonFunction.ToolTipsBalloonLi).unbind().click(function (e) {
                    e.preventDefault();
                    return false;
                });
                TooltipTypeBalloonFunction.ToolTipsBalloonLi.bind({
                    'mouseenter': function () {
                        TooltipTypeBalloonFunction.ToolTipsIndex = TooltipTypeBalloonFunction.ToolTipsBalloonLi.index(this);
                        TooltipTypeBalloonFunction.ToolTipsContent.removeClass('is-Show');
                        TooltipTypeBalloonFunction.ToolTipsContent.eq(TooltipTypeBalloonFunction.ToolTipsIndex).addClass('is-Show');
                    },
                    'mouseleave': function () {
                        TooltipTypeBalloonFunction.ToolTipsContent.removeClass('is-Show');
                    }
                });
            }
        };
        TooltipTypeBalloonFunction.init();
    }

    /* end Tooltip Type Balloon
     ---------------------------------------------------------------- */


    /* 05.Tooltip Type Content
     ---------------------------------------------------------------- */

    var $dgTooltipTypeContent = $('.Tooltip--TypeContent');
    if ($dgTooltipTypeContent.length) {
        var TooltipTypeContentFunction = {
            ToolTipsImageLi: $('.Tooltip__Image ul li')
            , ToolTipsContent: $('.Tooltip__Content')
            , init: function () {
                $('a[href^=#]', TooltipTypeContentFunction.ToolTipsImageLi).unbind().click(function (e) {
                    e.preventDefault();
                    return false;
                });
                $('.Tooltip__Image', $dgTooltipTypeContent).css('paddingBottom', '83px');
                TooltipTypeContentFunction.ToolTipsImageLi.bind({
                    'mouseenter': function () {
                        TooltipTypeContentFunction.ToolTipsIndex = TooltipTypeContentFunction.ToolTipsImageLi.index(this);
                        TooltipTypeContentFunction.ToolTipsContent.removeClass('is-Show');
                        if (TooltipTypeContentFunction.ToolTipsIndex > 2) {
                            $('.Tooltip__Image', $dgTooltipTypeContent).css('paddingBottom', '0');
                            TooltipTypeContentFunction.ToolTipsContent.eq(TooltipTypeContentFunction.ToolTipsIndex).addClass('is-Show');
                        } else {
                            TooltipTypeContentFunction.ToolTipsContent.eq(TooltipTypeContentFunction.ToolTipsIndex).addClass('is-Show').css({
                                'position': 'absolute',
                                'bottom': '410px',
                                'left': '0'
                            });
                        }
                    },
                    'mouseleave': function () {
                        $('.Tooltip__Image', $dgTooltipTypeContent).css('paddingBottom', '83px');
                        TooltipTypeContentFunction.ToolTipsContent.removeClass('is-Show');
                    }
                });
            }
        };
        TooltipTypeContentFunction.init();
    }

    /* end Tooltip Type Content
     ---------------------------------------------------------------- */


    /* 06.Tab Changer
     ---------------------------------------------------------------- */

    if ($('.js-TabBlock').length) {
        var dgTabChange = {
            hash: location.hash
            , TargetTabBlock: []
            , TabLength: []
            , init: function () {
                var jsTabBlock = $('.js-TabBlock');
                var TabNavLength = jsTabBlock.length;

                for (var i = 0; i < TabNavLength; i++) {
                    dgTabChange.TargetTabBlock[i] = jsTabBlock.eq(i);
                    dgTabChange.TabLength[i] = $('ul.TabNav--Top li', dgTabChange.TargetTabBlock[i]).length;
                    $('ul.TabNav--Top li a', dgTabChange.TargetTabBlock[i]).click(function (e) {
                        e.preventDefault();
                        $(this).closest('div').children('ul.TabNav').children('li').removeClass('is-Selected');
                        $(this).closest('div').children('.Tab__Content').removeClass('is-Show');
                        var ThisIndex = $(this).closest('div').children('ul.TabNav--Top').children('li').children('a').index(this);
                        $(this).closest('div').children('ul.TabNav--Top').children('li').eq(ThisIndex).addClass('is-Selected');
                        $(this).closest('div').children('.Tab__Content').eq(ThisIndex).addClass('is-Show');
                        $(this).closest('div').children('ul.TabNav--Btm').children('li').eq(ThisIndex).addClass('is-Selected');
                        return false;
                    });

                    $('ul.TabNav--Btm li a', dgTabChange.TargetTabBlock[i]).click(function (e) {
                        e.preventDefault();
                        $(this).closest('div').children('ul.TabNav').children('li').removeClass('is-Selected');
                        $(this).closest('div').children('.Tab__Content').removeClass('is-Show');
                        var ThisIndex = $(this).closest('div').children('ul.TabNav--Btm').children('li').children('a').index(this);
                        $(this).closest('div').children('ul.TabNav--Top').children('li').eq(ThisIndex).addClass('is-Selected');
                        $(this).closest('div').children('.Tab__Content').eq(ThisIndex).addClass('is-Show');
                        $(this).closest('div').children('ul.TabNav--Btm').children('li').eq(ThisIndex).addClass('is-Selected');
                        dgTabChange.ScrollHead($(this).attr('href'));
                        return false;
                    })
                }
            }
            , ScrollHead: function (e) {
                var TargetTop = 0;
                var hash = e.replace(/^\?/, "");
                if ($('#' + hash).length) {
                    var Target = $(hash == 'HeaderWrap' ? 'body' : '#' + hash);
                    if (Target.size()) {
                        TargetTop = Target.offset().top;
                    }
                } else {
                    TargetTop = $('body').offset().top;
                }
                if (TargetTop > 0) {
                    TargetTop = TargetTop - $dgHeaderHeight;
                }
                $('html, body').stop(false, false).animate({scrollTop: TargetTop}, 800, 'easeInOutQuart');
            }
        };
        dgTabChange.init();
    }

    /* end Tab Changer
     ---------------------------------------------------------------- */


    /* 07.Search Input Effect
     ---------------------------------------------------------------- */

    if ($dgBrowserUA.IE) {
        $('[placeholder]').each(function () {
            var $this = $(this),
                $form = $this.closest('form'),
                placeholderText = $this.attr('placeholder');

            $(this).attr('placeholder', '');
            $this.after('<span class="PlaceHolder">' + placeholderText + '</span><span class="BlockLayer"></span>');
            $this.bind({
                blur: function () {
                    if ($this.val() === '') {
                        $this.next('.PlaceHolder').show();
                    }
                },
                keyup: function () {
                    if ($this.val() != '') {
                        $this.next('.PlaceHolder').hide();
                    }
                }
            });
            $this.next('.PlaceHolder').show();
        });
    }

    /* end Search Input Effect
     ---------------------------------------------------------------- */


    /* 08.Side Floating Navigation
     ---------------------------------------------------------------- */
    var $SlideMenu = $('.SlideMenu');
    if ($SlideMenu.length) {
        $SlideMenu.hide();
        var dgSlideMenuNavigation = {
            ContentsWrap: $('#ContentsWrap')
            , WidthLimitMax: 0
            , WidthLimitMin: 960 + $SlideMenu.width() * 2
            , SidePos: 0
            , init: function () {
                dgSlideMenuNavigation.SidePos = 0;
                var WindowWidth = $dgWindow.width();
                if (WindowWidth < dgSlideMenuNavigation.WidthLimitMin) {
                    dgSlideMenuNavigation.SidePos = WindowWidth - dgSlideMenuNavigation.WidthLimitMin;
                } else if (dgSlideMenuNavigation.WidthLimitMax > 0 && dgSlideMenuNavigation.WidthLimitMax < WindowWidth) {
                    dgSlideMenuNavigation.SidePos = (WindowWidth - dgSlideMenuNavigation.WidthLimitMax) / 2;
                }
                $SlideMenu.css('left', dgSlideMenuNavigation.SidePos + 'px');

                var HasClassCheck = $SlideMenu.hasClass($dgShowClass);
                if (HasClassCheck) {
                    $SlideMenu.removeClass($dgShowClass);
                }

                $(window).resize(function () {
                    var WindowWidth = $dgWindow.width();
                    dgSlideMenuNavigation.SidePos = 0;
                    if (WindowWidth < dgSlideMenuNavigation.WidthLimitMin) {
                        dgSlideMenuNavigation.SidePos = WindowWidth - dgSlideMenuNavigation.WidthLimitMin;
                    } else if (dgSlideMenuNavigation.WidthLimitMax > 0 && dgSlideMenuNavigation.WidthLimitMax < $dgWindow.width()) {
                        dgSlideMenuNavigation.SidePos = (WindowWidth - dgSlideMenuNavigation.WidthLimitMax) / 2;
                    }
                    $SlideMenu.css('left', dgSlideMenuNavigation.SidePos + 'px');
                });

                $('dl', $SlideMenu).show();
                $SlideMenu.fadeIn();

                $SlideMenu.crossTypeScroll({
                    targetHeight: 600,
                    heightMargin: 100,
                    wrap: $('#ContentsInner'),
                    offsetTop: 100
                });

                $('p a', $SlideMenu).unbind().toggle(function (e) {
                        e.preventDefault();
                        $('dl', $SlideMenu).show();
                        dgSlideMenuNavigation.ClickFunction();
                        return false;
                    },
                    function (e) {
                        e.preventDefault();
                        dgSlideMenuNavigation.CloseFunction();
                        return false;
                    });
            },
            ClickFunction: function () {
                if (!$SlideMenu.hasClass($dgShowClass)) $SlideMenu.addClass($dgShowClass);
                $SlideMenu.stop(true, true).animate({
                    'width': '339px'
                }, 200);
            },
            CloseFunction: function () {
                if ($SlideMenu.hasClass($dgShowClass)) $SlideMenu.removeClass($dgShowClass);
                $SlideMenu.stop(true, true).animate({
                    'width': '39px'
                }, 50);
            }
        };
        dgSlideMenuNavigation.init();
    }
    /* end Side Floating Navigation
     ---------------------------------------------------------------- */


    /* *09.Navigation Highlight
     ---------------------------------------------------------------- */
    initHighlightNav = function (obj) {
        $dgWindow.setNavHighlight({
            localNavId: '.js-HighlightLocalNav',
            localNavPrefix: 'LocalNav__',
            currentClassName: $dgCurrentClass,
            localNav: (!obj.localNav) ? '' : obj.localNav
        });
    }//initHighlightLocalNav


    /* end Navigation Highlight
     ---------------------------------------------------------------- */

    /* 10.Footer Accordion
     ---------------------------------------------------------------- */
    var setFooterAccordion = false;
    var initFooterAccordion = function () {
        $dgFooterWrap.find('.SiteNav__Body__Inner dt').on('click.footerNav', function (e) {
            e.preventDefault();
            $(this).toggleClass($dgShowClass).next('dd').slideToggle();
            return false;
        });
    }
    $(window).on('load resize', function (e) {
        if ($dgBody.hasClass('set-responsiveWebDesign') && $dgWindow.width() < 961) {
            if (!setFooterAccordion) initFooterAccordion();
            setFooterAccordion = true;
        } else {
            $dgFooterWrap.find('.SiteNav__Body__Inner dt').off('click.footerNav');
            setFooterAccordion = false;
        }
    });


    /* end 10
     ---------------------------------------------------------------- */

    /* 11.Header Accordion
     ---------------------------------------------------------------- */
    if ($dgBody.hasClass('set-responsiveWebDesign')) {
        var initHeaderAccordion = function () {
            $('#GlobalNavWrapSp').find('.is-Show').removeClass($dgShowClass).next('dd').slideUp();
        }

        $(window).resize(function (e) {
            $('#GlobalNavWrapSp').css({
                'height': $(window).height() - $('#HeaderWrap').height()
            });
            $('#HeaderSubstitution').css({
                'height': $('#HeaderShrinking').height()
            });
            return false;
        });

        $('#GlobalNavBtn').click(function (e) {
            e.preventDefault();
            if ($(this).hasClass($dgShowClass)) {
                initHeaderAccordion();
            }
            $(this).toggleClass($dgShowClass).next('dd').slideToggle();
            $('body').toggleClass('header-open');
            $('#GlobalNavWrapSp').toggleClass($dgShowClass).css({
                'height': $(window).height() - $('#HeaderWrap').height()
            });

            if ($('body').hasClass('localnav-open')) {
                closeLocalNav();
            }
            return false;
        });

        $('#GlobalNavWrapSp').find('dt').click(function (e) {
            e.preventDefault();
            $(this).toggleClass($dgShowClass).next('dd').slideToggle();
            return false;
        });

        var setHeaderCurrentSp = function () {
            $GlobalNav = $('#GlobalNavWrapSp');
            $GlobalNavSecond = $GlobalNav.find('a[href^="/' + location.pathname.split("/")[1] + '"]').parent();
            target = $GlobalNavSecond.find('a[href^="/' + location.pathname.split("/")[1] + '/' + location.pathname.split("/")[2] + '"]').parent();
            target.addClass('is-Current').parents('dd').prev().addClass('is-Current');
        }
        setHeaderCurrentSp();

        var globalNavCurrentSp = function(){
          var path = location.pathname.replace('index.html','');
          var $nav = $('#GlobalNavWrapSp ul a');
          var domain = 'www.daikin.com'

          if(path !== '/'){
            $nav.each(function(){
              if($(this).attr('href').match(domain)){
                var href = $(this).attr('href').replace(/^https?:\/{2,}(.*?)(?:\/|\?|#|$)/, '').replace('index.html','');
                if(path.match(href)){
                  if($(this).parent('li').index() === 0){
                    $(this)
                      .parents('dd').prev('dt').addClass('is-Current');
                  }else{
                    $(this)
                      .parent('li').addClass('is-Current')
                      .parents('dd').prev('dt').addClass('is-Current');
                  }
                }
              }
            });
          }
        }
        globalNavCurrentSp();
    }

    /* end 11
     ---------------------------------------------------------------- */

    /* 12.LocalNav
     ---------------------------------------------------------------- */

    var _scrollTop = $(window).scrollTop();
    var initLocalNav = function () {

        var html, tmp;
        tmp = $('.Widget--LocalNav').clone().removeClass('Widget');
        html = '<div id="LocalNavWrapSp"><div id="LocalNavAreaSp"></div></div>';

        $('#GlobalNavWrapSp').after(html);
        $('#LocalNavAreaSp').append(tmp);

        $('#LocalNavWrapSp .Widget--LocalNav').prepend('<div id="LocallNavBtn" class="LocalMenu"><a href="javascript:void(0);"><span>Menu</span></a></div>');
        $('#LocalNavWrapSp .LocalNav').prepend('<li class="local-titleBtn">' + $('#LocalNavWrapSp .Widget__Title').html() + '</li>');

        $('#LocalNavWrapSp .LocalNav').find('ul').parent().addClass('local-accordion').children('a').addClass('local-accordionBtn');

        // Event
        $('#LocalNavWrapSp .Widget__Title').on('click', function () {
            if ($('body').hasClass('localnav-open')) {
                closeLocalNav();
            }
            return false;
        });

        $('#LocalNavWrapSp .local-accordionBtn i').on('click', function () {
            $(this).parent().toggleClass($dgShowClass).next('ul').slideToggle();
            return false;
        });

        $('#LocalNavWrapSp #LocallNavBtn').on('click', function () {

            if (!$('body').hasClass('localnav-open')) {
                _scrollTop = $(window).scrollTop();
            }
            // is-Fixed
            if ($('#LocalNavAreaSp').hasClass('is-Fixed')) {
                var setHeight = $(window).height() - $('#LocalNavAreaSp .Widget__Title').height();
                $('body').toggleClass('localnav-open');
                $('html').addClass('localnav-open').addClass('hide-header');
            } else {
                var setHeight = $(window).height() - $('#HeaderWrap').height() - $('#LocalNavAreaSp .Widget__Title').outerHeight();
                $('body').toggleClass('localnav-open').toggleClass('show-header');
                $('html').addClass('localnav-open');
            }

            if ($('#LocalNavWrapSp').hasClass($dgShowClass)) {
                // Remeve Class and Reset height
                closeLocalNav();
            } else {
                // Add Class and Set height
                openLocalNav(setHeight);
            }
            return false;
        });

        setLocalNavScroll();

        $(window).resize(function (e) {
            if (!$('body').hasClass('localnav-open')) {
                var setHeight = '';
            } else if ($('#LocalNavAreaSp').hasClass('is-Fixed')) {
                var setHeight = $(window).height() - $('#LocalNavAreaSp .Widget__Title').height();
            } else {
                var setHeight = $(window).height() - $('#HeaderWrap').height() - $('#LocalNavAreaSp .Widget__Title').outerHeight();
            }

            $('#LocalNavWrapSp').css({
                'height': $('#LocalNavWrapSp .Widget__Title').outerHeight()
            });
            $('#LocalNavWrapSp .Widget__Body').css({
                'height': setHeight
            });

            return false;
        });
    }

    var openLocalNav = function (setHeight) {
        $('#LocalNavWrapSp .Widget__Body').addClass($dgShowClass).css({
            'height': setHeight
        });
        $('#LocalNavWrapSp').addClass($dgShowClass);

        $(window).off('scroll.localnav-scroll');
    };

    var closeLocalNav = function () {
        $('#LocalNavWrapSp .Widget__Body').removeClass($dgShowClass).css({
            'height': $('#LocalNavWrapSp .Widget--LocalNav').height()
        });
        $('#LocalNavWrapSp').removeClass($dgShowClass).css({
            'height': $('#LocalNavWrapSp .Widget--LocalNav').height()
        });

        setLocalNavScroll();

        $('html').removeClass('localnav-open').removeClass('hide-header');
        $('body').removeClass('localnav-open').removeClass('show-header');
        $(window).scrollTop(_scrollTop);
        _scrollTop = 0;
    };

    var setLocalNavScroll = function () {
        $(window).on('load scroll.localnav-scroll', function () {
            var $LocalNavWrapSp = $('#LocalNavWrapSp');
            var $LocalNavAreaSp = $('#LocalNavAreaSp');
            if ($(window).scrollTop() > $('#HeaderWrap').height()) {
                $LocalNavAreaSp.addClass('is-Fixed');
                $LocalNavWrapSp.css({
                    'height': $('.Widget--LocalNav').height()
                });
            } else {
                $LocalNavAreaSp.removeClass('is-Fixed');
                $LocalNavWrapSp.css({
                    'height': $('.Widget--LocalNav').height()
                });
            }
        });
    }

    if ($dgBody.hasClass('set-responsiveWebDesign') && $('.Widget--LocalNav').length > 0) {
        initLocalNav();
    }

    /* end 12
     ---------------------------------------------------------------- */


});


// After Window Object Loaded
(function ($) {
    $(window).load(function () {


        /* *00.Settings
         ---------------------------------------------------------------- */

        var $PageHash = location.hash;
        var $dgCurrentPath = location.pathname.split('/');
        var $dgCurrentFolder = $dgCurrentPath[1];
        var $dgWindow = $(window);
        var $dgHtml = $('html');
        var $dgBody = $('body');
        var $dgHeaderWrap = $('#HeaderWrap');
        var $dgSearchWrap = $('#SearchWrap');
        var $dgSearchWrapHeight = 0;
        var $dgGlobalNavWrap = $('#GlobalNavWrap');
        var $dgGlobalNavArea = $('#GlobalNavArea');
        var $dgHeaderHeight = $dgHeaderWrap.height() + $dgGlobalNavWrap.height();
        var $dgShowClass = 'is-Show';
        var $dgHoverClass = 'is-Hover';
        var $dgCurrentClass = 'is-Current';
        var $dgRollOverSuffix = '_on';
        var $dgKeyVisualObj = $('.KeyVisual #KeyVisualWrap');

        /* end Settings
         ---------------------------------------------------------------- */


        /* *01.Accordion
         ---------------------------------------------------------------- */

        ///* Use Trouble Shooting */
        var $dgFlex = $('.Flex');
        if ($dgFlex.length) {
            var dgAccordion01Function = {
                AccordionLength: $('dl', $dgFlex).length
                , AccordionBodyHeight: []
                , TabContent: $('.Tab__Content')
                , init: function () {
                    if ($('.js-TabBlock').length) {
                        dgAccordion01Function.TabContent.addClass('is-Show');
                    }
                    for (var i = 0; i < dgAccordion01Function.AccordionLength; i++) {
                        $('dl', $dgFlex).eq(i).addClass('is-Open');
                        dgAccordion01Function.AccordionBodyHeight[i] = $('dl', $dgFlex).eq(i).children('dd.Flex__Content').height();
                        $('dl', $dgFlex).eq(i).children('dd.Flex__Content').css('height', 0);
                        $('dl', $dgFlex).eq(i).removeClass('is-Open');
                    }
                    $('dt a.Flex__Toggle', $dgFlex).click(function () {
                        var Index = $('dl', $dgFlex).children('dt').index($(this).parent('dt'));
                        var OPCheck = $(this).closest('dl').find('dd.Flex__Content').height();
                        if (OPCheck > 0) {
                            $(this).closest('dl').find('dd.Flex__Content').animate({
                                height: '0'
                            }, 400, function () {
                                $(this).closest('dl').removeClass('is-Open');
                            });
                        } else {
                            $(this).closest('dl').find('dd.Flex__Content').animate({
                                height: dgAccordion01Function.AccordionBodyHeight[Index] + 'px'
                            }, 400, function () {
                                $(this).closest('dl').addClass('is-Open');
                            });
                        }
                    });

                    dgAccordion01Function.TabContent.removeClass('is-Show').eq(0).addClass('is-Show');
                }
            };
            dgAccordion01Function.init();
        }

        /* end Accordion
         ---------------------------------------------------------------- */


        /* * RWD
         ---------------------------------------------------------------- */
        if ($('body.set-responsiveWebDesign').length > 0) {
            // return true;
            (function () {
                var $html = $('html');
                var $win = $(window);
                var $doc = $(document);
                var isIE8 = $html.hasClass('ie8');
                var isLegacyAndroid = /Android 4\.[012]/.test(navigator.userAgent);
                (function () {
                    var ua = navigator.userAgent.toLowerCase();
                    var ver = navigator.appVersion.toLowerCase();
                    var isMSIE = (ua.indexOf('msie') > -1) && (ua.indexOf('opera') == -1);
                    var isIE6 = isMSIE && (ver.indexOf('msie 6.') > -1);
                    var isIE7 = isMSIE && (ver.indexOf('msie 7.') > -1);
                    var isIE8 = isMSIE && (ver.indexOf('msie 8.') > -1);
                    var isIE9 = isMSIE && (ver.indexOf('msie 9.') > -1);
                    var isIE10 = isMSIE && (ver.indexOf('msie 10.') > -1);
                    var isIE11 = (ua.indexOf('trident/7') > -1);
                    var isIE = isMSIE || isIE11;
                    var isEdge = (ua.indexOf('edge') > -1);
                    var isChrome = (ua.indexOf('chrome') > -1) && (ua.indexOf('edge') == -1);
                    var isFirefox = (ua.indexOf('firefox') > -1);
                    var isSafari = (ua.indexOf('safari') > -1) && (ua.indexOf('chrome') == -1);
                    var isOpera = (ua.indexOf('opera') > -1);
                    var isWindows = (ua.indexOf('windows') > -1);
                    var isMac = (ua.indexOf('macintosh') > -1);
                    var $html = $('html');
                    if (isWindows) {
                        $html.addClass('windows');
                    }
                    if (isMac) {
                        $html.addClass('mac');
                    }
                    if (isIE) {
                        $html.addClass('ie');
                    }
                    if (isIE6) {
                        $html.addClass('ie6');
                    }
                    if (isIE7) {
                        $html.addClass('ie7');
                    }
                    if (isIE8) {
                        $html.addClass('ie8');
                    }
                    if (isIE9) {
                        $html.addClass('ie9');
                    }
                    if (isIE10) {
                        $html.addClass('ie10');
                    }
                    if (isIE11) {
                        $html.addClass('ie11');
                    }
                    if (isEdge) {
                        $html.addClass('edge');
                    }
                    if (isChrome) {
                        $html.addClass('chrome');
                    }
                    if (isFirefox) {
                        $html.addClass('ff');
                    }
                    if (isSafari) {
                        $html.addClass('safari');
                    }
                    if (isOpera) {
                        $html.addClass('opera');
                    }
                })();

                function getWinWidth() {
                    var w = window.innerWidth;
                    return (w !== undefined) ? w : $win.width();
                }

                /* * RWD modal
                 ---------------------------------------------------------------- */
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
                    var isSp = getWinWidth() <= 480;
                    var y;
                    var load = function ($anchor) {
                        $html.removeClass('g-modal-init g-modal-multi g-modal-prev g-modal-next');
                        $('.pkg-LightBoxContent', $body).remove();
                        var uri = $anchor[0].href;
                        var $iframe = $('<iframe src="' + uri + '" class="g-modal_if"/>').appendTo($body)
                            .one('load', function () {
                                var count = 0;
                                var scrollWatch = function () {
                                    var $wrapper = $('.g-modal_wrapper');
                                    if ($wrapper.length > 0) {
                                        var window_height = window.innerHeight;
                                        if (window_height < $('.g-modal_box').height()) {
                                            var $body = $('.g-modal_body');
                                            var scTop = $wrapper.scrollTop();
                                            var vCenter = ((window_height) / 2);
                                            var btnTop = vCenter + scTop - (71 / 2);
                                            $('.set-responsiveWebDesign .g-modal_btn__outer').css({top: btnTop});
                                        } else {
                                            $outerBtn.css({top: ''});
                                        }
                                    }
                                }
                                setInterval(scrollWatch, 100);
                                $loading.show();
                                var _self = this;
                                var contentsLoad = function (_self) {
                                    var win = _self.contentWindow;
                                    var isSp = getWinWidth() <= 480;
                                    var duration = (isIE8 || !isSp) ? 500 : 0;
                                    var $el = win.document.querySelector('.pkg-LightBoxContent'); // ie >= 8
                                    if (isSp || Modernizr.touchevents) {
                                        $wrapper.css({overflow: 'hidden', height: $win.height()});
                                    }
                                    $hiddenbox.empty().append($el);
                                    $content = $hiddenbox.find('.pkg-LightBoxContent');
                                    $box.find('.pkg-LightBoxContent').css({opacity: 0});
                                    $ctrlInner.hide();
                                    $outerBtn.hide();
                                    $html.addClass('g-modal-init');
                                    if ($group.length > 0) {
                                        var index = $group.index($anchor);
                                        $pagination.html('<b>' + (index + 1) + '</b>/' + $group.length);
                                        $html.toggleClass('g-modal-prev', index !== 0);
                                        $prev.off().on('click', function () {
                                            load($group.eq(index - 1));
                                        });
                                        $html.toggleClass('g-modal-next', index !== $group.length - 1);
                                        $next.off().on('click', function () {
                                            load($group.eq(index + 1));
                                        });
                                        $ctrlInner.css('marginRight', $win.width() - $inner.width());
                                        $html.addClass('g-modal-multi');
                                    } else {
                                        $pagination.html('<b>1</b>/1');
                                    }
                                    $modal.scrollTop(0);

                                    var outerHeight = $content.height() + (70 * 2);
                                    if ($('html').hasClass('safari') && $('html').hasClass('mac')) {
                                        $box.css({width: '100%', height: outerHeight, minHeight: outerHeight});
                                    } else {
                                        $box.css({width: '100%', height: outerHeight});
                                    }
                                    setTimeout(function () {
                                        $('.pkg-LightBoxContent').css({visibility: 'hidden'});
                                        setTimeout(function () {
                                            $('.g-modal_ctrlInner').show();
                                            var window_height = $(window).height();
                                            if (window_height < $('.g-modal_box').height()) {
                                                var btn_top = window_height / 2 - (71 / 2);
                                                $outerBtn.css({top: btn_top});
                                            } else {
                                                $outerBtn.css({top: ''});
                                            }
                                            if ($('html').hasClass('g-modal-prev')) {
                                                $('.g-modal_btn__outer.g-modal_prev').show();
                                            }
                                            if ($('html').hasClass('g-modal-next')) {
                                                $('.g-modal_btn__outer.g-modal_next').show();
                                            }
                                            $('.pkg-LightBoxContent').css({visibility: 'visible'});
                                            $loading.hide();
                                            $(_self).parent().append($el)
                                        }, 100);
                                    }, 500);
                                    $modal.off().on('click', function (e2) {
                                        var el = e2.target;
                                        if (el === $box[0] || $.contains($box[0], el)) return;
                                        $modal.remove();
                                        $html.removeClass('g-modal g-modal-init g-modal-multi g-modal-prev g-modal-next');
                                        if (isSp || Modernizr.touchevents) {
                                            $wrapper.css({overflow: 'visible', height: 'auto'});
                                            $win.scrollTop(y);
                                        }
                                        $('#ContentsWrap').css({position: ''});
                                    });
                                    $close.off().on('click', function () {
                                        $modal.trigger('click');
                                    });
                                    $print.off().on('click', function () {
                                        var param = (uri.indexOf('?') === -1 ? '?' : '&') + 'print';
                                        window.open(uri + param, '_blank');
                                    });
                                }

                                setTimeout(function () {
                                    contentsLoad(_self)
                                }, 0);
                            });
                        clearTimeout(timer);
                        timer = setTimeout(function () {
                            $iframe.trigger('load');
                        }, 5000);
                        return $iframe;
                    };
                    $(window).on('orientationchange resize', function () {
                        if ($('.g-modal_box').length > 0) {
                            $('.g-modal_box').css({height: 'auto'});
                        }
                    });
                    $('.js-ModalOpen').on('click', function (e) {
                        e.preventDefault();
                        var $el = $(this);

                        var group = $('.js-ModalOpen').eq(0).data('modalgroup')
                        $group = group ? $('.js-ModalOpen[data-modalgroup="' + group + '"]') : [];
                        $html.addClass('g-modal');
                        $wrapper = $('.g-wrapper');
                        $modal = $('<div class="g-modal_wrapper"><div class="g-modal_loading"></div><div class="g-modal_outer"><div class="g-modal_inner"><div class="g-modal_box"><div class="g-modal_body"/><div class="g-modal_btn g-modal_close"/><div class="g-modal_btn g-modal_print"/><div class="g-modal_btn g-modal_btn__outer g-modal_prev"></div><div class="g-modal_btn g-modal_btn__outer g-modal_next"></div><div class="g-modal_ctrl"><div class="g-modal_ctrlInner"><div class="g-modal_btn g-modal_prev"/><div class="g-modal_btn g-modal_next"/></div></div><div class="g-modal_pagination"/></div></div></div><div class="g-modal_hidden_box" style="visibility: hidden;position: absolute;bottom: 0;width: 100%;box-sizing: border-box;"></div></div>').appendTo('body');
                        $inner = $('.g-modal_inner');
                        $box = $('.g-modal_box');
                        $body = $('.g-modal_body');
                        $close = $('.g-modal_close');
                        $print = $('.g-modal_print');
                        $prev = $('.g-modal_prev');
                        $outerBtn = $('.g-modal_btn__outer');
                        $next = $('.g-modal_next');
                        $hiddenbox = $('.g-modal_wrapper .g-modal_hidden_box');
                        $pagination = $('.g-modal_pagination');
                        $ctrlInner = $('.g-modal_ctrlInner');
                        $loading = $('.g-modal_loading');
                        load($el);
                        if (isSp || Modernizr.touchevents) {
                            y = $win.scrollTop();
                            $('.set-responsiveWebDesign .g-modal_loading').css({height: window.innerHeight});
                        } else {
                            $('.set-responsiveWebDesign .g-modal_loading').css({
                                'height': '100%',
                                'background-attachment': 'fixed'
                            });
                        }
                    });
                }());
            })();
        } else {

            /* *00.Settings
             ---------------------------------------------------------------- */
            var $pkgWindow = $(window);

            /* end Settings
             ---------------------------------------------------------------- */
            /* *02.Colorbox
             ---------------------------------------------------------------- */

            ///* Colorbox Default Setting Function */
            var $dgGlobalTimer = false;
            var $dgModalNextCont = false;
            var $dgModalPrevCont = false;
            var dgColorBoxDefaultSetting = function (t) {
                var Colorbox = $('#colorbox');
                var ModalPrevious = $('#ModalPrevious');
                var ModalNext = $('#ModalNext');

                var CloseOffset = Colorbox.position();
                var WindowWidth = $dgWindow.width();
                var LeftPosition = CloseOffset.left;
                var RightPosition = WindowWidth - (CloseOffset.left + Colorbox.width() - 30);
                var RightNextPosition = WindowWidth - (CloseOffset.left + Colorbox.width());

                if (t) {
                    var ModalHref = $(t).attr('href');
                    if (!$('#ModalPrint').length) {
                        $('#ModalContent').append('<button type="button" id="ModalPrint">print</button>');
                    }
                    $('#ModalPrint').unbind().click(function (e) {
                        var obj = $(this);
                        obj.attr('href', ModalHref + '?print');
                        window.open(obj.attr('href'));
                        return false;
                    });
                }

                if (CloseOffset.top <= 0) {
                    $('#ModalClose').css({'position': 'fixed', 'right': RightPosition + 'px'});
                    $('#ModalCurrent').css({'position': 'fixed', 'right': RightPosition + 'px'});
                    $('#ModalPrint').css({'position': 'fixed', 'right': RightPosition + 'px'});
                } else {
                    $('#ModalClose').css({'position': 'absolute', 'right': '0'});
                    $('#ModalCurrent').css({'position': 'absolute', 'right': '0'});
                    $('#ModalPrint').css({'position': 'absolute', 'right': '0'});
                }

                ModalPrevious.css('left', LeftPosition + 'px');
                ModalNext.css('right', RightNextPosition + 'px');
                $('#ModalClose,#ModalCurrent,#ModalPrint').show();
            };

            var $dgModalLength = $("a.js-ModalOpen").length;

            if ($dgModalLength) {

                for (var i = 0; i < $dgModalLength; i++) {
                    var $dgModalGrouping = $("a.js-ModalOpen").eq(i).attr('data-modalgroup');
                    $("a.js-ModalOpen").eq(i).colorbox({
                        rel: $dgModalGrouping,
                        'width': '920px',
                        current: '{current}/{total}',
                        loop: false,
                        returnFocus: false,
                        title: false,
                        loadingcontents: '#ModalContentsArea',
                        onComplete: function () {
                            if ($('#ModalNext').is(':visible')) {
                                $dgModalNextCont = true;
                            } else {
                                $dgModalNextCont = false;
                            }
                            if ($('#ModalPrevious').is(':visible')) {
                                $dgModalPrevCont = true;
                            } else {
                                $dgModalPrevCont = false;
                            }
                            dgColorBoxDefaultSetting(this);
                        }
                    });
                }

                $dgWindow.resize(function () {

                    $('#ModalClose,#ModalCurrent,#ModalPrint,#ModalNext,#ModalPrevious').hide();
                    if ($dgGlobalTimer !== false) {
                        clearTimeout($dgGlobalTimer);
                    }
                    $dgGlobalTimer = setTimeout(function () {
                        dgColorBoxDefaultSetting();
                        if ($dgModalNextCont) $('#ModalNext').show();
                        if ($dgModalPrevCont) $('#ModalPrevious').show();
                    }, 400);
                });
            }
        }

        /* end Colorbox
         ---------------------------------------------------------------- */


        /* *03.Tab Viewer
         ---------------------------------------------------------------- */

        var $dgTabViewer = $('.TabViewer');
        if ($dgTabViewer.length) {
            var dgTabViewer1Function = {
                SummeryHeightMaxArray: []
                , SummeryHeightMinArray: []
                , TabListLength: $('.TabViewer__List ul li', $dgTabViewer).size()
                , TabContent: $('.TabViewer__Switch', $dgTabViewer)
                , TabContentLength: $('.TabViewer__Content', this.TabContent).length
                , init: function () {
                    $('.TabViewer__Content', dgTabViewer1Function.TabContent).addClass('is-Show');
                    $('.TabViewer__Summary', dgTabViewer1Function.TabContent).addClass('is-Show').append('<a href="javascript:void(0);" class="TabViewer__Toggle"></a>').append('<p class="BlindMask"></p>');
                    for (var i = 0; i < dgTabViewer1Function.TabListLength; i++) {
                        dgTabViewer1Function.SummeryHeightMaxArray[i] = $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).children('.TabViewer__Summary').height();
                        $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).removeClass('is-Show');
                        $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).children('.TabViewer__Summary').removeClass('is-Show');
                        dgTabViewer1Function.SummeryHeightMinArray[i] = 138;
                        if (dgTabViewer1Function.SummeryHeightMaxArray[i] > dgTabViewer1Function.SummeryHeightMinArray[i]) {
                            $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).find('a.TabViewer__Toggle').toggle(
                                function () {
                                    var Index = $('.TabViewer__Content a.TabViewer__Toggle', dgTabViewer1Function.TabContent).index(this);
                                    $(this).next('.BlindMask').animate({
                                        height: '0'
                                    }, 300, 'swing');
                                    $(this).parent('.TabViewer__Summary').animate({
                                        height: dgTabViewer1Function.SummeryHeightMaxArray[Index] + 'px'
                                    }, 300, 'swing', function () {
                                        $(this).addClass('is-Show');
                                        $(this).children('a.TabViewer__Toggle').addClass('is-Close');
                                    });
                                },
                                function () {
                                    var Index = $('.TabViewer__Content a.TabViewer__Toggle', dgTabViewer1Function.TabContent).index(this);
                                    $(this).next('.BlindMask').animate({
                                        height: '41px'
                                    }, 300, 'swing');
                                    $(this).parent('.TabViewer__Summary').animate({
                                        height: dgTabViewer1Function.SummeryHeightMinArray[Index] + 'px'
                                    }, 300, 'swing', function () {
                                        $(this).removeClass('is-Show');
                                        $(this).children('a.TabViewer__Toggle').removeClass('is-Close');
                                    });
                                }
                            );
                        } else {
                            $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).find('.TabViewer__Toggle').addClass('Disable');
                            $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(i).find('.BlindMask').addClass('Disable');
                        }
                        $('.TabViewer__List ul li', $dgTabViewer).eq(i).find('a').click(
                            function () {
                                var Index = $('.TabViewer__List ul li a', $dgTabViewer).index(this);
                                var Check = $(this).parent('li').hasClass('is-Selected');
                                if (!Check) {
                                    $('.TabViewer__List ul li', $dgTabViewer).removeClass('is-Selected');
                                    $(this).parent('li').addClass('is-Selected');
                                    $('.TabViewer__Content', dgTabViewer1Function.TabContent).removeClass('is-Show');
                                    $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(Index).addClass('is-Show');
                                }
                            }
                        );
                    }
                    $('.TabViewer__Content', dgTabViewer1Function.TabContent).eq(0).addClass('is-Show');
                }
            };
            dgTabViewer1Function.init();
        }

        /* end Tab Viewer
         ---------------------------------------------------------------- */


        /* *04.Carousels
         ---------------------------------------------------------------- */

        var $dgjsCarousel2 = $('#js-SlideImg');
        if ($dgjsCarousel2.length) {
            $dgjsCarousel2.flexslider({
                namespace: "Carousel"
                , selector: ".Slides > li"
                , animation: "slide"
                , animationLoop: false
                , easing: "easeInOutQuad"
                , slideshow: false
                , itemWidth: 233
                , itemMargin: 1
                , animationSpeed: 900
                , start: function () {
                    $('.Carouselcontrol-nav,.Carouseldirection-nav', $dgjsCarousel2).wrapAll('<div id="ControlWrapper"></div>');
                }
            });
        }

        var $dgjsSlideContent = $('#js-SlideContent');
        if ($dgjsSlideContent.length) {
            $dgjsSlideContent.flexslider({
                namespace: "Carousel"
                , selector: ".Slides > li"
                , animation: "slide"
                , animationLoop: false
                , easing: "easeInOutQuad"
                , slideshow: false
                , itemWidth: 300
                , itemMargin: 30
                , animationSpeed: 1100
                , start: function () {
                    $('.Carouselcontrol-nav,.Carouseldirection-nav', $dgjsSlideContent).wrapAll('<div id="ControlWrapper"></div>');
                }
            });
        }

        var $dgNewsCarousel = $('.NewsCarousel');
        if ($dgNewsCarousel.length) {
            $dgNewsCarousel.flexslider({
                namespace: "News"
                , selector: "ul > li"
                , animation: "slide"
                , controlNav: false
                , directionNav: false
                , pauseOnHover: true
                , easing: "easeInOutQuad"
                , slideshowSpeed: 6000
                , animationSpeed: 1200
            });
        }

        /* end Carousels
         ---------------------------------------------------------------- */


        /* *05.Hash Scroll (+Tab Block)
         ---------------------------------------------------------------- */
        if ($PageHash) {
            if ($('.js-TabBlock').length) {
                var dgTabChangeLoad = {
                    init: function (h) {
                        var jsTabBlock = $('.js-TabBlock');
                        var TabNavLength = jsTabBlock.length;
                        if ($(h).length) {
                            var TargetIndex = $(h).index() - 1;
                            var IncludeBlockIndex = $(h).parent('.js-TabBlock').index('.js-TabBlock');
                            var TargetTabBlockSet = jsTabBlock.eq(IncludeBlockIndex);
                            $('ul.TabNav li', TargetTabBlockSet).removeClass('is-Selected');
                            $('.Tab__Content', TargetTabBlockSet).removeClass('is-Show');
                            $('ul.TabNav--Top li', TargetTabBlockSet).eq(TargetIndex).addClass('is-Selected');
                            $('.Tab__Content', TargetTabBlockSet).eq(TargetIndex).addClass('is-Show');
                            $('ul.TabNav--Btm li', TargetTabBlockSet).eq(TargetIndex).addClass('is-Selected');
                        }
                    }
                };
                dgTabChangeLoad.init($PageHash);
            }
            var Path = location.pathname;
            var Pattern = ['/corporate/','/investor/','/faq/'], i = 0, len = Pattern.length;
            var PageTarget = $($PageHash);
            var PatternFlg = true;
            while (i < len) {
              if (!Path.indexOf(Pattern[i++])) {
                PatternFlg = false;
                break;
              }
            }
            if (PatternFlg) {
              if (PageTarget.length) {
                var PageTargetTop = PageTarget.offset().top - $dgHeaderHeight;
                $('html, body').animate({scrollTop: PageTargetTop}, 800, 'swing');
              }
            }
        }

        /* end Hash Scroll
         ---------------------------------------------------------------- */


        /* *06.Excerpt Roll Up Layer
         ---------------------------------------------------------------- */

        var $dgRollUpList = $('.js-RollUp');

        if ($dgRollUpList.length) {
            var RollUpFunction = {
                RollUpLength: $dgRollUpList.length
                , ListLengthArray: []
                , ListHeightArray: []
                , HeadHeightArray: []
                , TopArray: []
                , HeadCheck: 'h3'
                , RollUpMargin: 20
                , init: function () {
                    for (var v = 0; v < RollUpFunction.RollUpLength; v++) {
                        var RollUpObj = $dgRollUpList.eq(v);
                        RollUpFunction.ListLengthArray[v] = RollUpObj.find('li').length;
                        RollUpFunction.ListHeightArray[v] = RollUpObj.find('li').height();
                        if ($('dt', RollUpObj).length) {
                            RollUpFunction.HeadCheck = 'dt';
                            RollUpFunction.RollUpMargin = 15;
                        } else if ($('h3', RollUpObj).length) {
                            RollUpFunction.HeadCheck = 'h3';
                            RollUpFunction.RollUpMargin = 20;
                        }
                        RollUpFunction.HeadHeightArray[v] = [];
                        RollUpFunction.TopArray[v] = [];
                        for (var i = 0; i < RollUpFunction.ListLengthArray[v]; i++) {
                            RollUpFunction.HeadHeightArray[v][i] = $('li', RollUpObj).eq(i).find(RollUpFunction.HeadCheck).height() + RollUpFunction.RollUpMargin;
                            RollUpFunction.TopArray[v][i] = RollUpFunction.ListHeightArray[v] - RollUpFunction.HeadHeightArray[v][i];
                            $('li', RollUpObj).eq(i).children('a').css('top', RollUpFunction.TopArray[v][i] + 'px');
                            $('li', RollUpObj).eq(i).bind({
                                'mouseenter': function () {
                                    $('a', this).stop(true, false).animate({
                                        top: 0
                                    }, 400, 'easeOutExpo');
                                },
                                'mouseleave': function () {
                                    var ParentIndex = $dgRollUpList.index($(this).closest($dgRollUpList));
                                    var Index = $dgRollUpList.eq(ParentIndex).find('li').index(this);
                                    $('a', this).stop(true, false).animate({
                                        top: RollUpFunction.TopArray[ParentIndex][Index] + 'px'
                                    }, 500, 'easeInExpo');
                                }
                            });
                            $('li', RollUpObj).eq(i).children('a').focus(function () {
                                $(this).css('top', '0');
                            });
                            $('li', RollUpObj).eq(i).children('a').blur(function () {
                                var ParentIndex = $dgRollUpList.index($(this).closest($dgRollUpList));
                                var Index = $dgRollUpList.eq(ParentIndex).find('li').index(this);
                                $(this).css('top', RollUpFunction.TopArray[ParentIndex][Index] + 'px');
                            });
                        }
                    }
                }
            };
            RollUpFunction.init();
        }

        /* end Excerpt Roll Up Layer
         ---------------------------------------------------------------- */

        /* *07.Mega Menu
         ---------------------------------------------------------------- */

        if ($dgGlobalNavWrap.length) {

            var ContentsWrap = $('#ContentsWrap');
            var HeaderShrinking = $('#HeaderShrinking');
            var hasCategoryNav = $('body').hasClass('g-page-categoryNav') || $('body').hasClass('g-page-normalMegaMenu');

            var dgMegaMenuFunction = {
                MegaMenuWrap: $('.MegaMenuWrap')
                , MegaMenuArea: $('.MegaMenuArea')
                , MegaMenuContent: $('.MegaMenu_Content')
                , MegaMenuLength: $('li', $dgGlobalNavArea).length
                , MegaMenuProductWhiteList: ['products']
                , MegaMenuAboutWhiteList: ['corporate']
                , MegaMenuInveWhiteList: ['investor']
                , MegaMenuSusWhiteList: ['csr']
                , MegaMenuCareersWhiteList: ['careers']
                , MegaMenuNewsWhiteList: ['news', 'press']
                , MegaMenuHeightArray: []
                , MegaMenuDisableClass: 'js-Disable'
                , MegaMenuHasDisableClass: false
                , MegaMenuHoverIndex: ''
                , MegaMenuCloseTimer: ''
                , MegaMenuSetTimer: ''
                , MegaMenuMinHeight: ''
                , init: function () {

                    //Overlay
                    ContentsWrap.append('<div id="MegaMenu_Overlay"></div>');
                    $dgGlobalNavArea.prepend('<div id="Gnav_Overlay"></div>');

                    // ABOUT Current
                    var WhiteListLength = dgMegaMenuFunction.MegaMenuAboutWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuAboutWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(0).addClass($dgCurrentClass);
                        }
                    }

                    // PRODUCTS AND SERVICES Current
                    WhiteListLength = dgMegaMenuFunction.MegaMenuProductWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuProductWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(1).addClass($dgCurrentClass);
                        }
                    }


                    // INVESTOR RELATIONS Current
                    WhiteListLength = dgMegaMenuFunction.MegaMenuInveWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuInveWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(2).addClass($dgCurrentClass);
                        }
                    }

                    // SUSTAINABILITY Current
                    WhiteListLength = dgMegaMenuFunction.MegaMenuSusWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuSusWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(3).addClass($dgCurrentClass);
                        }
                    }

                    // CAREERS Current
                    WhiteListLength = dgMegaMenuFunction.MegaMenuCareersWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuCareersWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(4).addClass($dgCurrentClass);
                        }
                    }

                    // NEWS Current
                    WhiteListLength = dgMegaMenuFunction.MegaMenuNewsWhiteList.length;

                    for (var i = 0; i < WhiteListLength; i++) {
                        if (dgMegaMenuFunction.MegaMenuNewsWhiteList[i] == $dgCurrentFolder) {
                            $('li', $dgGlobalNavArea).eq(5).addClass($dgCurrentClass);
                        }
                    }
                    // for Touch device
                    // var supportTouch = 'ontouchend' in document;
                    var supportTouch = true;
                    var supportPointer = window.navigator.msMaxTouchPoints;

                    if (supportTouch) {
                        /*
                         $('body').css({
                         'cursor': 'pointer'
                         });
                         */
                        $('.MegaMenuWrap').addClass('is-Active');
                    } else if (supportPointer > 0) {
                        $('.MegaMenuWrap').addClass('is-Active');
                    }

                    dgMegaMenuFunction.MegaMenuSetHeightFunction();
                    dgMegaMenuFunction.MegaMenuContent.css('position', 'absolute');
                    if (!hasCategoryNav) {
                        dgMegaMenuFunction.MegaMenuCaluculateMinHeight();
                    }
                    $dgWindow.on('resize', function () {
                        if ($('body').hasClass('set-responsiveWebDesign') && $dgWindow.width() > 960) {
                            dgMegaMenuFunction.MegaMenuSetHeightFunction();
                        }
                        if (!hasCategoryNav) {
                            dgMegaMenuFunction.MegaMenuCaluculateMinHeight();
                        }
                    });
                    if (supportTouch) {
                        dgMegaMenuFunction.MegaMenuClickFunction();
                    } else if (supportPointer > 0) {
                        dgMegaMenuFunction.MegaMenuClickFunction();
                    }
                    /*if(!$dgBrowserUA.Mobile) {
                     for(var i=0;i<dgMegaMenuFunction.MegaMenuLength;i++) {
                     var hasDisable = $('li', $dgGlobalNavArea).eq(i).hasClass(dgMegaMenuFunction.MegaMenuDisableClass);
                     if(hasDisable) {
                     $('li', $dgGlobalNavArea).eq(i).bind({
                     'mouseenter':function() {
                     //alert('mouseenter1');
                     dgMegaMenuFunction.MegaMenuHoverIndex = $('li', $dgGlobalNavArea).index(this);
                     $(this).addClass($dgHoverClass);
                     },
                     'mouseleave':function() {
                     $(this).removeClass($dgHoverClass);
                     }
                     });
                     } else {
                     $('li', $dgGlobalNavArea).eq(i).bind({
                     'mouseenter':function() {
                     //alert('mouseenter2');
                     dgMegaMenuFunction.MegaMenuHoverIndex = $('li', $dgGlobalNavArea).index(this);
                     dgMegaMenuFunction.MegaMenuMouseHoverFunction();
                     },
                     'mouseleave':function() {
                     clearTimeout(dgMegaMenuFunction.MegaMenuSetTimer);
                     dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                     dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                     }
                     });
                     dgMegaMenuFunction.MegaMenuArea.bind({
                     'mouseenter':function() {
                     //alert('mouseenter3');
                     dgMegaMenuFunction.MegaMenuMouseHoverFunction();
                     },
                     'mouseleave':function() {
                     clearTimeout(dgMegaMenuFunction.MegaMenuSetTimer);
                     dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                     dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                     }
                     });

                     }
                     }
                     }*/
                },
                MegaMenuCaluculateMinHeight: function () {
                    var winHeight = $(window).height();
                    var headerHeight = HeaderShrinking.height();
                    dgMegaMenuFunction.MegaMenuMinHeight = winHeight - headerHeight;
                },
                MegaMenuMouseHoverFunction: function () {
                    $('li', $dgGlobalNavWrap).eq(dgMegaMenuFunction.MegaMenuHoverIndex).addClass($dgHoverClass);
                    clearTimeout(dgMegaMenuFunction.MegaMenuCloseTimer);
                    dgMegaMenuFunction.MegaMenuSetTimer = setTimeout(function () {
                        dgMegaMenuFunction.MegaMenuWrap.css('paddingBottom', '25px');
                        var WrapHeight = dgMegaMenuFunction.MegaMenuHeightArray[dgMegaMenuFunction.MegaMenuHoverIndex];
                        var TempIndex = dgMegaMenuFunction.MegaMenuHoverIndex;
                        if (!hasCategoryNav && WrapHeight > dgMegaMenuFunction.MegaMenuMinHeight) {
                            dgMegaMenuFunction.MegaMenuContent.eq(TempIndex).addClass('MegaMenuScrollBar').height(dgMegaMenuFunction.MegaMenuMinHeight);
                        } else {
                            dgMegaMenuFunction.MegaMenuContent.eq(TempIndex).removeClass('MegaMenuScrollBar').height('auto');
                        }
                        dgMegaMenuFunction.MegaMenuArea.show().stop(true, false).animate({
                            height: WrapHeight + 'px'
                        });
                        if (!dgMegaMenuFunction.MegaMenuContent.eq(TempIndex).hasClass($dgShowClass)) {
                            dgMegaMenuFunction.MegaMenuContent.fadeOut(100);
                            dgMegaMenuFunction.MegaMenuContent.removeClass($dgShowClass);
                            dgMegaMenuFunction.MegaMenuContent.eq(TempIndex).stop(true, true).fadeIn(200, function () {
                                dgMegaMenuFunction.MegaMenuContent.eq(TempIndex).addClass($dgShowClass);
                            });
                            $('#MegaMenu_Overlay').fadeIn(200);
                        }
                    }, 200);
                },
                MegaMenuClickFunction: function () {
                    $dgGlobalNavWrap.each(function () {
                        var globalNavArea = $(this).find($dgGlobalNavArea)
                            , globalNavAreaLi = globalNavArea.find('li').not('.js-Disable')
                            , liDisable = globalNavArea.find('li.js-Disable')
                            ;
                        globalNavAreaLi.on('mouseenter', function () {
                            dgMegaMenuFunction.MegaMenuHoverIndex = $('li', $dgGlobalNavArea).index(this);
                            dgMegaMenuFunction.MegaMenuMouseHoverFunction();
                            $(this).parent().children().removeClass('is-Hover');
                            $(this).addClass('is-Hover');
                        }).mouseleave(function () {
                            $dgHeaderWrap.on('mouseenter', function () {
                                dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                                dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                            });

                            dgMegaMenuFunction.MegaMenuArea.on('mouseenter', function () {
                            }).mouseleave(function () {
                                dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                                dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                            });

                            liDisable.on('mouseenter', function () {
                                dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                                dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                            });

                            $('body').on('mouseenter', '#Gnav_Overlay', function () {
                                dgMegaMenuFunction.MegaMenuCloseTimerFunction();
                                dgMegaMenuFunction.MegaMenuMouseLeaveFunction();
                            });
                        });
                    });
                },
                MegaMenuSetHeightFunction: function () {
                    dgMegaMenuFunction.MegaMenuArea.show().css('visible', 'hidden');
                    for (var i = 0; i < dgMegaMenuFunction.MegaMenuLength; i++) {
                        dgMegaMenuFunction.MegaMenuContent.eq(i).height('auto');
                        dgMegaMenuFunction.MegaMenuHeightArray[i] = dgMegaMenuFunction.MegaMenuContent.eq(i).height();
                    }
                    dgMegaMenuFunction.MegaMenuArea.css({'visible': 'show', 'height': '0'}).hide();
                },
                MegaMenuMouseLeaveFunction: function () {
                    $('li', $dgGlobalNavWrap).removeClass($dgHoverClass);
                },
                MegaMenuCloseTimerFunction: function () {
                    dgMegaMenuFunction.MegaMenuCloseTimer = setTimeout(dgMegaMenuFunction.MegaMenuCloseFunction, 200);
                },
                MegaMenuCloseFunction: function () {
                    dgMegaMenuFunction.MegaMenuHasDisableClass = $('li', $dgGlobalNavArea).eq(dgMegaMenuFunction.MegaMenuHoverIndex).hasClass(dgMegaMenuFunction.MegaMenuDisableClass);
                    if (dgMegaMenuFunction.MegaMenuHasDisableClass || !$('li', $dgGlobalNavWrap).hasClass($dgHoverClass)) {
                        clearTimeout(dgMegaMenuFunction.MegaMenuCloseTimer);
                        dgMegaMenuFunction.MegaMenuContent.removeClass($dgShowClass);
                        dgMegaMenuFunction.MegaMenuArea.fadeOut(200);
                        $('#MegaMenu_Overlay').fadeOut(200);
                        setTimeout(function () {
                            dgMegaMenuFunction.MegaMenuWrap.css('paddingBottom', '0');
                            dgMegaMenuFunction.MegaMenuArea.hide().css('height', '0');
                            $('#MegaMenu_Overlay').hide();
                        }, 200);
                    }
                }
            };
            dgMegaMenuFunction.init();
        }

        /* end Mega Menu
         ---------------------------------------------------------------- */

        /* *08.KeyVisual Print Dummy Background
         ---------------------------------------------------------------- */
        if ($dgKeyVisualObj.length) {
            dgKeyVisualPath = {
                Path: $('.KeyVisual #KeyVisualWrap').css('background-image')
                , FileName: ''
                , init: function () {
                    dgKeyVisualPath.FileName = dgKeyVisualPath.Path.match(/https?:\/\/[-_.!~*'()a-zA-Z0-9;\/?:@&=+$,%#]+[a-z]/g);
                    if (!dgKeyVisualPath.FileName) return false;
                    $dgKeyVisualObj.append('<div class="KeyVisualPrintBackground"><div class="BackgroundInner"><img src="' + dgKeyVisualPath.FileName + '" alt=""></div></div>');
                }
            }
            dgKeyVisualPath.init();
        }
        /* end KeyVisual Print Dummy Background
         ---------------------------------------------------------------- */

        /* 99.IE7,IE8 png Bug Fix
         ---------------------------------------------------------------- */

        if ($dgBrowserUA.IE) {
            $('img.' + $dgHoverClass).each(function () {
                if ($(this).attr('src').indexOf('.png') != -1) {
                    $(this).css({'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + $(this).attr('src') + '", sizingMethod="scale");'});
                }
            });
        }

        /* end IE7,IE8 png Bug Fix
         ---------------------------------------------------------------- */


    });
})(jQuery);