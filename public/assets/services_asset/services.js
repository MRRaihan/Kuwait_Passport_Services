$('.add-on-service').click(function() {
    var ischecked = $(this).is(':checked');
    // console.log($(this).parent().parent().parent().html());
    if (ischecked) {
        $(this).parent().parent().parent().find('.add-option-container').css("display", "block");
    } else {
        $(this).parent().parent().parent().find('.add-option-container').css("display", "none");
    }

})

//manual fee input fild
$('.fee-on-selection').click(function(){
    if($(this).val() != 0){
        $(this).parent().parent().parent().find('.manual-fee-input-container').css("display", "block");
    }else{
        $(this).parent().parent().parent().find('.manual-fee-input-container').css("display", "none");
        $(this).parent().parent().parent().find('.manual-fee-input-container input').val(null);
    }
})
