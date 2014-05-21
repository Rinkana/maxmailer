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
var EditorConfigs = [
	//0: Full feature toolbar
    {
        selector: ".mm-tinymce-active",
	    inline: true,
	    menubar: false,
	    theme: "modern",
	    autofocus: true,
		skin: 'light',
		fixed_toolbar_container: ".mm-toolbar-container",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    },
    //1: Simple toolbar
    {
        selector: ".mm-tinymce-active",
	    inline: true,
	    menubar: false,
	    theme: "modern",
		skin: 'light',
		fixed_toolbar_container: ".mm-toolbar-container",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "undo redo"
    },
    //2: Simple tooblar with image
    {
        selector: ".mm-tinymce-active",
	    inline: true,
	    menubar: false,
	    theme: "modern",
	    autofocus: true,
		skin: 'light',
		fixed_toolbar_container: ".mm-toolbar-container",
	    plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste"
	    ],
	    toolbar: "undo redo | image"
    }
];
tinymce.init({
});

/*
Extra edit selectors.
*/
$(document).ready(function(){
	setOverlay();
	$( window ).resize(function() {
		setOverlay();
	});
	$("body").append("<div class='mm-overlay'></div>");
	$("body").append("<div class='mm-toolbar-container'></div><div class='mm-exit-editor'>EXIT THE EDITOR HERE</div>");
	$(document).on("click",".mm-dupelicate",function(){
		var EditableID = $(this).parent().attr("editable-id");
		console.log(EditableID);
		var Element = $(".mm-editable[editable-id='"+EditableID+"']");
		var ElementClone = Element.clone();
		ElementClone.insertAfter(Element);
		setOverlay();
	});
	$(document).on("click",".mm-remove",function(){
		var EditableID = $(this).parent().attr("editable-id");
		$(".mm-editable[editable-id='"+EditableID+"']").remove();
		setOverlay();
	});
	$(document).on("click",".mm-edit-text",function(){
		var EditableID = $(this).parent().attr("editable-id");
		var Element = $(".mm-editable[editable-id='"+EditableID+"']");
		$(".mm-overlay").hide();

		setEditor(Element);
	});
	$(document).on("mouseenter",".mm-editable",function(){
		if(!EditorActive){
			var Element = $(this);
			var ElementID = Element.attr("editable-id");
			//$(".mm-overlay[editable-id='"+ElementID+"']").show();
		}
	}).on("mouseleave",".mm-editable",function(){
		if(!EditorActive){
			var Element = $(this);
			var ElementID = Element.attr("editable-id"); 
			//$(".mm-overlay[editable-id='"+ElementID+"']").hide(); //Do i want this??
		}
	});
	$(document).on("click",".mm-exit-editor",function(){
		removeEditors();
	});
});
function setEditor(Element){
	/*
	TinyMCE editors
	*/
	
	var elementUseful = false;
	$.each(AvailbeEditorClasses,function(i,v){
		if(Element.hasClass(v)){
			elementUseful = true;
		}
	});
	$("#mm-tinymce-active").removeAttr("id");
	if(elementUseful){
		EditorActive = true;
		Element.attr("id","mm-tinymce-active");
		//Set what settings tinymce should use
		if(Element.hasClass("mm-text-small")){
			tinymce.settings = EditorConfigs[1];
		}else if(Element.hasClass("mm-text-image")){
			tinymce.settings = EditorConfigs[2];
		}else{
			tinymce.settings = EditorConfigs[0];
		}
		tinymce.execCommand('mceAddEditor', false, "mm-tinymce-active");
		tinymce.get('mm-tinymce-active').focus();
		//tinymce.execCommand('mceFocus', false, 'mm-tinymce-active');
	}
}
function removeEditors(){
	$(".mm-overlay").show();
	EditorActive = false;
	tinymce.remove();
	tinymce.execCommand('mceRemoveControl', false, 'mm-tinymce-active');
}
function setOverlay(){
	$(".mm-overlay").remove();//In case we call this function again we remove all the current toolbars
	$(".mm-editable").each(function(i,e){
		var ItemHTML = "";
		var Element = $(this);
		var ElementPosition = $(this).position();
		if($(this).hasClass("mm-dupelicatable")){
			ItemHTML = ItemHTML + "<span class='mm-dupelicate'>DUPE</span>";
		}
		if($(this).hasClass("mm-removable")){
			ItemHTML = ItemHTML + "<span class='mm-remove'>REMO</span>";
		}
		$.each(AvailbeEditorClasses,function(i,v){
			if(Element.hasClass(v)){
				console.log('text editable');
				ItemHTML = ItemHTML + "<span class='mm-edit-text'>&nbsp;TEXT</span>"
			}
		});
		$(this).attr("editable-id",i);
		if(ItemHTML.length > 0){
			var PositionTop = parseInt(ElementPosition.top) - 5;
			var PositionLeft = parseInt(ElementPosition.left) - 5;
			var OverlayWidth = parseInt(Element.width()) + 10
			var OverlayHeight = parseInt(Element.height()) + 10;
			
			$("body").append("<div editable-id='"+i+"' class='mm-overlay'></div>");
			$(".mm-overlay[editable-id='"+i+"']").css({top:PositionTop,left:PositionLeft}).width(OverlayWidth).height(OverlayHeight).html(ItemHTML);
		}
		
	});
}