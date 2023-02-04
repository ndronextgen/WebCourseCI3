/*! Checkboxes 1.2.3
 *  Copyright (c) Gyrocode (www.gyrocode.com)
 *  License: MIT License
 */
(function(factory){if(typeof define==="function"&&define.amd){define(["jquery","datatables.net"],function($){return factory($,window,document);});}else{if(typeof exports==="object"){module.exports=function(root,$){if(!root){root=window;}if(!$||!$.fn.dataTable){$=require("datatables.net")(root,$).$;}return factory($,root,root.document);};}else{factory(jQuery,window,document);}}}(function($,window,document,undefined){var DataTable=$.fn.dataTable;var Checkboxes=function(settings){if(!DataTable.versionCheck||!DataTable.versionCheck("1.10.8")){throw"DataTables Checkboxes requires DataTables 1.10.8 or newer";}this.s={dt:new DataTable.Api(settings),columns:[],data:{},ignoreSelect:false};this.s.ctx=this.s.dt.settings()[0];if(this.s.ctx.checkboxes){return;}settings.checkboxes=this;this._constructor();};Checkboxes.prototype={_constructor:function(){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var hasCheckboxes=false;var hasCheckboxesSelectRow=false;var state=dt.state.loaded();for(var i=0;i<ctx.aoColumns.length;i++){if(ctx.aoColumns[i].checkboxes){var $colHeader=$(dt.column(i).header());hasCheckboxes=true;if(!$.isPlainObject(ctx.aoColumns[i].checkboxes)){ctx.aoColumns[i].checkboxes={};}ctx.aoColumns[i].checkboxes=$.extend({},Checkboxes.defaults,ctx.aoColumns[i].checkboxes);var colOptions={"searchable":false,"orderable":false};if(ctx.aoColumns[i].sClass===""){colOptions["className"]="dt-body-center";}if(ctx.aoColumns[i].sWidthOrig===null){colOptions["width"]="1%";}if(ctx.aoColumns[i].mRender===null){colOptions["render"]=function(){return'<input type="checkbox" class="dt-checkboxes">';};}DataTable.ext.internal._fnColumnOptions(ctx,i,colOptions);$colHeader.removeClass("sorting");$colHeader.off(".dt");self.s.data[i]={};if(state&&state.checkboxes&&state.checkboxes.hasOwnProperty(i)){self.s.data[i]=state.checkboxes[i];}self.s.columns.push(i);if(ctx.aoColumns[i].checkboxes.selectRow){if(ctx._select){hasCheckboxesSelectRow=true;}else{ctx.aoColumns[i].checkboxes.selectRow=false;}}if(ctx.aoColumns[i].checkboxes.selectAll){$colHeader.data("html",$colHeader.html());$colHeader.html('<input type="checkbox">').addClass("dt-checkboxes-select-all").attr("data-col",i);}}}if(hasCheckboxes){var $table=$(dt.table().node());var $tableBody=$(dt.table().body());var $tableContainer=$(dt.table().container());if(hasCheckboxesSelectRow){$table.addClass("dt-checkboxes-select");$table.on("select.dt.dtCheckboxes deselect.dt.dtCheckboxes",function(e,api,type,indexes){self.onSelect(e,type,indexes);});dt.select.info(false);$table.on("draw.dt.dtCheckboxes select.dt.dtCheckboxes deselect.dt.dtCheckboxes",function(){self.showInfoSelected();});}$table.on("xhr.dt",function(e,settings,json,xhr){var state=dt.state.loaded();$.each(self.s.columns,function(index,colIdx){self.s.data[colIdx]={};if(state&&state.checkboxes&&state.checkboxes.hasOwnProperty(colIdx)){self.s.data[colIdx]=state.checkboxes[colIdx];}});if(ctx.oFeatures.bStateSave){if(!ctx.oFeatures.bServerSide){$table.one("draw.dt.dtCheckboxes",function(e){self.updateState();});}}});$table.on("draw.dt.dtCheckboxes",function(e){self.onDraw(e);});$tableBody.on("click.dtCheckboxes","input.dt-checkboxes",function(e){self.onClick(e,this);});$tableContainer.on("click.dtCheckboxes",'thead th.dt-checkboxes-select-all input[type="checkbox"]',function(e){self.onClickSelectAll(e,this);});$tableContainer.on("click.dtCheckboxes","thead th.dt-checkboxes-select-all",function(e){$('input[type="checkbox"]',this).trigger("click");});$(document).on("click.dtCheckboxes",'.fixedHeader-floating thead th.dt-checkboxes-select-all input[type="checkbox"]',function(e){if(ctx._fixedHeader){if(ctx._fixedHeader.dom["header"].floating){self.onClickSelectAll(e,this);}}});$(document).on("click.dtCheckboxes",".fixedHeader-floating thead th.dt-checkboxes-select-all",function(e){if(ctx._fixedHeader){if(ctx._fixedHeader.dom["header"].floating){$('input[type="checkbox"]',this).trigger("click");}}});$table.on("init.dt.dtCheckboxes",function(){if(ctx.oFeatures.bStateSave){if(!ctx.oFeatures.bServerSide){self.updateState();}$table.on("stateSaveParams.dt.dtCheckboxes",function(e,settings,data){data.checkboxes=self.s.data;});}});$table.one("destroy.dt.dtCheckboxes",function(e,settings){$(document).off("click.dtCheckboxes");$tableContainer.on(".dtCheckboxes");$tableBody.off(".dtCheckboxes");$table.off(".dtCheckboxes");self.s.data={};$(".dt-checkboxes-select-all",$table).each(function(index,el){$(el).html($(el).data("html")).removeClass("dt-checkboxes-select-all");});});}},updateData:function(type,selector,isSelected,allowDups){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(typeof allowDups==="undefined"){allowDups=false;}var cellSelector;if(type==="cell"){cellSelector=selector;}else{if(type==="row"){cellSelector=[];dt.rows(selector).every(function(rowIdx){var colIdx=self.getSelectRowColIndex();if(colIdx!==null){cellSelector.push({row:rowIdx,column:colIdx});}});}}dt.cells(cellSelector).every(function(cellRow,cellCol){if(ctx.aoColumns[cellCol].checkboxes){var cellData=this.data();var hasData=ctx.checkboxes.s.data[cellCol].hasOwnProperty(cellData);if(isSelected){if(hasData&&allowDups){ctx.checkboxes.s.data[cellCol][cellData]++;}else{ctx.checkboxes.s.data[cellCol][cellData]=1;}}else{if(!isSelected&&hasData){if(ctx.checkboxes.s.data[cellCol][cellData]===1||!allowDups){delete ctx.checkboxes.s.data[cellCol][cellData];}else{ctx.checkboxes.s.data[cellCol][cellData]--;}}}}});if(ctx.oFeatures.bStateSave){dt.state.save();}},updateSelect:function(type,selector,isSelected){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(ctx._select){self.s.ignoreSelect=true;if(isSelected){dt.rows(selector).select();}else{dt.rows(selector).deselect();}self.s.ignoreSelect=false;}},updateCheckbox:function(type,selector,isSelected){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var cellSelector=[];if(type==="row"){dt.rows(selector).every(function(rowIdx){var colIdx=self.getSelectRowColIndex();if(colIdx!==null){cellSelector.push({row:rowIdx,column:colIdx});}});}else{if(type==="cell"){cellSelector=selector;}}var nodes=dt.cells(cellSelector).nodes();if(nodes.length){$("input.dt-checkboxes",nodes).prop("checked",isSelected);var colIdx=cellSelector[0].column;if($.isFunction(ctx.aoColumns[colIdx].checkboxes.selectCallback)){ctx.aoColumns[colIdx].checkboxes.selectCallback(nodes,isSelected);}}},updateState:function(){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;self.updateCheckboxes({page:"all",search:"none"});$.each(self.s.columns,function(index,colIdx){self.updateSelectAll(colIdx);});},updateCheckboxes:function(opts){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var dataSeen={};dt.cells("tr",self.s.columns,opts).every(function(cellRow,cellCol){var cellData=this.data();if(ctx.checkboxes.s.data[cellCol].hasOwnProperty(cellData)){if(dataSeen.hasOwnProperty(cellData)){dataSeen[cellData]++;}else{dataSeen[cellData]=1;}if(dataSeen[cellData]<=ctx.checkboxes.s.data[cellCol][cellData]){self.updateCheckbox("cell",[{row:cellRow,column:cellCol}],true);if(ctx.aoColumns[cellCol].checkboxes.selectRow){self.updateSelect("row",cellRow,true);}}}});},onClick:function(e,ctrl){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var cellSelector;var $cell=$(ctrl).closest("td");if($cell.parents(".DTFC_Cloned").length){cellSelector=dt.fixedColumns().cellIndex($cell);}else{cellSelector=$cell;}var cell=dt.cell(cellSelector);var cellIdx=cell.index();var colIdx=cellIdx.column;if(!ctx.aoColumns[colIdx].checkboxes.selectRow){cell.checkboxes.select(ctrl.checked,true);e.stopPropagation();}else{setTimeout(function(){var cellData=cell.data();var hasData=self.s.data[colIdx].hasOwnProperty(cellData);if(hasData!==ctrl.checked){self.updateCheckbox("cell",[cellIdx],hasData);self.updateSelectAll(colIdx);}},0);}},onSelect:function(e,type,indexes){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(self.s.ignoreSelect){return;}if(type==="row"){var allowDup=true;if((ctx._select.style==="os"||ctx._select.style==="multi+shift")&&indexes.length>1){allowDup=false;}self.updateData("row",indexes,(e.type==="select")?true:false,allowDup);self.updateCheckbox("row",indexes,(e.type==="select")?true:false);var colIdx=self.getSelectRowColIndex();if(colIdx!==null){self.updateSelectAll(colIdx);}}},onClickSelectAll:function(e,ctrl){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var colIdx=null;var $th=$(ctrl).closest("th");if($th.parents(".DTFC_Cloned").length){var cellIdx=dt.fixedColumns().cellIndex($th);colIdx=cellIdx.column;}else{colIdx=dt.column($th).index();}dt.column(colIdx,{page:((ctx.aoColumns[colIdx].checkboxes&&ctx.aoColumns[colIdx].checkboxes.selectAllPages)?"all":"current"),search:"applied"}).checkboxes.select(ctrl.checked,true);e.stopPropagation();},onDraw:function(e){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(ctx.oFeatures.bServerSide){self.updateCheckboxes({page:"current",search:"none"});}$.each(self.s.columns,function(index,colIdx){self.updateSelectAll(colIdx);});},updateSelectAll:function(colIdx){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(ctx.aoColumns[colIdx].checkboxes&&ctx.aoColumns[colIdx].checkboxes.selectAll){var cells=dt.cells("tr",colIdx,{page:((ctx.aoColumns[colIdx].checkboxes.selectAllPages)?"all":"current"),search:"applied"});var $tableContainer=dt.table().container();var $checkboxes=$(".dt-checkboxes",cells.nodes());var $checkboxesChecked=$checkboxes.filter(":checked");var $checkboxesSelectAll=$('.dt-checkboxes-select-all[data-col="'+colIdx+'"] input[type="checkbox"]',$tableContainer);if(ctx._fixedHeader){if(ctx._fixedHeader.dom["header"].floating){$checkboxesSelectAll=$('.fixedHeader-floating .dt-checkboxes-select-all[data-col="'+colIdx+'"] input[type="checkbox"]');}}var isSelected;var isIndeterminate;if($checkboxesChecked.length===0){isSelected=false;isIndeterminate=false;}else{if($checkboxesChecked.length===$checkboxes.length){isSelected=true;isIndeterminate=false;}else{isSelected=true;isIndeterminate=true;}}$checkboxesSelectAll.prop({"checked":isSelected,"indeterminate":isIndeterminate});if($.isFunction(ctx.aoColumns[colIdx].checkboxes.selectAllCallback)){ctx.aoColumns[colIdx].checkboxes.selectAllCallback($checkboxesSelectAll.closest("th").get(0),isSelected,isIndeterminate);}}},showInfoSelected:function(){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(!ctx.aanFeatures.i){return;}var $output=$('<span class="select-info"/>');var add=function(name,num){$output.append($('<span class="select-item"/>').append(dt.i18n("select."+name+"s",{_:"%d "+name+"s selected",0:"",1:"1 "+name+" selected"},num)));};var colIdx=self.getSelectRowColIndex();if(colIdx!==null){var countRows=0;for(var cellData in ctx.checkboxes.s.data[colIdx]){if(ctx.checkboxes.s.data[colIdx].hasOwnProperty(cellData)){countRows+=ctx.checkboxes.s.data[colIdx][cellData];}}add("row",countRows);$.each(ctx.aanFeatures.i,function(i,el){var $el=$(el);var $existing=$el.children("span.select-info");if($existing.length){$existing.remove();}if($output.text()!==""){$el.append($output);}});}},getCellIndex:function(cell){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(ctx._oFixedColumns){return dt.fixedColumns().cellIndex(cell);}else{return dt.cell(cell).index();}},getSelectRowColIndex:function(){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;var colIdx=null;for(var i=0;i<ctx.aoColumns.length;i++){if(ctx.aoColumns[i].checkboxes&&ctx.aoColumns[i].checkboxes.selectRow){colIdx=i;break;}}return colIdx;},updateFixedColumn:function(colIdx){var self=this;var dt=self.s.dt;var ctx=self.s.ctx;if(ctx._oFixedColumns){var leftCols=ctx._oFixedColumns.s.iLeftColumns;var rightCols=ctx.aoColumns.length-ctx._oFixedColumns.s.iRightColumns-1;if(colIdx<leftCols||colIdx>rightCols){dt.fixedColumns().update();}}}};Checkboxes.defaults={selectRow:false,selectAll:true,selectAllPages:true,selectCallback:null,selectAllCallback:null};var Api=$.fn.dataTable.Api;Api.register("checkboxes()",function(){return this;});Api.registerPlural("columns().checkboxes.select()","column().checkboxes.select()",function(select,allowDups){if(typeof select==="undefined"){select=true;}return this.iterator("column-rows",function(ctx,colIdx,i,j,rowsIdx){if(ctx.checkboxes){var selector=[];$.each(rowsIdx,function(index,rowIdx){selector.push({row:rowIdx,column:colIdx});});ctx.checkboxes.updateData("cell",selector,(select)?true:false,allowDups);ctx.checkboxes.updateCheckbox("cell",selector,(select)?true:false);if(ctx.aoColumns[colIdx].checkboxes.selectRow){ctx.checkboxes.updateSelect("row",rowsIdx,select);}if(ctx._oFixedColumns){setTimeout(function(){ctx.checkboxes.updateSelectAll(colIdx);},0);}else{ctx.checkboxes.updateSelectAll(colIdx);}ctx.checkboxes.updateFixedColumn(colIdx);}},1);});Api.registerPlural("cells().checkboxes.select()","cell().checkboxes.select()",function(select,allowDups){if(typeof select==="undefined"){select=true;}return this.iterator("cell",function(ctx,rowIdx,colIdx){if(ctx.checkboxes){var selector=[{row:rowIdx,column:colIdx}];ctx.checkboxes.updateData("cell",selector,(select)?true:false,allowDups);ctx.checkboxes.updateCheckbox("cell",selector,(select)?true:false);if(ctx.aoColumns[colIdx].checkboxes.selectRow){ctx.checkboxes.updateSelect("row",rowIdx,select);}if(ctx._oFixedColumns){setTimeout(function(){ctx.checkboxes.updateSelectAll(colIdx);},0);}else{ctx.checkboxes.updateSelectAll(colIdx);}ctx.checkboxes.updateFixedColumn(colIdx);}},1);});Api.registerPlural("columns().checkboxes.deselect()","column().checkboxes.deselect()",function(allowDups){return this.checkboxes.select(false,allowDups);});Api.registerPlural("cells().checkboxes.deselect()","cell().checkboxes.deselect()",function(allowDups){return this.checkboxes.select(false,allowDups);});Api.registerPlural("columns().checkboxes.deselectAll()","column().checkboxes.deselectAll()",function(){return this.iterator("column",function(ctx,colIdx){if(ctx.aoColumns[colIdx].checkboxes){ctx.checkboxes.s.data[colIdx]={};this.column(colIdx).checkboxes.select(false,false);}},1);});Api.registerPlural("columns().checkboxes.selected()","column().checkboxes.selected()",function(){return this.iterator("column",function(ctx,colIdx){if(ctx.aoColumns[colIdx].checkboxes){var data=[];$.each(ctx.checkboxes.s.data[colIdx],function(cellData,countRows){for(var i=0;i<countRows;i++){data.push(cellData);}});return data;}else{return[];}},1);});Checkboxes.version="1.2.3";$.fn.DataTable.Checkboxes=Checkboxes;$.fn.dataTable.Checkboxes=Checkboxes;$(document).on("preInit.dt.dtCheckboxes",function(e,settings,json){if(e.namespace!=="dt"){return;}new Checkboxes(settings);});return Checkboxes;}));