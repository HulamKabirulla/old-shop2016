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
 //$User=new User($Con->getConnection());
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
                <h1 style="font-weight:100;clear:left;float:left">
                    <font face="courier">Популярные товары</font>
                </h1>
                <div style="clear: left;float:left">
                    <?php
                        $massiveGoods="1,2,3";
                        $massiveExplodeGoods=explode(",",$massiveGoods);
                        $count=0;
                        for($i=0;$i<count($massiveExplodeGoods);$i++)
                        {
                        $GoodsRow=$Goods->getGoodsById($massiveExplodeGoods[$i]);
                        $GoodsImg=$Goods->getGoodsMainImg($GoodsRow['id']);
                        if($count<3)
                        {
                            echo "<div style='float:left;margin-bottom:30px'>";
                        }
                        else
                        {
                            echo "<div style='clear:left;float:left;margin-bottom:30px'>";
                            $count=0;
                        }
                            $CategoriesRow=$Categories->getCategory($GoodsRow['id_categories']);
                            echo "<div style='clear:left;float:left;font-size:150%'>";
                                echo "<a href='goods.php?Category=".$GoodsRow['id_categories']."' style='color:#1E90FF'>";
                                    echo $CategoriesRow['name']." &#8594;"; 
                                echo "</a>";
                            echo "</div>";
                            echo "<a href='GoodsDesc.php?good=".$GoodsRow['id']."'>";
                            echo "<div style='clear:left;float:left;background-image:url(\"".$GoodsImg."\");width:250px;margin-top:10px;height:200px;background-size:contain;background-repeat:no-repeat;margin-right:10px'>";
                            echo "</div>";
                            echo "</a>";
                            echo "<div style='clear:left;float:left;font-size:100%'>";
                                echo "<a href='#' style='color:#1E90FF'>";
                                echo $GoodsRow['name'];
                                echo "</a>";
                            echo "</div>";
                            echo "<div style='clear:left;float:left'>";
                            echo "Цена: ";
                                echo "<font style='font-size:150%' id='".$GoodsRow['id']."_BasketPriceGood'>";
                                echo $GoodsRow['price'];
                                echo "</font>";
                            echo "грн";
                            echo "</div>";
                            echo "<div style='clear:left;float:left;width:40px;margin-top:20px;margin-bottom:5px'>";
                                echo "<input type='number' style='padding:5px;width:100%' value='1' id='".$GoodsRow['id']."_Count'/>";
                            echo "</div>";
                            echo "<div style='clear:left;float:left;padding:10px;background-color: #1E90FF;color:white;font-weight:bold;' class='AddToBasket' id='".$GoodsRow['id']."_AddToBasket'>";
                                echo "<font face=\"monospace\">В корзину</font>";
                            echo "</div>";
                        echo "</div>";
                            
                        }
                    ?>
                </div>
                <h1 style="font-weight:100;clear:left;float:left">
                    <font face="courier">Новинки</font>
                </h1>
                <div style="clear: left;float:left">
                    <?php
                        $massiveGoods="15,33,50";
                        $massiveExplodeGoods=explode(",",$massiveGoods);
                        $count=0;
                        for($i=0;$i<count($massiveExplodeGoods);$i++)
                        {
                        $GoodsRow=$Goods->getGoodsById($massiveExplodeGoods[$i]);
                        $GoodsImg=$Goods->getGoodsMainImg($GoodsRow['id']);
                        if($count<3)
                        {
                            echo "<div style='float:left;margin-bottom:30px'>";
                        }
                        else
                        {
                            echo "<div style='clear:left;float:left;margin-bottom:30px'>";
                            $count=0;
                        }
                            $CategoriesRow=$Categories->getCategory($GoodsRow['id_categories']);
                            echo "<div style='clear:left;float:left;font-size:150%'>";
                                echo "<a href='goods.php?Category=".$GoodsRow['id_categories']."' style='color:#1E90FF'>";
                                    echo $CategoriesRow['name']." &#8594;"; 
                                echo "</a>";
                            echo "</div>";
                            echo "<a href='GoodsDesc.php?good=".$GoodsRow['id']."'>";
                            echo "<div style='clear:left;float:left;background-image:url(\"".$GoodsImg."\");width:250px;margin-top:10px;height:200px;background-size:contain;background-repeat:no-repeat;margin-right:10px'>";
                            echo "</div>";
                            echo "</a>";
                            echo "<div style='clear:left;float:left;font-size:100%'>";
                                echo "<a href='#' style='color:#1E90FF'>";
                                echo $GoodsRow['name'];
                                echo "</a>";
                            echo "</div>";
                            echo "<div style='clear:left;float:left'>";
                            echo "Цена: ";
                                echo "<font style='font-size:150%' id='".$GoodsRow['id']."_BasketPriceGood'>";
                                echo $GoodsRow['price'];
                                echo "</font>";
                            echo "грн";
                            echo "</div>";
                            echo "<div style='clear:left;float:left;width:40px;margin-top:20px;margin-bottom:5px'>";
                                echo "<input type='number' style='padding:5px;width:100%' value='1' id='".$GoodsRow['id']."_Count'/>";
                            echo "</div>";
                            echo "<div style='clear:left;float:left;padding:10px;background-color: #1E90FF;color:white;font-weight:bold;' class='AddToBasket' id='".$GoodsRow['id']."_AddToBasket'>";
                                echo "<font face=\"monospace\">В корзину</font>";
                            echo "</div>";
                        echo "</div>";
                            
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/Basket.js">
        
</script>
</html>