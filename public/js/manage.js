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
                       if (data == "DEPENDENT_CATEGORY") {
                           alert("Sorry ! this category is dependent on another subcategory");

                       }else if(data == "CATEGORY_DELETED"){
                           alert(" Category deleted Successfully...!");

                       }else if(data == "DELETED"){
                            alert("Deleted successfully...!");
                       }else{
                         alert(data);
                       }
                   }
              })
         }else{

         }
   })


})