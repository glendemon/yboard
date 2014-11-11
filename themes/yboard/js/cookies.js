/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function createCookie(n,t,i){var r,u;i?(r=new Date,r.setTime(r.getTime()+i*864e5),u="; expires="+r.toGMTString()):u="";document.cookie=n+"="+t+u+"; path=/"}
function readCookie(n){for(var t,r=n+"=",u=document.cookie.split(";"),i=0;i<u.length;i++){for(t=u[i];t.charAt(0)==" ";)t=t.substring(1,t.length);if(t.indexOf(r)==0)return t.substring(r.length,t.length)}}
    