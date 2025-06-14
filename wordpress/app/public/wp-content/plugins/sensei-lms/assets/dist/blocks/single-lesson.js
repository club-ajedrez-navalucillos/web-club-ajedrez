/******/(()=>{// webpackBootstrap
/******/var e={
/***/2192:
/***/(e,s,t)=>{"use strict";
/**
 * @license React
 * react-jsx-runtime.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */var n=t(51609),r=Symbol.for("react.element"),o=Symbol.for("react.fragment"),i=Object.prototype.hasOwnProperty,l=n.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,a={key:!0,ref:!0,__self:!0,__source:!0};function c(e,s,t){var n,o={},c=null,d=null;for(n in void 0!==t&&(c=""+t),void 0!==s.key&&(c=""+s.key),void 0!==s.ref&&(d=s.ref),s)i.call(s,n)&&!a.hasOwnProperty(n)&&(o[n]=s[n]);if(e&&e.defaultProps)for(n in s=e.defaultProps)void 0===o[n]&&(o[n]=s[n]);return{$$typeof:r,type:e,key:c,ref:d,props:o,_owner:l.current}}s.Fragment=o,s.jsx=c,s.jsxs=c}
/***/,
/***/3582:
/***/e=>{"use strict";e.exports=window.wp.coreData}
/***/,
/***/4452:
/***/(e,s)=>{var t;
/*!
	Copyright (c) 2018 Jed Watson.
	Licensed under the MIT License (MIT), see
	http://jedwatson.github.io/classnames
*/
/* global define */!function(){"use strict";var n={}.hasOwnProperty;function r(){for(var e="",s=0;s<arguments.length;s++){var t=arguments[s];t&&(e=i(e,o(t)))}return e}function o(e){if("string"==typeof e||"number"==typeof e)return e;if("object"!=typeof e)return"";if(Array.isArray(e))return r.apply(null,e);if(e.toString!==Object.prototype.toString&&!e.toString.toString().includes("[native code]"))return e.toString();var s="";for(var t in e)n.call(e,t)&&e[t]&&(s=i(s,t));return s}function i(e,s){return s?e?e+" "+s:e+s:e}e.exports?(r.default=r,e.exports=r):void 0===(t=function(){return r}.apply(s,[]))||(e.exports=t)}()}
/***/,
/***/17757:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>i
/* harmony export */});
/* harmony import */var n=t(50737),r=t(99423),o=t(81828);
/* harmony import */
/**
 * Internal dependencies
 */
/* harmony default export */const i={...r,metadata:r,icon:n/* ["default"] */.A,example:{attributes:{difficulty:"easy",length:10}},edit:o/* ["default"] */.A,save:()=>null};
/***/},
/***/25335:
/***/e=>{"use strict";e.exports=JSON.parse('{"name":"sensei-lms/featured-video","title":"Featured Video","description":"Add a featured video to your lesson to highlight the video and make use of our video templates.","icon":"format-video","category":"sensei-lms","textdomain":"sensei-lms","supports":{"multiple":false}}')}
/***/,
/***/27723:
/***/e=>{"use strict";e.exports=window.wp.i18n}
/***/,
/***/47056:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>l
/* harmony export */});
/* harmony import */var n=t(66087),r=t(74997),o=t(48597),i=t(62540);
/* harmony import */
/**
 * External dependencies
 */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
/**
 * Register Sensei blocks.
 *
 * @todo  Refactor how the metadata and settings are passed to `registerBlockType`.
 * @param {Array} blocks Blocks to be registered.
 */
const l=e=>{(0,r.updateCategory)("sensei-lms",{icon:(0/* ["default"] */,i.jsx)(o.A,{width:"20",height:"20"})}),e.forEach((e=>{let{metadata:s,name:t,...o}=e;s&&(
// Remove the overlapping metadata keys from the settings object to make localization work.
// This is needed because only the metadata object is localized, but the overlapping keys will be overwritten by the settings object and the localization is lost.
o=(0,n.omit)(o,Object.keys(s))),
// The metadata object should be used for the `block.json` strings to be localized.
// See https://github.com/Automattic/sensei/pull/5782 for more details.
// The metadata object should be used for the `block.json` strings to be localized.
// See https://github.com/Automattic/sensei/pull/5782 for more details.
(0,r.registerBlockType)(s||t,o)}))};
/* harmony default export */}
/***/,
/***/47143:
/***/e=>{"use strict";e.exports=window.wp.data}
/***/,
/***/48597:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>l
/* harmony export */});
/* harmony import */var n,r,o=t(51609);
/* harmony import */function i(){return i=Object.assign?Object.assign.bind():function(e){for(var s=1;s<arguments.length;s++){var t=arguments[s];for(var n in t)({}).hasOwnProperty.call(t,n)&&(e[n]=t[n])}return e},i.apply(null,arguments)}
/* harmony default export */const l=function(e){
return o.createElement("svg",i({viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg"},e),n||(n=o.createElement("circle",{cx:12,cy:12,r:12,fill:"#43AF99"})),r||(r=o.createElement("path",{fillRule:"evenodd",clipRule:"evenodd",d:"M9.835 15.38c.3-.23.179-.474.6-.563-.02.194.146.391.251.563-.109-.367-.002-.536.08-.72.347-.785-.662-1.293-1.35-1.418.235-.164.399-.327.694-.355a2.377 2.377 0 0 0-1.058.23c-1.112.531-1.993-.523-1.41-1.48.31-.51.664-.519.982-.865.077.178.103.372.075.564a.919.919 0 0 0 .049-.664c-.104-.336-.4-.338-.456-.821-.012-.101-.105.056-.263-.077-.038-.032-.113-.09-.163-.064-.085.044-.18.008-.232.034-.083.041-.109-.045-.2.016-.16.107-.178-.013-.332.005-.193.023-.32.261-.43.144-.102-.108-.206.075-.28.075-.05 0-.311.317-.426.028-.086-.216-.28.206-.382.063-.033-.046-.123.108-.18-.044-.014-.035 0-.078-.108-.027-.215.099-.138-.06-.207-.144-.083-.103-.113-.103-.068-.27.036-.133-.019-.33.2-.364.055-.008.107-.005.184-.148.096-.18.231-.093.207-.175-.036-.119.143-.28.226-.355.11-.103.254-.252.306-.396a.63.63 0 0 1 .102-.141c.081-.084.105-.003.227-.045.088-.03.02.053.106-.07.028-.038.105-.001.19-.039.259-.112.283-.11.347-.371.012-.05.025-.088.08-.083.109.01.134-.052.2-.05.061.001.083-.03.115-.068.18-.216.277-.055.357-.072.06-.012.022-.142.184-.102.23.057.155-.05.303-.015.174.041.186.19.306.225.143.042.211.198.307.196.337-.005.235.23.448.323-.16-.161.012-.421-.352-.455-.08-.007-.11-.127-.23-.183-.146-.067-.13-.21-.394-.27.068-.04.089.005.13-.073.058-.11.09-.046.113-.113.02-.063.006-.099.165-.155.165-.06.325-.195.472-.188.13.006.185-.08.177-.19-.008-.112-.033-.267.222-.22.153.029.15.003.15-.1-.002-.102.04-.165.174-.16.098.002.194-.003.231-.117.03-.091.207-.114.302-.148.317-.114.361.05.447-.095.07-.117.196-.317.337-.175.028.029.054.05.15-.056.08-.088.27-.2.337-.048.027.06.086.121.138.044a.08.08 0 0 1 .053-.039c.05-.01.079-.024.104-.036.218-.101.314-.095.213.125-.142.316.792-.192.532.151-.095.126.538.197.63.254.05.032.048.059.144.077.271.05.267.026.284.243.007.098.107.043.107.168 0 .535.472.266.549.399.012.022.032.042.079.042.149 0 .157-.03.224.089.027.047.05.072.127.096.12.037.112.05.068.138-.054.104.03.102.138.112.1.01.148.062.216.138.11.122.284.156.43.227.084.04.002.14.143.243.104.077.156.066.016.165-.59.418.22.305.446.694.051.087.118.195.216.295.225.23.1.293.221.437.07.083.015.063.13.137.272.175-.105.292-.319.212-.097-.035-.166-.085-.147-.025.016.049-.01.083-.052.12-.125.112.123.068.181.06.181-.025.664-.076.66.093-.005.22.136.27.25.284.185.024.238.057.34.226.092.152.145.07.288.205.097.093.217.258.02.282-.047.005-.099 0-.12.017a.411.411 0 0 1-.14.066c-.295.09.14.136.246.113.093-.02.209-.05.3-.027.057.015.062.08.244.107.06.01.036.099.006.16-.104.214.191.1.16.263-.017.093.11.245-.067.248-.057.001-.117-.015-.115.034.004.105-.165-.03-.317.115-.056.054-.19.092-.272-.009-.032-.038-.07-.069-.218-.023-.144.046-.242.204-.306-.04-.017-.064-.05-.065-.142-.097-.125-.043-.114-.258-.297-.12a.24.24 0 0 1-.214.039c-.144-.037-.303.012-.317-.096-.021-.179-.191-.305-.377-.296-.147.008-.278.034-.355-.137.057.195.207.208.382.208.144 0 .23.075.255.225.045.265.204.099.406.223.1.06.17.159.21.273.042.118.37-.024.282.258-.037.122-.107.168-.242.266-.4.294-.5.004-.618.239-.062.121-.063.031-.196.09-.22.098-.36-.128-.522-.045-.182.094-.168-.08-.352.037-.152.097-.308-.074-.38.192-.063.227-.322.232-.44.11-.189-.194-.132.229-.362.054-.123-.091-.213.043-.392.045-.33.005-.489-.282-.65-.107-.192.206-.331-.032-.334-.242-.003-.216-.777-.144-1.185-.256-.225-.062-.932.013-.702-.35-.372.39.456.366.682.455.136.053.245.095.377.114.13.296.214.617.227 1.007.043-.214.053-.433.028-.649-.043-.383.242.19.276.272.184.45-.022 1.278-.488 1.526a2.957 2.957 0 0 0-.562-.99c.256.392.616 1.192.327 1.65a1.023 1.023 0 0 1-.55-.483c.077.333.413.702.818.58.707-.213.704.233 1.641.307.682.111 1.654 0 2.118.037.254.02 1.32.197 1.315.465-.02 1.105-.438 1.164-1.539 1.268-.64.06-1.134.085-1.823.11-1.54.058-3.391.06-4.868 0-.724-.03-1.072-.036-1.841-.137-.769-.1-1.19-.363-1.178-1.187.005-.304.905-.594 1.2-.628.347-.039.901.005 1.405-.116.527-.127.747-.21 1.135-.508Zm5.347-6.052c-.167-.042-.051-.138-.339-.014-.17.073-.194-.13-.365-.094-.172.036-.242-.125-.499-.166-.318-.05-.088-.133-.592-.032-.097.02-.179-.09-.481-.052-.355.046-.23.084-.445-.115-.272-.251-.488-.082-.767-.184.216.166.368.019.622.221-.242.138-.523.802-.962.844.478.107.709.354 1.148.413.504.068.882.118 1.151.531.301.463.44.196.874.168.275-.017.282-.185.328-.362.063-.245.126-.256.31-.289.213-.037.163-.092.107-.156-.15-.172.019-.207.146-.244.222-.064.042-.075.042-.166-.278-.09-.063-.217.092-.273.169.105.242.087.317.073.109-.021.181.03.273-.028-.135.014-.163-.037-.278-.02-.051.007-.112.01-.219-.054-.18-.107-.27.048-.463 0Zm-2.28 1.64-1.09-.545c-1.316-.657-1.915.313-2.337 1.376l-.766.73c.549-.338.996-.714 1.574-.71.092 0 1.516.484 1.286-.092-.04-.104.09-.052.125-.201.04-.17.055-.141.195-.033.089.069.211.113.174-.048-.017-.072-.04-.137.28-.004.15.062.095-.064.303-.09.29-.034.228-.31.364-.349.076-.022.152.058.295-.077.05-.046.11-.089.232-.057-.143-.073-.22-.014-.292.03-.146.089-.204-.037-.343.07Zm-2.23-1.923c.16-.02.32-.036.482-.046a.13.13 0 0 0 .074-.06.111.111 0 0 0 .007-.09.268.268 0 0 1 .147-.206l-.002-.003c-.258.001-.466.1-.73.211-.052.022-.024.111-.118.213a.26.26 0 0 1-.201.235.136.136 0 0 0-.09.046.113.113 0 0 0-.026.092.252.252 0 0 1-.277.061c-.2-.077-.35-.065-.448.036a.39.39 0 0 1 .398.014c.134.066.3.031.39-.082a.132.132 0 0 1 .126-.098.421.421 0 0 0 .268-.323Z",fill:"#fff"})))};
/***/},
/***/50737:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>l
/* harmony export */});
/* harmony import */var n,r,o=t(51609);
/* harmony import */function i(){return i=Object.assign?Object.assign.bind():function(e){for(var s=1;s<arguments.length;s++){var t=arguments[s];for(var n in t)({}).hasOwnProperty.call(t,n)&&(e[n]=t[n])}return e},i.apply(null,arguments)}
/* harmony default export */const l=function(e){
return o.createElement("svg",i({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},e),n||(n=o.createElement("path",{d:"M16.181 17.381a7.61 7.61 0 0 1-2.13.133L15.778 20H18l-1.819-2.619zm-5.479-.953a7.712 7.712 0 0 1-2.12-1.928H5.5v-9h2.759A7.793 7.793 0 0 1 9.523 4H4v12h4.778L6 20h2.222l2.48-3.572zM15.541 8.944h-1.5v3.997h1.5V8.944zm0-1h-1.5V6.55h1.5v1.395z"})),r||(r=o.createElement("path",{d:"M20.79 9.768c0 3.425-2.714 6.269-6.145 6.269-3.43 0-6.145-2.844-6.145-6.269 0-3.424 2.714-6.268 6.145-6.268 3.43 0 6.145 2.844 6.145 6.268zm-6.145 4.769c2.565 0 4.645-2.135 4.645-4.769C19.29 7.135 17.21 5 14.645 5 12.08 5 10 7.135 10 9.768c0 2.634 2.08 4.769 4.645 4.769z"})))};
/***/},
/***/51609:
/***/e=>{"use strict";e.exports=window.React}
/***/,
/***/52619:
/***/e=>{"use strict";e.exports=window.wp.hooks}
/***/,
/***/56427:
/***/e=>{"use strict";e.exports=window.wp.components}
/***/,
/***/60817:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>a
/* harmony export */});
/* harmony import */var n=t(4452),r=t.n(n),o=t(56427),i=t(27723),l=t(62540);
/* harmony import */
/**
 * External dependencies
 */
/**
 * WordPress dependencies
 */
/**
 * Number control component.
 *
 * @param {Object}   props                     Component props.
 * @param {string}   [props.className]         Additional classnames for the input.
 * @param {string}   [props.id]                Component id used to connect label and input - required if label is set.
 * @param {string}   [props.label]             Input label.
 * @param {number}   [props.value]             Input value.
 * @param {string}   [props.help]              Help text.
 * @param {boolean}  [props.allowReset=false]  Whether reset is allowed.
 * @param {string}   [props.resetLabel]        Reset button custom label.
 * @param {Function} props.onChange            Change function, which receives number as argument.
 * @param {string}   props.suffix              Input suffix.
 * @param {boolean}  props.hideLabelFromVision Hides label.
 */
const a=({className:e,id:s,label:t,value:n,help:a,allowReset:c=!1,resetLabel:d,onChange:u,suffix:p,hideLabelFromVision:m,...f})=>(0,l.jsx)(o.BaseControl,{id:s,label:t,help:a,hideLabelFromVision:m,children:(0,l.jsxs)("div",{className:"sensei-number-control",children:[(0,l.jsxs)("div",{className:"sensei-number-control__input-container",children:[(0,l.jsx)("input",{className:r()("sensei-number-control__input components-text-control__input",e),type:"number",id:s,onChange:e=>{u(parseInt(e.target.value,10)||f.min||0)},value:null===n?"":n,...f}),p&&(0,l.jsx)("span",{className:"sensei-number-control__input-suffix",children:p})]}),c&&(0,l.jsx)(o.Button,{className:"sensei-number-control__button",isSmall:!0,isSecondary:!0,onClick:()=>u(null),children:d||(0,i.__)("Reset","sensei-lms")})]})});
/* harmony default export */}
/***/,
/***/61277:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>p
/* harmony export */});
/* harmony import */var n=t(86087),r=t(74997),o=t(94715),i=t(47143),l=t(25335),a=t(90284),c=t(62540);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
const d=[["core/video"]],u=["core/embed","core/video","sensei-pro/interactive-video"],p={...l,metadata:l,example:{innerBlocks:[{name:"core/image",attributes:{url:`${window.sensei?.assetUrl}/images/featured-video-example.png`}}]},edit:function({className:e,clientId:s}){const{replaceInnerBlocks:t,moveBlockToPosition:l}=(0,i.useDispatch)("core/block-editor"),a=(0,i.useSelect)((e=>e("core/block-editor").getBlocks(s).length)),p=(0,n.useRef)(a);(0,n.useEffect)((()=>{p.current>0&&0===a&&t(s,[(0,r.createBlock)("core/video")],!1),p.current=a}),[a,s,t]);const{parentBlocks:m,rootClientId:f,blockIndex:v}=(0,i.useSelect)((e=>{const{getBlockParents:t,getBlockRootClientId:n,getBlockIndex:r}=e("core/block-editor");return{parentBlocks:t(s),rootClientId:n(s),blockIndex:r(s)}}),[s]);
// Move Featured Video block to top at top level.
return(0,n.useEffect)((()=>{(m?.length||v)&&l(s,f,"",0)}),[m,f,v,l,s]),(0,c.jsx)("div",{className:e,children:(0,c.jsx)(o.InnerBlocks,{allowedBlocks:u,template:d,renderAppender:!1})})},save:()=>(0,c.jsx)(o.InnerBlocks.Content,{}),transforms:a/* .transforms */.m}}
/***/,
/***/62540:
/***/(e,s,t)=>{"use strict";e.exports=t(2192)}
/***/,
/***/64724:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */K:()=>/* binding */o
/* harmony export */});
/* harmony import */var n=t(52619),r=t(27723);
/* harmony import */
/**
 * WordPress dependencies
 */
const o=(0,n.applyFilters)("sensei-lms.Lesson.difficulties",[{label:(0,r.__)("None","sensei-lms"),value:""},{label:(0,r.__)("Easy","sensei-lms"),value:"easy"},{label:(0,r.__)("Standard","sensei-lms"),value:"std"},{label:(0,r.__)("Hard","sensei-lms"),value:"hard"}]);
/***/},
/***/66087:
/***/e=>{"use strict";e.exports=window.lodash}
/***/,
/***/74997:
/***/e=>{"use strict";e.exports=window.wp.blocks}
/***/,
/***/81828:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */A:()=>f
/* harmony export */});
/* harmony import */var n=t(4452),r=t.n(n),o=t(86087),i=t(3582),l=t(94715),a=t(56427),c=t(27723),d=t(60817),u=t(64724),p=t(62540);
/* harmony import */
/**
 * External dependencies
 */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
const m=window?.sensei?.courseThemeEnabled||!1,f=e=>{const{className:s}=e,[t,n]=(0,i.useEntityProp)("postType","lesson","meta"),{_lesson_complexity:f="",_lesson_length:v=10}=t||{},h=!t,b=(0,o.useCallback)(((e,s)=>{n({...t,[e]:s})}),[t,n]);
return(0,p.jsxs)(p.Fragment,{children:[!h&&(0,p.jsx)(l.InspectorControls,{children:(0,p.jsxs)(a.PanelBody,{title:(0,c.__)("Properties","sensei-lms"),children:[(0/* ["default"] */,p.jsx)(d.A,{id:"sensei-lesson-length",label:(0,c.__)("Length","sensei-lms"),min:0,step:1,value:v,onChange:e=>b("_lesson_length",e),suffix:(0,c._n)("minute","minutes",v,"sensei-lms")}),(0,p.jsx)(a.SelectControl,{label:(0,c.__)("Difficulty","sensei-lms"),options:u/* .DIFFICULTIES */.K.map((({label:e,value:s})=>({label:e,value:s}))),value:f,onChange:e=>b("_lesson_complexity",e)})]})}),m?(0,p.jsx)(a.Notice,{status:"warning",isDismissible:!1,children:(0,c.__)("Since Learning Mode is activated, use this block to add the properties to each lesson and make sure your Lesson template contains the Lesson Properties block.","sensei-lms")}):(0,p.jsxs)("div",{className:s,children:[(0,p.jsx)("span",{className:r()("wp-block-sensei-lms-lesson-properties__length",{disabled:!v}),children:(0,c.__)("Length","sensei-lms")+": "+v+" "+(0,c._n)("minute","minutes",v,"sensei-lms")}),(0,p.jsx)("span",{className:r()("wp-block-sensei-lms-lesson-properties__separator",{disabled:!v||!f}),children:"|"}),(0,p.jsx)("span",{className:r()("wp-block-sensei-lms-lesson-properties__difficulty",{disabled:!f}),children:(0,c.__)("Difficulty","sensei-lms")+": "+u/* .DIFFICULTIES */.K.find((e=>f===e.value))?.label})]})]})}}
/***/,
/***/86087:
/***/e=>{"use strict";e.exports=window.wp.element}
/***/,
/***/90284:
/***/(e,s,t)=>{"use strict";
/* harmony export */t.d(s,{
/* harmony export */m:()=>/* binding */o
/* harmony export */});
/* harmony import */var n=t(74997),r=t(25335);
/* harmony import */
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
const o={from:["core/video","core/embed","sensei-pro/interactive-video"].map((e=>({type:"block",blocks:[e],transform:(s={},t=[])=>{let o=e;return"core/embed"!==o||s.providerNameSlug||(o="core/video"),(0,n.createBlock)(r.name,{},[(0,n.createBlock)(o,s,t)])}}))),to:["core/video","core/embed","sensei-pro/interactive-video"].map((e=>({type:"block",blocks:[e],isMatch:(s,t={})=>e===t.innerBlocks?.[0]?.name,transform:(s,t=[])=>{const{attributes:r={},innerBlocks:o=[]}=t[0]||{};return(0,n.createBlock)(e,r,o)}})))};
/***/},
/***/94715:
/***/e=>{"use strict";e.exports=window.wp.blockEditor}
/***/,
/***/99423:
/***/e=>{"use strict";e.exports=JSON.parse('{"name":"sensei-lms/lesson-properties","title":"Lesson Properties","description":"Add lesson properties such as length and difficulty.","category":"sensei-lms","textdomain":"sensei-lms","keywords":["metadata","length","complexity","difficulty","lesson information","lesson properties"]}')}
/***/
/******/},s={};
/************************************************************************/
/******/ // The module cache
/******/
/******/
/******/ // The require function
/******/function t(n){
/******/ // Check if module is in cache
/******/var r=s[n];
/******/if(void 0!==r)
/******/return r.exports;
/******/
/******/ // Create a new module (and put it into the cache)
/******/var o=s[n]={
/******/ // no module.id needed
/******/ // no module.loaded needed
/******/exports:{}
/******/};
/******/
/******/ // Execute the module function
/******/
/******/
/******/ // Return the exports of the module
/******/return e[n](o,o.exports,t),o.exports;
/******/}
/******/
/************************************************************************/
/******/ /* webpack/runtime/compat get default export */
/******/
/******/ // getDefaultExport function for compatibility with non-harmony modules
/******/t.n=e=>{
/******/var s=e&&e.__esModule?
/******/()=>e.default
/******/:()=>e
/******/;
/******/return t.d(s,{a:s}),s;
/******/},
/******/ // define getter functions for harmony exports
/******/t.d=(e,s)=>{
/******/for(var n in s)
/******/t.o(s,n)&&!t.o(e,n)&&
/******/Object.defineProperty(e,n,{enumerable:!0,get:s[n]})
/******/;
/******/},
/******/t.o=(e,s)=>Object.prototype.hasOwnProperty.call(e,s)
/******/,
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(()=>{"use strict";
/* harmony import */var e=t(47056),s=t(17757),n=t(61277);
/* harmony import */
/**
 * Internal dependencies
 */
/**
 * Internal dependencies
 */
(0,e/* ["default"] */.A)([s/* ["default"] */.A,n/* ["default"] */.A])})()})
/******/();