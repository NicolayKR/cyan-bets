'use strict';

$(function() {

  page.config({
    googleApiKey: 'AIzaSyDRBLFOTTh2NFM93HpUA4ZrA99yKnCAsto',
    googleAnalyticsId: 'UA-73325209-2',
    reCaptchaSiteKey:  '6Ldaf0MUAAAAAHdsMv_7dND7BSTvdrE6VcQKpM-n',
    reCaptchaLanguage: '',
    disableAOSonMobile: true,
    smoothScroll: true,

  });
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