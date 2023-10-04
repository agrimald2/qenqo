import{T as d,o as i,f as c,b as e,e as m,h as a,v as l,u as s,d as p}from"./app-a7ca0acf.js";const u={class:"bg-gray-100"},b={class:"flex min-h-screen items-center justify-center p-4"},g={class:"min-h-1/2 bg-[#2A1E36] border border-gray-900 rounded-2xl"},y={class:"mx-4 sm:mx-24 md:mx-34 lg:mx-56 mx-auto flex items-center space-y-4 py-16 font-semibold text-gray-500 flex-col px-4"},f=["src"],_=e("h1",{class:"text-white text-2xl"},[p("iniciar sesion en "),e("strong",null," Qenqo ")],-1),x=["onSubmit"],h=["disabled"],V={__name:"Login",props:{canResetPassword:{type:Boolean},status:{type:String}},setup(w){const o=d({email:"",password:"",remember:!1}),n=()=>{o.post(route("login"),{onFinish:()=>o.reset("password")})};return(v,r)=>(i(),c("body",u,[e("div",b,[e("div",g,[e("div",y,[e("img",{src:"/logo.png",alt:"qenqo-logo",style:{width:"auto"}},null,8,f),_,e("form",{onSubmit:m(n,["prevent"]),class:"py-2"},[a(e("input",{"onUpdate:modelValue":r[0]||(r[0]=t=>s(o).email=t),class:"my-2 w-full p-2 bg-gray-800 rounded-md border border-gray-700 focus:border-purple-700",placeholder:"Usuario",type:"email",name:"correo",id:""},null,512),[[l,s(o).email]]),a(e("input",{"onUpdate:modelValue":r[1]||(r[1]=t=>s(o).password=t),class:"my-2 w-full p-2 bg-gray-800 rounded-md border border-gray-700",placeholder:"Contraseña",type:"password",name:"correo",id:""},null,512),[[l,s(o).password]]),e("input",{disabled:s(o).processing,class:"cursor-pointer my-2 w-full p-2 bg-gray-50 rounded-full font-bold text-gray-900 border border-gray-700",type:"submit",name:"correo",id:""},null,8,h)],40,x)])])])]))}};export{V as default};