(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{13:function(e){e.exports={url:"http://127.0.0.1:8000"}},29:function(e,a,t){e.exports=t(45)},34:function(e,a,t){},43:function(e,a,t){},45:function(e,a,t){"use strict";t.r(a);var n=t(0),l=t.n(n),r=t(25),c=t.n(r),m=(t(34),t(6)),o=t(18),s=t(7),i=t(8),u=t(10),p=t(9),d=t(11),E=t(46),h=t(47),f=t(48),b=t(49),w=t(50),g=t(51),y=t(52),N=t(53),j=t(54),v=t(55),k=t(56),S=t(13),x=function(e){function a(e){var t;return Object(s.a)(this,a),(t=Object(u.a)(this,Object(p.a)(a).call(this,e))).authUser=function(e){e.preventDefault(),fetch(S.url+"/api/auth",{method:"POST",credentials:"same-origin",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify({username:t.state.username,password:t.state.password})}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){sessionStorage.setItem("token",e.api_token),window.location.href="/profile"}).catch(function(e){alert("An error has occurred!")})},t.state={username:"",password:""},t}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){var e=this;return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:6,offset:3}},l.a.createElement(b.a,null,l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Login"),l.a.createElement(y.a,null,l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"username"},"Username"),l.a.createElement(v.a,{value:this.state.username,onChange:function(a){e.setState({username:a.target.value})},type:"text",name:"username",id:"username",placeholder:"Username"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"password"},"Password"),l.a.createElement(v.a,{value:this.state.password,onChange:function(a){e.setState({password:a.target.value})},type:"password",name:"password",id:"password",placeholder:"Password"})),l.a.createElement(k.a,{onClick:this.authUser,color:"primary",type:"submit"},"Login"),l.a.createElement(m.b,{className:"ml-3",to:"/register"},"Register")))))))}}]),a}(l.a.Component),O=(t(43),t(44),function(e){function a(e){var t;return Object(s.a)(this,a),(t=Object(u.a)(this,Object(p.a)(a).call(this,e))).registerUser=function(e){e.preventDefault(),t.state.password===t.state.repeatPassword?fetch(S.url+"/api/register",{method:"POST",credentials:"same-origin",headers:{Accept:"application/json","Content-Type":"application/json"},body:JSON.stringify({username:t.state.username,password:t.state.password})}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){sessionStorage.setItem("token",e.api_token),window.location.href="/profile"}).catch(function(e){alert("An error has occurred!")}):alert("Passwords do not match!")},t.state={username:"",password:"",repeatPassword:""},t}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){var e=this;return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:6,offset:3}},l.a.createElement(b.a,null,l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Register"),l.a.createElement(y.a,null,l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"username"},"Username"),l.a.createElement(v.a,{value:this.state.username,onChange:function(a){e.setState({username:a.target.value})},type:"text",name:"username",id:"username",placeholder:"Username"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"password"},"Password"),l.a.createElement(v.a,{value:this.state.password,onChange:function(a){e.setState({password:a.target.value})},type:"password",name:"password",id:"password",placeholder:"Password"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"password"},"Confirm password"),l.a.createElement(v.a,{value:this.state.repeatPassword,onChange:function(a){e.setState({repeatPassword:a.target.value})},type:"password",name:"confirmPassword",id:"confirmPassword",placeholder:"Password"})),l.a.createElement(k.a,{onClick:this.registerUser,color:"primary",type:"submit"},"Register"),l.a.createElement(m.b,{className:"ml-3",to:"/auth"},"Login")))))))}}]),a}(l.a.Component)),C=t(57),A=t(58),P=function(e){function a(){return Object(s.a)(this,a),Object(u.a)(this,Object(p.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){return l.a.createElement(C.a,null,l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/profile"},"Profile")),l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/news"},"News")),l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/people"},"People")),l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/messages"},"Messgaes")),l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/profile/edit"},"Edit profile")),l.a.createElement(A.a,null,l.a.createElement(m.b,{to:"/auth"},"Exit")))}}]),a}(l.a.Component),z=function(e){function a(e){var t;return Object(s.a)(this,a),(t=Object(u.a)(this,Object(p.a)(a).call(this,e))).editUser=function(e){e.preventDefault();var a=new FormData;a.append("name",t.state.name),a.append("surname",t.state.surname),a.append("status",t.state.status),a.append("birthday",new Date(t.state.birthday).getTime()/1e3),a.append("city_id",t.state.city_id),a.append("avatar",t.fileInput.current.files[0]),a.append("username",t.state.username),a.append("password",t.state.password),fetch(S.url+"/api/profile",{method:"PATCH",credentials:"same-origin",headers:{Accept:"application/json","Content-Type":"multipart/form-data"},body:a}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){window.location.href="/profile"}).catch(function(e){alert("An error has occurred!")})},t.state={name:"",surname:"",status:"",birthday:0,city_id:0,avatar:"",username:"",password:""},t.fileInput=l.a.createRef(),t}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){var e=this;return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:8,offset:0}},l.a.createElement(b.a,null,l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Edit profile"),l.a.createElement(y.a,null,l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"name"},"Name"),l.a.createElement(v.a,{onChange:function(a){e.setState({name:a.target.value})},type:"text",name:"name",id:"name",placeholder:"Name"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"surname"},"Surname"),l.a.createElement(v.a,{onChange:function(a){e.setState({surname:a.target.value})},type:"text",name:"surname",id:"surname",placeholder:"Surname"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"status"},"Status"),l.a.createElement(v.a,{onChange:function(a){e.setState({status:a.target.value})},type:"text",name:"status",id:"status",placeholder:"Status"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"birthday"},"Birthday"),l.a.createElement(v.a,{type:"date",name:"birthday",id:"birthday",placeholder:"Birthday",onChange:function(a){e.setState({birthday:a.target.value})}})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"city"},"City"),l.a.createElement(v.a,{onChange:function(a){e.setState({city_id:a.target.value})},type:"select",name:"city",id:"city"},l.a.createElement("option",{value:"1"},"1"),l.a.createElement("option",{value:"2"},"2"),l.a.createElement("option",{value:"3"},"3"),l.a.createElement("option",{value:"4"},"4"),l.a.createElement("option",{value:"5"},"5"))),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"photo"},"Photo"),l.a.createElement("br",null),l.a.createElement("input",{ref:this.fileInput,type:"file",id:"photo",name:"photo"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"username"},"Username"),l.a.createElement(v.a,{onChange:function(a){e.setState({username:a.target.value})},type:"text",name:"username",id:"username",placeholder:"Username"})),l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"password"},"Password"),l.a.createElement(v.a,{onChange:function(a){e.setState({password:a.target.value})},type:"password",name:"password",id:"password",placeholder:"Password"})),l.a.createElement(k.a,{onClick:this.editUser,color:"primary",type:"submit"},"Save")))))))}}]),a}(l.a.Component),T=t(59),D=function(e){function a(e){var t;return Object(s.a)(this,a),(t=Object(u.a)(this,Object(p.a)(a).call(this,e))).sendPost=function(e){e.preventDefault(),fetch(S.url+"/api/profile/posts",{method:"POST",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+t.state.token},body:JSON.stringify({text:t.state.postText})}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){console.log(e),t.setState({posts:e.posts}),console.log(t.state.posts)}).catch(function(e){alert("An error has occurred!")})},t.sendPhoto=function(e){e.preventDefault();var a=new FormData;a.append("photo",t.fileInput.current.files[0]),fetch(S.url+"/api/profile/photos",{method:"POST",credentials:"same-origin",headers:{Accept:"application/json","Content-Type":"multipart/form-data"},body:a}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){window.location.href="/profile"}).catch(function(e){alert("An error has occurred!")})},t.deletePhoto=function(e){fetch(S.url+"/api/profile/photos/"+e,{method:"DELETE",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+t.state.token}}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){console.log(e),t.setState({posts:e.posts}),console.log(t.state.posts)}).catch(function(e){alert("An error has occurred!")})},t.editPost=function(e){var a=prompt("New text for post");fetch(S.url+"/api/profile/posts/"+e,{method:"PATCH",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+t.state.token},body:JSON.stringify({text:a})}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){console.log(e),t.setState({posts:e.posts}),console.log(t.state.posts)}).catch(function(e){alert("An error has occurred!")})},t.deletePost=function(e){fetch(S.url+"/api/profile/posts/"+e,{method:"DELETE",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+t.state.token}}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(e){console.log(e),t.setState({posts:e.posts}),console.log(t.state.posts)}).catch(function(e){alert("An error has occurred!")})},t.state={name:"John Doe",status:"\u0412\u043e\u043b\u043a \u0441\u043b\u0430\u0431\u0435\u0435 \u043c\u0435\u0434\u0432\u0435\u0434\u044f, \u043d\u043e \u0432 \u0446\u0438\u0440\u043a\u0435 \u043d\u0435 \u0432\u044b\u0441\u0442\u0443\u043f\u0430\u0435\u0442",birthday:"",city:"",avatar:"",photos:[],posts:[],token:"",postText:""},t.fileInput=l.a.createRef(),t}return Object(d.a)(a,e),Object(i.a)(a,[{key:"componentDidMount",value:function(){var e=this,a=sessionStorage.getItem("token");a?(this.setState({token:a}),fetch(S.url+"/api/profile",{method:"GET",credentials:"same-origin",headers:{Accept:"application/json","Content-Type":"application/json",Authorization:"Bearer "+a}}).then(function(e){if(200===e.status)return e.json();alert("An error has occurred!")}).then(function(a){e.setState({name:a.name+" "+a.surname,birthday:a.birthday,city:a.city,photos:a.photos,posts:a.posts,status:a.status,avatar:a.avatar})}).catch(function(e){alert("An error has occurred!")})):window.location.href="/auth"}},{key:"render",value:function(){var e=this;return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:9,offset:0}},l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{md:{size:5}},l.a.createElement(b.a,null,l.a.createElement(w.a,null,l.a.createElement(g.a,null,l.a.createElement("img",{src:this.state.avatar,className:"rounded float-left avatar",alt:"Avatar"}))))),l.a.createElement(f.a,{md:{size:7}},l.a.createElement("h1",null,this.state.name),l.a.createElement("span",{className:"text-muted status"},this.state.status),l.a.createElement("br",null),l.a.createElement("br",null),l.a.createElement("span",{className:"text-muted userinfo"},l.a.createElement("strong",null,"Birthday:")," ",new Date(1e3*this.state.birthday).toLocaleDateString()),l.a.createElement("br",null),l.a.createElement("span",{className:"text-muted userinfo"},l.a.createElement("strong",null,"City:")," ",this.state.city))),l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{md:{size:5}},l.a.createElement(b.a,{className:"mb-3"},l.a.createElement(w.a,null,l.a.createElement(y.a,null,l.a.createElement(N.a,null,l.a.createElement(j.a,{for:"photo"},"Photo"),l.a.createElement("input",{ref:this.fileInput,type:"file",id:"photo",name:"photo"})),l.a.createElement(k.a,{onClick:this.sendPhoto,color:"primary",type:"submit",className:"mt-3"},"Upload")))),this.state.photos.map(function(a){return l.a.createElement("div",null,l.a.createElement("img",{key:a.link,src:a.link,alt:"Photo",className:"img-thumbnail"}),l.a.createElement(k.a,{onClick:function(){e.deletePost(a.id)},color:"danger",className:"mb-2"},"Delete"))})),l.a.createElement(f.a,{md:{size:7}},l.a.createElement(b.a,{className:"mb-3"},l.a.createElement(w.a,null,l.a.createElement(y.a,null,l.a.createElement(v.a,{value:this.state.postText,onChange:function(a){e.setState({postText:a.target.value})},type:"textarea",name:"postText",id:"postText"}),l.a.createElement(k.a,{onClick:this.sendPost,color:"primary",type:"submit",className:"mt-3"},"Public")))),this.state.posts.map(function(a){return l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(g.a,null,new Date(1e3*a.date).toLocaleDateString()),l.a.createElement("hr",null),l.a.createElement(T.a,null,a.text),l.a.createElement(k.a,{onClick:function(){e.editPost(a.id)},color:"warning",className:"mr-2"},"Edit"),l.a.createElement(k.a,{onClick:function(){e.deletePost(a.id)},color:"danger"},"Delete")))}))))))}}]),a}(l.a.Component),U=function(e){function a(){return Object(s.a)(this,a),Object(u.a)(this,Object(p.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:9,offset:0}},l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{md:{size:12}},l.a.createElement(b.a,{className:"mb-3"},l.a.createElement(w.a,null,l.a.createElement(y.a,null,l.a.createElement(v.a,{type:"textarea",name:"postText",id:"postText"}),l.a.createElement(k.a,{color:"primary",type:"submit",className:"mt-3"},"Public")))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))))))))}}]),a}(l.a.Component),q=t(60),B=function(e){function a(){return Object(s.a)(this,a),Object(u.a)(this,Object(p.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:9,offset:0}},l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{className:"mb-3",md:{size:4}},l.a.createElement(b.a,null,l.a.createElement("img",{width:"100%",src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",alt:"Card image cap"}),l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Name Surname"),l.a.createElement(q.a,{href:"#"},"Profile"),l.a.createElement(q.a,{href:"#"},"Messages")))),l.a.createElement(f.a,{className:"mb-3",md:{size:4}},l.a.createElement(b.a,null,l.a.createElement("img",{width:"100%",src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",alt:"Card image cap"}),l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Name Surname"),l.a.createElement(q.a,{href:"#"},"Profile"),l.a.createElement(q.a,{href:"#"},"Messages")))),l.a.createElement(f.a,{className:"mb-3",md:{size:4}},l.a.createElement(b.a,null,l.a.createElement("img",{width:"100%",src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",alt:"Card image cap"}),l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Name Surname"),l.a.createElement(q.a,{href:"#"},"Profile"),l.a.createElement(q.a,{href:"#"},"Messages")))),l.a.createElement(f.a,{className:"mb-3",md:{size:4}},l.a.createElement(b.a,null,l.a.createElement("img",{width:"100%",src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",alt:"Card image cap"}),l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Name Surname"),l.a.createElement(q.a,{href:"#"},"Profile"),l.a.createElement(q.a,{href:"#"},"Messages")))),l.a.createElement(f.a,{className:"mb-3",md:{size:4}},l.a.createElement(b.a,null,l.a.createElement("img",{width:"100%",src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",alt:"Card image cap"}),l.a.createElement(w.a,null,l.a.createElement(g.a,null,"Name Surname"),l.a.createElement(q.a,{href:"#"},"Profile"),l.a.createElement(q.a,{href:"#"},"Messages"))))))))}}]),a}(l.a.Component),I=function(e){function a(){return Object(s.a)(this,a),Object(u.a)(this,Object(p.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:9,offset:0}},l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{md:{size:12}},l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."),l.a.createElement(m.b,{to:"/messages/chat"},"Open chat"))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."),l.a.createElement(m.b,{to:"/messages/chat"},"Open chat"))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."),l.a.createElement(m.b,{to:"/messages/chat"},"Open chat"))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."),l.a.createElement(m.b,{to:"/messages/chat"},"Open chat"))))))))))}}]),a}(l.a.Component),J=function(e){function a(){return Object(s.a)(this,a),Object(u.a)(this,Object(p.a)(a).apply(this,arguments))}return Object(d.a)(a,e),Object(i.a)(a,[{key:"render",value:function(){return l.a.createElement(E.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:{size:3,offset:0}},l.a.createElement(P,null)),l.a.createElement(f.a,{md:{size:9,offset:0}},l.a.createElement(h.a,{className:"mb-4"},l.a.createElement(f.a,{md:{size:12}},l.a.createElement(b.a,{className:"mb-3"},l.a.createElement(w.a,null,l.a.createElement(y.a,null,l.a.createElement(v.a,{type:"textarea",name:"postText",id:"postText"}),l.a.createElement(k.a,{color:"primary",type:"submit",className:"mt-3"},"Send")))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))),l.a.createElement(b.a,{className:"mb-2"},l.a.createElement(w.a,null,l.a.createElement(h.a,null,l.a.createElement(f.a,{md:"3"},l.a.createElement("img",{src:"http://www.liberaldictionary.com/wp-content/uploads/2018/12/man.jpg",className:"rounded float-left w-100",alt:"Avatar"})),l.a.createElement(f.a,{md:"9"},l.a.createElement(g.a,null,l.a.createElement("strong",{className:"mr-2"},"Name Surname"),"30.05.2019"),l.a.createElement("hr",null),l.a.createElement(T.a,null,"Some quick example text to build on the card title and make up the bulk of the card's content."))))))))))}}]),a}(l.a.Component);var L=function(){return l.a.createElement("div",{className:"App"},l.a.createElement(m.a,null,l.a.createElement(o.a,{path:"/profile/edit",exact:!0,component:z}),l.a.createElement(o.a,{path:"/profile",exact:!0,component:D}),l.a.createElement(o.a,{path:"/auth",exact:!0,component:x}),l.a.createElement(o.a,{path:"/register",exact:!0,component:O}),l.a.createElement(o.a,{path:"/news",exact:!0,component:U}),l.a.createElement(o.a,{path:"/people",exact:!0,component:B}),l.a.createElement(o.a,{path:"/messages",exact:!0,component:I}),l.a.createElement(o.a,{path:"/messages/chat",exact:!0,component:J})))};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));c.a.render(l.a.createElement(L,null),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then(function(e){e.unregister()})}},[[29,1,2]]]);
//# sourceMappingURL=main.0ed8dd9b.chunk.js.map