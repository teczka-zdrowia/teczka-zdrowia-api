webpackJsonp([18],{m5Jo:function(a,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var e=n("Dd8w"),i=n.n(e),c=n("YVw1"),l=n("mfxR"),o=n("NYxO"),s=(n("8M/P"),{name:"ActivatePlace",data:function(){return{isLoading:!1}},computed:i()({},Object(o.c)({place:"modal/data"})),methods:i()({},Object(o.b)({hideModal:"modal/hide",updatePlace:"userRoles/updatePlace"}),{activatePlace:function(){var a=this;this.isLoading=!0;var t={id:this.place.id,data:{is_active:!0}};this.updatePlace(t).then(function(){return a.hideModal()}).catch(function(a){return Object(l.a)(a)}).finally(function(){a.isLoading=!1})}}),components:{MainBtn:c.a}}),d={render:function(){var a=this,t=a.$createElement,n=a._self._c||t;return n("div",{staticClass:"modal--da"},[n("h1",{staticClass:"modal__title"},[a._v("\n    Aktywacja gabinetu\n  ")]),a._v(" "),n("div",{staticClass:"modal__info"},[a._v("\n    Czy na pewno chcesz aktywować gabinet "),n("b",[a._v(a._s(a.place.name))]),a._v("?\n  ")]),a._v(" "),n("div",{staticClass:"modal__actions"},[n("button",{staticClass:"modal__btn modal__btn--grey",attrs:{type:"button"},on:{click:a.hideModal}},[a._v("Anuluj\n    ")]),a._v(" "),n("MainBtn",{staticClass:"modal__btn modal__btn--violet",attrs:{loading:a.isLoading,disabled:a.isLoading,color:"#fafafa"},nativeOn:{click:function(t){return a.activatePlace(t)}}},[a._v("Aktywuj\n    ")])],1)])},staticRenderFns:[]},u=n("VU/8")(s,d,!1,null,null,null);t.default=u.exports}});
//# sourceMappingURL=18.c89d52923276bb079719.js.map