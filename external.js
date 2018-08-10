$(document).ready(function(){
	var buttonColor = $('.subtractFromCart').css("background-color");
	$('#search').click(function(){
		var content = $(this).val();
		if (content == "Search keyword...") {
			$(this).val('');
		}
	}); //end #search click
	
	$('#search').focusout(function(){
		var content = $(this).val();
		if (content == "") {
			$(this).val('Search keyword...');
			}
			});

	
	
		

	
	
	$('.addToCart').click(function(){
		var current = parseInt($(this).prev('.addToCartAmount').html());
		var stock = parseInt($(this).prevAll(".stock").html());
			if (current < stock) {
				current = current + 1;
			}
		
		$(this).prev('.addToCartAmount').html(current);
		var newLink = "product.php?productId=<?php echo $row['productId'];?>&num=" + current;
		
		var newHtml = '<a href="' + newLink + '">Add To Cart</a>';
		
		
		$(this).next('.addToCartSubmit').html(newHtml);
			
	});
	
		$('.subtractFromCart').click(function(){
		var current = parseInt($(this).next().html());
		var stock = parseInt($(this).prevAll(".stock").html());
			if (current > 0) {
				current = current - 1;
			}

		$(this).next().html(current);
		var newLink = "product.php?productId=<?php echo $row['productId'];?>&num=" + current;
		
		var newHtml = '<a href="' + newLink + '">Add To Cart</a>';
		
		
		$(this).next('.addToCartSubmit').html(newHtml);
			
	});
	
	
	
	
	
	
		$('#add').validate({
		rules: {
			productName: {
				required: true
			},
			productPrice: {
				required: true,
				number: true
			},
			productDesc: {
				required: true
				
			},
			productQuantity:  {
				required: true,
				digits: true
				}
			
			
		},
		
		 messages: {
			productName: {
				required: "*Please include product name"
			},
			productPrice: {
				required: "*Please include price",
				number: "*Must be a whole number or decimal"
				
			},
			productDesc: {
				required: "*Please include description"
				
			},
			productQuantity:  {
				required: "*Please include qunaity available in stock",
				digits: "*Must be an integer value"
			}
			
		},
		
		  errorPlacement: function(error, element) { 
       if ( element.is(":radio") || element.is(":checkbox")) {
          error.appendTo( element.parent()); 
        } else {
          error.insertAfter(element);
        } 
    } 
		
		
		
	});//end add form validate
	
	
	$('#user').validate({
		rules: {
			username: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
				
			},
			confirmPassword:  {
				equalTo:'#password'
				},
				
			s_firstName: {
				required: true
			},
			s_lastName: {
				required: true
			},
			s_address: {
				required: true
				
			},
			
			s_city: {
				required: true
			},
			s_zip: {
				required: true,
				
			},
			s_state: {
				required: true
				
			},
			
			b_firstName: {
				required: true
			},
			b_lastName: {
				required: true
			},
			b_address: {
				required: true
				
			},
			
			b_city: {
				required: true
			},
			b_zip: {
				required: true
			},
			b_state: {
				required: true
				
			
			}
			
		},
		
		 messages: {
			username: {
				required: "*Please include Username"
			},
			email: {
				required: "*Please include email address",
				email: "*Invalid email address format"
				
			},
			password: {
				required: "*Please include password"
				
			},
			confirmPassword:  {
				equalTo: "*Does not match password"
			},
			
			s_firstName: {
				required: "*Must include first name"
			},
			s_lastName: {
				required: "*Must include last name"
			},
			s_address: {
				required: "*Must include shipping address"
			},
			
			s_city: {
				required: "*Must include city"
			},
			s_zip: {
				required: "*Must include zip code"
			},
			s_state: {
				required: "*Must choose state"
				
			},
			
			b_firstName: {
				required: "*Must include first name"
			},
			b_lastName: {
				required: "*Must include last name"
			},
			b_address: {
				required: "*Must include billing address"
			},
			
			b_city: {
				required: "*Must include city"
			},
			b_zip: {
				required: "*Must include zip code"
			},
			b_state: {
				required: "*Must choose state"
				
			},
			
		},
		
		  errorPlacement: function(error, element) { 
       if ( element.is(":radio") || element.is(":checkbox")) {
          error.appendTo( element.parent()); 
        } else {
          error.insertAfter(element);
        } 
    } 
		
		
		
	});//end form validate
	
	$('#same').change(function(){
		if ($(this).is(':checked')){
		$('#b_firstName').val($('#s_firstName').val());
		$('#b_lastName').val($('#s_lastName').val());
		$('#b_address').val($('#s_address').val());
		$('#b_city').val($('#s_city').val());
		$('#b_zip').val($('#s_zip').val());
		$('#b_state').val($('#s_state').val());
		$('#b_firstName, #b_lastName, #b_address, #b_city, #b_zip, #b_state').prop('readonly', true);
		
		
		}
		else {
			$('#b_firstName, #b_lastName, #b_address, #b_city, #b_zip, #b_state').prop('readonly', false);
		}
	});
	
}); //end document ready