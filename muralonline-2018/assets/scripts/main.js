/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        var isMobile = false;

        if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
            isMobile = true;
        }

        if (!isMobile) {
          $(window).on('scroll', function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 500) {
              $('body').addClass('scrolled');
            } else {
              $('body').removeClass('scrolled');
            }
          });

          $('.footer-fixed-menu').hover(function() {
            $(this).find('.footer-fixed-menu__wrapper').stop().fadeIn('fast');
          }, function() {
            $(this).find('.footer-fixed-menu__wrapper').stop().fadeOut('fast');
          });
        } else {
          $('.footer-fixed-menu__toggler').on('click', function() {
            $('.footer-fixed-menu__wrapper').toggle();
          });
        }

        //Shop Property filter dropdown
        $('.property_filter_selector_trigger').click(function() {
          $('.property_filter_selector_dropdown').slideToggle();
        });

        $('.property_filter_searchbutton').click(function(e) {
          e.preventDefault();

          var terms_id    = $('input[name="tax_input[bairro][]"]:checked');
          var order_by    = $('#property_filter_orderby').val();
          var terms_comma = '';

          if( terms_id === '' ) {
            alert('Please, select a location first');
            return false;
          }

          $.each( terms_id, function(index, val) {
            if( terms_comma === '') {
              terms_comma = val.value;
            } else {
              terms_comma = terms_comma + ',' + val.value;
            }
          });

          terms_comma = terms_comma.replace(/,\s*$/, "");

          if( ! order_by ) {
            order_by = 'name_asc';
          }

          console.log( terms_comma );
          console.log( order_by );

          //window.location.replace( home_url + 'shop-search/?terms=' + terms_comma + '&order_by=' + order_by );
          window.location.href = home_url + 'shop-search/?terms=' + terms_comma + '&order_by=' + order_by;

          return;
        });

        //Escolha o Estado / Cidade / Bairro
        $('.selectit').click(function(e) {
          var selected_item_name = $(this).text();
          var current_text       = '';
          var final_text         = '';
          var text_status        = $('.property_filter_selector_trigger').attr('data-status');

          console.log( 'selected_item_name: ' + selected_item_name );
          console.log( 'text_status: ' + text_status );

          if( text_status === 'populated' ) {
            current_text = $('.property_filter_selector_trigger').text();
          }

          console.log( 'current_text: ' + current_text );

          if ( current_text.toLowerCase().indexOf( selected_item_name.toLowerCase() ) < 0 ) {
            //add it
            if(text_status === 'empty') {
              final_text = selected_item_name;
            } else {
              final_text = current_text + ', ' + selected_item_name;
            }

            $('.property_filter_selector_trigger').text(final_text).attr('data-status', 'populated');
          }
        });
      },
      finalize: function() {

        if($('body').hasClass('logged-in')){
          $('#menu-item-170 a').attr('href', 'https://muraldigitalonline.com.br/publicador-account/');
        }

        $('.slider-ad-boxes').slick({
          rows: 2,
          slidesPerRow: 4,
          responsive: [{

             breakpoint: 768,
             settings: {
               rows: 3,
               slidesPerRow: 1,
               infinite: true
             }

           }]
        });

        if( $('#wppb-login-wrap').length ) {
          console.log('login page');
          $('a[href$="/cadastrarse/"]').next('a').remove();
          $('a[href$="/cadastrarse/"]').remove();

          $('<a href="http://muraldigitalonline.com.br/recuperar-a-minha-senha/">Recuperar a minha senha</a>').insertAfter('#wppb-login-wrap');
        }

        //Search filter trigger on change
        if( $('#property_filter_orderby').length ) {
          $('#property_filter_orderby').change(function(event) {
            $('.property_filter_searchbutton').click();
          });
        }

        $('.woocommerce-message').on('click', function() {
          $(this).fadeOut('fast');
        });
      }
    },
    // Home page
    'home': {
      init: function() {
        $('.marquee').marquee({
          duration: 15000,
        });
        $('.slider-items').slick({
          arrows: false,
          autoplay: true
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    'page_template_faq': {
      init: function() {
        $('article h3').click(function(event){
          event.preventDefault();
          $(this).parents('article').toggleClass('active');
        });
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
