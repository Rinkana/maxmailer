$(document).ready(function() {
    $(document).on("click",".Notifications > span",function(e){
       $(this).slideUp("normal",function(){
           $(this).remove();
           if(!$(".Notifications").children().length > 0){
               $(".Notifications").remove();
           }
       });
    });
    $(document).on("click",".Disabled a, a.Disabled",function(e){
      e.preventDefault();
    });
    /*Template selection*/
    $(".ContentWrapper").on("click",".Template",function(){
    	if(!$(this).hasClass("Disabled")){
	    	$(".ContentWrapper .Template.Selected").removeClass("Selected").addClass("Available");
	    	$("input[name='templateSelect']").prop('checked', false);
	    	$(this).find("input[name='templateSelect']").prop('checked', true);
	    	$(this).addClass("Selected");
    	}
    });
    /*Receiver selection, this handles the check all button*/
    $(".ContentWrapper").on("change","input[name='receivers[]']",function(){
      if($(this).hasClass("checkall") && $(this).is(":checked")){
        $(".ContentWrapper input[name='receivers[]']").prop("checked",true);
      }else if(!$(this).hasClass("checkall") && !$(this).is(":checked")){
        $(".ContentWrapper input.checkall").prop("checked",false);
      }else if(!$(this).hasClass("checkall") && $(this).is(":checked")){
        var aUnckeded = $(".ContentWrapper input[name='receivers[]']:not(:checked)");
        if(aUnckeded.length == 1){
          if(aUnckeded.eq(0).hasClass("checkall")){
            $(".ContentWrapper input.checkall").prop("checked",true);
          }
        }
      }
    });
    $(".ContentWrapper").on("click",".ReceiverSelection tr > td",function(){
      //use the td > td tag so it wont trigger on the checkall button (that is tr > th)
      $(this).parent().find("input[name='receivers[]']").trigger("click");
    });
    /*Date time picker*/
    $(".ContentWrapper").on("click",".DateTimePicker a.Add",function(){
      var CurrentValue = parseInt($(this).parent().find(".Value").html());
      var NewValue = CurrentValue + 1;
      if(NewValue <= 9){
        NewValue = "0" + NewValue;
      }
      $(this).parent().find(".Value").html(NewValue);
    });
    $(".ContentWrapper").on("click",".DateTimePicker a.Substract",function(){
      var CurrentValue = parseInt($(this).parent().find(".Value").html());
      var NewValue = CurrentValue - 1;
      if(NewValue <= 9){
        NewValue = "0" + NewValue;
      }
      $(this).parent().find(".Value").html(NewValue);
    });
});