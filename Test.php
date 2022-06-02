<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" style="height:100%">
<head><link href="css/main.css" rel="stylesheet"/>
    <script type="text/javascript" src="jquery-2.1.4.js">
    </script>
    <meta charset="utf-8" />
    <meta name="description" content="Одесса,7км, 1ая площадка, ролет 316"/>
    <title>
        Главная
    </title>
</head>
<body style="background-color:#DCDCDC;margin: 0 !important;padding: 0 !important;">
    <div style='padding:50px;background-color:green' id='Click'>
		CLICK
	</div>
</body>
<script type="text/javascript">
        $(document).ready(function(){  
			$("#Click").mousedown(function(){
				$.ajax({
                        type: "POST",
                        url: "AAndroidRequests.php",
                        data :"getGoodsByCategory=1",
                        dataType: "json",
                        success: function(data)
                        {
                            console.log(data);
                        }
				});
                /*$.ajax({
                        type: "POST",
                        url: "ARequests.php",
                        data :"delBasket="+id,
                        dataType: "json",async:false,
                        success: function(data)
                        {
                            if(data=="true")
                            {
                                $("#"+id+"_divGoods").remove();
                            }
                        }
                });*/
			});
		});
</script>
</html>