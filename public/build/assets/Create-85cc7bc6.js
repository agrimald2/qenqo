import{l as d,o as u,f as c,b as e,h as l,v as m,p as a}from"./app-a7ca0acf.js";import{_ as f}from"./_plugin-vue_export-helper-c27b6911.js";const p={components:{},props:["id"],data(){return{family:[],data:null}},methods:{async submit(){try{this.family.is_enabled=this.isEnabled,this.family.required_admin_permission=this.requiredAdminPermission;const t=await d.post("/families",{name:this.family.name,is_enabled:this.family.is_enabled,required_admin_permission:this.family.required_admin_permission});window.location.reload()}catch(t){console.log(t)}},hideModal(){let t=document.getElementById(this.id);t.classList.add("slide-out-bck-center"),setTimeout(()=>{t.classList.add("no-display")},500)}},mounted(){},computed:{isEnabled:{set(t){this.family.is_enabled=t?1:0},get(){return this.family.is_enabled===1}},requiredAdminPermission:{set(t){this.family.required_admin_permission=t?1:0},get(){return this.family.required_admin_permission===1}}}},b=["id"],h={class:"relative max-w-xl max-h-full m-auto",style:{"min-width":"30%"}},g={class:"relative bg-white rounded-lg shadow"},_=e("svg",{class:"w-3 h-3",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 14 14"},[e("path",{stroke:"currentColor","stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"})],-1),y=e("span",{class:"sr-only"},"Close modal",-1),x=[_,y],v={class:"px-6 py-6 lg:px-8"},w=e("h3",{class:"mb-4 text-xl font-medium text-gray-900"},"Editar",-1),k={class:"space-y-6"},q=e("label",{for:"name",class:"block mb-2 text-sm font-medium text-gray-900"}," Nombre ",-1),E={class:"relative"},M=e("div",{class:"absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none"},[e("i",{class:"fa-solid fa-signature"})],-1),C={class:"flex justify-between gap-4"},A=e("label",{for:"document_number",class:"block mb-2 text-sm font-medium text-gray-900"}," ¿Habilitada? ",-1),B={class:"relative text-center"},P={class:"relative inline-flex items-center cursor-pointer"},j=e("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"},null,-1),V=e("label",{for:"document_number",class:"block mb-2 text-sm font-medium text-gray-900"}," ¿Requiere Permisos de Admin? ",-1),U={class:"relative text-center"},D={class:"relative inline-flex items-center cursor-pointer"},L=e("div",{class:"w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600"},null,-1);function N(t,r,n,T,o,i){return u(),c("div",{id:n.id,tabindex:"-1",class:"no-display slide-in-fwd-center fixed inset-0 flex items-center justify-center z-50 w-full p-2 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full"},[e("div",h,[e("div",g,[e("button",{type:"button",onClick:r[0]||(r[0]=(...s)=>i.hideModal&&i.hideModal(...s)),class:"absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"},x),e("div",v,[w,e("div",k,[e("div",null,[q,e("div",E,[M,l(e("input",{type:"text",name:"name",id:"name","onUpdate:modelValue":r[1]||(r[1]=s=>o.family.name=s),class:"bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full pl-10 p-2.5 dark:placeholder-gray-400 dark:focus:ring-purple-500 dark:focus:border-purple-500",placeholder:"John Doe"},null,512),[[m,o.family.name]])])]),e("div",C,[e("div",null,[A,e("div",B,[e("label",P,[l(e("input",{type:"checkbox","onUpdate:modelValue":r[2]||(r[2]=s=>i.isEnabled=s),class:"sr-only peer"},null,512),[[a,i.isEnabled]]),j])])]),e("div",null,[V,e("div",U,[e("label",D,[l(e("input",{type:"checkbox","onUpdate:modelValue":r[3]||(r[3]=s=>i.requiredAdminPermission=s),class:"sr-only peer"},null,512),[[a,i.requiredAdminPermission]]),L])])])]),e("button",{type:"button",onClick:r[4]||(r[4]=(...s)=>i.submit&&i.submit(...s)),class:"w-full text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center uppercase"}," Editar ")])])])])],8,b)}const I=f(p,[["render",N]]);export{I as default};
