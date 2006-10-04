<?php

/**
 * Copyright (C) 2006 Google Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

  //Point to the correct directory
  chdir("..");
  //Include all the required files
  require_once('library/googlecart.php');
  require_once('library/googleitem.php');
  require_once('library/googleshipping.php');
  require_once('library/googletaxrule.php');
  require_once('library/googletaxtable.php');

  function UseCase1() {
    //Create a new shopping cart object
    $merchant_id = "530014911156791";
    $merchant_key = "S0ETwSMMc3LfYa8VteqAuw";
    $server_type = "sandbox";
    $cart =  new GoogleCart($merchant_id, $merchant_key, $server_type); 

    //Add items to the cart
    $item1 = new GoogleItem("Dry Food Pack AA1453", 
        " pack of highly nutritious dried food for emergency", 1, 35);
    $item2 = new GoogleItem("MegaSound 2GB MP3 Player", 
        "Portable MP3 player - stores 500 songs", 1, 178);
    $item3 = new GoogleItem("AA Rechargeable Battery Pack", 
        "Battery pack containing four AA rechargeable batteries", 1 , 12 );
    $cart->AddItem($item1);
    $cart->AddItem($item2);
    $cart->AddItem($item3);

    //Display XML data
    $data = $cart->GetXML();
    echo $data;

    //Send request using curl for test
    send_google_req($cart->request_url, $cart->merchant_id, 
        $cart->merchant_key, $data, "");
  }

  function UseCase2() {
    //Create a new shopping cart object
    $merchant_id = "530014911156791";
    $merchant_key = "S0ETwSMMc3LfYa8VteqAuw";
    $server_type = "sandbox";
    $cart =  new GoogleCart($merchant_id, $merchant_key, $server_type); 

    //Add items to the cart
    $item1 = new GoogleItem("Dry Food Pack AA1453", 
        " pack of highly nutritious dried food for emergency", 1, 35);
    $item2 = new GoogleItem("MegaSound 2GB MP3 Player", 
        "Portable MP3 player - stores 500 songs", 1, 178);
    $item3 = new GoogleItem("AA Rechargeable Battery Pack", 
        "Battery pack containing four AA rechargeable batteries", 1 , 12);
    $cart->AddItem($item1);
    $cart->AddItem($item2);
    $cart->AddItem($item3);

    //Add shipping options
    $ship = new GoogleShipping("flat", "flat-rate", 5);
    $ship->SetAllowedStateAreas(array("NY", "CA"));
    $cart->AddShipping($ship);

    $ship = new GoogleShipping("pickup", "pickup", 10);
    $cart->AddShipping($ship);

    //Add tax options
    $tax_rule = new GoogleTaxRule("default", 0.02, "FULL_50_STATES");
    $tax_rule->SetStateAreas( array("CA", "NY") );
    $tax_table = new GoogleTaxTable("default");
    $tax_table->AddTaxRules($tax_rule);
    $cart->AddTaxTables($tax_table);

    $tax_rule = new GoogleTaxRule("alternate", 0.05);
    $tax_rule->SetZipPatterns( array("94305", "10027") );
    $tax_rule->SetStateAreas( array("CA") );
    $tax_table = new GoogleTaxTable("alternate", "test");
    $tax_table->AddTaxRules($tax_rule);

    $tax_rule = new GoogleTaxRule("alternate", 0.1);
    $tax_rule->SetStateAreas( array("CO", "FL") );
    $tax_table->AddTaxRules($tax_rule);

    $cart->AddTaxTables($tax_table);

    //Display XML data
    $data = $cart->GetXML();
    echo $data;

    //Send request using curl for test
    send_google_req($cart->request_url, $cart->merchant_id, 
        $cart->merchant_key, $data, "");
  }

  function UseCase3() {
    //Create a new shopping cart object
    $merchant_id = "530014911156791";
    $merchant_key = "S0ETwSMMc3LfYa8VteqAuw";
    $server_type = "sandbox";
    $cart =  new GoogleCart($merchant_id, $merchant_key, $server_type); 

    //Add items to the cart
    $item1 = new GoogleItem("Dry Food Pack AA1453", 
        " pack of highly nutritious dried food for emergency", 1, 35);
    $item2 = new GoogleItem("MegaSound 2GB MP3 Player", 
        "Portable MP3 player - stores 500 songs", 1, 178);
    $item3 = new GoogleItem("AA Rechargeable Battery Pack", 
        "Battery pack containing four AA rechargeable batteries", 1 , 12 );
    $cart->AddItem($item1);
    $cart->AddItem($item2);
    $cart->AddItem($item3);

    //Set request buyer phone
    $cart->SetRequestBuyerPhone("true");

    //Add merchant calculations options
    $cart->SetMerchantCalculations(
        //"http://manifoldreality.org/gtest/vignesh/php-sample-code/demo/responsehandlerdemo.php", "true","true", "true");
       "https://www.example.com/shopping/merchantCalc", "true", "true", "true");
    $ship = new GoogleShipping("merchant-calc", 
        "merchant-calculated", 5, "USD", "ALL");
    $ship->SetAllowedStateAreas(array("NY", "CA"));
    $cart->AddShipping($ship);

    $tax_rule = new GoogleTaxRule("default", 0.2);
    $tax_rule->SetStateAreas( array("CA", "NY") );

    $tax_table = new GoogleTaxTable("default");
    $tax_table->AddTaxRules($tax_rule);
    $cart->AddTaxTables($tax_table);


    //Display XML data
    $data = $cart->GetXML();
    echo $data;

    //Send request using curl for test
    send_google_req($cart->request_url, $cart->merchant_id, 
        $cart->merchant_key, $data, "");
  }

  function send_google_req($url, $merid, $merkey,
      $postargs, $message_log) {
    // Get the curl session object
    $session = curl_init($url);

   // Set the header array
    $header_string_1 = "Authorization: Basic ".base64_encode($merid.':'.$merkey);
    $header_string_2 = "Content-Type: application/xml";
    $header_string_3 = "Accept: application/xml";

    // Set the POST options.
    curl_setopt ($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_HTTPHEADER, array($header_string_1, $header_string_2, $header_string_3));
    curl_setopt ($session, CURLOPT_POSTFIELDS, $postargs);
    curl_setopt($session, CURLOPT_HEADER, true);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // Do the POST and then close the session
    $response = curl_exec($session);
    curl_close($session);

    // Get HTTP Status code from the response
    $status_code = array();
    preg_match('/\d\d\d/', $response, $status_code);

    // Check for errors
    switch( $status_code[0] ) {
      case 200:
      // Success
        break;
      case 503:
        die('Error 503: Service unavailable.');
        break;
      case 403:
        die('Error 403: Forbidden.');
        break;
      case 400:
        die('Error 400:  Bad request.');
        break;
      default:
        echo $response;
       die('Error :' . $status_code[0]);
    }
    echo $response;
    echo $status_code[0];
  }

  //Invoke any of the provided use cases
  
  //UseCase1();
  //UseCase2();
  //UseCase3();
  
?>
