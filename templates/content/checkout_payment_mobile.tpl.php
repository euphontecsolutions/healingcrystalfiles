</tr></tbody></table>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <style>
   html, body {
    max-width: 100%;
    overflow-x: hidden;
}
   @media screen and (max-width: 360px) {
  table {
    width: 50%;
  }
  .main-containertable {
    width: 50%;
  }
}

/* On screens that are 600px or less, set the background color to olive */
@media screen and (max-width: 600px) {
/*  body {
    background-color: red;
  }*/
    table {
    width: 100%;
  }
  .main-container {
    width: 100%;
  }
/*  img {
    width: 50%;
  }
*/
element {

}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd0;
    background-color: transparent;
    padding: 0px;
}
.table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {

    padding: 5px;

}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}
TD.pageHeading, TD.nfpageHeading, TD.pageHeadingAllProds, TD.allpicHeading, TD.regularHeading {

    text-align: center;
    width: 50%;

}
}
   .main{
       width:auto;
   }
   .table .table {
    background-color: transparent;
    border-color: transparent;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 8px;
    line-height: 1.42857143;
    /*vertical-align: top;*/
    border-top: 1px solid #ddd0;
     background-color: transparent;
}
   hr.style-eight {
height: 10px;
border: 1;
box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8);
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
-ms-border-radius: 5px;
-o-border-radius: 5px;
border-radius: 5px;
}
      .grey-text{
          color:#9e9e9e !important;
      }
     /* .infoBoxContents{
          background-color: #fff;
          
      }*/
      
      .container {
          padding-left:0px;
          padding-right:0px;
      }
      TEXTAREA{
          width:100%;
      }
      .contentSF{
          display:none;
      }
      .articleNavigation{
          display:none;
      }
      .headertextsmall{
          display:none;
      }
      .head_img {
          display:flex;
          flex-direction:row;
          justify-content:space-between;

        border-top: 1px solid #d2d2d2;
        padding-top: 30px;
      }
      
      .product_name {
          font-size:12px;
          flex-shrink:1;
              margin-top: 30px;
      }
      .product_img {
          flex-shrink:1;
          box-shadow: 5px 10px 5px 0px #d4d4d4;
      }
      .descrip {
      	  margin-top: 5%;
          display:flex;
          flex-direction:row;
          justify-content:space-between;
          border-bottom: 1px solid #e0e0e0;
         padding-bottom: 30px;

      }
      
      .text_price {
      	  padding-left: 10%;
          display:flex;
          flex-direction:column;
          justify-content:space-between;
          color:#000;
          text-align:center;
      }
      .updater{
      	  margin-left: 10%;
          display:flex;
          flex-direction:column;
          justify-content:space-between;
      }


@media screen and (max-width: 767px) {
    .table-responsive {
        width: 100%;
        margin-bottom: 15px;
        overflow-y: hidden;
        -ms-overflow-style: -ms-autohiding-scrollbar;
        border:none;
    }
}
  </style>
<?php 
if(tep_session_is_registered('is_retail_store')){
        $retail_products = TRUE;
}
?> 
<script language="javascript" type="text/javascript">
<!-- 
//Browser Support Code
function checkcustomerdetails(){
    var cfname = document.getElementById('retail_firstname').value;
    var clname = document.getElementById('retail_lastname').value;
    var cpostcode = document.getElementById('retail_postcode').value;
    var cemail = document.getElementById('retail_email').value;
    var error = false;
    var error_message = '';
    if (cfname == '' || cfname.length < 2) {
      error_message = error_message + "* " + "please enter customer first name or first name must have atleast 2 letter" + "\n";
      error = true;
    }
    if (clname == '' || clname.length < 2) {
      error_message = error_message + "* " + "please enter customer last name or last name must have atleast 2 letter" + "\n";
      error = true;
    }
    if (cpostcode == '' || cpostcode.length < 4) {
      error_message = error_message + "* " + "please enter customer postcode or postcode must have atleast 4 letter" + "\n";
      error = true;
    }
    if(cemail != ''){
        var atpos=cemail.indexOf("@");
        var dotpos=cemail.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=cemail.length)
        {
          error_message = error_message + "* " + "please enter a valid e-mail address or leave the field empty" + "\n";
          error = true;
        }
    }
    
    if (error == true) {
        alert(error_message);
        //document.getElementById('retail_firstname').focus();
        return false;
    } else if(error == false && check_form()) {
        return true;
    }else{
        return false;
    }
}
function getfocus(){
	if(document.getElementById('domestic_check1')){		
		document.getElementById('domestic_check1').focus();	
	}
}
//new function added 15-10-2015
function check_address_us_or_not(){
   
   //new changes for outside us
  
     // var is_confirm = confirm("**Please note:\nCustomer is responsible for any customs, taxes or duties, if any, related to their order.\nCertificate of Origin not provided.");
	  	  
	 // if(is_confirm)
		return true;
	  //else
	  // return false;
  
 
	
}
function ajaxFunction(){
	//return false;
	var ajaxRequest;  // The variable that makes Ajax possible!
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			//alert(ajaxRequest.responseText);
			//alert('1234567890');
		}
	}	
	var queryString ='';
	for( var x=0; x<document.checkout_payment.elements.length; x++){
		var field = document.checkout_payment.elements[x];	
		//check if variable is radio field
		if(field.type=="radio"){	
			//check if it is shipping variable
			if(field.name=="shipping"){
				var selectedShipping = '';
				var selectedShippingArray = document.checkout_payment.elements["shipping"];
				for(var i = 0; i < selectedShippingArray.length; i++) {
					if(selectedShippingArray[i].checked) {
						selectedShipping = selectedShippingArray[i].value;
					}
				}		
			}else if(field.name=="payment"){
				var selectedPayment = '';
				var selectedPaymentArray = document.checkout_payment.elements["payment"];
				for(var i = 0; i < selectedPaymentArray.length; i++) {
					if(selectedPaymentArray[i].checked) {
						selectedPayment = selectedPaymentArray[i].value;
					}
				}				
			}
		}else if(field.type == "checkbox"){
			if(field.checked)queryString = queryString+"checkout_"+field.name+"="+field.value+"&";
			else queryString = queryString+"checkout_"+field.name+"=0&";
		}else{
			if(field.value!=''){				
				if(field.name.indexOf("paypalwpp")!= '-1')queryString = queryString+field.name+"="+field.value+"&";
				else queryString = queryString+"checkout_"+field.name+"="+field.value+"&";
			}
		}		
	}
	queryString = queryString+"checkout_shipping="+selectedShipping+"&checkout_payment="+selectedPayment;
	ajaxRequest.open("GET", "updateCheckoutValues.php"+"?"+queryString, true);
	ajaxRequest.send(null);
}

function validatephone(xxxxx) 
{
    var maintainplus = '';
    var numval = xxxxx.value
    if ( numval.charAt(0)=='+' )
    {
        var maintainplus = '';
    }
    curphonevar = numval.replace(/[\\A-Za-z!"�$%^&\-\)\(*+_={};:'@#~,.�\/<>\" "\?|`�\]\[]/g,'');
    xxxxx.value = maintainplus + curphonevar;
    var maintainplus = '';
    xxxxx.focus;
}

function checkFeild() {
   error = false;
   telephone = $('input[name="telephone"]').val();
   if(telephone == '' || telephone.length < '10'){
       error = true;
       error_message = '* please entered a valid phone number';
   }
   
   if (error == true) {
    alert(error_message);
    $('input[name="telephone"]').focus();
    return false;
  } else {
    return true;
  }
}

//-->
</script>

<div class="container">
<?php

  if(STORE_COUNTRY == $order->delivery['country']['id']){
  	$country_match = true;
  }else{
  	$country_match = false;
  }
  $is_domestic_only = false;
  if(!$country_match){
	  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
			 if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
			  for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {				
					if($order->products[$i]['attributes'][$j]['is_domestic_only'] == '1'){
						$is_domestic_only = true;
					}			
			  }
			}  
	  }
  }

 if(!$is_domestic_only)echo tep_draw_form('checkout_payment', tep_href_link('checkout_confirmation_mobile.php', '', 'SSL'), 'post', (tep_session_is_registered('retail_rep') && $_SESSION['retail_rep'] != ''?'onsubmit="return checkcustomerdetails();"':'onsubmit="return check_form() && checkFeild();"')); ?><table class="table table-responsive table-condensed" cellspacing="0" cellpadding="<?php echo CELLPADDING_SUB; ?>">
<?php if(isset($HTTP_GET_VARS['payment_error']) && $HTTP_GET_VARS['payment_error']!='')echo '<tr>
        <td><table class="table table-responsive table-condensed">
          <tbody>
		    <tr>
                <td><img src="images/pixel_trans.gif" alt="" width="50%" border="0" height="10"></td>
                
      	  </tr>
		  <tr class="infoBoxNoticeContents">

            <td><table class="table table-responsive table-condensed">
              <tbody>
			
			  <tr>
                <td><img src="images/pixel_trans.gif" alt=""  border="0" height="1"></td>
                <td class="main" valign="top">We were unable to process your credit card. Please scroll down to the payment section for details.</td>
                <td><img src="images/pixel_trans.gif" alt=""  border="0" height="1"></td>
              </tr>
              
            </tbody></table></td>
          </tr>
          <tr>
                <td><img src="images/pixel_trans.gif" alt="" width="50%" border="0" height="10"></td>
                
              </tr>

        </tbody></table></td>
      </tr>'; ?>
<?php if(isset($HTTP_GET_VARS['error']) && $HTTP_GET_VARS['error']=='temp_order_blocked')echo '<tr>
        <td><table class="table table-responsive table-condensed">
          <tbody>
		    <tr>
                <td><img src="images/pixel_trans.gif" alt="" width="50%" border="0" height="10"></td>
	  
      	  </tr>
		  <tr class="infoBoxNoticeContents">
	  
            <td><table class="table table-responsive table-condensed">
              <tbody>
	  
			  <tr>
                <td><img src="images/pixel_trans.gif" alt=""  border="0" height="1"></td>
                <td class="main" valign="top" width="100%">We\'re really sorry, but we\'re having trouble processing your order.  The system has now emailed our Customer Service Team to let them know about the issue and we will be contacting you personally to try and resolve the issue.   Please let us know if you prefer that we contact you by phone or by email and if you have a preferred time that we can try and reach you.<br><br>Computers can be pesky sometimes, but we\'ll get it straightened out for you.  Thanks again for shopping with Healing Crystals!
                </td>
                <td><img src="images/pixel_trans.gif" alt=""  border="0" height="1"></td>
              </tr>
	  
            </tbody></table></td>
          </tr>
          <tr>
                <td><img src="images/pixel_trans.gif" alt="" width="50%" border="0" height="10"></td>
                
              </tr>

        </tbody></table></td>
      </tr>'; ?>
	  
	  
	  
	  
<?php
// BOF: Lango Added for template MOD
if (SHOW_HEADING_TITLE_ORIGINAL == 'yes') {
$header_text = '&nbsp;'
//EOF: Lango Added for template MOD
?>
  <table class="table table-responsive table-condensed" border="0" style="margin-top: -49px;">
	  <tr>
	  	<td><?php require(DIR_WS_INCLUDES . 'warnings.php'); ?></td>
	  </tr>
	  <tr>
	     <td><table class="table table-responsive table-condensed">
          <tr>
             
            <td class="pageHeading" style="width:100%"  align="middle" ><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_payment.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
// BOF: Lango Added for template MOD
}else{
$header_text = HEADING_TITLE;
}
// EOF: Lango Added for template MOD
?>

<? //---PayPal WPP Modification START ---//-- ?>
<?php
  if ($ec_enabled) {
    if (tep_session_is_registered('paypal_error')) {
      $checkout_login = true;
      $messageStack->add('shipping', $paypal_error);
      tep_session_unregister('paypal_error');
    }
    if ($messageStack->size('shipping') > 0) {
?>
       <table class="table table-responsive table-condensed" border="0"> <tr>
     <!--    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
      </tr>
      <tr>
        <td><?php echo $messageStack->output('shipping'); ?></td>
      </tr></table>
<?php
    }
  }
?>

<?php
 /*
 if ($HTTP_GET_VARS['coupon'] == 'redeemed') {
 ?>
  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
 <?php
  echo $order_total_modules->redeem_coupon();//ICW ADDED FOR CREDIT CLASS SYSTEM
 }
 */
?>
</table>
  
<table class="table table-responsive table-condensed" border="0" style="border-color:#ff;">
          <tr>
             
            <td class="mainCP" style="background-color: white;">Order Summary</td>
          </tr>

        </table>
<!-- <div class="row"><div class="mainCP">Order Summary</div></div> -->
<table class="table table-responsive table-condensed"  style=" margin-left:10px;border: 1px solid #ddd;">

            <tr style="background-color:#80808042">
            <td><b>Product</b></td>
            <td><b>Unit Price</b></td>
            <td><b>Price</b></td>
            </tr>
                <?php
  $domestic_only_count = 0;       
                for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
  $domestic_product = false;
  echo '<tr>' . "\n" .'<td>' . stripslashes($order->products[$i]['name']);
         if (STOCK_CHECK == 'true') {
      echo tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);}
    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<br><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' .stripslashes($order->products[$i]['attributes'][$j]['value']). '</i></small>';
    if($order->products[$i]['attributes'][$j]['is_domestic_only'] == '1'){
      $domestic_product = true;
    }}}
    echo '<br><b>Quantity:'. $order->products[$i]['qty'].'</b></td>' . "\n";

    echo '<td>' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], '1') . '</td>';

    if (sizeof($order->info['tax_groups']) > 1) 
      echo '            <td>' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n";
    echo '<td>' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . '</td>' . "\n" .'</tr>' . "\n";
  if($domestic_product && !$country_match){
    $domestic_only_count++;
    echo '<tr><td class="domestic_only_msg"  colspan="4" style="padding-left:30px;">';
    echo '<a href="javascript:void(0);" id="domestic_check' . $domestic_only_count . '" ></a>We\'re sorry, but this product is only available for delivery within the United States.<br />To proceed with checkout, please ' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'action=remove_domestic_only&pro_id='.$order->products[$i]['id'], 'SSL') . '">' . 'Remove Item from your Shopping Cart' . '</a>' . ' or ' . '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . 'Change your Delivery Address' . '</a>' . '.';
    echo '</td></tr>'; } }?>
  <tr><td colspan="4"><a class="infoBoxContents" href="<?php echo tep_href_link('shopping_cart_mobile.php');?>"><?php echo tep_template_image_button('button_edit_quantities.gif', 'Edit Quantities');?></a></td><td colspan="3">&nbsp;</td></tr>

            </table>
<table>
      </table>
      <table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
      <?php
     
  echo $order_total_modules->output();
$gv_query = tep_db_query("select amount from coupon_gv_customer where customer_id = '".$customer_id."'");
$gv_result = tep_db_fetch_array($gv_query);
  ?>
<tr>
        <td colspan="2" align="right" class="main">
        <?php if(isset($_SESSION['amount_deduced_gv']) && ($_SESSION['amount_deduced_gv']>'0') && ($gv_result['amount']-$_SESSION['amount_deduced_gv'])>'0'){
        
        echo ' <b>Gift Voucher Balance After this Purchase: '.($currencies->format($gv_result['amount']-$_SESSION['amount_deduced_gv'])).'</b>
        ';
        	
        }elseif($gv_result['amount']>0){?>
        	 <b>Gift Voucher Balance available for this purchase: <?php echo $currencies->format($gv_result['amount']); ?></b>
        
       <?php 
        }
        ?>
       
        </td>
      </tr>
      <?php 
   echo '</table></td></tr>';
?>
	  <!--tr>
        <td><?php //echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr//-->
<?php
//print_r($_SESSION);
if (($_SESSION['cc_id']!= '' )|| ($_SESSION['gv_cc_id']!= '' && $_SESSION['gv_coupon_amount']!= '')){
include(DIR_WS_MODULES . 'coupon_help_tip.php');

}
 //echo $order_total_modules->credit_selection();//ICW ADDED FOR CREDIT CLASS SYSTEM ?>

	 <?php
       if (($order->content_type == 'virtual') || ($order->content_type == 'virtual_weight') ) {
        if (!tep_session_is_registered('shipping')) tep_session_register('shipping');
    $shipping = false;
    $sendto = $customer_default_address_id;
    } else {
    ?>
	<tr>
               <!--  <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
	</tr>
      <tr>
        <td><table class="table table-responsive table-condensed" border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP"  style="background-color: white;">Phone Number</td>
          </tr>
        </table></td>
      </tr>
      <tr>  
        <td><table class="infoBox table table-responsive table-condensed" border="0" cellpadding="0" cellspacing="0">
                <tbody>
             <!--   <td><img src="images/pixel_trans.gif" alt="" width="50%" border="0" height="1"></td> -->
                 <!-- <td width=20%">&nbsp;<?php// echo ENTRY_TELEPHONE_NUMBER; ?></td>-->
      <td><?php 
        if(isset($_SESSION['telephone']) && $_SESSION['telephone'] != ''){
            $telephone = str_replace('-', '', $_SESSION['telephone']);
        }else{
            $telephone_query= tep_db_query("select customers_telephone from customers where customers_id = '".$_SESSION['customer_id']."'");
            if(tep_db_num_rows($telephone_query)){
                $telephone_array = tep_db_fetch_array($telephone_query);
                $telephone = str_replace('-', '', $telephone_array['customers_telephone']);
            }else{
                $telephone = '';
            }
        }
	  echo tep_draw_input_field('telephone',(int)$telephone,'onkeyup="validatephone(this);"') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement"><a href="javascript:void();" style="text-decoration:none;  color: red;" title="A phone number is required.   We require a phone number so that we may contact to confirm your address or payment details if needed.   Thanks for your understanding!">' . ENTRY_TELEPHONE_NUMBER_TEXT . ' </a></span><a href="javascript:void();" style="text-decoration:none;  color: red;" title="A phone number is required.   We require a phone number so that we may contact to confirm your address or payment details if needed.   Thanks for your understanding!">Required </a>': ''); ?><?php //echo tep_draw_input_field('telephone', $account['customers_telephone']). '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': '');
	  ?> </td>
      <!--<td style="background-color:#FCF937; font-size">Please check whether your phone number is correct or not.If not then please enter your number.</td>-->
     
      </tbody></table></td></tr>
      <tr><td>&nbsp;</td></tr>
        <tr>
              <!--   <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
	</tr>
      <tr>
        <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
          <tr>
              
            <td class="mainCP"  style="background-color: white;">Shipping</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="0" class="infoBox">
          <tr class="infoBoxContents">
            <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
              <tr>
                 <td align="left"  valign="top"><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="left" valign="top"><?php echo '<b>' . TITLE_SHIPPING_ADDRESS . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                   <? //---PayPal WPP Modification START ---//-- ?>
<?php
			if ($ec_checkout && $ec_enabled) {
				$paypal_ec_payer_info = $_SESSION['paypal_ec_payer_info'];
				$address_label = $paypal_ec_payer_info['payer_firstname'] . ' ' . $paypal_ec_payer_info['payer_lastname'] . '<br>';
				if ($paypal_ec_payer_info['payer_business']) $address_label .= $paypal_ec_payer_info['payer_business'].'<br>';
				$address_label .= $paypal_ec_payer_info['ship_street_1'] . '<br>';
				if ($paypal_ec_payer_info['ship_street_2']) $address_label .= $paypal_ec_payer_info['ship_street_2'].'<br>';
				$address_label .= $paypal_ec_payer_info['ship_city'] . ', ' . $paypal_ec_payer_info['ship_state'] . '  ' . $paypal_ec_payer_info['ship_postal_code'] . '<br>';
				$address_label .= $paypal_ec_payer_info['ship_country_name'];
?>
                    <td class="main" valign="top"><?php echo $address_label; ?></td>
<?php } else { ?>
                    <td class="main" valign="top"><?php echo tep_address_label($customer_id, $sendto, true, ' ', '<br>'); ?></td>
<?php } ?>
<? //---PayPal WPP Modification END ---//-- ?>


                    
                    
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          
        </table></td>
      </tr>

<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>

<?php
  if (tep_count_shipping_modules() > 0) {
?>
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_top(false, false, TABLE_HEADING_SHIPPING_METHOD);
}else{/*
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></td>
          </tr>
        </table></td>
      </tr>
<?php
*/}
// EOF: Lango Added for template MOD
?>
      <!-- <tr>
        <td> --><table class="table table-responsive table-condensed infoBox" border="0" cellspacing="0" cellpadding="0" >

          <tr class="infoBoxContents">
            <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
<?php
$error_ship = false; 
$error_postal_code = false;
$error_postal_code_fedex = false;
foreach($quotes as $key =>$val){
    //echo 'hiii123'.$quotes[$key]['error'];
    if(isset($quotes[$key]['error']) && $quotes[$key]['error'] != ''){
        $error_ship = true;
        if(strstr($quotes[$key]['error'], 'postal code')){
            if($quotes[$key]['id'] == 'fedexmodule'){
                $error_postal_code_fedex = true;
            }else{
                $error_postal_code = true;
            //echo $quotes[$key]['error'];
            }
        }
        
    }
}

if($error_postal_code == true && $error_ship == true){
    ?>
                  <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td colspan="3"><div style="background-color: #FF0000; color :#FFFFFF"><b><?php echo '&nbsp;&nbsp;Invalid Zip Code - Please Enter a valid Zip Code by clicking on Change Address button above'; ?></b></div></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
    
    <?php
}else{
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></td>
                <td><?php echo '<b>' . TITLE_PLEASE_SELECT . '</b><br>' . tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
             <!--    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
              </tr>
<?php
    } elseif ($free_shipping == false && false) {
?>
              <tr>
                <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                <td colspan="2"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
               <!--  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
              </tr>
<?php
    }

    if ($free_shipping == true) {
?>
              <tr>
                <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                <td colspan="2"><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                   <!--  <td ><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                    <td colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
                    <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                  </tr>
                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, 0)">
                   <!--  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                    <td ><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . tep_draw_hidden_field('shipping', 'free_free'); ?></td>
                   <!--  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                  </tr>
                </table></td>
                <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
              </tr>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                   <!--  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                    <tdcolspan="3"><b><?php echo $quotes[$i]['module']; ?></b>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
                   <!--  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                  </tr>
<?php
        if (isset($quotes[$i]['error'])) {
?>
                  <tr>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td colspan="3"><div style="background-color: #FF0000; color :#FFFFFF"><b><?php echo '&nbsp;&nbsp;Invalid Zip Code - Please Enter a valid Zip Code by clicking on Change Address button above'; ?></b></div></td>
                    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              echo '                  <tr id="defaultSelectedShipping" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectShipping(this, ' . $radio_buttons . ');ajaxFunction();">' . "\n";
            } else {
              echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffectShipping(this, ' . $radio_buttons . ');ajaxFunction();">' . "\n";
            }
?>
                     <td ><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>

                    
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
                    
                    <td class="main" align="left" colspan="3"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?>&nbsp;&nbsp;<?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?>&nbsp;&nbsp;&nbsp;<?php echo $quotes[$i]['methods'][$j]['title']; ?></td>

<?php
            } else {
?>
                    <td class="main" align="left" colspan="3"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?>&nbsp;&nbsp;&nbsp;<?php echo $quotes[$i]['methods'][$j]['title']; ?></td>
<?php
            }
?>
                    <td ><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
<?php
            $radio_buttons++;
          }
        }
?>
                </table>
<?php
      }
    }
}
?>
        <!--     </table></td>
          </tr>
        </table></div></td>
      </tr>
      
      <tr>
        <td> -->
          </td>
          </tr>
        </tbody></table></td>
      </tr>
      
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>
      <!-- <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr> -->
<?php
    }
  }
?>

<?php
  if (isset($HTTP_GET_VARS['payment_error']) && is_object(${$HTTP_GET_VARS['payment_error']}) && ($error = ${$HTTP_GET_VARS['payment_error']}->get_error())) {
?>
      <tr>
        <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo tep_output_string_protected($error['title']); ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td></td></tr></tdcolspan="3"></tr></table></td></tr></table></td></tr></table></td></tr></table>
          <table  cellspacing="1" cellpadding="2" class="infoBoxNotice table table-responsive table-condensed" border="0">
          <tr class="infoBoxNoticeContents">
            <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
              <tr>
              <!--   <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                <td class="main"><?php echo $error['error']; ?></td>
              <!--   <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
              </tr>
            </table></td>
          </tr>
        </table><!-- </td>
      </tr> -->
      <!-- <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr> -->
<?php
  }
?>
<? //---PayPal WPP Modification START ---//-- ?>
<?php if (!$ec_enabled || isset($_GET['ec_cancel']) || (!tep_session_is_registered('paypal_ec_payer_id') && !tep_session_is_registered('paypal_ec_payer_info'))) { ?>
<? //---PayPal WPP Modification END ---//-- ?>

<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>	<!-- <tr>
                <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr> -->
      
      <?php
     if(tep_session_is_registered('is_retail_store') && tep_session_is_registered('retail_rep') && $_SESSION['retail_rep'] != ''){
        $retail_products = TRUE;
      ?>
      <tr>
        <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
      </tr>
      <tr>
        <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP">Customer information</td>
          </tr>
        </table></td>
      </tr>

      <tr>
        <td></td></tr></tdcolspan="3"></tr></table></td></tr></table></td></tr></table></td></tr></table>
          <table class="table table-responsive table-condensed" border="0" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2" id="retailcustomerdetails">
                    <tr>
                        <td class="main" > First Name: </td>
                        <td class="main"><?php echo tep_draw_input_field('retail_firstname',$_SESSION['retail_cust_fname'],'id="retail_firstname"') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>' : ''); ?></td>
                    </tr>
                    <tr>
                        <td class="main" > Last Name: </td>
                        <td class="main"><?php echo tep_draw_input_field('retail_lastname',$_SESSION['retail_cust_lname'],'id="retail_lastname"') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>' : ''); ?></td>
                    </tr>
                    <tr>
                        <td class="main" >Zip Code: </td>
                         <td class="main"><?php echo tep_draw_input_field('retail_postcode',$_SESSION['retail_cust_postcode'],'id="retail_postcode"') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>' : ''); ?></td>
                    </tr>
                    <tr>
                         <td class="main" >Email (optional):</td>
                         <td class="main"><?php echo tep_draw_input_field('retail_email',$_SESSION['retail_cust_email'],'id="retail_email"'); ?></td>
                    </tr>
                </table>
                </td>
          </tr>
        </table><!-- </td>
      </tr>
      <tr> -->
               <!--  <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
<!-- 	</tr> -->
            <?php }
?> 
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_top(false, false, TABLE_HEADING_PAYMENT_METHOD);
}else{
?>
    <!--   <tr>
        <td>
        </td></tr></tdcolspan="3"></tr></table></td></tr></table> -->
        <table class="table table-responsive table-condensed" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP" style="background-color: white;">Payment information</td>
          </tr>
        </table><!-- </td>
      </tr> -->
<?php
}
// BOF: Lango Added for template MOD
?>
      <tr>
        <td></td></tr></tdcolspan="3"></tr></table></td></tr></table></td></tr></table></td></tr></table>

          <table class="table table-responsive table-condensed" border="0" cellspacing="1" cellpadding="2" class="infoBox">
        <table class="table table-responsive table-condensed infoBoxContents" border="0" cellspacing="0" cellpadding="2">
<?php
  $selection = $payment_modules->selection();

  //Added to make sure if price is zero that only this module is present
  for ($i=0; $i<sizeof($selection); $i++) {
		if ($selection[$i]['id'] == 'zero_priced') {
			$saved_selection = $selection[$i];
			$selection = array();
			$selection[0] = $saved_selection;
			break;
		}
	}

  if (sizeof($selection) > 1) {
?>
              <tr>
                <td><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></td>
                <td><b><?php //echo TITLE_PLEASE_SELECT; ?></b>&nbsp;<?php //echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif' , '', '', '', ' align="top"'); ?></td>
              </tr>


<?php
  } else {
?>
              <tr>
                <td colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></td>
              </tr>     <tr>
             <!--    <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                <td ></td></tr></table>
                </table></td></tr></tdcolspan="3"></tr></table></td></tr></table></td></tr></table></td></tr></table>
<?php
  }

  $radio_buttons = 0;
  $gv_am_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
$gv_am_result = tep_db_fetch_array($gv_am_query);
//echo $gv_am_result['amount'];
if($order->info['total'] < $gv_am_result['amount']){
 $payment = 'gvc';
$_SESSION['payment'] ='gvc';}
if($_SESSION['checkout_payment']!=''){
  	$payment = $_SESSION['checkout_payment'];
  }else
  if ($payment == '') {
      $payment = 'authorizenet';
  	//$payment = 'paypal_wpp';
  }
  
  
  
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
         <table border="0" class="table table-responsive table-condensed"  cellspacing="0" cellpadding="2">
<?php
 if (!isset($selection[$i]['country_error'])) {
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ');ajaxFunction();">' . "\n";
    } else {
      echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ');ajaxFunction();">' . "\n";
    }
  } else {
   echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
}
?>
<td class="main" >
<?php
 if ( ($selection[$i]['id'] == $payment)) {
   $checked = true;
   } else {
   $checked = false;
   }
 if (!isset($selection[$i]['country_error'])) {
    if (sizeof($selection) > 1) {
      echo tep_draw_radio_field('payment', $selection[$i]['id'], $checked);
    } else {
      echo tep_draw_hidden_field('payment', $selection[$i]['id']);
    }
  }
?>
                    </td>

                    <td class="main"  colspan="3" nowrap>&nbsp;<b>
<?php echo $selection[$i]['module'];
 if (isset($selection[$i]['country_error'])) {
    echo ' - ' . $selection[$i]['country_error'];
 }
?></b></td>
                  </tr>
<?php
    if (isset($selection[$i]['error'])) {
?>
                  <tr>
    
                    <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
    
                  </tr>
<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>
                  <tr>
                    <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
                      <tr>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                        <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                      </tr>
<?php
      }
?>
                    </table></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
<?php
    $radio_buttons++;
  }
?>
<!-- /tr//-->
 <?php
 /*
  if ($ec_enabled) {
      if (!$ec_checkout) {
?>

              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    if ($payment == 'paypal_express') {
      echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    } else {
      echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    }
?>
<td class="main" ><input type="radio" name="payment" value="paypal_express"></td>
 <td class="main" align="left" width="100%" COLSPAN="3" nowrap>&nbsp;<b><?php echo TEXT_PAYPALWPP_EC_BUTTON_TEXT; ?></b>&nbsp;&nbsp;&nbsp;<img src="https://www.healingcrystals.com/images/icon_paypal_verification_se.gif" border="0" alt="Official PayPal Seal" align="absmiddle"></td>
<td ><img src="images/pixel_trans.gif" border="0" alt=""  height="1"></td>
<td ><img src="images/pixel_trans.gif" border="0" alt=""  height="1"></td>
                  </tr>
                </table></td>
                <td><img src="images/pixel_trans.gif" border="0" alt=""  height="1"></td>
              </tr>
<?php } }
*/
?>
<? //---PayPal WPP Modification END ---//-- ?>
<? //---PayPal WPP Modification START ---//-- ?>

      <tr>
      </tr>
		
     </table></td>
</tr>
        </table>
      </div>
      <?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_top(false, false, TABLE_HEADING_BILLING_ADDRESS);
}else{/*
?>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP"><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></td>
          </tr>
        </table></td>
      </tr>
<?php
*/}
// BOF: Lango Added for template MOD
?>

        <table border="0"  cellspacing="0" cellpadding="0" class="infoBox table table-responsive table-condensed" >
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
				<td valign="top" align="left"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="left" valign="top"><b><?php echo TITLE_BILLING_ADDRESS; ?></b><br><?php echo tep_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                    <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                    <td class="main" valign="top"><?php echo tep_address_label($customer_id, $billto, true, ' ', '<br>'); ?></td>
                  <!--   <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td> -->
                     <td class="main" valign="top" align="left" style="margin-right:10px;"><?php // echo TEXT_SELECTED_BILLING_DESTINATION; ?></td>
                
                  </tr>
                </table></td>


              </tr>
            </table></td>
          </tr>
        </table>
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>
<!-- 	<tr> -->
               <!--  <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
<!-- 	</tr> -->
<?php } ?>
<? //---PayPal WPP Modification END ---//-- ?>
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_top(false, false, TABLE_HEADING_COMMENTS);
}else{
?>
  <table border="0" class="table table-responsive table-condensed"  cellspacing="0" cellpadding="2">
          <tr>
            <td class="mainCP"><?php echo TABLE_HEADING_COMMENTS; ?></td>
          </tr>
        </table><!-- </td>
      </tr> -->
<?php
}
// BOF: Lango Added for template MOD
?>
    <!--   <tr>
        <td> -->
          <table class="table table-responsive table-condensed infoBox" cellspacing="0" cellpadding="2">
          <tr class="infoBoxContents">
            <td><table class="table table-responsive table-condensed" cellspacing="0" cellpadding="2">
              <tr>
                  <td><?php //echo tep_draw_textarea_field('comments', '', '60', '5'); 
				 echo '<textarea name="comments" wrap="" cols="60" rows="5">'.$_SESSION['comments'].'</textarea>'; ?></td>
              
				</td>
              </tr>
                    <tr>
                        <td class="main1" colspan="2"><input  type="checkbox" id = 'Daily_Nugget'  name='daily' value="1" checked/>Subscribe to the Healing Crystals Monthly Newsletter (with a new Free Gift every month).</td>
                    </tr>
            </table>
            </td></tr></table>
     <table class="table table-responsive table-condensed" >
		<tr style="display:none;">
        <td style="display:none;">
        <table style="display:none;" border="0" width="100%" cellspacing="0" cellpadding="0" class="infoBox">
          <tr class="infoBoxContents" style="display:none;">      
          <?php 
          	if($_SESSION['checkout_subscribe_nl']=='on')$checked_comments= 'checked';
          	else if($_SESSION['checkout_subscribe_nl']=='0')$checked_comments= '';
                else $checked_comments= 'checked';
          ?>      
                <td style="display:none;" class="main" align="left" colspan="2" onmouseover="Tip('Subscribe to our Newsletter and receive<br> -Monthly Article about Crystals<br> -Monthly Coupon & Free Gift Code<br><br>We respect your privacy and promise to:<br> -keep your email confidential<br> -and to send only 1 newsletter per month.<br><br>You can unsubscribe at anytime.')" onmouseout="UnTip()"><input type="checkbox" name="subscribe_nl" <?php echo $checked_comments; ?>/>&nbsp; <strong>Monthly Newsletter w/Coupon &amp; Free Gift. </strong></td>				
          </tr>
        </table>
      </td></tr></table>

   <!--    </td>
      </tr>
		<tr>
                <td style="background:#DFE6FA;"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr>
      <tr>
        <td> -->
          <table border="0" class="table table-responsive table-condensed" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b>&nbsp;</b></td>
          </tr>
        </table></td>
      </tr>
       <tr>
        <td>
        </td></tr></table><table border="0"  cellspacing="1" cellpadding="2" class="infoBox  table table-responsive table-condensed">
          <tr class="infoBoxContents">
            <td><table border="0" class="table table-responsive table-condensed" cellspacing="0" cellpadding="2">
              <tr>
                <td class="mainCP" align="left" width="55%">Proceed to Checkout Confirmation Page </td>
				<?php /* OLD Code ?><td align="center"> <?php echo tep_template_image_submit('button_continue_checkout.gif', IMAGE_BUTTON_CONTINUE, $is_domestic_only ? '  onclick="getfocus();"' : ''); ?></td><?php */?>
				<?php //if shipping address outside of US  15-10-2015 5:00 pm
	   $qry_country_id=tep_db_query("SELECT entry_country_id FROM address_book WHERE customers_id='".(int)$customer_id."' AND address_book_id='".(int)$sendto."'");
	   $is_us_or_not=0;
	   $row_country_id = tep_db_fetch_array($qry_country_id);
	   $is_us_or_not=($row_country_id['entry_country_id']==223)?0:1;
	 
	   //$row_country_id = tep_db_fetch_array($qry_country_id);
	  
	  $onclick_fun='';
				if($is_domestic_only)
					$onclick_fun='onclick="getfocus();"';
				
               elseif($is_us_or_not>0)
					$onclick_fun='onclick="return check_address_us_or_not();"';
				elseif($is_us_or_not>0 && $is_domestic_only>0)
					$onclick_fun='onclick="getfocus();check_address_us_or_not();"';	
				else $onclick_fun='';				
				?>
				
				<td align="center"> <?php echo tep_template_image_submit('button_continue_checkout.gif', IMAGE_BUTTON_CONTINUE, $onclick_fun); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
// BOF: Lango Added for template MOD
if (MAIN_TABLE_BORDER == 'yes'){
table_image_border_bottom();
}
// EOF: Lango Added for template MOD
?>
      <tr>
        <!-- <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> -->
      </tr>
</table></td></tr>

</table>   </td></tr>
<!-- <tr><td ><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td></tr> -->
      
</table>
<?php if(!$is_domestic_only)echo '</form>'; ?> 
</div>