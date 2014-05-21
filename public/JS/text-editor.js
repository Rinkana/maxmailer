/*
This js handles the build of the text template.
Selectors (use this as class):

mm-editable: tells the scipt this will be editable. Needs to be used on every element that can change

mm-text-small: Small editor, used only to edit the text (no styling)
mm-text-big: Big editor. Use this for the general content (has styling)
mm-text-image: Small editor that only has an image field.

mm-dupelicatable: Allows the dupelication of the given element. The dupelicated will be added just below the element
mm-removable: Allows for the deletion of the selected element.

mm-temp: Nothing more than a wrapper. TODO: remove this element when done
*/
var AvailbeEditorClasses = ["mm-text-small","mm-text-big","mm-text-image"]; //Used to theck if the editor is allowed to be used here.
var Toolbar = "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image";

var EditorActive = false;
var SectionToolbarHover = false;
var WaitTimeout = null;
var FocusInterval = null;
var ActiveElementHover = null;
var ActiveSectionHover = null;

/*
Extra edit selectors.
*/
$(document).ready(function(){
	setEditableID();
	$("body").append("<div class='mm-overlay'></div><div class='mm-section-toolbar'><span class='add'>ADD</span> / REMOVE</div>");
	$("body").append("<div class='mm-toolbar-container'></div><div class='mm-exit-editor'>EXIT THE EDITOR HERE</div>");
	$(document).on("click",".mm-dupelicate",function(){
		var EditableID = $(this).parent().attr("editable-id");
		console.log(EditableID);
		var Element = $(".mm-editable[editable-id='"+EditableID+"']");
		var ElementClone = Element.clone();
		ElementClone.insertAfter(Element);
		//setOverlay();
	});
	$(document).on("click",".mm-remove",function(){
		var EditableID = $(this).parent().attr("editable-id");
		$(".mm-editable[editable-id='"+EditableID+"']").remove();
		//setOverlay();
	});
	$(document).on("click",".mm-edit-text",function(){
		var EditableID = $(this).parent().attr("editable-id");
		var Element = $(".mm-editable[editable-id='"+EditableID+"']");
		console.log(Element);
		setEditor(Element);
	});
	/*
	Default overlay
	*/
	$(document).on("mouseenter",".mm-editable:not(.mm-section)",function(){
		if(!EditorActive){
			setOverlaySettings($(this));
			clearTimeout(WaitTimeout);
			$('.mm-overlay').fadeIn("fast");
		}
	});
	$(document).on("mouseleave",".mm-overlay",function(){
		WaitTimeout = setTimeout(function(){
			clearTimeout(WaitTimeout);
			$('.mm-overlay').fadeOut("fast");
			ActiveElementHover = null;
		},50);
	});
	/*
	Section toolbar
	*/
	$(document).on("mouseenter",".mm-editable.mm-section",function(){
		if(!EditorActive){
			setSectionToolbarSettings($(this));
			
		}
	});
	$(document).on("click",".mm-exit-editor",function(){
		removeEditors();
	});
	$(document).on("mousemove","body",checkSectionOverlay);
});
function setOverlaySettings(Element){
	var EditableID = Element.attr("editable-id");
	var ElementPosition = Element.position();
	var PositionTop = parseInt(ElementPosition.top) - 5;
	var PositionLeft = parseInt(ElementPosition.left) - 5;
	var OverlayWidth = parseInt(Element.width()) + 10
	var OverlayHeight = parseInt(Element.height()) + 10;
	var ItemHTML = "";
	if($(this).hasClass("mm-dupelicatable")){
		ItemHTML = ItemHTML + "<span class='mm-dupelicate'>DUPE</span>";
	}
	if($(this).hasClass("mm-removable")){
		ItemHTML = ItemHTML + "<span class='mm-remove'>REMO</span>";
	}
	$.each(AvailbeEditorClasses,function(i,v){
		if(Element.hasClass(v)){
			ItemHTML = ItemHTML + "<span class='mm-edit-text'>&nbsp;TEXT</span>"
		}
	});
	$(".mm-overlay").css({top:PositionTop,left:PositionLeft}).width(OverlayWidth).height(OverlayHeight).html(ItemHTML).attr("editable-id",EditableID);
	ActiveElementHover = EditableID;
}
function setSectionToolbarSettings(Element){
	var EditableID = Element.attr("editable-id");
	var ElementPosition = Element.position();
	var PositionTop = parseInt(ElementPosition.top) + Element.height() + 5;
	var PositionLeft = parseInt(ElementPosition.left) - 5;
	var ItemHTML = "";
	if($(this).hasClass("mm-dupelicatable")){
		ItemHTML = ItemHTML + "<span class='mm-dupelicate'>DUPE</span>";
	}
	if($(this).hasClass("mm-removable")){
		ItemHTML = ItemHTML + "<span class='mm-remove'>REMO</span>";
	}
	//.html(ItemHTML)
	$(".mm-section-toolbar").css({top:PositionTop,left:PositionLeft}).attr("editable-id",EditableID);
	ActiveSectionHover = EditableID;
}
function setEditor(Element){
	var elementUseful = false;
	$.each(AvailbeEditorClasses,function(i,v){
		if(Element.hasClass(v)){
			elementUseful = true;
		}
	});
	$("#mm-tinymce-active").removeAttr("id");
	if(elementUseful){
		$('.mm-overlay').fadeOut("fast");
		EditorActive = true;
		Element.attr("id","mm-tinymce-active");
		$("body").addClass("editorActive");
		$('#mm-tinymce-active').redactor({focus: true,toolbarExternal: '.mm-toolbar-container',paragraphy: false});
		focusElement(Element);
	}else{
		console.log("Sorry, i cant edit this");
	}
}
function removeEditors(){
	unfocus();
	EditorActive = false;
	$('#mm-tinymce-active').redactor('destroy');
}
function focusElement(Element){
	unfocus();//Remove all current 
	var ElementPosition = Element.position();
	var PositionTop = parseInt(ElementPosition.top);
	var PositionLeft = parseInt(ElementPosition.left);
	var FocusWidth = parseInt(Element.width())
	var FocusHeight = parseInt(Element.height());
	//Set 4 diffrent block sizes
	var TopMaskHTML = "<div class='mm-mask mm-mask-top'></div>";
	var BottomMaskHTML = "<div class='mm-mask mm-mask-bottom'></div>";
	var LeftMaskHTML = "<div class='mm-mask mm-mask-left'></div>";
	var RightMaskHTML = "<div class='mm-mask mm-mask-right'></div>";

	$("body").append(TopMaskHTML).append(BottomMaskHTML).append(LeftMaskHTML).append(RightMaskHTML);
	$(".mm-mask-top").css({
		top: 0,
		left: 0,
		width: "100%",
		height: (PositionTop - 5)
	});
	$(".mm-mask-bottom").css({
		top: (PositionTop + FocusHeight) + 5,
		left: 0,
		width: "100%",
		height: ((parseInt($(document).height()) - FocusHeight) - PositionTop) - 5
	});
	$(".mm-mask-left").css({
		top: (PositionTop - 5),
		left: 0,
		width: (PositionLeft - 5),
		height: (FocusHeight + 10)
	});
	$(".mm-mask-right").css({
		top: (PositionTop - 5),
		left: (PositionLeft + FocusWidth) + 5,
		width: ((parseInt($(document).width()) - PositionLeft) - FocusWidth) - 5,
		height: (FocusHeight + 10)
	});
	FocusInterval = setInterval(function(){
		focusElement(Element);
	},20);
}
function unfocus(){
	//Remove the 4 focus elements
	clearInterval(FocusInterval);
	$(".mm-mask").remove();
}

function setEditableID(){
	$(".mm-editable").each(function(i,e){
		$(this).attr("editable-id",i);
	});
}
function checkSectionOverlay(e){
	if(ActiveElementHover && ActiveElementHover >= 0){
		//Element is active
		if($(".mm-editable[editable-id='"+ActiveElementHover+"']").parents(".mm-section").length > 0){
			$('.mm-section-toolbar').show();
		}else{
			$('.mm-section-toolbar').hide();
		}
	}else{
		var x = e.clientX;
        var y = e.clientY;
        var CurrentElement = document.elementFromPoint(x,y);
        if(!$(CurrentElement).hasClass("mm-section-toolbar") && !$(CurrentElement).parents(".mm-section-toolbar").length > 0){
			$('.mm-section-toolbar').hide();
        }
		
	}
	
}