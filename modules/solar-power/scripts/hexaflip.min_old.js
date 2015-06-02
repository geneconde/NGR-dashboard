(function(){var e,t,n,r,i,s,o,u,a,f,l,c,h,p,d,v=this;e="hexaFlip";t=e[0].toUpperCase()+e.slice(1);u=["webkit","Moz","O","ms"];a=function(e){var t,n,r,i;if(document.body.style[e.toLowerCase()]!=null){return e.toLowerCase()}for(r=0,i=u.length;r<i;r++){t=u[r];n=t+e;if(document.body.style[n]!=null){return n}}return false};n={};p=["Transform","Perspective"];for(c=0,h=p.length;c<h;c++){f=p[c];n[f.toLowerCase()]=a(f)}i={size:400,margin:20,fontSize:264,perspective:1e3,touchSensitivity:1};r=e.toLowerCase();s=["front","bottom","back","top","left","right"];o=s.slice(0,4);l=/^((((https?)|(file)):)?\/\/)|(data:)|(\.\.?\/)/i;window.HexaFlip=function(){function e(t,s,o){var u,a,f,c,h,p,d,v,m,g,y,b,w,E,S,x,T,N=this;this.el=t;this.sets=s;this.options=o!=null?o:{};this._onMouseOut=function(t,n){return e.prototype._onMouseOut.apply(N,arguments)};if(!(n.transform&&this.el)){return}for(d in i){b=i[d];this[d]=(x=this.options[d])!=null?x:i[d]}if(typeof this.fontSize==="number"){this.fontSize+="px"}if(!this.sets){this.el.classList.add(r+"-timepicker");this.sets={hour:function(){var e,t;t=[];for(f=e=1;e<=12;f=++e){t.push(f+"")}return t}(),minute:function(){var e,t;t=[];for(f=e=0;e<=60;f=++e){t.push(f+"")}return t}(),meridian:["am","pm"]}}m=Object.keys(this.sets);g=m.length;a=document.createDocumentFragment();f=w=0;p=g/2+1;this.cubes={};T=this.sets;for(h in T){v=T[h];u=this.cubes[h]=this._createCube(h);if(++f<p){w++}else{w--}u.el.style.zIndex=w;this._setContent(u.front,v[0]);a.appendChild(u.el);for(E=0,S=v.length;E<S;E++){y=v[E];if(l.test(y)){c=new Image;c.src=y}}}this.cubes[m[0]].el.style.marginLeft="0";this.cubes[m[m.length-1]].el.style.marginRight="0";this.el.classList.add(r);this.el.style.height=this.size+"px";this.el.style.width=(this.size+this.margin*2)*g-this.margin*2+"px";this.el.style[n.perspective]=this.perspective+"px";this.el.appendChild(a)}e.prototype._createCube=function(e){var t,i,o,u,a,f,l,c,h,p,d,v,m,g,y=this;t={set:e,offset:0,y1:0,yDelta:0,yLast:0,el:document.createElement("div")};t.el.className=""+r+"-cube "+r+"-cube-"+e;t.el.style.margin="0 "+this.margin+"px";t.el.style.width=t.el.style.height=this.size+"px";t.el.style[n.transform]=this._getTransform(0);for(h=0,v=s.length;h<v;h++){l=s[h];t[l]=document.createElement("div");t[l].className=r+"-"+l;f=function(){switch(l){case"front":return"0, 0, 0, 0deg";case"back":return"1, 0, 0, 180deg";case"top":return"1, 0, 0, 90deg";case"bottom":return"1, 0, 0, -90deg";case"left":return"0, 1, 0, -90deg";case"right":return"0, 1, 0, 90deg"}}();t[l].style[n.transform]="rotate3d("+f+") translate3d(0, 0, "+this.size/2+"px)";t[l].style.fontSize=this.fontSize;t.el.appendChild(t[l])}u=[["TouchStart","MouseDown"],["TouchMove","MouseMove"],["TouchEnd","MouseUp"],["TouchLeave","MouseLeave"]];a="onmouseleave"in window;for(p=0,m=u.length;p<m;p++){o=u[p];c=function(e,t){if(!((i==="TouchLeave"||i==="MouseLeave")&&!a)){return t.el.addEventListener(i.toLowerCase(),function(n){return y[e](n,t)},true)}else{return t.el.addEventListener("mouseout",function(e){return y._onMouseOut(e,t)},true)}};for(d=0,g=o.length;d<g;d++){i=o[d];c("_on"+o[0],t)}}this._setSides(t);return t};e.prototype._getTransform=function(e){return"translateZ(-"+this.size/2+"px) rotateX("+e+"deg)"};e.prototype._setContent=function(e,t){var n,r,i,s;if(!(e&&t)){return}if(typeof t==="object"){r=t.style,s=t.value;for(n in r){i=r[n];e.style[n]=i}}else{s=t}if(l.test(s)){e.innerHTML="";return e.style.backgroundImage="url("+s+")"}else{return e.innerHTML=s}};e.prototype._setSides=function(e){var t,r,i,s,u,a,f;e.el.style[n.transform]=this._getTransform(e.yDelta);e.offset=i=Math.floor(e.yDelta/90);if(i===e.lastOffset){return}e.lastOffset=r=a=i;s=this.sets[e.set];u=s.length;if(i<0){r=a=++i;if(i<0){if(-i>u){a=u- -i%u;if(a===u){a=0}}else{a=u+i}if(-i>4){r=4- -i%4;if(r===4){r=0}}else{r=4+i}}}if(a>=u){a%=u}if(r>=4){r%=4}f=r-1;t=r+1;if(f===-1){f=3}if(t===4){t=0}this._setContent(e[o[f]],s[a-1]||s[u-1]);return this._setContent(e[o[t]],s[a+1]||s[0])};e.prototype._onTouchStart=function(e,t){e.preventDefault();t.touchStarted=true;e.currentTarget.classList.add("no-tween");if(e.type==="mousedown"){return t.y1=e.pageY}else{return t.y1=e.touches[0].pageY}};e.prototype._onTouchMove=function(e,t){if(!t.touchStarted){return}e.preventDefault();t.diff=(e.pageY-t.y1)*this.touchSensitivity;t.yDelta=t.yLast-t.diff;return this._setSides(t)};e.prototype._onTouchEnd=function(e,t){var r;t.touchStarted=false;r=t.yDelta%90;if(r<45){t.yLast=t.yDelta+r}else{if(t.yDelta>0){t.yLast=t.yDelta+r}else{t.yLast=t.yDelta-(90-r)}}if(t.yLast%90!==0){t.yLast-=t.yLast%90}t.el.classList.remove("no-tween");return t.el.style[n.transform]=this._getTransform(t.yLast)};e.prototype._onTouchLeave=function(e,t){if(!t.touchStarted){return}return this._onTouchEnd(e,t)};e.prototype._onMouseOut=function(e,t){if(!t.touchStarted){return}if(e.toElement&&!t.el.contains(e.toElement)){return this._onTouchEnd(e,t)}};e.prototype.setValue=function(e){var t,n,r,i,s;s=[];for(r in e){i=e[r];if(!(this.sets[r]&&!this.cubes[r].touchStarted)){continue}i=i.toString();t=this.cubes[r];n=this.sets[r].indexOf(i);t.yDelta=t.yLast=90*n;this._setSides(t);s.push(this._setContent(t[o[n%4]],i))}return s};e.prototype.getValue=function(){var e,t,n,r,i,s;i=this.cubes;s=[];for(n in i){e=i[n];n=this.sets[n];r=n.length;t=e.yLast/90;if(t<0){if(-t>r){t=r- -t%r;if(t===r){t=0}}else{t=r+t}}if(t>=r){t%=r}if(typeof n[t]==="object"){s.push(n[t].value)}else{s.push(n[t])}}return s};e.prototype.flip=function(e){var t,n,r,i,s;n=e?-90:90;i=this.cubes;s=[];for(r in i){t=i[r];if(t.touchStarted){continue}t.yDelta=t.yLast+=n;s.push(this._setSides(t))}return s};e.prototype.flipBack=function(){return this.flip(true)};return e}();if(window.jQuery!=null||((d=window.$)!=null?d.data:void 0)!=null){$.fn.hexaFlip=function(t,r){var i,s,o,u,a,f,l,c;if(!n.transform){return this}if(typeof t==="string"){u=t;if(typeof HexaFlip.prototype[u]!=="function"){return this}for(a=0,l=this.length;a<l;a++){s=this[a];if(!(o=$.data(s,e))){return}i=Array.prototype.slice.call(arguments);i.shift();o[u](i)}return this}else{for(f=0,c=this.length;f<c;f++){s=this[f];if(o=$.data(s,e)){return o}else{$.data(s,e,new HexaFlip(s,t,r))}}}}}}).call(this)