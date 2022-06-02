$(document).ready(function(){  
    function delFromBasket(id)
    {
            var price=parseInt($("#"+id+"_BasketPriceGoods").text());
            var BasketSumGoods=$(".BasketSumGoods");
            var ResAllSum=0;
            var curSum=parseInt($("#"+id+"_BasketSumGoods").text());
            for(var i=0;i<BasketSumGoods.length;i++)
            {
                ResAllSum+=parseInt($(BasketSumGoods[i]).text());
            }
            ResAllSum-=curSum;
                $("#divAllResDiv").text("Всего: "+(ResAllSum)+"грн.");
                $.ajax({
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
                });
             if(ResAllSum<=0)
             {
                document.getElementById("BasketGoodsDiv").innerHTML="<u style=\"clear:left;float: left;text-align:center;width: 100%;text-align:center;margin-bottom:30px\">Корзина пуста</u>";
             }       
    }
    function GetBasket()
    {
            document.getElementById("BasketDiv").style.display='inherit';
            $.ajax({
                    type: "POST",
                    url: "ARequests.php",
                    data :"getBasket=1",
                    dataType: "json",async:false,
                    success: function(data)
                    {
                        if(data[0])
                        {
                            document.getElementById("BasketGoodsDiv").innerHTML="";
                        }
                        else
                        {
                             document.getElementById("BasketGoodsDiv").innerHTML="<u style=\"clear:left;float: left;text-align:center;width: 100%;text-align:center;margin-bottom:30px\">Корзина пуста</u>";
                        }
                        var resSum=0;
                        for(var i=0;data[i];i++)
                        {
                            var HrefBasket=document.createElement("a");
                            var divGoods=document.createElement("div");
                            divGoods.id=data[i].id_goods+"_divGoods";
                            divGoods.style.clear='left';
                            divGoods.style.cssFloat='left';
                            divGoods.style.marginBottom='10px';
                            var divImgGoods=document.createElement("div");
                            divImgGoods.style.backgroundImage='url('+data[i].src+')';
                            divImgGoods.style.cssFloat='left';
                            divImgGoods.style.width='100px';
                            divImgGoods.style.height='100px';
                            divImgGoods.style.backgroundSize='contain';
                            divImgGoods.style.backgroundRepeat='no-repeat';
                            var divNameGoods=document.createElement("h3");
                            divNameGoods.style.cssFloat='left';
                            divNameGoods.style.width='100px';
                            divNameGoods.style.wordBreak='break-all';
                            divNameGoods.style.margin='0px 0px 0px 0px';
                            divNameGoods.style.marginLeft='5px';
                            var divPriceGoods=document.createElement("h4");
                            divPriceGoods.style.cssFloat='left';
                            divPriceGoods.style.margin='0px 0px 0px 0px';
                            divPriceGoods.style.marginLeft='10px';
                            divPriceGoods.id=data[i].id_goods+"_BasketPriceGoods";
                            var divCountGoods=document.createElement("input");
                            divCountGoods.style.cssFloat='left';
                            divCountGoods.style.marginLeft='10px';
                            divCountGoods.style.width='15px';
                            divCountGoods.className='BasketCountGoods';
                            divCountGoods.id=data[i].id_goods+"_BasketCountGoods";
                            divCountGoods.value=data[i].count;
                            var divSumGoods=document.createElement("h4");
                            divSumGoods.style.cssFloat='left';
                            divSumGoods.style.marginLeft='10px';
                            divSumGoods.style.margin='0px 0px 0px 0px';
                            divSumGoods.style.marginLeft='5px';
                            divSumGoods.id=data[i].id_goods+"_BasketSumGoods";
                            divSumGoods.className="BasketSumGoods";
                            var divDelGoods=document.createElement("div");
                            divDelGoods.style.marginLeft='10px';
                            divDelGoods.style.cssFloat='left';
                            divDelGoods.className='delGoodsFromBasket';
                            divDelGoods.id=data[i].id_goods+"_delGoodsFromBasket";
                            $(divDelGoods).text("Удалить");
                            $(divNameGoods).text(data[i].name);
                            $(divPriceGoods).text(data[i].price+"грн. *");
                            $(divSumGoods).text(data[i].count*data[i].price+"грн.");
                            HrefBasket.appendChild(divImgGoods);
                            HrefBasket.href="GoodsDesc.php?good="+data[i].id_goods;
                            divGoods.appendChild(HrefBasket);
                            divGoods.appendChild(divNameGoods);
                            divGoods.appendChild(divPriceGoods);
                            divGoods.appendChild(divCountGoods);
                            divGoods.appendChild(divSumGoods);
                            divGoods.appendChild(divDelGoods);
                            document.getElementById("BasketGoodsDiv").appendChild(divGoods);
                            resSum+=data[i].count*data[i].price;
                        }
                        if(data[0])
                        {
                            var divAllResDiv=document.createElement("h2");
                            divAllResDiv.id="divAllResDiv";
                            divAllResDiv.style.color='#228B22';
                            divAllResDiv.style.clear='left';
                            divAllResDiv.style.cssFloat='right';
                            var divBuyGoods=document.createElement("h3");
                            divBuyGoods.style.clear='right';
                            divBuyGoods.style.cssFloat='right'
                            divBuyGoods.style.backgroundColor='green';
                            divBuyGoods.style.padding='10px';
                            divBuyGoods.style.color='white';
                            divBuyGoods.style.cursor='pointer';
                            divBuyGoods.id="BasketBuyGoods";
                            $(divBuyGoods).text("Купить");
                            $(divAllResDiv).text("Всего: "+resSum+"грн.");
                            document.getElementById("BasketGoodsDiv").appendChild(divAllResDiv);
                            document.getElementById("BasketGoodsDiv").appendChild(divBuyGoods);
                        }
                    }
                });
    }
	function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}
function SetCookie(cookieName,cookieValue,nDays) {
         var today = new Date();
         var expire = new Date();
         if (nDays==null || nDays==0) nDays=1;
         expire.setTime(today.getTime() + 3600000*24*nDays);
         document.cookie = cookieName+"="+escape(cookieValue)
                         + ";expires="+expire.toGMTString();
        }
		function issetInArray(array,idGoods)
		{
			var length=array.length;
			for(var i=0;i<length;i++)
			{
				if(parseInt(array[i])==idGoods)
				{
					return true;
				}
			}
			return false;
		}
		function UpdateBasketArray(array,idGoods,newCount)
		{
			var newArray="";
			for(var i=0;i<array.length;i++)
			{
				if(parseInt(array[i])!=idGoods)
				{
				newArray=newArray+array[i];
				if(i!=array.length-1)
					{
						newArray=newArray+"}";
					}
				}
				else
				{
					newArray=newArray+idGoods+"_"+newCount;
					if(i!=array.length-1)
					{
						newArray=newArray+"}";
					}
				}
			}
			return newArray;
		}
    function AddToBasket(id,count,price)
    {
		/*var BasketValue=id+"_"+count;
		var goodsBasket=getCookie("goodsBasket");
		if(goodsBasket)
		{
		goodsBasketArray=goodsBasket.split("}");
			if(!issetInArray(goodsBasketArray,id))
			{
			goodsBasket=goodsBasket+"}"+BasketValue;
				SetCookie("goodsBasket",goodsBasket,1);
			}
			else
			{
				goodsBasket=(UpdateBasketArray(goodsBasketArray,id,count));
				SetCookie("goodsBasket",goodsBasket,1);
			}
		}
		else
		{
			SetCookie("goodsBasket",BasketValue,1);
		}
		alert(goodsBasket);*/
		var hash="";
		$.ajax({
                    type: "POST",
                    url: "ARequests.php",
                    data :"issetHash=1",
                    dataType: "json",async:false,
                    success: function(data)
                    {
                        hash=data;
                    }
            });
            var ResSum=count*price;
            if(price<0.0||count<1)
            {
                return;
            }
            $.ajax({
                    type: "POST",
                    url: "ARequests.php",
                    data :"addToBasket="+id+"&count="+count,
                    dataType: "json",async:false,
                    success: function(data)
                    {
                        $("#"+id+"_BasketSumGoods").text(ResSum+"грн.");
                    }
            });
            var BasketSumGoods=$(".BasketSumGoods");
            var ResAllSum=0;
            for(var i=0;i<BasketSumGoods.length;i++)
            {
                ResAllSum+=parseInt($(BasketSumGoods[i]).text());
            }
            $("#divAllResDiv").text("Всего: "+ResAllSum+"грн.");
    }
        $(document).on('click', '#ReadyUser', function (){
            var nameUser=document.getElementById("NameUser").value;
            var numUser=document.getElementById("NumUser").value;
            var AdressUser=document.getElementById("AdressUser").value;
			var goodsBasket=getCookie("goodsBasket");
			alert(goodsBasket);
            /*$.ajax({
                    type: "POST",
                    url: "ARequests.php",
                    data :"NameUser="+nameUser+"&NumUser="+numUser+"&AdressUser="+AdressUser,
                    dataType: "json",async:false,
                    success: function(data)
                    {
                        if(data=="true")
                        {
                            document.getElementById("BasketGoodsDiv").innerHTML="<u style=\"clear:left;float: left;text-align:center;width: 100%;text-align:center;margin-bottom:30px\">Мы свяжемся с Вами в ближайшее время</u>";
                        }
                    }
            });*/
        });
        $(document).on('click', '#BasketBuyGoods', function (){
            document.getElementById("BasketGoodsDiv").innerHTML="";
            var divName=document.createElement("h4");
            var inputName=document.createElement("input");
            var divNum=document.createElement("h4");
            var inputNum=document.createElement("input");
            var divAdress=document.createElement("h4");
            var inputAdress=document.createElement("input");
            var divReady=document.createElement("h3");
            divName.style.clear='left';
            divName.style.width='150px';
            divName.style.cssFloat='left';
            divName.style.margin='0px 0px 0px 0px';
            divName.style.padding='2px';
            inputName.style.cssFloat='left';
            inputName.style.padding='2px';
            inputName.id="NameUser";
            divNum.style.clear='left';
            divNum.style.width='150px';
            divNum.style.cssFloat='left';
            divNum.style.margin='0px 0px 0px 0px';
            divNum.style.marginTop='5px';
            divNum.style.padding='2px';
            inputNum.style.cssFloat='left';
            inputNum.style.padding='2px';
            inputNum.style.marginTop='5px';
            inputNum.id='NumUser';
            divAdress.style.clear='left';
            divAdress.style.cssFloat='left';
            divAdress.style.margin='0px 0px 0px 0px';
            divAdress.style.marginTop='5px';
            divAdress.style.padding='2px';
            divAdress.style.width='150px';
            inputAdress.style.cssFloat='left';
            inputAdress.style.padding='2px';
            inputAdress.style.marginTop='5px';
            inputAdress.id="AdressUser"
            divReady.style.clear='left';
            divReady.style.cssFloat='right';
            divReady.style.padding='10px';
            divReady.style.backgroundColor='green';
            divReady.style.color='white';
            divReady.style.cursor='pointer';
            divReady.id='ReadyUser';
            $(divName).text("Имя получателя: ");
            $(divNum).text("Номер телефона: ");
            $(divAdress).text("Адрес доставки: ");
            inputAdress.placeholder="Город,улица,дом,квартира";
            $(divReady).text("Готово");
            document.getElementById("BasketGoodsDiv").appendChild(divName);
            document.getElementById("BasketGoodsDiv").appendChild(inputName);
            document.getElementById("BasketGoodsDiv").appendChild(divNum);
            document.getElementById("BasketGoodsDiv").appendChild(inputNum);
            document.getElementById("BasketGoodsDiv").appendChild(divAdress);
            document.getElementById("BasketGoodsDiv").appendChild(inputAdress);
            document.getElementById("BasketGoodsDiv").appendChild(divReady);
        });
        $(document).on('keyup', '.BasketCountGoods', function (){
            var id=parseInt($(this).attr(("id")));
            var count=parseInt(this.value);
            var price=parseInt($("#"+id+"_BasketPriceGoods").text());
            AddToBasket(id,count,price);
        });
        $(document).on('click', '.delGoodsFromBasket', function (){
            delFromBasket(parseInt($(this).attr(("id"))));
        });
        $("#BasketClose").click(function(){
            document.getElementById("BasketDiv").style.display='none';
        });
        $("#BasketOpen").click(function(){
            GetBasket();
        });
        $(".AddToBasket").mouseup(function(){
            var id=parseInt($(this).attr("id"));
            var count=parseInt(document.getElementById(id+"_Count").value);
			var price=parseInt($("#"+id+"_BasketPriceGood").text());
            AddToBasket(id,count,price);
            GetBasket();
        });    
    });