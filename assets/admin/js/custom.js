$(document).ready(function(){
	"use strict";
	//For Trash  
    $(".trashproduct").on('click', function(e){
        e.preventDefault();
        
        //get the curproductid id
        var itemId = $(this).parents('tr').find('.curproductid').val();
        var itemRow = $(this).closest('tr');
       
        if(itemId){
            var confirm = window.confirm("Are you sure you want to trash item?");
            
            if(confirm){
                $.ajax({
                    url: baseUrl+"admin/product/trash_delete",
                    method: "POST",
                    data: {product_id:itemId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //$(itemRow).remove();
                       $("#trash_error_msg").html('<div class="alert alert-success-mas"> <span>Product Trash Successfully.</span> <a class="close" data-dismiss="alert">×</a></div>');
                       location.reload();
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
    
    //For Delete   
    $(".deleteproduct").on('click', function(e){
        e.preventDefault();
        
        //get the curproductid id
        var itemId = $(this).parents('tr').find('.curproductid').val();
        var itemRow = $(this).closest('tr');
       
        if(itemId){
            var confirm = window.confirm("Are you sure you want to delete item?");
            
            if(confirm){
                $.ajax({
                    url: baseUrl+"admin/product/delete",
                    method: "POST",
                    data: {product_id:itemId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //$(itemRow).remove();
                       $("#delete_error_msg").html('<div class="alert alert-success-mas"> <span>Product deleted successfully.</span> <a class="close" data-dismiss="alert">×</a></div>');
                       location.reload();
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
    

    //For Delete Product Gallery Image  
    $(".pro_del_img").on('click', function(e){
        e.preventDefault();
        //get the curproductid id
        var itemId = $(this).parents('.product_gallerys').find('.curproductid').val();
        //var photoId = $(this).parents('.product_gallerys').find('.curphotoid').val();
        var photoId = $(this).attr('photo_id');
        var itemRow = $(this).closest('tr');
        if(itemId){
            var confirm = window.confirm("Are you sure you want to delete photo?");
            
            if(confirm){
                $.ajax({
                    url: baseUrl+"admin/product/product_gallery_photo_delete",
                    method: "POST",
                    data: {product_id:itemId,photo_id:photoId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //$(itemRow).remove();
                       $("#gallert_delete_msg").html('<div class="alert alert-success-mas"> <span>Gallery deleted successfully.</span> <a class="close" data-dismiss="alert">×</a></div>');
                       location.reload();
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
    
    
    // Add More File     
    $(".add_field_button").on('click', function(e){ 
        var x = 1; //initlal text box count
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
$(wrapper).append('<div class="row"><div class="col-md-6 product_gallery mt-3"> <input class="form-control" id="product_gallery" name="product_gallery[]" type="file"><a href="#" class="remove_field">Remove</a></div></div>'); //add input box
        }
    });
   
    $(".input_fields_wrap").on("click",".remove_field", function(e){
        var x = 1;
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
    
    
     //For Delete User 
    $(".deleteuser").on('click', function(e){
        e.preventDefault();
        
        var itemId = $(this).parents('tr').find('.curuserid').val();
        var itemRow = $(this).closest('tr');
        if(itemId){
            var confirm = window.confirm("Are you sure you want to delete user?");
            
            if(confirm){
                $.ajax({
                    url: baseUrl+"admin/users/delete_user",
                    method: "POST",
                    data: {user_id:itemId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //$(itemRow).remove();
                       $("#user_delete_msg").html('<div class="alert alert-success-mas"> <span>User deleted successfully.</span> <a class="close" data-dismiss="alert">×</a></div>');
                       location.reload();
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
    
    //For Delete Blog 
    
    $(".deleteblog").on('click', function(e){
        e.preventDefault();
        
        var itemId = $(this).parents('tr').find('.curblogid').val();
        var itemRow = $(this).closest('tr');
        if(itemId){
            var confirm = window.confirm("Are you sure you want to delete blog?");
            
            if(confirm){
                $.ajax({
                    url: baseUrl+"admin/blog/delete_blog",
                    method: "POST",
                    data: {blog_id:itemId}
                }).done(function(rd){
                    if(rd.status === 1){
                        //$(itemRow).remove();
                       $("#user_blog_msg").html('<div class="alert alert-success-mas"> <span>Blog deleted successfully.</span> <a class="close" data-dismiss="alert">×</a></div>');
                       location.reload();
                    }

                    else{

                    }
                }).fail(function(){
                    console.log('Req Failed');
                });
            }
        }
    });
});

 