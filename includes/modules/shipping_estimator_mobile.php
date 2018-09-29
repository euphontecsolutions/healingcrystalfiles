

<style>
.infoboxcontents{
    background:#c1d7ff !important;
    
}

table#carts tbody tr td:first-child{
    background:rgba(0,0,0,.0001) !important;
    
}
button, input, optgroup, select, textarea{
    color:black;
}
.infoBoxHeading{
    background:rgba(0,0,0,.0001) !important;
    margin-left: -80px;
    font-size: 20px !important;
    margin-top: -20px;
    
}
</style>





<?php

// Only do when something is in the cart

if ($cart->count_contents() > 0) {



// Could be placed in english.php

// shopping cart quotes

  define('SHIPPING_OPTIONS', 'Shipping Options:');

  if (strstr($PHP_SELF,'shopping_cart_mobile.php')) {

  	

    define('SHIPPING_OPTIONS_LOGIN', '

    Calculate your Personal Shipping Cost below -&nbsp Just Enter your Zip Code/Country & Click "Re-calculate"

    <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    We ship most orders within 1-4 business days.

    ');

    

  } else {

    define('SHIPPING_OPTIONS_LOGIN', '

    Calculate your Personal Shipping Cost below -&nbsp Just Enter your Zip Code/Country & Click "Re-calculate"

    <br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

    We ship most orders within 1-4 business days.');

  }

  

  define('SHIPPING_METHOD_TEXT','');

  define('SHIPPING_METHOD_RATES','Rates:');

  define('SHIPPING_METHOD_TO','Ship to: ');

  define('SHIPPING_METHOD_TO_NOLOGIN', 'Ship to: <a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '"><u>Log In</u></a>');

  define('SHIPPING_METHOD_FREE_TEXT','Free Shipping');

  define('SHIPPING_METHOD_ALL_DOWNLOADS','- Downloads');

  define('SHIPPING_METHOD_RECALCULATE','Recalculate');

  define('SHIPPING_METHOD_ZIP_REQUIRED','true');

  define('SHIPPING_METHOD_ADDRESS','Address:');

  define('SHIPPING_METHOD_INFO', 'These rates are provided for your information. Please choose your prefered shipping method during checkout.');

  define('SHIPPING_TIME_INFO', 'How Long Will My Shipment Take? <a href="' . tep_href_link('article_info.php','articles_id=4433') . '" target="_blank">Click Here</a>');


  // shipping cost

  require('includes/classes/http_client.php'); // shipping in basket



  if($cart->get_content_type() !== 'virtual' && $cart->get_content_type() !== 'virtual_weight') {


    if (tep_session_is_registered('customer_id')) {

      // user is logged in

      if (isset($HTTP_POST_VARS['address_id'])){

        // user changed address

        $sendto = $HTTP_POST_VARS['address_id'];

      }elseif (tep_session_is_registered('cart_address_id')){

        // user once changed address

        $sendto = $cart_address_id;
//$sendto = $customer_default_shipping_id;
      }else{

        // first timer

        //$sendto = $customer_default_address_id;
      if(!isset($customer_default_shipping_id))$customer_default_shipping_id=$customer_default_address_id;
		$sendto = $customer_default_shipping_id;
      }
      // set session now

      $cart_address_id = $sendto;

      tep_session_register('cart_address_id');

      // include the order class (uses the sendto !)

      require(DIR_WS_CLASSES . 'order.php');

      $order = new order;

    }else{

      // user not logged in !
        require_once(DIR_WS_CLASSES . 'order.php');

      $order = new order;

      if (isset($HTTP_POST_VARS['country_id'])){

        // country is selected

        $country_info = tep_get_countries($HTTP_POST_VARS['country_id'],true);

        $order->delivery = array('postcode' => $HTTP_POST_VARS['zip_code'],

                                 'country' => array('id' => $HTTP_POST_VARS['country_id'], 'title' => $country_info['countries_name'], 'iso_code_2' => $country_info['countries_iso_code_2'], 'iso_code_3' =>  $country_info['countries_iso_code_3']),

                                 'country_id' => $HTTP_POST_VARS['country_id'],

                                 'format_id' => tep_get_address_format_id($HTTP_POST_VARS['country_id']));

        $cart_country_id = $HTTP_POST_VARS['country_id'];

        tep_session_register('cart_country_id');

        $cart_zip_code = $HTTP_POST_VARS['zip_code'];

        tep_session_register('cart_zip_code');

      }elseif (tep_session_is_registered('cart_country_id')){

        // session is available

        $country_info = tep_get_countries($cart_country_id,true);

        $order->delivery = array('postcode' => $cart_zip_code,

                                 'country' => array('id' => $cart_country_id, 'title' => $country_info['countries_name'], 'iso_code_2' => $country_info['countries_iso_code_2'], 'iso_code_3' =>  $country_info['countries_iso_code_3']),

                                 'country_id' => $cart_country_id,

                                 'format_id' => tep_get_address_format_id($cart_country_id));

      } else {

        // first timer

        $cart_country_id = STORE_COUNTRY;

        tep_session_register('cart_country_id');

// WebMakers.com Added: changes

// changed from STORE_ORIGIN_ZIP to SHIPPING_ORIGIN_ZIP

        $cart_zip_code = SHIPPING_ORIGIN_ZIP;

        $country_info = tep_get_countries(STORE_COUNTRY,true);

        tep_session_register('cart_zip_code');

        $order->delivery = array('postcode' => SHIPPING_ORIGIN_ZIP,

                                 'country' => array('id' => STORE_COUNTRY, 'title' => $country_info['countries_name'], 'iso_code_2' => $country_info['countries_iso_code_2'], 'iso_code_3' =>  $country_info['countries_iso_code_3']),

                                 'country_id' => STORE_COUNTRY,

                                 'format_id' => tep_get_address_format_id($HTTP_POST_VARS['country_id']));

      }

      // set the cost to be able to calvculate free shipping

      $order->info = array('total' => $cart->show_total()); // TAX ????

    }

    // weight and count needed for shipping !

    $total_weight = $cart->show_weight();

    $total_count = $cart->count_contents();

    require(DIR_WS_CLASSES . 'shipping.php');

    $shipping_modules = new shipping;

    $quotes = $shipping_modules->quote();

    $cheapest = $shipping_modules->cheapest();

    // set selections for displaying

    $selected_country = $order->delivery['country']['id'];

    $selected_zip = $order->delivery['postcode'];

    $selected_address = $sendto;

  }

    // eo shipping cost



  $info_box_contents = array();

  $info_box_contents[] = array('text' => SHIPPING_OPTIONS,

															'image' => tep_image(DIR_WS_TEMPLATES. TEMPLATE_NAME . '/images/infobox/left_stones_5.gif', '', '45', '28')

																);



  new infoBoxHeading($info_box_contents, false, false);



// check free shipping based on order $total

  if ( defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') ) {

    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {

      case 'national':

        if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;

      case 'international':

        if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;

      case 'both':

        $pass = true; break;

      default:

        $pass = false; break;

    }

    $free_shipping = false;

    if ( ($pass == true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) ) {

      $free_shipping = true;

      include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');

    }

  } else {

    $free_shipping = false;

  }

// end free shipping based on order total

//  $ShipTxt= tep_draw_form('estimator', tep_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'), 'post'); //'onSubmit="return check_form();"'

  $ShipTxt= tep_draw_form('estimator', tep_href_link(basename($PHP_SELF), '', 'SSL'), 'post'); //'onSubmit="return check_form();"'

  $ShipTxt.='<table id="carts"  style="background:rgba(0,0,0,.0001);color:#000099;">';

	$ShipTxt.='<tr><div class="col-sm-12 " ><b>'.SHIPPING_METHOD_INFO.'</div></tr>';
//	$ShipTxt.='<tr><div class="col-sm-12 " ><b>'.SHIPPING_TIME_INFO.'</div></tr>';


  if(sizeof($quotes)) {

    if (tep_session_is_registered('customer_id')) {

      // logged in

      $addresses_query = tep_db_query("select address_book_id, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $customer_id . "'");

      while ($addresses = tep_db_fetch_array($addresses_query)) {

        $addresses_array[] = array('id' => $addresses['address_book_id'], 'text' => tep_address_format(tep_get_address_format_id($addresses['country_id']), $addresses, 0, ' ', ' '));

      }

      //$ShipTxt.='<tr><td colspan="3" class="main">' . ($total_count == 1 ? ' Item: ' : ' Items: ') . $total_count . '&nbsp;-&nbsp;Weight: ' . $total_weight . 'lbs</td></tr>';

     $ShipTxt.='<tr><div class="col-sm-12 " >' .

                SHIPPING_METHOD_ADDRESS .'&nbsp;'. tep_draw_pull_down_menu('address_id', $addresses_array, $selected_address, 'onchange="document.estimator.submit();return false;"').'&nbsp;&nbsp;<a class="articleNavigation" href="'.tep_href_link(FILENAME_ADDRESS_BOOK,'','SSL').'">Edit Address Book</a></div></tr>';

      $ShipTxt.='<tr valign="top"><td class="" align="left" style="margin-left:-70px;"><b>' . SHIPPING_METHOD_TO .'</b></td><td colspan="4" class=""><br>'. tep_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>') . '</td></tr><br>';

    } else {

      // not logged in

      $ShipTxt.=tep_output_warning_new(SHIPPING_OPTIONS_LOGIN);

     //$ShipTxt.='<tr><td colspan="3" class="main">' . ($total_count == 1 ? ' Item: ' : ' Items: ') . $total_count . '&nbsp;-&nbsp;Weight: ' . $total_weight . 'lbs</td></tr>';

      $ShipTxt.='<tr><td colspan="3" class="main" nowrap>' .

                ENTRY_COUNTRY .'&nbsp;'. tep_get_country_list('country_id', $selected_country,'style="width=200;"');

      if(SHIPPING_METHOD_ZIP_REQUIRED == "true"){

        /*$ShipTxt.='</td></tr>          <tr>

            <td colspan="3" class="main" nowrap>' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>

          </tr>
           
 <tr>

            <td colspan="3" class="main" nowrap>' . tep_draw_separator('pixel_trans.gif', '100%', '10') . '</td>

          </tr>
<tr><td colspan="3" class="main" nowrap>'.ENTRY_POST_CODE .'&nbsp;'. tep_draw_input_field('zip_code', $selected_zip, 'size="10"');*/

      }
$ShipTxt.='&nbsp;<input type="submit" value="' . SHIPPING_METHOD_RECALCULATE . '" onclick="document.estimator.submit();return false;">'.'</a></td></tr>';
      //$ShipTxt.='&nbsp;<a href="_" onclick="document.estimator.submit();return false;">' . SHIPPING_METHOD_RECALCULATE.'</a></td></tr>';

    }
	$ShipTxt .= '</form>';
	
	if (isset($currencies) && is_object($currencies)) {
	    
		reset($currencies->currencies);

		$currencies_array = array();
	
		while (list($key, $value) = each($currencies->currencies)) {
	
		  $currencies_array[] = array('id' => $key, 'text' => $value['title']);
	
		}
		$hidden_get_variables = '';
	
		reset($HTTP_GET_VARS);
	
		while (list($key, $value) = each($HTTP_GET_VARS)) {
	
		  if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
	
			$hidden_get_variables .= tep_draw_hidden_field($key, $value);
	
		  }
	
		}
	    $ShipTxt .='<tr valign="top"><td  style="margin-left:-80px;"><b>Currency:</b> </td><td colspan="2" class="main">'; 
		$ShipTxt .= tep_draw_form('curr', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');

		$ShipTxt .= tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'style="width:100px;"onChange="this.form.submit();"');
	
		$ShipTxt .= $hidden_get_variables;
	
		$ShipTxt .= tep_hide_session_id();
	
		$ShipTxt .= '</form>';
		  
		  
		$ShipTxt .= '</td></tr>';
	  
    }

    if ($free_shipping==1) {

      // order $total is free

      $ShipTxt.='<tr><td colspan="3" class="main">'.tep_draw_separator().'</td></tr>';

      $ShipTxt.='<tr><td>&nbsp;</td><td class="main">' . sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . '</td><td>&nbsp;</td></tr>';

    }else{

      // shipping display

      $ShipTxt.='<tr><td  style="margin-left:-80px;"><b> ' . SHIPPING_METHOD_RATES . '</b></td></tr>';

     // $ShipTxt.='<tr><td colspan="3" class="main">'.tep_draw_separator().'</td></tr>';

      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {

        if(sizeof($quotes[$i]['methods'])==1){

          // simple shipping method

          $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][0]['id'];

          $ShipTxt.= '<tr class="'.$extra.'">';

          $ShipTxt.='<td class="">'.$quotes[$i]['icon'].'&nbsp;</td>';

          if($quotes[$i]['error']){

            $ShipTxt.='<td colspan="2" class="">'.$quotes[$i]['module'].'&nbsp;';

            $ShipTxt.= '('.$quotes[$i]['error'].')</td></tr>';

          }else{

            if($cheapest['id'] == $thisquoteid){

              $ShipTxt.='<td class=""><b>'.$quotes[$i]['module'].'&nbsp;';

              $ShipTxt.= '('.$quotes[$i]['methods'][0]['title'].')</b></td><td align="right" class=""><b>'.$currencies->format(tep_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])).'<b></td></tr>';

            }else{

              $ShipTxt.='<td class="">'.$quotes[$i]['module'].'&nbsp;';

              $ShipTxt.= '('.$quotes[$i]['methods'][0]['title'].')</td><td align="right" class="">'.$currencies->format(tep_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])).'</td></tr>';

            }

          }

        } else {

          // shipping method with sub methods (multipickup)
$ShipTxt.= '<hr>';
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {

            $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][$j]['id'];

            $ShipTxt.= '<tr class="'.$extra.'">';

            $ShipTxt.='<td class="" style="width: 100px; height: 30px;">'.$quotes[$i]['icon'].'&nbsp;</td>';

            if($quotes[$i]['error']){

              $ShipTxt.='<td  class=""><center>'.$quotes[$i]['module'].'</center>&nbsp;';

              $ShipTxt.= '('.$quotes[$i]['error'].')</td></tr>';

            }else{

              if($cheapest['id'] == $thisquoteid){

                $ShipTxt.='<td class=""><b><center>'.$quotes[$i]['module'].'&nbsp;';

                $ShipTxt.= '('.$quotes[$i]['methods'][$j]['title'].')</center></b></td><td align="" class=""><b><center>'.$currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])).'</center></b></td></tr>';

              }else{

                $ShipTxt.='<td class=""><center>'.$quotes[$i]['module'].'&nbsp;';

                $ShipTxt.= '('.$quotes[$i]['methods'][$j]['title'].')<center></td><td align="" class=""><center>'.$currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])).'</center></td></tr>';

              }

            }

          }

        }

      }

    }

  } else {

    // virtual product/download

    $ShipTxt.='<tr><td class="main">' . SHIPPING_METHOD_FREE_TEXT . ' ' . SHIPPING_METHOD_ALL_DOWNLOADS . ' / Gift Voucher</td></tr>';

  }



 
 



  $info_box_contents = array();

  $info_box_contents[] = array('text' => $ShipTxt);



  new contentBox($info_box_contents);



$info_box_contents = array();

 

 // new infoboxFooter($info_box_contents, true, true);

} // Only do when something is in the cart

?>

              </td></tr></table>

            </td>

          </tr>

<!-- shipping_estimator_eof //-->

