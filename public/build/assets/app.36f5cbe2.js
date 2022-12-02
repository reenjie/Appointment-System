var D=(a,i)=>()=>(i||a((i={exports:{}}).exports,i),i.exports);var q=D((N,g)=>{window._=require("lodash");try{require("bootstrap")}catch{}window.axios=require("axios");window.axios.defaults.headers.common["X-Requested-With"]="XMLHttpRequest";/**
 * Timeago is a jQuery plugin that makes it easy to support automatically
 * updating fuzzy timestamps (e.g. "4 minutes ago" or "about 1 day ago").
 *
 * @name timeago
 * @version 1.6.7
 * @requires jQuery >=1.5.0 <4.0
 * @author Ryan McGeary
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 *
 * For usage and examples, visit:
 * http://timeago.yarp.com/
 *
 * Copyright (c) 2008-2019, Ryan McGeary (ryan -[at]- mcgeary [*dot*] org)
 */(function(a){typeof define=="function"&&define.amd?define(["jquery"],a):typeof g=="object"&&typeof g.exports=="object"?a(require("jquery")):a(jQuery)})(function(a){a.timeago=function(t){return t instanceof Date?s(t):s(typeof t=="string"?a.timeago.parse(t):typeof t=="number"?new Date(t):a.timeago.datetime(t))};var i=a.timeago;a.extend(a.timeago,{settings:{refreshMillis:6e4,allowPast:!0,allowFuture:!1,localeTitle:!1,cutoff:0,autoDispose:!0,strings:{prefixAgo:null,prefixFromNow:null,suffixAgo:"ago..",suffixFromNow:"from now",inPast:"any moment now",seconds:"About a Seconds",minute:"about a minute",minutes:"%d minutes",hour:"about an hour",hours:"about %d hours",day:"a day",days:"%d days",month:"about a month",months:"%d months",year:"about a year",years:"%d years",wordSeparator:" ",numbers:[]}},inWords:function(t){if(!this.settings.allowPast&&!this.settings.allowFuture)throw"timeago allowPast and allowFuture settings can not both be set to false.";var e=this.settings.strings,n=e.prefixAgo,w=e.suffixAgo;if(this.settings.allowFuture&&t<0&&(n=e.prefixFromNow,w=e.suffixFromNow),!this.settings.allowPast&&t>=0)return this.settings.strings.inPast;var u=Math.abs(t)/1e3,f=u/60,d=f/60,o=d/24,v=o/365;function r(c,m){var T=a.isFunction(c)?c(m,t):c,M=e.numbers&&e.numbers[m]||m;return T.replace(/%d/i,M)}var x=u<45&&r(e.seconds,Math.round(u))||u<90&&r(e.minute,1)||f<45&&r(e.minutes,Math.round(f))||f<90&&r(e.hour,1)||d<24&&r(e.hours,Math.round(d))||d<42&&r(e.day,1)||o<30&&r(e.days,Math.round(o))||o<45&&r(e.month,1)||o<365&&r(e.months,Math.round(o/30))||v<1.5&&r(e.year,1)||r(e.years,Math.round(v)),y=e.wordSeparator||"";return e.wordSeparator===void 0&&(y=" "),a.trim([n,x,w].join(y))},parse:function(t){var e=a.trim(t);return e=e.replace(/\.\d+/,""),e=e.replace(/-/,"/").replace(/-/,"/"),e=e.replace(/T/," ").replace(/Z/," UTC"),e=e.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"),e=e.replace(/([\+\-]\d\d)$/," $100"),new Date(e)},datetime:function(t){var e=i.isTime(t)?a(t).attr("datetime"):a(t).attr("title");return i.parse(e)},isTime:function(t){return a(t).get(0).tagName.toLowerCase()==="time"}});var l={init:function(){l.dispose.call(this);var t=a.proxy(h,this);t();var e=i.settings;e.refreshMillis>0&&(this._timeagoInterval=setInterval(t,e.refreshMillis))},update:function(t){var e=t instanceof Date?t:i.parse(t);a(this).data("timeago",{datetime:e}),i.settings.localeTitle&&a(this).attr("title",e.toLocaleString()),h.apply(this)},updateFromDOM:function(){a(this).data("timeago",{datetime:i.parse(i.isTime(this)?a(this).attr("datetime"):a(this).attr("title"))}),h.apply(this)},dispose:function(){this._timeagoInterval&&(window.clearInterval(this._timeagoInterval),this._timeagoInterval=null)}};a.fn.timeago=function(t,e){var n=t?l[t]:l.init;if(!n)throw new Error("Unknown function name '"+t+"' for timeago");return this.each(function(){n.call(this,e)}),this};function h(){var t=i.settings;if(t.autoDispose&&!a.contains(document.documentElement,this))return a(this).timeago("dispose"),this;var e=b(this);return isNaN(e.datetime)||(t.cutoff===0||Math.abs(p(e.datetime))<t.cutoff?a(this).text(s(e.datetime)):a(this).attr("title").length>0&&a(this).text(a(this).attr("title"))),this}function b(t){if(t=a(t),!t.data("timeago")){t.data("timeago",{datetime:i.datetime(t)});var e=a.trim(t.text());i.settings.localeTitle?t.attr("title",t.data("timeago").datetime.toLocaleString()):e.length>0&&!(i.isTime(t)&&t.attr("title"))&&t.attr("title",e)}return t.data("timeago")}function s(t){return i.inWords(p(t))}function p(t){return new Date().getTime()-t.getTime()}document.createElement("abbr"),document.createElement("time")})});export default q();
