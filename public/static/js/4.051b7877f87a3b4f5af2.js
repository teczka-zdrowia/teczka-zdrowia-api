webpackJsonp([4],{"9YAh":function(t,a,n){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var e=n("Xxa5"),o=n.n(e),p=n("exGp"),i=n.n(p),d=n("Dd8w"),s=n.n(d),u=n("5bl4"),c=n("YVw1"),l=n("NYxO"),r=n("mfxR"),m=(n("8M/P"),{name:"UpdateAppointment",data:function(){return{isLoading:!1}},computed:s()({},Object(l.c)({data:"modal/data",appointmentData:"updateAppointment/data",appointmentOldData:"updateAppointment/oldData"})),methods:s()({},Object(l.b)({hideModal:"modal/hide",showModal:"modal/show",updateUserAppointment:"updateAppointment/update",updateLocalAppointmentsByMe:"appointmentsByMe/updateLocal",updateLocalPlaceAppointments:"placeAppointments/updateLocal",updateLocalUserAppointments:"userAppointments/updateLocal"}),{updateAppointment:function(){var t=i()(o.a.mark(function t(){var a,n=this;return o.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return this.isLoading=!0,a={id:this.appointmentOldData.id,data:this.appointmentData},t.next=4,this.updateUserAppointment(a).then(function(t){n.updateLocally(t),n.$toasted.success("Poprawnie zaktualizowano wizytę"),n.showModal({componentName:"AppointmentInfo",data:{hideBorders:!0,viewerType:"author",appointment:t}})}).catch(function(t){return Object(r.a)(t)});case 4:this.isLoading=!1;case 5:case"end":return t.stop()}},t,this)}));return function(){return t.apply(this,arguments)}}(),updateLocally:function(t){this.updateLocalAppointmentsByMe(t),this.updateLocalPlaceAppointments(t),this.updateLocalUserAppointments(t)}}),components:{UpdateAppointmentComponent:u.a,MainBtn:c.a}}),f={render:function(){var t=this,a=t.$createElement,n=t._self._c||a;return n("form",{staticClass:"modal--ua",on:{submit:function(a){return a.preventDefault(),t.updateAppointment(a)}}},[n("UpdateAppointmentComponent"),t._v(" "),n("div",{staticClass:"modal__actions"},[n("button",{staticClass:"modal__btn modal__btn--grey",attrs:{type:"button"},on:{click:t.hideModal}},[t._v("Anuluj\n    ")]),t._v(" "),n("MainBtn",{staticClass:"modal__btn modal__btn--violet",attrs:{loading:t.isLoading,disabled:t.isLoading,color:"#fafafa"},on:{click:t.updateAppointment}},[t._v("Zaktualizuj wizytę\n    ")])],1)],1)},staticRenderFns:[]};var h=n("VU/8")(m,f,!1,function(t){n("EMMH")},"data-v-736ef5e4",null);a.default=h.exports},EMMH:function(t,a){}});
//# sourceMappingURL=4.051b7877f87a3b4f5af2.js.map