/* Do version 2.0 pre
 * creator: kejun (listenpro@gmail.com)
 * 最新更新：2011-7-12
 */
(function(c,w){var o={},t={},a={},v={autoLoad:true,timeout:6000,coreLib:[],mods:{}},p=(function(){var d=w.getElementsByTagName("script");return d[d.length-1]})(),e=[],h,j=[],n=false,b={},u={},k=function(d){return d.constructor===Array},i=function(x){var q=v.mods,d;if(typeof x==="string"){d=(q[x])?q[x]:{path:x}}else{d=x}return d},g=function(d,C,x,y){var B,q,D,A,z=function(){o[d]=1;y&&y(d);y=null;c.clearTimeout(B)};if(!d){return}if(o[d]){a[d]=false;if(y){y(d)}return}if(a[d]){setTimeout(function(){g(d,C,x,y)},10);return}a[d]=true;B=c.setTimeout(function(){if(v.timeoutCallback){try{v.timeoutCallback(d)}catch(E){}}},v.timeout);D=C||d.toLowerCase().split(/\./).pop().replace(/[\?#].*/,"");if(D==="js"){q=w.createElement("script");q.setAttribute("type","text/javascript");q.setAttribute("src",d);q.setAttribute("async",true)}else{if(D==="css"){q=w.createElement("link");q.setAttribute("type","text/css");q.setAttribute("rel","stylesheet");q.setAttribute("href",d)}}if(x){q.charset=x}if(D==="css"){A=new Image();A.onerror=function(){z();A.onerror=null;A=null};A.src=d}else{q.onerror=function(){z();q.onerror=null};q.onload=q.onreadystatechange=function(){var E;if(!this.readyState||this.readyState==="loaded"||this.readyState==="complete"){z();q.onload=q.onreadystatechange=null}}}p.parentNode.insertBefore(q,p)},l=function(C,x){var D=v.mods,d,q,A,y=0,z;d=C.join("");z=C.length;if(t[d]){x();return}function B(){if(!--z){t[d]=1;x()}}for(;q=C[y++];){A=i(q);if(A.requires){l(A.requires,(function(E){return function(){g(E.path,E.type,E.charset,B)}})(A))}else{g(A.path,A.type,A.charset,B)}}}
/*!
   * contentloaded.js
   *
   * Author: Diego Perini (diego.perini at gmail.com)
   * Summary: cross-browser wrapper for DOMContentLoaded
   * Updated: 20101020
   * License: MIT
   * Version: 1.2
   *
   * URL:
   * http://javascript.nwbox.com/ContentLoaded/
   * http://javascript.nwbox.com/ContentLoaded/MIT-LICENSE
   *
   */
,s=function(A){var q=false,z=true,C=c.document,B=C.documentElement,F=C.addEventListener?"addEventListener":"attachEvent",D=C.addEventListener?"removeEventListener":"detachEvent",d=C.addEventListener?"":"on",E=function(G){if(G.type=="readystatechange"&&C.readyState!="complete"){return}(G.type=="load"?c:C)[D](d+G.type,E,false);if(!q&&(q=true)){A.call(c,G.type||G)}},y=function(){try{B.doScroll("left")}catch(G){setTimeout(y,50);return}E("poll")};if(C.readyState=="complete"){A.call(c,"lazy")}else{if(C.createEventObject&&B.doScroll){try{z=!c.frameElement}catch(x){}if(z){y()}}C[F](d+"DOMContentLoaded",E,false);C[F](d+"readystatechange",E,false);c[F](d+"load",E,false)}},f=function(){var d=0,q;if(j.length){for(;q=j[d++];){r.apply(this,q)}}},r=function(){var d=[].slice.call(arguments),q,x;if(v.autoLoad&&!t[v.coreLib.join("")]){l(v.coreLib,function(){r.apply(null,d)});return}if(e.length>0&&!t[e.join("")]){l(e,function(){r.apply(null,d)});return}if(typeof d[d.length-1]==="function"){q=d.pop()}x=d.join("");if((d.length===0||t[x])&&q){q();return}l(d,function(){t[x]=1;q&&q()})};r.add=r.define=function(q,d){if(!q||!d||!d.path){return}v.mods[q]=d};r.delay=function(){var q=[].slice.call(arguments),d=q.shift();c.setTimeout(function(){r.apply(this,q)},d)};r.global=function(){var d=k(arguments[0])?arguments[0]:[].slice.call(arguments);e=e.concat(d)};r.ready=function(){var d=[].slice.call(arguments);if(n){return r.apply(this,d)}j.push(d)};r.css=function(q){var d=w.getElementById("do-inline-css");if(!d){d=w.createElement("style");d.type="text/css";d.id="do-inline-css";p.parentNode.insertBefore(d,p)}if(d.styleSheet){d.styleSheet.cssText=d.styleSheet.cssText+q}else{d.appendChild(w.createTextNode(q))}};r.setData=r.setPublicData=function(x,q){var d=u[x];b[x]=q;if(!d){return}while(d.length>0){(d.pop()).call(this,q)}};r.getData=r.getPublicData=function(q,d){if(b[q]){d(b[q]);return}if(!u[q]){u[q]=[]}u[q].push(function(x){d(x)})};r.setConfig=function(q,d){v[q]=d;return r};r.getConfig=function(d){return v[d]};h=p.getAttribute("data-cfg-autoload");if(h){v.autoLoad=(h.toLowerCase()==="true")?true:false}h=p.getAttribute("data-cfg-corelib");if(h){v.coreLib=h.split(",")}if(typeof Do!=="undefined"){e=Do.global.mods;v.mods=Do.mods;var m;while(m=Do.actions.shift()){r.apply(null,m)}delete Do}c.Do=r;s(function(){n=true;f()})})(window,document);