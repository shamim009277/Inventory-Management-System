$(document).ready(function(){
	var DOMAIN = "http://localhost/inventory/public";

	addNewRow();
	$("#add").click(function(){
        addNewRow();
	})

	function addNewRow(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getNewOrderItem:1},
			success : function(data){
               //alert(data);
               $("#invoice-item").append(data);
               var n = 0;
               $(".number").each(function(){
               	  $(this).html(++n);
               })
			}
		})
	}

	$("#remove").click(function(){
		$("#invoice-item").children("tr:last").remove();
		calculate(0,0);
	})

	$("#invoice-item").delegate(".pid","change",function(){
		 var pid = $(this).val();
		 //alert(pid);
		 var tr = $(this).parent().parent();
		   $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                dataType : "json",
                data : {getPriceQuantity:1,id:pid},
                success : function(data){
                    tr.find(".tqty").val(data["product_stock"]);
                    tr.find(".qty").val(1);
                    tr.find(".pro_name").val(data["pro_name"]);
                    tr.find(".price").val(data["product_price"]);
                    tr.find(".amt").html(tr.find(".qty").val()*tr.find(".price").val());
                    calculate(0,0);
                }
		   })
		 
	})

	$("#invoice-item").delegate(".qty","keyup",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if(isNaN(qty.val())) {
           alert("Please enter a valid quantity !");
           qty.val(1);
		}else if((qty.val()-1) > (tr.find(".tqty").val()-1)){
            alert("Sorry !! This much of quantity is not available");
            qty.val(1);
		}else{
			tr.find(".amt").html(qty.val() * tr.find(".price").val());
			calculate(0,0);
		}
		
	})


	function calculate(dis,paid){

		var sub_total = 0;
		var gst = 0;
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;
		
		$(".amt").each(function(){
			sub_total = sub_total + ($(this).html()*1);
		})

		gst = Math.ceil(0.18 * sub_total);
		net_total = sub_total + gst;
		net_total = net_total - discount;
	    due = net_total-paid_amt;

		
        $("#gst").val(gst);
		$("#sub_total").val(sub_total);
		$("#discount").val(discount);
		$("#net_total").val(net_total);
		$("#due").val(due);

		//$("#sub_total")
		//$("#gst")
		//$("#discount")
		//$("#net_total")
		//$("#paid")
		//$("#due")
		//$("#payment_type")
	}

	
   $("#discount").keyup(function(){
   	  var discount = $(this).val();
   	  calculate(discount,0);
   })

   $("#paid").keyup(function(){
   	 var paid = $(this).val();
   	 var discount = $("#discount").val();
   	 calculate(discount,paid);
   })



})