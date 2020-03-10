$(document).ready(function(){
	var DOMAIN = "http://localhost/inventory/public";

      //For Registration
	
	$("#register_form").on("submit",function(){
    var status = false;
		var name   = $("#name");
		var email  = $("#email");
		var pass1  = $("#password1");
		var pass2  = $("#password2");
		var user   = $("#usertype");

		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

		if(name.val() == "" || name.val().length < 6 ) {
            name.addClass("border-danger");
            $("#n_error").html("<span class='text-danger'>Enter your name and name should be 6 character</span>");
            status = false;
		}else{
            name.removeClass("border-danger");
            $("#n_error").html("");
            status = true;
		}

		if(!e_patt.test(email.val())) {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please enter a valid email address</span>");
            status = false;
		}else{
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
		}

		if(pass1.val() == "" || pass1.val().length < 8 ) {
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please enter at least 8 character</span>");
            status = false;
		}else{
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
		}

		if(pass2.val() == "" || pass2.val().length < 8 ) {
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please enter at least 8 character</span>");
            status = false;
		}else{
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
		}

		if(user.val() == "" ) {
            user.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please select user type</span>");
            statuts = false;
		}else{
            user.removeClass("border-danger");
            $("#t_error").html("");
            status = true;
		}
		if((pass1.val() == pass2.val()) && status == true) {
            $.ajax({
            	url: DOMAIN+"/includes/process.php",
            	method: "POST",
            	data: $("#register_form").serialize(),
            	success: function(data){
            		if (data == "EMAIL_ALREADY_EXIST") {
                       alert("It seems this email is alredy used");
            		}else if (data == "SOMETHING WRONG") {

            		}else{
            			window.location.href=encodeURI(DOMAIN+"/index.php?msg= you are Register Now you can login");
            		}

            	}
            })
		}else{
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>password is not matched</span>");
            status = true;
		}
	})

     //For Login Page
     $("#form_login").on("submit",function(){

            var status = false;
            var email  = $("#log_email");
            var pass   = $("#log_password");

             if (email.val() == "") {
                email.addClass("border-danger");
                $("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
                status = false;
             }else{
                email.removeClass("border-danger");
                $("#e_error").html("");
                status = true;
             } 

             if (pass.val() == "") {
                pass.addClass("border-danger");
                $("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
                status = false;
             }else{
                pass.removeClass("border-danger");
                $("#p_error").html("");
                status = true;
             } 
             if (status) {
                $.ajax({
                  url: DOMAIN+"/includes/process.php",
                  method: "POST",
                  data: $("#form_login").serialize(),
                  success: function(data){
                        if (data == "NOTHING_REGISTER") {
                            email.addClass("border-danger");
                            $("#e_error").html("<span class='text-danger'>Please Complete Your Registration</span>");
                        }else if (data == "PASSWORD_NOT_MATCHED") {
                            pass.addClass("border-danger");
                            $("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
                        }else{
                           console.log(data);
                           window.location = DOMAIN+"/dashboard.php";
                        }
                  }
                  
                })  
             }
     })

  //Fetch category
  fetch_category();
  function fetch_category(){
      $.ajax({
          url : DOMAIN+"/includes/process.php", 
          method : "POST",
          data : {getCategory:1},
          success : function(data){
            var root = "<option value='0'>Root</option>";
            var choose = "<option value='0'>Select Category</option>";
              $("#parent_cat").html(root+data);
              $("#select_cat").html(choose+data);
              

          }
      })
  }

  //Fetch Brand 
  fetch_brand();
  function fetch_brand(){
      $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {getBrand:1},
          success : function(data){
            var choos = "<option value='0'>Select Brand</option>";
             $("#select_bar").html(choos+data);
             
          }
      })

  }


  //Add New Category 
  $("#category_form").on("submit",function(){
      if ($("#category_name").val() == "") {
          $("#category_name").addClass("border-danger");
          $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
      }else{
          $.ajax({
              url : DOMAIN+"/includes/process.php",
              method: "POST",
              data: $("#category_form").serialize(),
              success: function(data){                
                  if (data=="Category_added") {
                         $("#category_name").val("");
                         fetch_category();
                        $("#category").modal("hide");
                     alert("Category Added Successfully !!");
                  }else{
                      alert(data);
                  }

                  
              }
          })

      }

  })

  //For Add New Brand

  $("#brand_form").on("submit",function(){
     if ($("#brand_name").val() == "") {
           $("#brand_name").addClass("border-danger");
           $("#br_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
     }else{
        $.ajax({
             url : DOMAIN+"/includes/process.php",
             method: "POST",
             data : $("#brand_form").serialize(),
             success : function (data){
                 
                 if (data == "BRAND_ADDED") {
                     $("#brand_name").val("");
                     fetch_brand();
                     $("#brand").modal("hide");
                     alert("Brand Added Successfully !!");
                 }else{
                    alert(data);
                 }
             }
        })
     }
  })

   //For Add New Products
  $("#product_form").on("submit",function(){
       var status = false;
     if ($("#product_name").val()=="") {
         $("#product_name").addClass("border-danger");
         $("#prt_error").html("<span class='text-danger'>Please Enter Product Name</span>");
         status=false;
     }else{
         $("#product_name").removeClass("border-danger");
         $("#prt_error").html("");
         status=true;
     }
     if ($("#select_cat").val()=="0") {
         $("#select_cat").addClass("border-danger");
         $("#cate_error").html("<span class='text-danger'>Please Select Category Name</span>");
         status=false;
     }else{
         $("#select_cat").removeClass("border-danger");
         $("#cate_error").html("");
         status=true;
     }
     if ($("#select_bar").val()=="0") {
         $("#select_bar").addClass("border-danger");
         $("#brd_error").html("<span class='text-danger'>Please Select Brand Name</span>");
         status=false;
     }else{
         $("#select_bar").removeClass("border-danger");
         $("#brd_error").html("");
         status=true;
     }
     if ($("#product_price").val()=="" || $("#product_price").val()=="0") {
         $("#product_price").addClass("border-danger");
         $("#pri_error").html("<span class='text-danger'>Please Enter Product Price</span>");
         status=false;
     }else{
         $("#product_price").removeClass("border-danger");
         $("#pri_error").html("");
         status=true;
     }
     if ($("#product_stock").val()=="" || $("#product_stock").val()=="0") {
         $("#product_stock").addClass("border-danger");
         $("#stk_error").html("<span class='text-danger'>Please Enter Product Quantity</span>");
         status=false;
     }else{
         $("#product_stock").removeClass("border-danger");
         $("#stk_error").html("");
         status=true;
     }
     if (status) {
        $.ajax({
           url : DOMAIN+"/includes/process.php",
           method: "POST",
           data : $("#product_form").serialize(),
           success : function(data){

               if (data == "PRODUCT_ADDED") {
               
                    $("#product").modal("hide");
                    $("#product_name").val("");
                    $("#product_price").val("");
                    $("#product_stock").val("");
                    $("#select_cat").val("0");
                    $("#select_bar").val("0");
                     alert("Product Added Successfully !!");
                  
               }else{
                  alert(data);
               }
           }
        })
     }

  })



 
})




