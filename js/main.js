$(function(){
	//For User Registration
	$("#regsubmit").click(function(){
		var name     = $("#name").val();
		var username = $("#username").val();
		var password = $("#password").val();
		var email    = $("#email").val();
		var dataString = 'name='+name+'&username='+username+'&password='+password+'&email='+email;
		$.ajax({
			type:"POST",
			url :"getregister.php",
			data:dataString,
			success:function(data){
				$("#state").html(data);
			}
		});
		return false;
	});
    
    //For User login
	$("#loginsubmit").click(function(){
		var email    = $("#email").val();
		var password = $("#password").val();
		var dataString = 'email='+email+'&password='+password;
		$.ajax({
			type:"POST",
			url :"getlogin.php",
			data:dataString,
			success:function(data){
				if($.trim(data) == "empty"){
					$(".empty").show();
					setTimeOut(function(){
						$(".empty").fadeOut();
					},4000);
				}
				else if($.trim(data) == "disable"){
					$(".disable").show();
					setTimeOut(function(){
						$(".disable").fadeOut();
					},4000);
				}
				else if($.trim(data) == 'error'){
					$(".error").show();
					setTimeOut(function(){
						$(".error").fadeOut();
					},4000);
				}
				else{
					window.location = "exam.php";
				}
			}
		});
		return false;
	});

});