$(document).ready(function(){
var DOMAIN = "http://localhost/inventory/public";

	//Manage Category
   manage_category(1);
   function manage_category(pn){
      $.ajax({
           url : DOMAIN+"/includes/process.php",
           method : "POST",
           data : {manageCategory:1,pageno:pn},
           success : function(data){
            $("#get_category").html(data);
              //alert(data);
           }
      })
   }

   $("body").delegate(".page-link","click",function(){
   	    var pn = $(this).attr("pn");
   	    manage_category(pn);
   })

   $("body").delegate(".del_cat","click",function(){ 
       var did = $(this).attr("did");
         if (confirm("Are you sure ? You want to delete this item ...!")) {
              $.ajax({
                   url : DOMAIN+"/includes/process.php",
                   method : "POST",
                   data : {deleteCategory:1,id:did},
                   success : function(data){
                       if ($.trim(data)=="DEPENDENT_CATEGORY") {
                           alert("Sorry ! this category is dependent on another subcategory");
                       }else if($.trim(data)=="CATEGORY_DELETED"){
                           alert(" Category deleted Successfully...!");
                           manage_category(1);
                       }else if($.trim(data)=="DELETED"){
                            alert("Deleted successfully...!");
                       }else{
                         alert(data);
                       }
                   }
              })
         }else{

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
              $("#parent_cat").html(root+data);   
          }
      })
  }

   //Update Category
   $("body").delegate(".edt_cat","click",function(){
        var eid = $(this).attr("eid");
            //alert(eid);
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            dataType : "json",
            data : {updateCategory:1,id:eid},
            success: function(data){
                 //alert(data["cid"]);
                 //console.log(data);
                 $("#cid").val(data["cid"]);
                 $("#update_category_name").val(data["category_name"]);
                 $("#parent_cat").val(data["parent_cat"]);
            }
        })
   })


//Update Category 
    $("#update_category_form").on("submit",function(){
        if ($("#update_category_name").val()=="") {
            $("#update_category_name").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        }else{
            $.ajax({
              url : DOMAIN+"/includes/process.php",
              method: "POST",
              data: $("#update_category_form").serialize(),
              success: function(data){                
                  alert(data);
              }
          })
        }
    })


    //Manage Brand
    manageBrand(1);
    function manageBrand(pn){
       $.ajax({
           url : DOMAIN+"/includes/process.php",
           method: "POST",
           data : {manageBrand:1,pageno:pn},
           success : function (data){
              $("#get_brand").html(data);
           }
       })
    }

    $("body").delegate(".page-link","click",function(){
      var pn = $(this).attr("pn");
       //alert(pn);
       manageBrand(pn);
    })


    //Delete Brand
    $("body").delegate(".del-bar","click",function(){
      var did = $(this).attr("did");
       if (confirm("Are you sure you want to delete this permanently !!")) {
          $.ajax({
              url : DOMAIN+"/includes/process.php",
              method : "POST",
              data : {deleteBrand:1,id:did},
              success : function(data){
                 if ($.trim(data) == "DELETED"){
                    alert("Brand Deleted Successfully !!");
                    manageBrand(1);
                 }else{
                   alert(data);
                 }
              }
          })
       }else{
             alert("Dat is not deleted");
       }
    })





    //Fetch products
    manageProduct(1);
    function manageProduct(pn){
       $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {manageProduct:1,pageno:pn},
          success : function(data){
             $("#get_product").html(data);
          }
       })
    }

    $("body").delegate(".page-link","click",function(){
      var pn = $(this).attr("pn");
       //alert(pn);
       manageProduct(pn);
    })




})