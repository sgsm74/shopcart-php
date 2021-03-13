<?php

namespace App\Controllers;

use \Core\View;
session_start();
/**
 * Home controller
 *
 */
class Home extends \Core\Controller
{
    

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::render('Home/index.php');
    }

    public function add2cartAction()
    {
    $cars=Array
    (
        (0) => Array
            (
                'name' => 'Volvo',
                'price' => 22000,
                'code' => 1000,
                'balance'=> 7
            ),

        (1) => Array
        (
            'name' => 'BMW',
            'price' => 15000,
            'code' => 1001,
            'balance' => 8
        ),

        (2) => Array
            (
            'name' => 'Saab',
            'price' => 5000,
            'code' => 1002,
            'balance' => 9
            )
    );
        if(!empty($_POST["quantity"])) {
            $key = array_search($_POST["code"], array_column($cars, 'code'));
			$itemArray = array($cars[$key]["code"]=>array('name'=>$cars[$key]["name"], 'code'=>$cars[$key]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$cars[$key]["price"]));
            if($_POST["quantity"] <= $cars[$key]["balance"]){
                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($cars[$key]["code"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                                if($cars[$key]["code"] == $k) {
                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                    if($_SESSION["cart_item"][$k]["quantity"] < $cars[$key]["balance"])
                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    else
                                    echo "موجودی کم است";
                                }
                        }
                    } else {
                        $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            else{
                echo "موجودی کم است";
            }
            
		}
        View::render('Home/index.php');
    }

    public function removeFromCartAction()
    {
        if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_POST["code"] == $v["code"])
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}

        View::render('Home/index.php');
    }

    public function emptyCartAction()
    {
        unset($_SESSION["cart_item"]);
        View::render('Home/index.php');
    }

}
