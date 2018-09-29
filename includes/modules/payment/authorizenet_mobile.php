<?php
/*
  $Id: authorizenet.php,v 1.40 2002/11/25 18:23:14 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class authorizenet {
    var $code, $title, $description, $enabled, $txid;

// class constructor
    function authorizenet() {
      $this->code = 'authorizenet';
      $this->title = MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION;
      $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') ? true : false);
      $this->order_status = DEFAULT_ORDERS_STATUS_ID;
    }

// class methods
    function javascript_validation() {
      global $order;
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_firstname = document.checkout_payment.authorizenet_cc_firstname.value;' . "\n" .
            '    var cc_lastname = document.checkout_payment.authorizenet_cc_lastname.value;' . "\n" .
            '    var cc_number = document.checkout_payment.authorizenet_cc_number.value;' . "\n" .
            '    if (cc_firstname == "" || cc_lastname == "" || eval(cc_firstname.length) + eval(cc_lastname.length) < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" ;
      if ($order->billing['country']['iso_code_2']=='US'){
      $js .= '    var cc_cvv = document.checkout_payment.authorizenet_cc_cvv2.value;' . "\n" .
            '    if (cc_cvv == "" || cc_cvv.length < "3") {' . "\n".
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" ;
      }
      $js .= '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => '(' . sprintf('%02d', $i) . ') ' . strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate();
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => ICONS_PAYMENT_METHOD,
                                                       'field' => ''),
                                           //array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                           //      'field' => tep_draw_input_field('authorizenet_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_FIRSTNAME,
                                                 'field' => tep_draw_input_field('authorizenet_cc_firstname', $order->billing['firstname'])),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_LASTNAME,
                                                 'field' => tep_draw_input_field('authorizenet_cc_lastname', $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_TYPE,
                                                 'field' => tep_draw_pull_down_menu('authorizenet_cc_type', array(array('id' => 'Visa', 'text' => 'Visa'),
                                                                                                               array('id' => 'MasterCard', 'text' => 'MasterCard'),
                                                                                                               array('id' => 'Discover', 'text' => 'Discover'),
                                                                                                               array('id' => 'Amex', 'text' => 'American Express')))),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('authorizenet_cc_number','','autocomplete="off"')),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('authorizenet_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('authorizenet_cc_expires_year', $expires_year)) ));
      //if ($order->billing['country']['iso_code_2']=='US'){
        $selection['fields'][] = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_CVV . ' ' .
                                                  '<a href=https://vip.anonymouse.org/cgi-bin/anon-www.cgi/https://www.healingcrystals.com/pear/Net/"javascript: void(0);" onclick="window.open(\'' . tep_href_link(FILENAME_CVV) . '\',\'\',\'width=450,height=660,scrollbars=yes,resizable=yes,left=20,top=10\');"><b><u>' . MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_CVV_DESCRIPTION . '</u></b></a>',
                                       'field' => tep_draw_input_field('authorizenet_cc_cvv2','','SIZE="4" autocomplete="off"'));
      //}
      return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($HTTP_POST_VARS['authorizenet_cc_number'], $HTTP_POST_VARS['authorizenet_cc_expires_month'], $HTTP_POST_VARS['authorizenet_cc_expires_year']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&authorizenet_cc_owner=' . urlencode($HTTP_POST_VARS['authorizenet_cc_firstname'].' '. $HTTP_POST_VARS['authorizenet_cc_lastname']) . '&authorizenet_cc_expires_month=' . $HTTP_POST_VARS['authorizenet_cc_expires_month'] . '&authorizenet_cc_expires_year=' . $HTTP_POST_VARS['authorizenet_cc_expires_year'];

        tep_redirect(tep_href_link('checkout_payment_mobile.php', $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_cvv2 = $HTTP_POST_VARS['authorizenet_cc_cvv2'];
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    }

    function confirmation() {
      global $HTTP_POST_VARS;

      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['authorizenet_cc_firstname'].' '. $HTTP_POST_VARS['authorizenet_cc_lastname']),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['authorizenet_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['authorizenet_cc_expires_year'])))));
      if (tep_not_null($HTTP_POST_VARS['authorizenet_cc_cvv2'])) {
          $confirmation['fields'][] = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_CVV,
                                            'field' => $HTTP_POST_VARS['authorizenet_cc_cvv2']);
        }

      return $confirmation;
    }

    function process_button_2() {
      global $HTTP_SERVER_VARS, $order, $customer_id;

      switch(MODULE_PAYMENT_AUTHORIZENET_TYPE) {
        case 'Auth':
          $type = 'AUTH_ONLY';
        break;
        case 'Capture':
          $type = 'AUTH_CAPTURE';
        break;
        default:
          $type = 'AUTH_CAPTURE';
        break;
      }

      $process_button_string = tep_draw_hidden_field('x_Login', MODULE_PAYMENT_AUTHORIZENET_LOGIN) .
                               tep_draw_hidden_field('x_Tran_Key', MODULE_PAYMENT_AUTHORIZENET_TXNKEY) .
                               tep_draw_hidden_field('x_Description', addslashes(STORE_NAME) . ' order') .
                               tep_draw_hidden_field('x_Card_Num', $this->cc_card_number) .
                               tep_draw_hidden_field('x_card_code', $this->cc_card_cvv2) .
                               tep_draw_hidden_field('x_invoice_num', '') .                                     tep_draw_hidden_field('x_po_num', 'ST1-' . $customer_id) .

                               tep_draw_hidden_field('x_Exp_Date', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                               tep_draw_hidden_field('x_Amount', number_format($order->info['total'], 2)) .
                               tep_draw_hidden_field('x_ADC_Delim_Data', 'TRUE') .
                               tep_draw_hidden_field('x_ADC_URL', 'FALSE') .
                               tep_draw_hidden_field('x_Type', $type) . //AUTH_CAPTURE
                               tep_draw_hidden_field('x_Method', ((MODULE_PAYMENT_AUTHORIZENET_METHOD == 'Credit Card') ? 'CC' : 'ECHECK')) .
                               tep_draw_hidden_field('x_Version', '3.1') .
                               tep_draw_hidden_field('x_Cust_ID', $customer_id) .
                               tep_draw_hidden_field('x_Email_Customer', ((MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER == 'True') ? 'TRUE': 'FALSE')) .
                               tep_draw_hidden_field('x_Email_Merchant', ((MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT == 'True') ? 'TRUE': 'FALSE')) .
                               tep_draw_hidden_field('x_first_name', $order->billing['firstname']) .
                               tep_draw_hidden_field('x_last_name', $order->billing['lastname']) .
                               tep_draw_hidden_field('x_address', $order->billing['street_address']) .
                               tep_draw_hidden_field('x_city', $order->billing['city']) .
                               tep_draw_hidden_field('x_state', $order->billing['state']) .
                               tep_draw_hidden_field('x_zip', $order->billing['postcode']) .
                               tep_draw_hidden_field('x_country', $order->billing['country']['title']) .
                               tep_draw_hidden_field('x_phone', $order->customer['customers_telephone']) .
                               tep_draw_hidden_field('x_email', $order->customer['email_address']) .
                               tep_draw_hidden_field('x_ship_to_first_name', $order->delivery['firstname']) .
                               tep_draw_hidden_field('x_ship_to_last_name', $order->delivery['lastname']) .
                               tep_draw_hidden_field('x_ship_to_address', $order->delivery['street_address']) .
                               tep_draw_hidden_field('x_ship_to_city', $order->delivery['city']) .
                               tep_draw_hidden_field('x_ship_to_state', $order->delivery['state']) .
                               tep_draw_hidden_field('x_ship_to_zip', $order->delivery['postcode']) .
                               tep_draw_hidden_field('x_ship_to_country', $order->delivery['country']['title']) .
                               tep_draw_hidden_field('x_Customer_IP', $HTTP_SERVER_VARS['REMOTE_ADDR']);
      if (MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test') $process_button_string .= tep_draw_hidden_field('x_Test_Request', 'TRUE');

      $process_button_string .= tep_draw_hidden_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])  .
                               tep_draw_hidden_field('cc_expires', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                               tep_draw_hidden_field('cc_type', $this->cc_card_type) .
                               tep_draw_hidden_field('cc_number', $this->cc_card_number);
      $process_button_string .= tep_draw_hidden_field(tep_session_name(), tep_session_id());

      return $process_button_string;
    }

function process_button() {
      global $HTTP_SERVER_VARS, $order, $customer_id;

      switch(MODULE_PAYMENT_AUTHORIZENET_TYPE) {
        case 'Auth':
          $type = 'AUTH_ONLY';
        break;
        case 'Capture':
          $type = 'AUTH_CAPTURE';
        break;
        default:
          $type = 'AUTH_CAPTURE';
        break;
      }

      $process_button_string = tep_draw_hidden_field('x_Login', MODULE_PAYMENT_AUTHORIZENET_LOGIN) .
                               tep_draw_hidden_field('x_Tran_Key', MODULE_PAYMENT_AUTHORIZENET_TXNKEY) .
                               tep_draw_hidden_field('x_Description', addslashes(STORE_NAME) . ' order') .
                               tep_draw_hidden_field('cc_type',  $this->cc_card_type).
                               tep_draw_hidden_field('x_Card_Num', $this->cc_card_number) .
                               tep_draw_hidden_field('x_card_code', $this->cc_card_cvv2)  .
                               tep_draw_hidden_field('x_invoice_num', '') . 
                               tep_draw_hidden_field('x_po_num', 'ST1-' . $customer_id) .
                               tep_draw_hidden_field('x_Exp_Date', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                               tep_draw_hidden_field('x_Amount', number_format($order->info['total'], 2)) .
                               tep_draw_hidden_field('x_ADC_Delim_Data', 'TRUE') .
                               tep_draw_hidden_field('x_ADC_URL', 'FALSE') .
                               tep_draw_hidden_field('x_Type', $type) . //AUTH_CAPTURE
                               tep_draw_hidden_field('x_Method', ((MODULE_PAYMENT_AUTHORIZENET_METHOD == 'Credit Card') ? 'CC' : 'ECHECK')) .
                               tep_draw_hidden_field('x_Version', '3.1') .
                               tep_draw_hidden_field('x_Cust_ID', $customer_id) .
                               tep_draw_hidden_field('x_Email_Customer', ((MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER == 'True') ? 'TRUE': 'FALSE')) .
                               tep_draw_hidden_field('x_Email_Merchant', ((MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT == 'True') ? 'TRUE': 'FALSE')) .
                               tep_draw_hidden_field('x_first_name', $order->billing['firstname']) .
                               tep_draw_hidden_field('x_last_name', $order->billing['lastname']) .
                               tep_draw_hidden_field('x_address', $order->billing['street_address']) .
                               tep_draw_hidden_field('x_city', $order->billing['city']) .
                               tep_draw_hidden_field('x_state', $order->billing['state']) .
                               tep_draw_hidden_field('x_zip', $order->billing['postcode']) .
                               tep_draw_hidden_field('x_country', $order->billing['country']['title']) .
                               tep_draw_hidden_field('x_phone', $order->customer['customers_telephone']) .
                               tep_draw_hidden_field('x_email', $order->customer['email_address']) .
                               tep_draw_hidden_field('x_ship_to_first_name', $order->delivery['firstname']) .
                               tep_draw_hidden_field('x_ship_to_last_name', $order->delivery['lastname']) .
                               tep_draw_hidden_field('x_ship_to_address', $order->delivery['street_address']) .
                               tep_draw_hidden_field('x_ship_to_city', $order->delivery['city']) .
                               tep_draw_hidden_field('x_ship_to_state', $order->delivery['state']) .
                               tep_draw_hidden_field('x_ship_to_zip', $order->delivery['postcode']) .
                               tep_draw_hidden_field('x_ship_to_country', $order->delivery['country']['title']) .
                               tep_draw_hidden_field('x_Customer_IP', $HTTP_SERVER_VARS['REMOTE_ADDR']);
      if (MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test') $process_button_string .= tep_draw_hidden_field('x_Test_Request', 'TRUE');
/*
      $process_button_string .= tep_draw_hidden_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])  .
                               tep_draw_hidden_field('cc_expires',  $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                               tep_draw_hidden_field('cc_type',  $this->cc_card_type) .
                                tep_draw_hidden_field('cc_cvn', $this->cc_card_cvv2) .
                               tep_draw_hidden_field('cc_number', $this->cc_card_number);
      $process_button_string .= tep_draw_hidden_field(tep_session_name(), tep_session_id());
*/
      return $process_button_string;
    }

    function before_process() {
      global $HTTP_POST_VARS, $insert_id, $order;
      $firstname = ($HTTP_POST_VARS['authorizenet_cc_firstname'] != '' ? $HTTP_POST_VARS['authorizenet_cc_firstname']:$order->billing['firstname']);
      $lastname = ($HTTP_POST_VARS['authorizenet_cc_lastname'] != '' ? $HTTP_POST_VARS['authorizenet_cc_lastname']:$order->billing['lastname']);
      /*
      $order->info['cc_type'] = $this->cc_card_type;
      $order->info['cc_number'] = $this->cc_card_number;
      $order->info['cc_owner'] = $firstname . ' ' . $lastname;
      $order->info['cc_expires'] = $this->cc_expiry_month . substr($this->cc_expiry_year, -2);
      $order->info['cc_cvn'] = $this->cc_card_cvv2;
      */

      $HTTP_POST_VARS['x_invoice_num'] =  "ST1 - " . $insert_id;
      if(strlen($HTTP_POST_VARS['x_Description']) == 0)
      {
            unset($HTTP_POST_VARS['x_Description']);
      }
      $params = '';
      foreach ($HTTP_POST_VARS as $key => $value)
      {
        $params .= $key . "=" . rawurlencode($value) . "&";
        
      }

        unset($response);
/*
        // Post order info data to Authorize.net, make sure you have curl installed
      $command = MODULE_PAYMENT_AUTHORIZENET_CURL_PATH . " -d \"$params\" https://secure.authorize.net/gateway/transact.dll";

        exec($command, $response);
//echo "<pre>"; print_r($response); echo "</pre>";

      // Change made by using ADC Direct Connection
      $response_vars = explode(',', $response[0]);
      $x_response_code = $response_vars[0];
      $response_reason = $response_vars[3];


//    error_log("log: " . $command . "\n" . implode("\n", $response_vars ) . "\n", 1, "vkoshelev@triasphera.com");
*/


      $ch = curl_init ();
      curl_setopt ($ch, CURLOPT_URL,"https://secure.authorize.net/gateway/transact.dll");
      curl_setopt ($ch, CURLOPT_FAILONERROR, 1);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch, CURLOPT_POST, 1);
      curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
      $response = curl_exec ($ch);
      curl_close ($ch);

      $response_vars = explode(',', $response);
      //tep_mail(STORE_OWNER, 'office@focusindia.com', 'Atuhorize Dump, Order ID: '.$insert_id, $response, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
      
      $x_response_code = $response_vars[0];
      $response_reason = $response_vars[3];
      tep_db_close();
      tep_db_connect();
     
      if ($x_response_code != '1') {
       //tep_session_unregister('card');
       	 tep_db_query("update orders_status_history set orders_status_id='100003', customer_notified = '0', comments='Declined by Authorize.net: " . addslashes($response_reason) . "' where orders_id='" . (int)$insert_id . "'");
	  tep_db_query("update orders set orders_status='100003' where orders_id='" . (int)$insert_id . "'");
         //tep_mail(STORE_OWNER, SEND_PAYPAL_EMAILS_TO, 'Authorizenet declined the enclosed card', 'User: ' . $order->customer['email_address'] . "\r\n\r\nCredit Card Information:\r\n" . "\r\n\r\nFor the amount of: " . number_format($order->info['total'], 2) . "\r\n\r\n" . 'To preserve your customer\'s privacy, please delete this email after you have manually processed their card.'. "\n\n" . 'PayPal Error Dump' . "\n\n" .  $error_return. "\n\n" . $this->avs . "\n\n" . $this->cvv2, STORE_OWNER, SEND_PAYPAL_EMAILS_TO);
        

        if (!tep_session_is_registered('card')) tep_session_register('card');
        if($order->billing['country']['id'] != '188' && $order->delivery['country_id'] != '188'){
        $_SESSION['card'] = array(  'cc_type' => $_POST['cc_type'] ,
                                    'cc_number' => $_POST['x_Card_Num'] ,
                                    'cc_owner_firstname' => $_POST['x_first_name'] ,
                                    'cc_owner_lastname' => $_POST['x_last_name'] ,
                                    'cc_expires_month' => substr($_POST['x_Exp_Date'],0,2) ,
                                    'cc_expires_year' => substr($_POST['x_Exp_Date'], -2) ,
                                    'cc_cvn' => $_POST['x_card_code'] );
						      
          switch ($response_vars[2]){
          case 27:
          case 127:
            //tep_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . $insert_id . '"');
            tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' .   urlencode(sprintf(MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE_AVS, $response_vars[5])) . $response_reason, 'SSL', true, false));
          break;
          default:
            //tep_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . $insert_id . '"');
            tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' .   urlencode(MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE) . $response_reason, 'SSL', true, false));
        }
        	
        }else{
            switch ($response_vars[2]){
                case 27:
                case 127:
                  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' .   urlencode(sprintf(MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE_AVS, $response_vars[5])) . $response_reason, 'SSL', true, false));
                break;
                default:
                  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' .   urlencode(MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE) . $response_reason, 'SSL', true, false));
            }
        }
      }
      $this->txid = $response_vars[6];
    }

    function after_process() {
      global $insert_id, $HTTP_GET_VARS, $order;
      switch(MODULE_PAYMENT_AUTHORIZENET_TYPE) {
        case 'Auth':
          $authorize_finished = 0;
        break;
        case 'Capture':
          $authorize_finished = 1;
        break;
        default:
          $authorize_finished = 0;
        break;
      }
      if($this->txid==''){
		$comments = 'No transaction ID found, Order Declined';
		$this->order_status = '100003';
}else{
		$this->order_status ='2';
		$comments = 'Transaction ID: ' . $this->txid . "\n" . 'Payment Type: Authorize.net' . "\n" . 'Status: ' . ($authorize_finished ? 'Capture' : 'Auth');
}
tep_db_close();
      tep_db_connect();
      tep_db_query("update orders set orders_status = '" .$this->order_status . "', authorize_finished=" . $authorize_finished . ", authorize_trx_id = '" . $this->txid . "', capture_date='" . EST_TIME_NOW . "' where orders_id = '" . (int)$insert_id . "'");
  $sql_data_array = array('orders_id' => $insert_id,
                          'orders_status_id' => $this->order_status,
                          'date_added' => EST_TIME_NOW,
                          'customer_notified' => '0',
                          'comments' => $comments);
  tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Authorize.net Module', 'MODULE_PAYMENT_AUTHORIZENET_STATUS', 'True', 'Do you want to accept Authorize.net payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Username', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'testing', 'The login username used for the Authorize.net service', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_TXNKEY', 'testing', 'The merchant transaction key used for the Authorize.net service', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'Test', 'Transaction mode used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'Credit Card', 'Transaction method used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Credit Card\', \'eCheck\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authentication/Capturing', 'MODULE_PAYMENT_AUTHORIZENET_TYPE', 'Auth', 'What type should be used? Authentication then capturing, or capturing directly.', '6', '0', 'tep_cfg_select_option(array(\'Auth\', \'Capture\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Customer Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'False', 'Should Authorize.Net e-mail a receipt to the customer?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Merchant Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT', 'True', 'Should Authorize.Net e-mail a receipt to the store owner?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Path to curl', 'MODULE_PAYMENT_AUTHORIZENET_CURL_PATH', '/usr/local/bin/curl', 'Path to curl on your server', '6', '0', now())");


    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_AUTHORIZENET_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'MODULE_PAYMENT_AUTHORIZENET_TXNKEY', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'MODULE_PAYMENT_AUTHORIZENET_TYPE',  'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT', 'MODULE_PAYMENT_AUTHORIZENET_CURL_PATH');
    }
  }
?>
