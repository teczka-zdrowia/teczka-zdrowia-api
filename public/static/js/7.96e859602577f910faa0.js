webpackJsonp([7],{byXt:function(t,n,e){"use strict";Object.defineProperty(n,"__esModule",{value:!0});var a=e("Xxa5"),i=e.n(a),o=e("exGp"),r=e.n(o),s=e("//Fk"),u=e.n(s),d=e("woOf"),c=e.n(d),l=e("Dd8w"),h=e.n(l),f=e("ctaT"),p=e("NYxO"),v=(e("8M/P"),{name:"SignAgreement",data:function(){return{apiUrl:f.a,drawing:null}},computed:h()({},Object(p.c)({data:"modal/data",historyData:"addHistory/data"})),methods:h()({},Object(p.b)({hideModal:"modal/hide",setHistory:"addHistory/setData"}),{saveAppointmentAgreement:function(){var t=this;this.drawing.toBlob(function(n){var e=c()(t.historyData,{agreement:n});t.setHistory(e),t.hideModal()})},addImageProcess:function(t){return new u.a(function(n,e){var a=new Image;a.onload=function(){return n(a)},a.onerror=e,a.src=t,a.crossOrigin="anonymous"})}}),mounted:function(){var t=r()(i.a.mark(function t(){var n,e,a,o,r,s,u,d,c,l,h,p,v,x,y,m,g,w,b,_,C,P,T,A,M,O,k,W,D,I;return i.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return D=function(t){return void 0===navigator.maxTouchPoints&&(navigator.appVersion.indexOf("Android")>-1||navigator.appVersion.indexOf("iPhone")>-1||navigator.appVersion.indexOf("iPad")>-1)&&(navigator.maxTouchPoints=5),navigator.maxTouchPoints>0?W(t):k(t)},W=function(t){var e={points:[],x:0,y:0,count:0,w:0,rx:0,ry:0},i=e,o=e.points;function r(){for(var t=0;t<i.pCount;t++)if(-1===o[t].id)return o[t]}function s(t){for(var n=0;n<i.pCount;n++)if(o[n].id===t)return o[n]}function u(t,e,a,i){void 0!==t&&(a?(t.oy=e.pageX,t.ox=e.pageY,t.id=e.identifier):(t.ox=t.x,t.oy=t.y),t.x=e.pageX,t.y=e.pageY-window.scrollY,t.down=i,i||(t.id=-1,C=null,n.drawing=h))}function d(t){var n,e;if(e=t.changedTouches,"touchstart"===t.type)for(n=0;n<e.length;n++)u(r(),e[n],!0,!0);else if("touchmove"===t.type)for(n=0;n<e.length;n++)u(s(e[n].identifier),e[n],!1,!0);else if("touchend"===t.type)for(n=0;n<e.length;n++)u(s(e[n].identifier),e[n],!1,!1);return function(){for(var t=0,n=0;n<i.pCount;n++)-1!==o[n].id&&(0===t&&(i.x=o[n].x,i.y=o[n].y),t+=1);i.count=t}(),t.preventDefault(),!1}return e.pCount=navigator.maxTouchPoints,t=void 0===t?document:t,a(navigator.maxTouchPoints,function(){return e.points.push({x:0,y:0,dx:0,dy:0,down:!1,id:-1})}),["touchstart","touchmove","touchend"].forEach(function(n){return t.addEventListener(n,d)}),e},k=function(t){var e={points:[],x:0,y:0,count:0,w:0,rx:0,ry:0},i=e,o=e.points;function r(t){if(o[0].id===t)return o[0]}function s(t,e,a,i){void 0!==t&&(a?(t.oy=e.pageX,t.ox=e.pageY,t.id=0):(t.ox=t.x,t.oy=t.y),t.x=e.pageX,t.y=e.pageY-window.scrollY,t.down=i,i||(t.id=-1,C=null,n.drawing=h))}function u(t){var n;return"mousedown"===t.type?s(function(){if(-1===o[0].id)return o[0]}(),t,!0,!0):"mousemove"===t.type?s(r(0),t,!1,!0):"mouseup"===t.type&&s(r(0),t,!1,!1),n=0,-1!==o[0].id&&(0===n&&(i.x=o[0].x,i.y=o[0].y),n+=1),i.count=n,t.preventDefault(),!1}return t=void 0===t?document:t,a(1,function(){return e.points.push({x:0,y:0,dx:0,dy:0,down:!1,id:-1})}),["mousedown","mousemove","mouseup"].forEach(function(n){return t.addEventListener(n,u)}),e},O=function t(n){c&&T(),n,s.setTransform(1,0,0,1,0,0),s.globalAlpha=1,s.globalCompositeOperation="source-over",A===innerWidth&&M===innerHeight||((A=canvas.width=innerWidth)/2,(M=canvas.height=innerHeight)/2),s.clearRect(0,0,A,M),I.apply(),s.fillStyle="black",s.globalAlpha=.4,s.fillRect(5,v,p-5,5),s.fillRect(p,5,5,v),s.globalAlpha=1,s.drawImage(h,0,0),s.setTransform(1,0,0,1,0,0),1!==w.count&&!u||d?2===w.count||d?(b.length=0,0===w.count?d=!1:d||2!==w.count?I.movePinch(w.points[0],w.points[1]):(d=!0,I.setPinch(w.points[0],w.points[1]))):(d=!1,u=!1):0===w.count?(u=!1,P()):(I.toWorld(w,r),b.push({x:r.x,y:r.y}),u?P():b.length>o&&(u=!0)),requestAnimationFrame(t)},T=function(){c=!1,I.setContext(s)},P=function(){for(x.fillStyle="black",x.lineWidth=.005*l.width;_<b.length;_++){var t=b[_];null!=C&&(x.beginPath(),x.moveTo(C.x,C.y),x.lineTo(t.x,t.y),x.lineCap="round",x.stroke()),C={x:t.x,y:t.y}}},n=this,e=f.a+"/storage/files/"+this.data.template,void 0,a=function(t,n){for(var e=0;e<t&&!0!==n(e++););},o=3,r={x:0,y:0},s=canvas.getContext("2d"),u=!1,d=!1,c=!0,t.next=18,this.addImageProcess(e);case 18:l=t.sent,h=document.createElement("canvas"),p=h.width=l.width,v=h.height=l.height,(x=h.getContext("2d")).fillStyle="transparent",x.fillRect(0,0,p,v),x.drawImage(l,0,0),y=window.innerWidth/l.width,m=960/l.height,g=window.innerWidth<960?y:m,w=D(canvas),s.font="16px arial.",b=[],_=0,C=null,A=canvas.width,M=canvas.height,A/2,M/2,requestAnimationFrame(O),I=function(){var t,n=[1,0,0,1,0,0],e=[1,0,0,1,0,0],a=n,i=e,o=g,r=0,s={x:0,y:0},u={x:0,y:0},d=0,c=1,l=0,h=0,f={x:0,y:0},p=!0;return{canvasDefault:function(){t.setTransform(1,0,0,1,0,0)},apply:function(){p&&this.update(),t.setTransform(a[0],a[1],a[2],a[3],a[4],a[5])},reset:function(){o=1,r=0,f.x=0,f.y=0,p=!0},matrix:n,invMatrix:e,update:function(){p=!1,a[3]=a[0]=Math.cos(r)*o,a[2]=-(a[1]=Math.sin(r)*o),a[4]=f.x,a[5]=f.y,this.invScale=1/o;var t=a[0]*a[3]-a[1]*a[2];i[0]=a[3]/t,i[1]=-a[1]/t,i[2]=-a[2]/t,i[3]=a[0]/t},toWorld:function(t){var n,e,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return p&&this.update(),n=t.x-a[4],e=t.y-a[5],o.x=n*i[0]+e*i[2],o.y=n*i[1]+e*i[3],o},toScreen:function(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return p&&this.update(),n.x=t.x*a[0]+t.y*a[2]+a[4],n.y=t.x*a[1]+t.y*a[3]+a[5],n},setPinch:function(t,n){p&&this.update(),s.x=t.x,s.y=t.y;var e=n.x-s.x,a=n.y-s.y;d=Math.sqrt(e*e+a*a),h=Math.atan2(a,e),c=o,l=r,this.toWorld(s,u)},movePinch:function(t,n,e){p&&this.update();var i=n.x-t.x,s=n.y-t.y,v=Math.sqrt(i*i+s*s);if(o=c*(v/d),!e){var x=Math.atan2(s,i);r=l+(x-h)}this.update(),f.x=t.x-u.x*a[0]-u.y*a[2],f.y=t.y-u.x*a[1]-u.y*a[3],p=!0},setContext:function(n){t=n,p=!0}}}();case 40:case"end":return t.stop()}},t,this)}));return function(){return t.apply(this,arguments)}}()}),x={render:function(){var t=this.$createElement,n=this._self._c||t;return n("div",{staticClass:"modal--sa"},[n("canvas",{ref:"canvas",attrs:{id:"canvas"}}),this._v(" "),n("div",{staticClass:"modal__actions fullwidth modal--sa__action rounded"},[n("button",{staticClass:"modal__btn fullwidth",on:{click:this.hideModal}},[n("span",{staticClass:"fas fa-times",attrs:{"aria-hidden":"true"}}),this._v("\n      Anuluj\n    ")]),this._v(" "),n("button",{staticClass:"modal__btn fullwidth modal__btn--violet",on:{click:this.saveAppointmentAgreement}},[n("span",{staticClass:"fas fa-save",attrs:{"aria-hidden":"true"}}),this._v("\n      Zapisz\n    ")])])])},staticRenderFns:[]};var y=e("VU/8")(v,x,!1,function(t){e("zO8I")},"data-v-36234499",null);n.default=y.exports},zO8I:function(t,n){}});
//# sourceMappingURL=7.96e859602577f910faa0.js.map