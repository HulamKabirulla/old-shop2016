<?php
/**
 * @author azichan
 * @copyright 2016
 */
 session_start();
 require("classes/CConnect.php");
 require("classes/CCategories.php");
 require("classes/CGoods.php");
 require("classes/CUser.php");
 $Con=new Connect();
 $Categories=new Categories($Con->getConnection());
 $Goods=new Goods($Con->getConnection());
 $User=new User($Con->getConnection());
?>
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
    <div id="AllDiv">
        <div style="clear: left;float:left;background-color:black;width:100%;font-weight:100;margin-bottom:10px">
            <div style="clear: left;float:left;margin-left:5px;padding:5px">
                <a href="index.php" style="color: white;">
                    <font face="monospace">Главная</font>
                </a>
            </div>
            <div style="float:left;color:white;margin-left:50px;padding:5px">
                <a href="index.php" style="color: white;">
                    <font face="monospace">О сайте</font>
                </a>
            </div>
            <div style="float:left;color:white;margin-left:50px;padding:5px">
                <a href="index.php" style="color: white;">
                    <font face="monospace">Контакты</font>
                </a>
            </div>
        </div>
        <div style="clear: left;float:left;margin-left:20%;font-size:120%;margin-bottom:10px">
            <div style="clear: left;float:left;margin-top:15px;padding-right:15px;border-right:inset 1px;border-color:#AFEEEE">
                <font face="cambria">0 963 807 091</font>
            </div>
            <div style="float: left;padding:15px">
                <font face="cambria">0 636 968 657</font>
            </div>
            <div style="float: left;padding:15px;margin-left:400px;background-color:#1E90FF;color:white;border-radius:50px" id="BasketOpen">
                <font face="cambria">Корзина</font>
            </div>
            <div id="BasketDiv">
                <u style="float: right;" id="BasketClose">
                    Скрыть
                </u>
                <div style="clear: right;float:left;margin-top:20px;width:100%" id="BasketGoodsDiv">
                    <u style="clear:left;float: left;text-align:center;width: 100%;text-align:center;margin-bottom:30px">
                        Корзина пуста
                    </u>
                </div>
            </div>
        </div>
        <div style="clear:left;float:left;width: 17%;">
            <div style="clear: left;float:left;background-color: #1E90FF;padding:8px;color:white;font-weight:bold;font-size:120%;width:100%">
                <font face="calibri">Все товары</font>
            </div>
            <?php
                $massive=$Categories->getAllCategory();
                for($i=0;$massive[$i];$i++)
                {
                    echo "<div style=\"clear: left;float:left;border-bottom:1px inset;padding: 10px;width:98%;border-right:1px inset;\">";
                    echo "<a href='goods.php?Category=".$massive[$i]['id']."' style='text-decoration:none;color:black'>";
                    echo "<font face=\"calibri\">".$massive[$i]['name']."</font>";
                    echo "</a>";
                    echo "</div>";
                }
            ?>
        </div>
        <div style="float: left;width:80%">
            <form action="goods.php" method="GET">
                <div style="clear:left;float: left;width:70%">
                <?php
                    if(isset($_GET['search']))
                    {
                        echo "<input type=\"search\" style=\"clear:left;float:left;padding: 15px;width:100%;margin-left:50px;border:1px ridge;border-color:#1E90FF;\" placeholder=\"Что нибудь ищете?\" name=\"search\" value=\"".htmlspecialchars($_GET['search'])."\"/>";
                    }
                    else
                    {
                        echo "<input type=\"search\" style=\"clear:left;float:left;padding: 15px;width:100%;margin-left:50px;border:1px ridge;border-color:#1E90FF;\" placeholder=\"Что нибудь ищете?\" name=\"search\"/>";
                    }  
                ?>
                </div>
                <button style="float: left;padding: 10px;background-color:#1E90FF;color:white;margin-left:35px;font-size:150%;border:0px;">
                    Найти
                </button>
            </form>
            <div style="clear: left;float:left;margin-left:50px;width:100%">
					<h1 style="clear: left;float:left">
						Консультации и заказ по телефонам
					</h1>
					<h2 style="clear: left;float:left;border-right:1px inset;border-color:#DCDCDC;font-weight:100">
						<p style="clear: left;float:left;margin-right:10px">
							(096) 380-70-91
						</p>
						<p style="clear: left;float:left;margin-top:0px">
							(063) 696-86-57
						</p>
					</h2>
					<div style="float:left;margin:0px 0px 0px 10px;">
						<h4 style="clear: left;float:left;color:#8B8989">
							График работы колл-центра:
						</h4>
						<h3 style="clear: left;float:left">
							C 8:00 до 20:00
						</h3>
					</div>
					<div style="float:left;border-right:1px inset;border-color:#DCDCDC;margin-left:20px">
						<h2 style="clear: left;float:left;margin-right:10px">
							Место работы:
						</h2>
						<h3 style="clear: left;float:left;margin-top:0px;font-weight:100;margin-right:10px">
							<u>г. Одесса, 7км, <br />1-ая площадка,ролет 316</u>
						</h3>
					</div>
					<div style="float:left;margin:0px 0px 0px 10px;">
						<h4 style="clear: left;float:left;color:#8B8989">
							График работы:
						</h4>
						<h3 style="clear: left;float:left">
							C 8:00 до 14:00
						</h3>
					</div>
					<h1 style="clear: left;float:left;">
						<u>Плюсы покупки на нашем сайте</u>
					</h1>
					<div style="clear: left;float:left;margin-left:20px">
						<div style="clear: left;float:left;border-bottom:1px outset;width:400px">
							<b>Невероятный выбор</b>
							Более 1 500 уникальных моделей сумок, клатчей, чемоданов, кошельков от 30 именитых брендов. Регулярно расширяем ассортимент товаров.
						</div>
						<div style="float:left;border-bottom:1px outset;width:400px">
							<b>Конкурентные цены</b>
							Наша компания является прямым поставщиком производителя, поэтому стоимость наших товаров существенно ниже рыночной.
						</div>
						<div style="clear: left;float:left;margin-top:10px;border-bottom:1px outset;width:400px;margin-top:30px">
							<b>Выгода для покупателей</b>
							Предоставляем возможность приобрести товары в розницу или воспользоваться дополнительными скидками при оптовом заказе.
						</div>
						<div style="float:left;margin-top:10px;border-bottom:1px outset;width:400px;margin-top:30px">
							<b>Удобная оплата</b>
							Предусмотрена предоплата или оплата покупки по факту получения. Комиссию и дополнительные услуги оплачивает наша компания.
						</div>
					</div>
					<div style="clear:left;float:left;margin-top:50px">
						<div style='clear:left;float:left;background-image:url("./storage/otherimg/315.jpg");width:450px;margin-top:10px;height:350px;background-size:contain;background-repeat:no-repeat;margin-right:10px'>
						</div>
						<div style='float:left;background-image:url("./storage/otherimg/315-316.jpg");width:450px;margin-top:10px;height:350px;background-size:contain;background-repeat:no-repeat;margin-right:10px'>
						</div>
						<div style='clear:left;float:left;background-image:url("./storage/otherimg/316.jpg");width:450px;margin-top:10px;height:350px;background-size:contain;background-repeat:no-repeat;margin-right:10px'>
						</div>
					</div>
				</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/Basket.js">
        
</script>
</html>