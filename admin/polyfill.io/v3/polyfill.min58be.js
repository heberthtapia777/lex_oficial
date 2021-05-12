/* Disable minification (remove `.min` from URL path) for more info */

(function(self, undefined) {function IsCallable(n){return"function"==typeof n}if (!("Date"in self&&"now"in self.Date&&"getTime"in self.Date.prototype
)) {Date.now=function e(){return(new Date).getTime()};}if (!("defineProperty"in Object&&function(){try{var e={}
return Object.defineProperty(e,"test",{value:42}),!0}catch(t){return!1}}()
)) {!function(e){var t=Object.prototype.hasOwnProperty.call(Object.prototype,"__defineGetter__"),r="A property cannot both have accessors and be writable or have a value";Object.defineProperty=function n(o,i,c){if(e&&(o===window||o===document||o===Element.prototype||o instanceof Element))return e(o,i,c);if(null===o||!(o instanceof Object||"object"==typeof o))throw new TypeError("Object.defineProperty called on non-object");if(!(c instanceof Object))throw new TypeError("Property description must be an object");var a=String(i),f="value"in c||"writable"in c,p="get"in c&&typeof c.get,s="set"in c&&typeof c.set;if(p){if("function"!==p)throw new TypeError("Getter must be a function");if(!t)throw new TypeError("Getters & setters cannot be defined on this javascript engine");if(f)throw new TypeError(r);Object.__defineGetter__.call(o,a,c.get)}else o[a]=c.value;if(s){if("function"!==s)throw new TypeError("Setter must be a function");if(!t)throw new TypeError("Getters & setters cannot be defined on this javascript engine");if(f)throw new TypeError(r);Object.__defineSetter__.call(o,a,c.set)}return"value"in c&&(o[a]=c.value),o}}(Object.defineProperty);}function CreateMethodProperty(e,r,t){var a={value:t,writable:!0,enumerable:!1,configurable:!0};Object.defineProperty(e,r,a)}if (!("bind"in Function.prototype
)) {CreateMethodProperty(Function.prototype,"bind",function t(n){var r=Array,o=Object,e=r.prototype,l=function g(){},p=e.slice,a=e.concat,i=e.push,c=Math.max,u=this;if(!IsCallable(u))throw new TypeError("Function.prototype.bind called on incompatible "+u);for(var y,h=p.call(arguments,1),s=function(){if(this instanceof y){var t=u.apply(this,a.call(h,p.call(arguments)));return o(t)===t?t:this}return u.apply(n,a.call(h,p.call(arguments)))},f=c(0,u.length-h.length),b=[],d=0;d<f;d++)i.call(b,"$"+d);return y=Function("binder","return function ("+b.join(",")+"){ return binder.apply(this, arguments); }")(s),u.prototype&&(l.prototype=u.prototype,y.prototype=new l,l.prototype=null),y});}if (!("requestAnimationFrame"in self
)) {!function(n){var e,t=Date.now(),o=function(){return n.performance&&"function"==typeof n.performance.now?n.performance.now():Date.now()-t};if("mozRequestAnimationFrame"in n?e="moz":"webkitRequestAnimationFrame"in n&&(e="webkit"),e)n.requestAnimationFrame=function(t){return n[e+"RequestAnimationFrame"](function(){t(o())})},n.cancelAnimationFrame=n[e+"CancelAnimationFrame"];else{var i=Date.now();n.requestAnimationFrame=function(n){if("function"!=typeof n)throw new TypeError(n+" is not a function");var e=Date.now(),t=16+i-e;return t<0&&(t=0),i=e,setTimeout(function(){i=Date.now(),n(o())},t)},n.cancelAnimationFrame=function(n){clearTimeout(n)}}}(self);}if (!("Window"in self
)) {"undefined"==typeof WorkerGlobalScope&&"function"!=typeof importScripts&&function(o){o.constructor?o.Window=o.constructor:(o.Window=o.constructor=new Function("return function Window() {}")()).prototype=self}(self);}if (!("getComputedStyle"in self
)) {!function(t){function e(t,o,r){var n,i=t.document&&t.currentStyle[o].match(/([\d.]+)(%|cm|em|in|mm|pc|pt|)/)||[0,0,""],l=i[1],u=i[2];return r=r?/%|em/.test(u)&&t.parentElement?e(t.parentElement,"fontSize",null):16:r,n="fontSize"==o?r:/width/i.test(o)?t.clientWidth:t.clientHeight,"%"==u?l/100*n:"cm"==u?.3937*l*96:"em"==u?l*r:"in"==u?96*l:"mm"==u?.3937*l*96/10:"pc"==u?12*l*96/72:"pt"==u?96*l/72:l}function o(t,e){var o="border"==e?"Width":"",r=e+"Top"+o,n=e+"Right"+o,i=e+"Bottom"+o,l=e+"Left"+o;t[e]=(t[r]==t[n]&&t[r]==t[i]&&t[r]==t[l]?[t[r]]:t[r]==t[i]&&t[l]==t[n]?[t[r],t[n]]:t[l]==t[n]?[t[r],t[n],t[i]]:[t[r],t[n],t[i],t[l]]).join(" ")}function r(t){var r,n=this,i=t.currentStyle,l=e(t,"fontSize"),u=function(t){return"-"+t.toLowerCase()};for(r in i)if(Array.prototype.push.call(n,"styleFloat"==r?"float":r.replace(/[A-Z]/,u)),"width"==r)n[r]=t.offsetWidth+"px";else if("height"==r)n[r]=t.offsetHeight+"px";else if("styleFloat"==r)n["float"]=i[r];else if(/margin.|padding.|border.+W/.test(r)&&"auto"!=n[r])n[r]=Math.round(e(t,r,l))+"px";else if(/^outline/.test(r))try{n[r]=i[r]}catch(c){n.outlineColor=i.color,n.outlineStyle=n.outlineStyle||"none",n.outlineWidth=n.outlineWidth||"0px",n.outline=[n.outlineColor,n.outlineWidth,n.outlineStyle].join(" ")}else n[r]=i[r];o(n,"margin"),o(n,"padding"),o(n,"border"),n.fontSize=Math.round(l)+"px"}r.prototype={constructor:r,getPropertyPriority:function(){throw new Error("NotSupportedError: DOM Exception 9")},getPropertyValue:function(t){return this[t.replace(/-\w/g,function(t){return t[1].toUpperCase()})]},item:function(t){return this[t]},removeProperty:function(){throw new Error("NoModificationAllowedError: DOM Exception 7")},setProperty:function(){throw new Error("NoModificationAllowedError: DOM Exception 7")},getPropertyCSSValue:function(){throw new Error("NotSupportedError: DOM Exception 9")}},t.getComputedStyle=function n(t){return new r(t)}}(self);}if (!("document"in self&&"documentElement"in self.document&&"style"in self.document.documentElement&&"scrollBehavior"in document.documentElement.style||function(){try{var e=!1,t={top:0,left:0}
return Object.defineProperty(t,"behavior",{get:function(){return e=!0,"smooth"},enumerable:!0}),document.body.scrollTo(t),e}catch(n){return!1}}()
)) {!function(){"use strict";function e(e){var t="function"==typeof Symbol&&Symbol.iterator,n=t&&e[t],o=0;if(n)return n.call(e);if(e&&"number"==typeof e.length)return{next:function(){return e&&o>=e.length&&(e=void 0),{value:e&&e[o++],done:!e}}};throw new TypeError(t?"Object is not iterable.":"Symbol.iterator is not defined.")}function t(e,t){var n="function"==typeof Symbol&&e[Symbol.iterator];if(!n)return e;var o,r,i=n.call(e),a=[];try{for(;(void 0===t||t-- >0)&&!(o=i.next()).done;)a.push(o.value)}catch(c){r={error:c}}finally{try{o&&!o.done&&(n=i["return"])&&n.call(i)}finally{if(r)throw r.error}}return a}function n(e,t,n,o,r,i,a,c){return i<e&&a>t||i>e&&a<t?0:i<=e&&c<=n||a>=t&&c>=n?i-e-o:a>t&&c<n||i<e&&c>n?a-t+r:0}var o,r,i,a,c,l=function(){return l=Object.assign||function e(t){for(var n,o=1,r=arguments.length;o<r;o++){n=arguments[o];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])}return t},l.apply(this,arguments)},u=function(e){return.5*(1-Math.cos(Math.PI*e))},f=function(){return(performance&&performance.now?performance:Date).now()},s=function(e){var t=f(),n=(t-e.timeStamp)/(e.duration||500);if(n>1)return e.method(e.targetX,e.targetY),void e.callback();var o=(e.timingFunc||u)(n),r=e.startX+(e.targetX-e.startX)*o,i=e.startY+(e.targetY-e.startY)*o;e.method(r,i),e.rafId=requestAnimationFrame(function(){s(e)})},d=function(){return o===undefined&&(o=Element.prototype.scroll||Element.prototype.scrollTo||function(e,t){this.scrollLeft=e,this.scrollTop=t}),o},w=function(e,t){var n=d().bind(e);if(t.left!==undefined||t.top!==undefined){var o=e.scrollLeft,r=e.scrollTop,i=t.left,a=void 0===i?o:i,c=t.top,l=void 0===c?r:c;if("smooth"!==t.behavior)return n(a,l);var u=function(){window.removeEventListener("wheel",p),window.removeEventListener("touchmove",p)},w={timeStamp:f(),duration:t.duration,startX:o,startY:r,targetX:a,targetY:l,rafId:0,method:n,timingFunc:t.timingFunc,callback:u},p=function(){cancelAnimationFrame(w.rafId),u()};window.addEventListener("wheel",p,{passive:!0,once:!0}),window.addEventListener("touchmove",p,{passive:!0,once:!0}),s(w)}},p=function(e){var n=d();Element.prototype.scroll=function o(){var o=t(arguments,2),r=o[0],i=void 0===r?0:r,a=o[1],c=void 0===a?0:a;if("number"==typeof i&&"number"==typeof c)return n.call(this,i,c);if(Object(i)!==i)throw new TypeError("Failed to execute 'scroll' on 'Element': parameter 1 ('options') is not an object.");return w(this,l(l({},i),e))}},m=function(e,t){var n=(t.left||0)+e.scrollLeft,o=(t.top||0)+e.scrollTop;return w(e,l(l({},t),{left:n,top:o}))},h=function(e){Element.prototype.scrollBy=function n(){var n=t(arguments,2),o=n[0],r=void 0===o?0:o,i=n[1],a=void 0===i?0:i;if("number"==typeof r&&"number"==typeof a)return m(this,{left:r,top:a});if(Object(r)!==r)throw new TypeError("Failed to execute 'scrollBy' on 'Element': parameter 1 ('options') is not an object.");return m(this,l(l({},r),e))}},v=function(e,t,n,o){var r=0===t&&n||1===t&&!n?e.inline:e.block;return"center"===r?1:"nearest"===r?0:"start"===r?0===t?o?5:4:2:"end"===r?0===t?o?4:5:3:n?0===t?0:2:0===t?4:0},b=function(e){return"visible"!==e&&"clip"!==e},y=function(e){if(e.clientHeight<e.scrollHeight||e.clientWidth<e.scrollWidth){var t=getComputedStyle(e);return b(t.overflowY)||b(t.overflowX)}return!1},g=function(e){var t=e.parentNode;return t&&(t.nodeType===Node.DOCUMENT_FRAGMENT_NODE?t.host:t)},E=function(t,o){var r,i;if(t.ownerDocument.documentElement.contains(t)){for(var a=document.scrollingElement||document.documentElement,c=[],u=g(t);null!==u;u=g(u)){if(u===a){c.push(u);break}u===document.body&&y(u)&&!y(document.documentElement)||y(u)&&c.push(u)}var f=window.visualViewport?window.visualViewport.width:innerWidth,s=window.visualViewport?window.visualViewport.height:innerHeight,d=window.scrollX||window.pageXOffset,p=window.scrollY||window.pageYOffset,m=t.getBoundingClientRect(),h=m.height,b=m.width,E=m.top,T=m.right,O=m.bottom,k=m.left,j=getComputedStyle(t),F=j.writingMode||j.webkitWritingMode||j.getPropertyValue("-ms-writing-mode")||"horizontal-tb",x=["horizontal-tb","lr","lr-tb","rl"].some(function(e){return e===F}),W=["vertical-rl","tb-rl"].some(function(e){return e===F}),X=v(o,0,x,W),Y=v(o,1,x,W),I=function(){switch(Y){case 2:case 0:return E;case 3:return O;default:return E+h/2}}(),L=function(){switch(X){case 1:return k+b/2;case 5:return T;default:return k}}(),M=[];try{for(var S=e(c),B=S.next();!B.done;B=S.next()){var V=B.value;!function(e){var t=e.getBoundingClientRect(),r=t.height,i=t.width,c=t.top,u=t.right,m=t.bottom,v=t.left,y=getComputedStyle(e),g=parseInt(y.borderLeftWidth,10),E=parseInt(y.borderTopWidth,10),T=parseInt(y.borderRightWidth,10),O=parseInt(y.borderBottomWidth,10),k=0,j=0,F="offsetWidth"in e?e.offsetWidth-e.clientWidth-g-T:0,x="offsetHeight"in e?e.offsetHeight-e.clientHeight-E-O:0;if(a===e){switch(Y){case 2:k=I;break;case 3:k=I-s;break;case 1:k=I-s/2;break;case 0:k=n(p,p+s,s,E,O,p+I,p+I+h,h)}switch(X){case 4:j=L;break;case 5:j=L-f;break;case 1:j=L-f/2;break;case 0:j=n(d,d+f,f,g,T,d+L,d+L+b,b)}k=Math.max(0,k+p),j=Math.max(0,j+d)}else{switch(Y){case 2:k=I-c-E;break;case 3:k=I-m+O+x;break;case 1:k=I-(c+r/2)+x/2;break;case 0:k=n(c,m,r,E,O+x,I,I+h,h)}switch(X){case 4:j=L-v-g;break;case 5:j=L-u+T+F;break;case 1:j=L-(v+i/2)+F/2;break;case 0:j=n(v,u,i,g,T+F,L,L+b,b)}var W=e.scrollLeft,S=e.scrollTop;k=Math.max(0,Math.min(S+k,e.scrollHeight-r+x)),j=Math.max(0,Math.min(W+j,e.scrollWidth-i+F)),I+=S-k,L+=W-j}M.push(function(){return w(e,l(l({},o),{top:k,left:j}))})}(V)}}catch(H){r={error:H}}finally{try{B&&!B.done&&(i=S["return"])&&i.call(S)}finally{if(r)throw r.error}}M.forEach(function(e){return e()})}},T=function(){return r===undefined&&(r=document.documentElement.scrollIntoView),r},O=function(e){var t=T();Element.prototype.scrollIntoView=function n(o){if("boolean"==typeof o||o===undefined)return t.call(this,o);if(Object(o)!==o)throw new TypeError("Failed to execute 'scrollIntoView' on 'Element': parameter 1 ('options') is not an object.");return E(this,l(l({},o),e))}},k=function(e){var n=d();Element.prototype.scrollTo=function o(){var o=t(arguments,2),r=o[0],i=void 0===r?0:r,a=o[1],c=void 0===a?0:a;if("number"==typeof i&&"number"==typeof c)return n.call(this,i,c);if(Object(i)!==i)throw new TypeError("Failed to execute 'scrollTo' on 'Element': parameter 1 ('options') is not an object.");return w(this,l(l({},i),e))}},j=function(){return i===undefined&&(i=(window.scroll||window.scrollTo).bind(window)),i},F=function(e){var t=j();if(e.left!==undefined||e.top!==undefined){var n=window.scrollX||window.pageXOffset,o=window.scrollY||window.pageYOffset,r=e.left,i=void 0===r?n:r,a=e.top,c=void 0===a?o:a;if("smooth"!==e.behavior)return t(i,c);var l=function(){window.removeEventListener("wheel",d),window.removeEventListener("touchmove",d)},u={timeStamp:f(),duration:e.duration,startX:n,startY:o,targetX:i,targetY:c,rafId:0,method:t,timingFunc:e.timingFunc,callback:l},d=function(){cancelAnimationFrame(u.rafId),l()};window.addEventListener("wheel",d,{passive:!0,once:!0}),window.addEventListener("touchmove",d,{passive:!0,once:!0}),s(u)}},x=function(e){var n=j();window.scroll=function o(){var o=t(arguments,2),r=o[0],i=void 0===r?0:r,a=o[1],c=void 0===a?0:a;if("number"==typeof i&&"number"==typeof c)return n.call(this,i,c);if(Object(i)!==i)throw new TypeError("Failed to execute 'scroll' on 'Window': parameter 1 ('options') is not an object.");return F(l(l({},i),e))}},W=function(e){var t=(e.left||0)+(window.scrollX||window.pageXOffset),n=(e.top||0)+(window.scrollY||window.pageYOffset);return"smooth"!==e.behavior?j()(t,n):F(l(l({},e),{left:t,top:n}))},X=function(e){var n=function(){return a===undefined&&(a=window.scrollBy.bind(window)),a}();window.scrollBy=function o(){var o=t(arguments,2),r=o[0],i=void 0===r?0:r,a=o[1],c=void 0===a?0:a;if("number"==typeof i&&"number"==typeof c)return n.call(this,i,c);if(Object(i)!==i)throw new TypeError("Failed to execute 'scrollBy' on 'Window': parameter 1 ('options') is not an object.");return W(l(l({},i),e))}},Y=function(){return c===undefined&&(c=(window.scrollTo||window.scroll).bind(window)),c},I=function(e){var n=Y();window.scrollTo=function o(){var o=t(arguments,2),r=o[0],i=void 0===r?0:r,a=o[1],c=void 0===a?0:a;if("number"==typeof i&&"number"==typeof c)return n.call(this,i,c);if(Object(i)!==i)throw new TypeError("Failed to execute 'scrollTo' on 'Window': parameter 1 ('options') is not an object.");return F(l(l({},i),e))}};!function(e){"scrollBehavior"in document.documentElement.style||(x(e),I(e),X(e),p(e),k(e),h(e),O(e))}()}();}})('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});