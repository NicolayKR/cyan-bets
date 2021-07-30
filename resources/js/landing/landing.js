'use strict';

$(function() {


  /*
  |--------------------------------------------------------------------------
  | Configure your website
  |--------------------------------------------------------------------------
  |
  | We provided several configuration variables for your ease of development.
  | Read their complete description and modify them based on your need.
  |
  */

  page.config({

    /*
    |--------------------------------------------------------------------------
    | Google API Key
    |--------------------------------------------------------------------------
    |
    | Here you may specify your Google API key if you need to use Google Maps
    | in your application
    |
    | https://developers.google.com/maps/documentation/javascript/get-api-key
    |
    */

    googleApiKey: 'AIzaSyDRBLFOTTh2NFM93HpUA4ZrA99yKnCAsto',

    /*
    |--------------------------------------------------------------------------
    | Google Analytics Tracking
    |--------------------------------------------------------------------------
    |
    | If you want to use Google Analytics, you can specify your Tracking ID in
    | this option. Your key would be a value like: UA-12345678-9
    |
    */

    googleAnalyticsId: 'UA-73325209-2',

    /*
    |--------------------------------------------------------------------------
    | Google reCAPTCHA
    |--------------------------------------------------------------------------
    |
    | reCAPTCHA protects you against spam and other types of automated abuse.
    | Please signup for an API key pair and insert your `Site key` value to the
    | following variable.
    |
    | http://www.google.com/recaptcha/admin
    |
    */

    reCaptchaSiteKey:  '6Ldaf0MUAAAAAHdsMv_7dND7BSTvdrE6VcQKpM-n',

    // See available languages: https://developers.google.com/recaptcha/docs/language
    reCaptchaLanguage: '',

    /*
    |--------------------------------------------------------------------------
    | Disable AOS on mobile
    |--------------------------------------------------------------------------
    |
    | If true, the Animate On Scroll animations don't run on mobile devices.
    |
    */

    disableAOSonMobile: true,

    /*
    |--------------------------------------------------------------------------
    | Smooth Scroll
    |--------------------------------------------------------------------------
    |
    | If true, the browser's scrollbar moves smoothly on scroll and gives your
    | visitor a better experience for scrolling.
    |
    */

    smoothScroll: true,

  });





  /*
  |--------------------------------------------------------------------------
  | Custom Javascript code
  |--------------------------------------------------------------------------
  |
  | Now that you configured your website, you can write additional Javascript
  | code below this comment. You might want to add more plugins and initialize
  | them in this file.
  |
  */

  $.getScript('https://www.googletagmanager.com/gtag/js?id=AW-864788073');
  
  function gtag_report_conversion(url) {
    var callback = function () {
      if (typeof(url) != 'undefined') {
        window.location = url;
      }
    };
    gtag('event', 'conversion', {
        'send_to': 'AW-864788073/SK3PCMCPsZMBEOm8rpwD',
        'event_callback': callback
    });
    return false;
  }
  
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-864788073');
  
  $('a[href*="https://themeforest.net"]').on('click', function() {
    //gtag_report_conversion();
    ga('send', 'event', {
      eventCategory: 'TheSaaS - Buy',
      eventAction: 'Click',
      eventLabel: 'Buy',
      transport: 'beacon'
    });
  });
  
  
  $(document).on('click', '.fo-icon, .fo-popup', function() {
    ga('send', 'event', {
      eventCategory: 'Formito - TheSaaS',
      eventAction: 'Click',
      eventLabel: 'Badge',
      transport: 'beacon'
    });
  });

});



(function ($, window, document) {
  $(document).ready(function () {
    var queryParams = getQueryParams(document.location.search)
    var storedParams = storeParams(queryParams)
    var urlAttachment = createURLAttachment(storedParams)

	if ( urlAttachment === '' ) {
		return;
	}
    history.pushState(null, '', location.href.split('?')[0])
    $('a[href*="/19778599"]').each(function () {
		var href = $(this).attr('href')
		$(this).attr('href', href + '&' + urlAttachment)
    })
  })
  function getQueryParams (qs) {
    qs = qs.split('+').join(' ')
    var params = {}
    var tokens
    var re = /[?&]?([^=]+)=([^&]*)/g
    while (tokens = re.exec(qs)) {
      params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2])
    }
    return params
  }
  function getCookie (cName) {
    var i; var x; var y; var ARRcookies = document.cookie.split(';')
    for (i = 0; i < ARRcookies.length; i++) {
      x = ARRcookies[i].substr(0, ARRcookies[i].indexOf('='))
      y = ARRcookies[i].substr(ARRcookies[i].indexOf('=') + 1)
      x = x.replace(/^\s+|\s+$/g, '')
      if (x === cName) {
        return unescape(y)
      }
    }
  }
  function storeParams (p) {
    var cookieName = 'urlparams'
    if (p.gclid) {
      var today = new Date()
      var expires = new Date(today.getTime() + 60 * 24 * 60 * 60 * 1000)
      var data = { gclid: '' }
      if (p.gclid) data.gclid = p.gclid
      document.cookie = cookieName + '=' + JSON.stringify(data) + '; expires=' + expires
    }
    var c = getCookie(cookieName)
    if (c) return JSON.parse(c)
    return undefined
  }
  function createURLAttachment (p) {
    if (!p) return ''
    var attachment = ''
    if (p.gclid) attachment += 'gclid=' + p.gclid + '&'
    attachment = attachment.substr(0, attachment.length - 1)
    return attachment
  }
})(jQuery, window, document)

//!function(e,t,n,s,u,a){e.formito_form='11q';u=t.createElement(n),u.async=!0,u.src='//script.formito.com/v1/formito.js',a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a)}(window,document,'script');

//!function(t,d,e,i,n){(n=d.body).insertAdjacentHTML("beforeend",'<div data-formito-id="91GdcdyvBtL5uwZS1yCR" data-trigger="fab"></div>'),(i=d.createElement("script")).async=!0,i.src="https://s.formito.com/ft.js",n.appendChild(i)}(window,document);
