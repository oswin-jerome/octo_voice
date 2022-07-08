import{F as C,z as Ze,A as Xe,B as je,C as Ae,d as Q,D as X,r as I,f as j,E as Y,e as Ye,G as L,o as k,c as E,b as y,a as N,w as B,u as W,T as et,s as $,i as tt,n as z,t as K,g as ke,j as fe,k as le,I as nt}from"./app.e7e40026.js";import{a as Ee,_ as rt}from"./Label.8609a721.js";import{_ as at}from"./Button.6b402a14.js";function ee(e,r,...a){if(e in r){let n=r[e];return typeof n=="function"?n(...a):n}let t=new Error(`Tried to handle "${e}" but there is no handler defined. Only defined handlers are: ${Object.keys(r).map(n=>`"${n}"`).join(", ")}.`);throw Error.captureStackTrace&&Error.captureStackTrace(t,ee),t}var de=(e=>(e[e.None=0]="None",e[e.RenderStrategy=1]="RenderStrategy",e[e.Static=2]="Static",e))(de||{}),st=(e=>(e[e.Unmount=0]="Unmount",e[e.Hidden=1]="Hidden",e))(st||{});function te({visible:e=!0,features:r=0,...a}){var t;if(e||r&2&&a.props.static)return ue(a);if(r&1){let n=(t=a.props.unmount)==null||t?0:1;return ee(n,{[0](){return null},[1](){return ue({...a,props:{...a.props,hidden:!0,style:{display:"none"}}})}})}return ue(a)}function ue({props:e,attrs:r,slots:a,slot:t,name:n}){var l;let{as:o,...d}=ot(e,["unmount","static"]),i=(l=a.default)==null?void 0:l.call(a,t),u={};if(o==="template"){if(i=Ne(i),Object.keys(d).length>0||Object.keys(r).length>0){let[c,...s]=i!=null?i:[];if(!it(c)||s.length>0)throw new Error(['Passing props on "template"!',"",`The current component <${n} /> is rendering a "template".`,"However we need to passthrough the following props:",Object.keys(d).concat(Object.keys(r)).map(f=>`  - ${f}`).join(`
`),"","You can apply a few solutions:",['Add an `as="..."` prop, to ensure that we render an actual element instead of a "template".',"Render a single element as the child so that we can forward the props onto that element."].map(f=>`  - ${f}`).join(`
`)].join(`
`));return Ze(c,Object.assign({},d,u))}return Array.isArray(i)&&i.length===1?i[0]:i}return Xe(o,Object.assign({},d,u),i)}function Ne(e){return e.flatMap(r=>r.type===C?Ne(r.children):[r])}function ot(e,r=[]){let a=Object.assign({},e);for(let t of r)t in a&&delete a[t];return a}function it(e){return e==null?!1:typeof e.type=="string"||typeof e.type=="object"||typeof e.type=="function"}let lt=0;function ut(){return++lt}function he(){return ut()}var x=(e=>(e.Space=" ",e.Enter="Enter",e.Escape="Escape",e.Backspace="Backspace",e.Delete="Delete",e.ArrowLeft="ArrowLeft",e.ArrowUp="ArrowUp",e.ArrowRight="ArrowRight",e.ArrowDown="ArrowDown",e.Home="Home",e.End="End",e.PageUp="PageUp",e.PageDown="PageDown",e.Tab="Tab",e))(x||{});function ct(e){throw new Error("Unexpected object: "+e)}var _=(e=>(e[e.First=0]="First",e[e.Previous=1]="Previous",e[e.Next=2]="Next",e[e.Last=3]="Last",e[e.Specific=4]="Specific",e[e.Nothing=5]="Nothing",e))(_||{});function ft(e,r){let a=r.resolveItems();if(a.length<=0)return null;let t=r.resolveActiveIndex(),n=t!=null?t:-1,l=(()=>{switch(e.focus){case 0:return a.findIndex(o=>!r.resolveDisabled(o));case 1:{let o=a.slice().reverse().findIndex((d,i,u)=>n!==-1&&u.length-i-1>=n?!1:!r.resolveDisabled(d));return o===-1?o:a.length-1-o}case 2:return a.findIndex((o,d)=>d<=n?!1:!r.resolveDisabled(o));case 3:{let o=a.slice().reverse().findIndex(d=>!r.resolveDisabled(d));return o===-1?o:a.length-1-o}case 4:return a.findIndex(o=>r.resolveId(o)===e.id);case 5:return null;default:ct(e)}})();return l===-1?t:l}function g(e){return e==null||e.value==null?null:"$el"in e.value?e.value.$el:e.value}let Pe=Symbol("Context");var Z=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(Z||{});function dt(){return je(Pe,null)}function vt(e){Ae(Pe,e)}function Ie(e,r){if(e)return e;let a=r!=null?r:"button";if(typeof a=="string"&&a.toLowerCase()==="button")return"button"}function pt(e,r){let a=I(Ie(e.value.type,e.value.as));return Q(()=>{a.value=Ie(e.value.type,e.value.as)}),X(()=>{var t;a.value||!g(r)||g(r)instanceof HTMLButtonElement&&!((t=g(r))!=null&&t.hasAttribute("type"))&&(a.value="button")}),a}function Ce(e){if(typeof window=="undefined")return null;if(e instanceof Node)return e.ownerDocument;if(e!=null&&e.hasOwnProperty("value")){let r=g(e);if(r)return r.ownerDocument}return document}function ht({container:e,accept:r,walk:a,enabled:t}){X(()=>{let n=e.value;if(!n||t!==void 0&&!t.value)return;let l=Ce(e);if(!l)return;let o=Object.assign(i=>r(i),{acceptNode:r}),d=l.createTreeWalker(n,NodeFilter.SHOW_ELEMENT,o,!1);for(;d.nextNode();)a(d.currentNode)})}let Oe=["[contentEditable=true]","[tabindex]","a[href]","area[href]","button:not([disabled])","iframe","input:not([disabled])","select:not([disabled])","textarea:not([disabled])"].map(e=>`${e}:not([tabindex='-1'])`).join(",");var mt=(e=>(e[e.First=1]="First",e[e.Previous=2]="Previous",e[e.Next=4]="Next",e[e.Last=8]="Last",e[e.WrapAround=16]="WrapAround",e[e.NoScroll=32]="NoScroll",e))(mt||{}),gt=(e=>(e[e.Error=0]="Error",e[e.Overflow=1]="Overflow",e[e.Success=2]="Success",e[e.Underflow=3]="Underflow",e))(gt||{}),bt=(e=>(e[e.Previous=-1]="Previous",e[e.Next=1]="Next",e))(bt||{}),me=(e=>(e[e.Strict=0]="Strict",e[e.Loose=1]="Loose",e))(me||{});function De(e,r=0){var a;return e===((a=Ce(e))==null?void 0:a.body)?!1:ee(r,{[0](){return e.matches(Oe)},[1](){let t=e;for(;t!==null;){if(t.matches(Oe))return!0;t=t.parentElement}return!1}})}function yt(e,r=a=>a){return e.slice().sort((a,t)=>{let n=r(a),l=r(t);if(n===null||l===null)return 0;let o=n.compareDocumentPosition(l);return o&Node.DOCUMENT_POSITION_FOLLOWING?-1:o&Node.DOCUMENT_POSITION_PRECEDING?1:0})}function _e(e,r,a){typeof window!="undefined"&&X(t=>{window.addEventListener(e,r,a),t(()=>window.removeEventListener(e,r,a))})}function xt(e,r,a=j(()=>!0)){function t(n,l){if(!a.value||n.defaultPrevented)return;let o=l(n);if(o===null||!o.ownerDocument.documentElement.contains(o))return;let d=function i(u){return typeof u=="function"?i(u()):Array.isArray(u)||u instanceof Set?u:[u]}(e);for(let i of d){if(i===null)continue;let u=i instanceof HTMLElement?i:g(i);if(u!=null&&u.contains(o))return}return!De(o,me.Loose)&&o.tabIndex!==-1&&n.preventDefault(),r(n,o)}_e("click",n=>t(n,l=>l.target),!0),_e("blur",n=>t(n,()=>window.document.activeElement instanceof HTMLIFrameElement?window.document.activeElement:null),!0)}var wt=(e=>(e[e.Open=0]="Open",e[e.Closed=1]="Closed",e))(wt||{}),St=(e=>(e[e.Pointer=0]="Pointer",e[e.Other=1]="Other",e))(St||{});function kt(e){requestAnimationFrame(()=>requestAnimationFrame(e))}let Le=Symbol("MenuContext");function ne(e){let r=je(Le,null);if(r===null){let a=new Error(`<${e} /> is missing a parent <Menu /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(a,ne),a}return r}let Et=Y({name:"Menu",props:{as:{type:[Object,String],default:"template"}},setup(e,{slots:r,attrs:a}){let t=I(1),n=I(null),l=I(null),o=I([]),d=I(""),i=I(null),u=I(1);function c(f=v=>v){let v=i.value!==null?o.value[i.value]:null,p=yt(f(o.value.slice()),O=>g(O.dataRef.domRef)),h=v?p.indexOf(v):null;return h===-1&&(h=null),{items:p,activeItemIndex:h}}let s={menuState:t,buttonRef:n,itemsRef:l,items:o,searchQuery:d,activeItemIndex:i,activationTrigger:u,closeMenu:()=>{t.value=1,i.value=null},openMenu:()=>t.value=0,goToItem(f,v,p){let h=c(),O=ft(f===_.Specific?{focus:_.Specific,id:v}:{focus:f},{resolveItems:()=>h.items,resolveActiveIndex:()=>h.activeItemIndex,resolveId:m=>m.id,resolveDisabled:m=>m.dataRef.disabled});d.value="",i.value=O,u.value=p!=null?p:1,o.value=h.items},search(f){let v=d.value!==""?0:1;d.value+=f.toLowerCase();let p=(i.value!==null?o.value.slice(i.value+v).concat(o.value.slice(0,i.value+v)):o.value).find(O=>O.dataRef.textValue.startsWith(d.value)&&!O.dataRef.disabled),h=p?o.value.indexOf(p):-1;h===-1||h===i.value||(i.value=h,u.value=1)},clearSearch(){d.value=""},registerItem(f,v){let p=c(h=>[...h,{id:f,dataRef:v}]);o.value=p.items,i.value=p.activeItemIndex,u.value=1},unregisterItem(f){let v=c(p=>{let h=p.findIndex(O=>O.id===f);return h!==-1&&p.splice(h,1),p});o.value=v.items,i.value=v.activeItemIndex,u.value=1}};return xt([n,l],(f,v)=>{var p;s.closeMenu(),De(v,me.Loose)||(f.preventDefault(),(p=g(n))==null||p.focus())},j(()=>t.value===0)),Ae(Le,s),vt(j(()=>ee(t.value,{[0]:Z.Open,[1]:Z.Closed}))),()=>{let f={open:t.value===0};return te({props:e,slot:f,slots:r,attrs:a,name:"Menu"})}}}),It=Y({name:"MenuButton",props:{disabled:{type:Boolean,default:!1},as:{type:[Object,String],default:"button"}},setup(e,{attrs:r,slots:a,expose:t}){let n=ne("MenuButton"),l=`headlessui-menu-button-${he()}`;t({el:n.buttonRef,$el:n.buttonRef});function o(c){switch(c.key){case x.Space:case x.Enter:case x.ArrowDown:c.preventDefault(),c.stopPropagation(),n.openMenu(),L(()=>{var s;(s=g(n.itemsRef))==null||s.focus({preventScroll:!0}),n.goToItem(_.First)});break;case x.ArrowUp:c.preventDefault(),c.stopPropagation(),n.openMenu(),L(()=>{var s;(s=g(n.itemsRef))==null||s.focus({preventScroll:!0}),n.goToItem(_.Last)});break}}function d(c){switch(c.key){case x.Space:c.preventDefault();break}}function i(c){e.disabled||(n.menuState.value===0?(n.closeMenu(),L(()=>{var s;return(s=g(n.buttonRef))==null?void 0:s.focus({preventScroll:!0})})):(c.preventDefault(),n.openMenu(),kt(()=>{var s;return(s=g(n.itemsRef))==null?void 0:s.focus({preventScroll:!0})})))}let u=pt(j(()=>({as:e.as,type:r.type})),n.buttonRef);return()=>{var c;let s={open:n.menuState.value===0},f={ref:n.buttonRef,id:l,type:u.value,"aria-haspopup":!0,"aria-controls":(c=g(n.itemsRef))==null?void 0:c.id,"aria-expanded":e.disabled?void 0:n.menuState.value===0,onKeydown:o,onKeyup:d,onClick:i};return te({props:{...e,...f},slot:s,attrs:r,slots:a,name:"MenuButton"})}}}),Ot=Y({name:"MenuItems",props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0}},setup(e,{attrs:r,slots:a,expose:t}){let n=ne("MenuItems"),l=`headlessui-menu-items-${he()}`,o=I(null);t({el:n.itemsRef,$el:n.itemsRef}),ht({container:j(()=>g(n.itemsRef)),enabled:j(()=>n.menuState.value===0),accept(s){return s.getAttribute("role")==="menuitem"?NodeFilter.FILTER_REJECT:s.hasAttribute("role")?NodeFilter.FILTER_SKIP:NodeFilter.FILTER_ACCEPT},walk(s){s.setAttribute("role","none")}});function d(s){var f;switch(o.value&&clearTimeout(o.value),s.key){case x.Space:if(n.searchQuery.value!=="")return s.preventDefault(),s.stopPropagation(),n.search(s.key);case x.Enter:if(s.preventDefault(),s.stopPropagation(),n.activeItemIndex.value!==null){let v=n.items.value[n.activeItemIndex.value];(f=g(v.dataRef.domRef))==null||f.click()}n.closeMenu(),L(()=>{var v;return(v=g(n.buttonRef))==null?void 0:v.focus({preventScroll:!0})});break;case x.ArrowDown:return s.preventDefault(),s.stopPropagation(),n.goToItem(_.Next);case x.ArrowUp:return s.preventDefault(),s.stopPropagation(),n.goToItem(_.Previous);case x.Home:case x.PageUp:return s.preventDefault(),s.stopPropagation(),n.goToItem(_.First);case x.End:case x.PageDown:return s.preventDefault(),s.stopPropagation(),n.goToItem(_.Last);case x.Escape:s.preventDefault(),s.stopPropagation(),n.closeMenu(),L(()=>{var v;return(v=g(n.buttonRef))==null?void 0:v.focus({preventScroll:!0})});break;case x.Tab:s.preventDefault(),s.stopPropagation();break;default:s.key.length===1&&(n.search(s.key),o.value=setTimeout(()=>n.clearSearch(),350));break}}function i(s){switch(s.key){case x.Space:s.preventDefault();break}}let u=dt(),c=j(()=>u!==null?u.value===Z.Open:n.menuState.value===0);return()=>{var s,f;let v={open:n.menuState.value===0},p={"aria-activedescendant":n.activeItemIndex.value===null||(s=n.items.value[n.activeItemIndex.value])==null?void 0:s.id,"aria-labelledby":(f=g(n.buttonRef))==null?void 0:f.id,id:l,onKeydown:d,onKeyup:i,role:"menu",tabIndex:0,ref:n.itemsRef};return te({props:{...e,...p},slot:v,attrs:r,slots:a,features:de.RenderStrategy|de.Static,visible:c.value,name:"MenuItems"})}}}),_t=Y({name:"MenuItem",props:{as:{type:[Object,String],default:"template"},disabled:{type:Boolean,default:!1}},setup(e,{slots:r,attrs:a,expose:t}){let n=ne("MenuItem"),l=`headlessui-menu-item-${he()}`,o=I(null);t({el:o,$el:o});let d=j(()=>n.activeItemIndex.value!==null?n.items.value[n.activeItemIndex.value].id===l:!1),i=j(()=>({disabled:e.disabled,textValue:"",domRef:o}));Q(()=>{var v,p;let h=(p=(v=g(o))==null?void 0:v.textContent)==null?void 0:p.toLowerCase().trim();h!==void 0&&(i.value.textValue=h)}),Q(()=>n.registerItem(l,i)),Ye(()=>n.unregisterItem(l)),X(()=>{n.menuState.value===0&&(!d.value||n.activationTrigger.value!==0&&L(()=>{var v,p;return(p=(v=g(o))==null?void 0:v.scrollIntoView)==null?void 0:p.call(v,{block:"nearest"})}))});function u(v){if(e.disabled)return v.preventDefault();n.closeMenu(),L(()=>{var p;return(p=g(n.buttonRef))==null?void 0:p.focus({preventScroll:!0})})}function c(){if(e.disabled)return n.goToItem(_.Nothing);n.goToItem(_.Specific,l)}function s(){e.disabled||d.value||n.goToItem(_.Specific,l,0)}function f(){e.disabled||!d.value||n.goToItem(_.Nothing)}return()=>{let{disabled:v}=e,p={active:d.value,disabled:v};return te({props:{...e,id:l,ref:o,role:"menuitem",tabIndex:v===!0?void 0:-1,"aria-disabled":v===!0?!0:void 0,onClick:u,onFocus:c,onPointermove:s,onMousemove:s,onPointerleave:f,onMouseleave:f},slot:p,attrs:a,slots:r,name:"MenuItem"})}}});var Mt=function(e,r){for(var a=[],t=0;t<e.length;t++){var n=r(e[t],t);Rt(n)?a.push.apply(a,n):a.push(n)}return a},Rt=Array.isArray||function(e){return Object.prototype.toString.call(e)==="[object Array]"},Tt=Fe;function Fe(e,r,a){e instanceof RegExp&&(e=Me(e,a)),r instanceof RegExp&&(r=Me(r,a));var t=Be(e,r,a);return t&&{start:t[0],end:t[1],pre:a.slice(0,t[0]),body:a.slice(t[0]+e.length,t[1]),post:a.slice(t[1]+r.length)}}function Me(e,r){var a=r.match(e);return a?a[0]:null}Fe.range=Be;function Be(e,r,a){var t,n,l,o,d,i=a.indexOf(e),u=a.indexOf(r,i+1),c=i;if(i>=0&&u>0){if(e===r)return[i,u];for(t=[],l=a.length;c>=0&&!d;)c==i?(t.push(c),i=a.indexOf(e,c+1)):t.length==1?d=[t.pop(),u]:(n=t.pop(),n<l&&(l=n,o=u),u=a.indexOf(r,c+1)),c=i<u&&i>=0?i:u;t.length&&(d=[l,o])}return d}var jt=Mt,$e=Tt,At=Ct,Ue="\0SLASH"+Math.random()+"\0",Ve="\0OPEN"+Math.random()+"\0",ge="\0CLOSE"+Math.random()+"\0",He="\0COMMA"+Math.random()+"\0",qe="\0PERIOD"+Math.random()+"\0";function ce(e){return parseInt(e,10)==e?parseInt(e,10):e.charCodeAt(0)}function Nt(e){return e.split("\\\\").join(Ue).split("\\{").join(Ve).split("\\}").join(ge).split("\\,").join(He).split("\\.").join(qe)}function Pt(e){return e.split(Ue).join("\\").split(Ve).join("{").split(ge).join("}").split(He).join(",").split(qe).join(".")}function Ge(e){if(!e)return[""];var r=[],a=$e("{","}",e);if(!a)return e.split(",");var t=a.pre,n=a.body,l=a.post,o=t.split(",");o[o.length-1]+="{"+n+"}";var d=Ge(l);return l.length&&(o[o.length-1]+=d.shift(),o.push.apply(o,d)),r.push.apply(r,o),r}function Ct(e){return e?(e.substr(0,2)==="{}"&&(e="\\{\\}"+e.substr(2)),U(Nt(e),!0).map(Pt)):[]}function Dt(e){return"{"+e+"}"}function Lt(e){return/^-?0\d/.test(e)}function Ft(e,r){return e<=r}function Bt(e,r){return e>=r}function U(e,r){var a=[],t=$e("{","}",e);if(!t||/\$$/.test(t.pre))return[e];var n=/^-?\d+\.\.-?\d+(?:\.\.-?\d+)?$/.test(t.body),l=/^[a-zA-Z]\.\.[a-zA-Z](?:\.\.-?\d+)?$/.test(t.body),o=n||l,d=t.body.indexOf(",")>=0;if(!o&&!d)return t.post.match(/,.*\}/)?(e=t.pre+"{"+t.body+ge+t.post,U(e)):[e];var i;if(o)i=t.body.split(/\.\./);else if(i=Ge(t.body),i.length===1&&(i=U(i[0],!1).map(Dt),i.length===1)){var c=t.post.length?U(t.post,!1):[""];return c.map(function(ae){return t.pre+i[0]+ae})}var u=t.pre,c=t.post.length?U(t.post,!1):[""],s;if(o){var f=ce(i[0]),v=ce(i[1]),p=Math.max(i[0].length,i[1].length),h=i.length==3?Math.abs(ce(i[2])):1,O=Ft,m=v<f;m&&(h*=-1,O=Bt);var b=i.some(Lt);s=[];for(var R=f;O(R,v);R+=h){var S;if(l)S=String.fromCharCode(R),S==="\\"&&(S="");else if(S=String(R),b){var A=p-S.length;if(A>0){var q=new Array(A+1).join("0");R<0?S="-"+q+S.slice(1):S=q+S}}s.push(S)}}else s=jt(i,function(G){return U(G,!1)});for(var F=0;F<s.length;F++)for(var D=0;D<c.length;D++){var T=u+s[F]+c[D];(!r||o||T)&&a.push(T)}return a}M.Minimatch=w;var H=function(){try{return require("path")}catch{}}()||{sep:"/"};M.sep=H.sep;var be=M.GLOBSTAR=w.GLOBSTAR={},$t=At,Re={"!":{open:"(?:(?!(?:",close:"))[^/]*?)"},"?":{open:"(?:",close:")?"},"+":{open:"(?:",close:")+"},"*":{open:"(?:",close:")*"},"@":{open:"(?:",close:")"}},ve="[^/]",pe=ve+"*?",Ut="(?:(?!(?:\\/|^)(?:\\.{1,2})($|\\/)).)*?",Vt="(?:(?!(?:\\/|^)\\.).)*?",Te=Ht("().*{}+?[]^$\\!");function Ht(e){return e.split("").reduce(function(r,a){return r[a]=!0,r},{})}var We=/\/+/;M.filter=qt;function qt(e,r){return r=r||{},function(a,t,n){return M(a,e,r)}}function P(e,r){r=r||{};var a={};return Object.keys(e).forEach(function(t){a[t]=e[t]}),Object.keys(r).forEach(function(t){a[t]=r[t]}),a}M.defaults=function(e){if(!e||typeof e!="object"||!Object.keys(e).length)return M;var r=M,a=function(n,l,o){return r(n,l,P(e,o))};return a.Minimatch=function(n,l){return new r.Minimatch(n,P(e,l))},a.Minimatch.defaults=function(n){return r.defaults(P(e,n)).Minimatch},a.filter=function(n,l){return r.filter(n,P(e,l))},a.defaults=function(n){return r.defaults(P(e,n))},a.makeRe=function(n,l){return r.makeRe(n,P(e,l))},a.braceExpand=function(n,l){return r.braceExpand(n,P(e,l))},a.match=function(t,n,l){return r.match(t,n,P(e,l))},a};w.defaults=function(e){return M.defaults(e).Minimatch};function M(e,r,a){return re(r),a||(a={}),!a.nocomment&&r.charAt(0)==="#"?!1:new w(r,a).match(e)}function w(e,r){if(!(this instanceof w))return new w(e,r);re(e),r||(r={}),e=e.trim(),!r.allowWindowsEscape&&H.sep!=="/"&&(e=e.split(H.sep).join("/")),this.options=r,this.set=[],this.pattern=e,this.regexp=null,this.negate=!1,this.comment=!1,this.empty=!1,this.partial=!!r.partial,this.make()}w.prototype.debug=function(){};w.prototype.make=Gt;function Gt(){var e=this.pattern,r=this.options;if(!r.nocomment&&e.charAt(0)==="#"){this.comment=!0;return}if(!e){this.empty=!0;return}this.parseNegate();var a=this.globSet=this.braceExpand();r.debug&&(this.debug=function(){console.error.apply(console,arguments)}),this.debug(this.pattern,a),a=this.globParts=a.map(function(t){return t.split(We)}),this.debug(this.pattern,a),a=a.map(function(t,n,l){return t.map(this.parse,this)},this),this.debug(this.pattern,a),a=a.filter(function(t){return t.indexOf(!1)===-1}),this.debug(this.pattern,a),this.set=a}w.prototype.parseNegate=Wt;function Wt(){var e=this.pattern,r=!1,a=this.options,t=0;if(!a.nonegate){for(var n=0,l=e.length;n<l&&e.charAt(n)==="!";n++)r=!r,t++;t&&(this.pattern=e.substr(t)),this.negate=r}}M.braceExpand=function(e,r){return ze(e,r)};w.prototype.braceExpand=ze;function ze(e,r){return r||(this instanceof w?r=this.options:r={}),e=typeof e=="undefined"?this.pattern:e,re(e),r.nobrace||!/\{(?:(?!\{).)*\}/.test(e)?[e]:$t(e)}var zt=1024*64,re=function(e){if(typeof e!="string")throw new TypeError("invalid pattern");if(e.length>zt)throw new TypeError("pattern is too long")};w.prototype.parse=Kt;var J={};function Kt(e,r){re(e);var a=this.options;if(e==="**")if(a.noglobstar)e="*";else return be;if(e==="")return"";var t="",n=!!a.nocase,l=!1,o=[],d=[],i,u=!1,c=-1,s=-1,f=e.charAt(0)==="."?"":a.dot?"(?!(?:^|\\/)\\.{1,2}(?:$|\\/))":"(?!\\.)",v=this;function p(){if(i){switch(i){case"*":t+=pe,n=!0;break;case"?":t+=ve,n=!0;break;default:t+="\\"+i;break}v.debug("clearStateChar %j %j",i,t),i=!1}}for(var h=0,O=e.length,m;h<O&&(m=e.charAt(h));h++){if(this.debug("%s	%s %s %j",e,h,t,m),l&&Te[m]){t+="\\"+m,l=!1;continue}switch(m){case"/":return!1;case"\\":p(),l=!0;continue;case"?":case"*":case"+":case"@":case"!":if(this.debug("%s	%s %s %j <-- stateChar",e,h,t,m),u){this.debug("  in class"),m==="!"&&h===s+1&&(m="^"),t+=m;continue}v.debug("call clearStateChar %j",i),p(),i=m,a.noext&&p();continue;case"(":if(u){t+="(";continue}if(!i){t+="\\(";continue}o.push({type:i,start:h-1,reStart:t.length,open:Re[i].open,close:Re[i].close}),t+=i==="!"?"(?:(?!(?:":"(?:",this.debug("plType %j %j",i,t),i=!1;continue;case")":if(u||!o.length){t+="\\)";continue}p(),n=!0;var b=o.pop();t+=b.close,b.type==="!"&&d.push(b),b.reEnd=t.length;continue;case"|":if(u||!o.length||l){t+="\\|",l=!1;continue}p(),t+="|";continue;case"[":if(p(),u){t+="\\"+m;continue}u=!0,s=h,c=t.length,t+=m;continue;case"]":if(h===s+1||!u){t+="\\"+m,l=!1;continue}var R=e.substring(s+1,h);try{RegExp("["+R+"]")}catch{var S=this.parse(R,J);t=t.substr(0,c)+"\\["+S[0]+"\\]",n=n||S[1],u=!1;continue}n=!0,u=!1,t+=m;continue;default:p(),l?l=!1:Te[m]&&!(m==="^"&&u)&&(t+="\\"),t+=m}}for(u&&(R=e.substr(s+1),S=this.parse(R,J),t=t.substr(0,c)+"\\["+S[0],n=n||S[1]),b=o.pop();b;b=o.pop()){var A=t.slice(b.reStart+b.open.length);this.debug("setting tail",t,b),A=A.replace(/((?:\\{2}){0,64})(\\?)\|/g,function(we,Se,ie){return ie||(ie="\\"),Se+Se+ie+"|"}),this.debug(`tail=%j
   %s`,A,A,b,t);var q=b.type==="*"?pe:b.type==="?"?ve:"\\"+b.type;n=!0,t=t.slice(0,b.reStart)+q+"\\("+A}p(),l&&(t+="\\\\");var F=!1;switch(t.charAt(0)){case"[":case".":case"(":F=!0}for(var D=d.length-1;D>-1;D--){var T=d[D],G=t.slice(0,T.reStart),ae=t.slice(T.reStart,T.reEnd-8),ye=t.slice(T.reEnd-8,T.reEnd),V=t.slice(T.reEnd);ye+=V;var Ke=G.split("(").length-1,se=V;for(h=0;h<Ke;h++)se=se.replace(/\)[+*?]?/,"");V=se;var xe="";V===""&&r!==J&&(xe="$");var Je=G+ae+V+xe+ye;t=Je}if(t!==""&&n&&(t="(?=.)"+t),F&&(t=f+t),r===J)return[t,n];if(!n)return Qt(e);var Qe=a.nocase?"i":"";try{var oe=new RegExp("^"+t+"$",Qe)}catch{return new RegExp("$.")}return oe._glob=e,oe._src=t,oe}M.makeRe=function(e,r){return new w(e,r||{}).makeRe()};w.prototype.makeRe=Jt;function Jt(){if(this.regexp||this.regexp===!1)return this.regexp;var e=this.set;if(!e.length)return this.regexp=!1,this.regexp;var r=this.options,a=r.noglobstar?pe:r.dot?Ut:Vt,t=r.nocase?"i":"",n=e.map(function(l){return l.map(function(o){return o===be?a:typeof o=="string"?Zt(o):o._src}).join("\\/")}).join("|");n="^(?:"+n+")$",this.negate&&(n="^(?!"+n+").*$");try{this.regexp=new RegExp(n,t)}catch{this.regexp=!1}return this.regexp}M.match=function(e,r,a){a=a||{};var t=new w(r,a);return e=e.filter(function(n){return t.match(n)}),t.options.nonull&&!e.length&&e.push(r),e};w.prototype.match=function(r,a){if(typeof a=="undefined"&&(a=this.partial),this.debug("match",r,this.pattern),this.comment)return!1;if(this.empty)return r==="";if(r==="/"&&a)return!0;var t=this.options;H.sep!=="/"&&(r=r.split(H.sep).join("/")),r=r.split(We),this.debug(this.pattern,"split",r);var n=this.set;this.debug(this.pattern,"set",n);var l,o;for(o=r.length-1;o>=0&&(l=r[o],!l);o--);for(o=0;o<n.length;o++){var d=n[o],i=r;t.matchBase&&d.length===1&&(i=[l]);var u=this.matchOne(i,d,a);if(u)return t.flipNegate?!0:!this.negate}return t.flipNegate?!1:this.negate};w.prototype.matchOne=function(e,r,a){var t=this.options;this.debug("matchOne",{this:this,file:e,pattern:r}),this.debug("matchOne",e.length,r.length);for(var n=0,l=0,o=e.length,d=r.length;n<o&&l<d;n++,l++){this.debug("matchOne loop");var i=r[l],u=e[n];if(this.debug(r,i,u),i===!1)return!1;if(i===be){this.debug("GLOBSTAR",[r,i,u]);var c=n,s=l+1;if(s===d){for(this.debug("** at the end");n<o;n++)if(e[n]==="."||e[n]===".."||!t.dot&&e[n].charAt(0)===".")return!1;return!0}for(;c<o;){var f=e[c];if(this.debug(`
globstar while`,e,c,r,s,f),this.matchOne(e.slice(c),r.slice(s),a))return this.debug("globstar found match!",c,o,f),!0;if(f==="."||f===".."||!t.dot&&f.charAt(0)==="."){this.debug("dot detected!",e,c,r,s);break}this.debug("globstar swallow a segment, and continue"),c++}return!!(a&&(this.debug(`
>>> no match, partial?`,e,c,r,s),c===o))}var v;if(typeof i=="string"?(v=u===i,this.debug("string match",i,u,v)):(v=u.match(i),this.debug("pattern match",i,u,v)),!v)return!1}if(n===o&&l===d)return!0;if(n===o)return a;if(l===d)return n===o-1&&e[n]==="";throw new Error("wtf?")};function Qt(e){return e.replace(/\\(.)/g,"$1")}function Zt(e){return e.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")}const Xt={class:"p-3 flex gap-4 items-center"},Yt={class:"flex flex-1 gap-1"},en=fe(" Add Filter "),tn={class:"px-1 py-1"},nn={class:"flex-1"},rn={class:"w-full text-sm text-left text-gray-500 dark:text-gray-400"},an={class:"text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"},sn=["onClick"],on={class:"flex items-center gap-2"},ln=y("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19 9l-7 7-7-7"},null,-1),un=[ln],cn={key:0,class:"p-3 text-center text-sm text-gray-500 flex flex-col items-center justify-center"},fn=y("svg",{xmlns:"http://www.w3.org/2000/svg",class:"h-28 w-28 text-gray-200",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","stroke-width":"1"},[y("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"})],-1),dn=y("p",null,"No data",-1),vn=[fn,dn],pn={class:"p-3 text-center text-sm text-gray-500"},hn={key:0,class:"flex gap-4 justify-end w-full"},mn=["onClick"],xn={__name:"DTable",props:{columns:Array,data:Array,meta:Object},setup(e){const r=I(""),a=I(1),t=I(""),n=I(!0),l=I({});Q(()=>{var u,c;r.value=(c=(u=route().params)==null?void 0:u.search)!=null?c:""});const o=u=>{!u.sort||(t.value===u.name?n.value=!n.value:t.value=u.name,i())},d=u=>{console.log(u.name),l.value[u.name]=""},i=()=>{var u=Object.keys(l.value),c={};u.forEach(function(f){l[f]!=""&&(c["search_"+f]=l.value[f],c["search_"+f]==""&&delete c["search_"+f])}),console.log(c);var s={search:r.value,page:a.value,sort_by:t.value,sort_order:n.value?"asc":"desc"};s.search===""&&delete s.search,s.sort_by===""&&(delete s.sort_by,delete s.sort_order),nt.Inertia.get(route(route().current(),{...s,...c}),{},{preserveState:!0,onProgress:()=>{console.log(0)}})};return(u,c)=>(k(),E(C,null,[y("div",Xt,[y("div",Yt,[N(Ee,{modelValue:r.value,"onUpdate:modelValue":c[0]||(c[0]=s=>r.value=s),onFocusout:i,placeholder:"Search...",type:"text",class:"mt-1 inline w-full text-sm flex-grow",required:""},null,8,["modelValue"])]),N(W(Et),{as:"div",class:"relative inline-block text-left"},{default:B(()=>[y("div",null,[N(W(It),{class:""},{default:B(()=>[N(at,{class:"text-sm"},{default:B(()=>[en]),_:1})]),_:1})]),N(et,{"enter-active-class":"transition duration-100 ease-out","enter-from-class":"transform scale-95 opacity-0","enter-to-class":"transform scale-100 opacity-100","leave-active-class":"transition duration-75 ease-in","leave-from-class":"transform scale-100 opacity-100","leave-to-class":"transform scale-95 opacity-0"},{default:B(()=>[N(W(Ot),{class:"absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"},{default:B(()=>[y("div",tn,[(k(!0),E(C,null,$(e.columns.filter(s=>s.filter),s=>(k(),tt(W(_t),{key:s,onClick:f=>d(s)},{default:B(({active:f})=>[y("button",{class:z([f?"bg-gray-200":"text-gray-900","group flex w-full items-center rounded-md px-2 py-2 text-sm"])},K(s.label),3)]),_:2},1032,["onClick"]))),128))])]),_:1})]),_:1})]),_:1})]),(k(!0),E(C,null,$(Object.keys(l.value),s=>(k(),E("div",{class:"p-3 flex gap-4",key:s},[y("div",nn,[N(rt,{value:s},null,8,["value"]),N(Ee,{modelValue:l.value[s],"onUpdate:modelValue":f=>l.value[s]=f,placeholder:"Search...",type:"text",class:"mt-1 inline w-full text-sm flex-grow",required:""},null,8,["modelValue","onUpdate:modelValue"])])]))),128)),y("table",rn,[y("thead",an,[y("tr",null,[(k(!0),E(C,null,$(e.columns,s=>(k(),E("th",{key:s,scope:"col",class:z(["px-6 py-3",s.sort?" cursor-pointer ":""]),onClick:f=>o(s)},[y("div",on,[ke(u.$slots,"col_"+s.name,{},()=>[fe(K(s.label),1)]),s.sort&&t.value==s.name?(k(),E("svg",{key:0,xmlns:"http://www.w3.org/2000/svg",class:z([!s.name==t.value?"":n.value?"transform rotate-180":"","h-4 w-4 text-gray-500"]),fill:"none",viewBox:"0 0 24 24",stroke:"currentColor","stroke-width":"2"},un,2)):le("",!0)])],10,sn))),128))])]),y("tbody",null,[(k(!0),E(C,null,$(e.data,s=>(k(),E("tr",{key:s,class:"bg-white border-b dark:bg-gray-800 dark:border-gray-700"},[(k(!0),E(C,null,$(e.columns,f=>(k(),E("td",{key:f,scope:"row",class:"px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"},[ke(u.$slots,f.name,{row:s,col:f},()=>[fe(K(s[f.name]),1)])]))),128))]))),128))])]),e.data.length<1?(k(),E("div",cn,vn)):le("",!0),y("div",pn,[e.data.length>0?(k(),E("ul",hn,[(k(!0),E(C,null,$(e.meta.last_page,s=>(k(),E("li",{onClick:()=>{a.value=s,i()},class:z(["cursor-pointer text-blue-600",e.meta.current_page!=s?"text-opacity-50":""]),key:s},[y("a",null,K(s),1)],10,mn))),128))])):le("",!0)])],64))}};export{xn as _};