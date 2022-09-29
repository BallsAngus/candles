$("#header-cart").mouseover(function(){
    $("#cart-btn").addClass("fa-beat")
})

$("#header-cart").mouseleave(function(){
    $("#cart-btn").removeClass("fa-beat")
})

$("#header-acct").mouseover(function(){
    $("#acct-btn").addClass("fa-beat")
})

$("#header-acct").mouseleave(function(){
    $("#acct-btn").removeClass("fa-beat")
})


$(".add").click(function(){
    var id = this.id;
    var index = id.substring(3);
    var amt_id = "#amt".concat(index);
    var amt = parseInt($(amt_id).val());
    $(amt_id).val(amt+1);
})

$(".subtract").click(function(){
    var id = this.id;
    var index = id.substring(3);
    var amt_id = "#amt".concat(index);
    var amt = parseInt($(amt_id).val());
    $(amt_id).val(Math.max(amt-1, 1));
})