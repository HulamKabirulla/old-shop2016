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
 if(isset($_POST['addToBasket'])&&isset($_POST['count']))
 {
    echo json_encode($Basket->AddToBasket($_POST['addToBasket'],$_POST['count']));
 }
 else if(isset($_POST['getBasket']))
 {
    $massive=$Basket->GetUsersBasket();
    echo json_encode($massive);
 }
 else if(isset($_POST['delBasket']))
 {
    echo json_encode($Basket->delGoodFromBasket($_POST['delBasket']));
 }
 else if(isset($_POST['NameUser'])&&isset($_POST['NumUser'])&&isset($_POST['AdressUser']))
 {
     echo json_encode($Basket->BuyGoods($_POST['NameUser'],$_POST['NumUser'],$_POST['AdressUser']));
 }
 else if(isset($_POST['issetHash']))
 {
	 $hash=$_COOKIE['usersHash'];
	 if($User->CheckForHashUser($hash))
	 {
		echo json_encode($hash);
	 }
	 else
	 {
		$hash=$User->CreateHash();
		echo json_encode($hash);
	 }
 }
 else if(isset($_POST['usersLastOrder']))
 {
	 
 }
?>