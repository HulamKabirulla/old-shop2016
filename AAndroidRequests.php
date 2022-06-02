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
 require("classes/CBasket.php");
 $Con=new Connect();
 $Categories=new Categories($Con->getConnection());
 $Goods=new Goods($Con->getConnection());
 $User=new User($Con->getConnection());
 $Basket=new Basket($Con->getConnection());
 if(isset($_POST['getGoodsByCategory']))
 {
	 $massiveGoods=$Goods->getGoodsByCategory($_POST['getGoodsByCategory']);
	 echo json_encode($massiveGoods);
 }
?>