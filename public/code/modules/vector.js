/**
 * Highcharts JS v11.2.0 (2023-10-30)
 *
 * Vector plot series module
 *
 * (c) 2010-2021 Torstein Honsi
 *
 * License: www.highcharts.com/license
 */!function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/modules/vector",["highcharts"],function(e){return t(e),t.Highcharts=e,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var e=t?t._modules:{};function i(t,e,i,r){t.hasOwnProperty(e)||(t[e]=r.apply(null,i),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:t[e]}})))}i(e,"Series/Vector/VectorSeriesDefaults.js",[],function(){return{lineWidth:2,marker:void 0,rotationOrigin:"center",states:{hover:{lineWidthPlus:1}},tooltip:{pointFormat:"<b>[{point.x}, {point.y}]</b><br/>Length: <b>{point.length}</b><br/>Direction: <b>{point.direction}\xb0</b><br/>"},vectorLength:20}}),i(e,"Series/Vector/VectorSeries.js",[e["Core/Animation/AnimationUtilities.js"],e["Core/Globals.js"],e["Core/Series/SeriesRegistry.js"],e["Core/Utilities.js"],e["Series/Vector/VectorSeriesDefaults.js"]],function(t,e,i,r,o){let{animObject:s}=t,{series:n,seriesTypes:{scatter:a}}=i,{arrayMax:h,extend:l,merge:c,pick:p}=r;class d extends a{constructor(){super(...arguments),this.data=void 0,this.lengthMax=void 0,this.options=void 0,this.points=void 0}animate(t){t?this.markerGroup.attr({opacity:.01}):this.markerGroup.animate({opacity:1},s(this.options.animation))}arrow(t){let e=t.length/this.lengthMax,i=e*this.options.vectorLength/20,r={start:10*i,center:0,end:-10*i}[this.options.rotationOrigin]||0;return[["M",0,7*i+r],["L",-1.5*i,7*i+r],["L",0,10*i+r],["L",1.5*i,7*i+r],["L",0,7*i+r],["L",0,-10*i+r]]}drawPoints(){let t=this.chart;for(let e of this.points){let i=e.plotX,r=e.plotY;!1===this.options.clip||t.isInsidePlot(i,r,{inverted:t.inverted})?(e.graphic||(e.graphic=this.chart.renderer.path().add(this.markerGroup).addClass("highcharts-point highcharts-color-"+p(e.colorIndex,e.series.colorIndex))),e.graphic.attr({d:this.arrow(e),translateX:i,translateY:r,rotation:e.direction}),this.chart.styledMode||e.graphic.attr(this.pointAttribs(e))):e.graphic&&(e.graphic=e.graphic.destroy())}}pointAttribs(t,e){let i=this.options,r=t?.color||this.color,o=this.options.lineWidth;return e&&(r=i.states[e].color||r,o=(i.states[e].lineWidth||o)+(i.states[e].lineWidthPlus||0)),{stroke:r,"stroke-width":o}}translate(){n.prototype.translate.call(this),this.lengthMax=h(this.lengthData)}}return d.defaultOptions=c(a.defaultOptions,o),l(d.prototype,{drawGraph:e.noop,getSymbol:e.noop,markerAttribs:e.noop,parallelArrays:["x","y","length","direction"],pointArrayMap:["y","length","direction"]}),i.registerSeriesType("vector",d),d}),i(e,"masters/modules/vector.src.js",[],function(){})});//# sourceMappingURL=vector.js.map