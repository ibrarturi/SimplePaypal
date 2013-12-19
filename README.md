SimplePaypal Yii Module
============

Yii framework simple module for paypal with paypal setting page via user interface

After installing this module user will be able to add/update changes via user interface and these settings will be used for setting sandbox and live paypal from interface. You can also set the 'return', 'cancel' and 'notify' urls.

**Requirements**

Tested with Yii 1.1.10 and 1.1.12. may work with other versions

**Installation**
* Extract the file under protected/modules folder.
* Import two tables sql into your database; sql included with in the simple module > data folder
* In main.php file:

```
'modules' => array(
....
  'SimplePaypal' => array(
    'components' => array(
      'paypalManager' => array(
        'class' => 'SimplePaypal.components.Paypal',
      ),
    ),
  ),
....
```

**Usage**
* Payal Test Page

```
public function actionPaypalTest() {
  $paypalManager = Yii::app()->getModule('SimplePaypal')->paypalManager;
  
  $paypalManager->addField('item_name', 'Paypal Test Transaction');
  $paypalManager->addField('amount', '0.01');
  $paypalManager->addField('item_name_1', 'Test Title');
  $paypalManager->addField('quantity_1', '2');
  $paypalManager->addField('amount_1', '3');
  $paypalManager->addField('custom', '111');
  
  $paypalManager->dumpFields();   // for printing paypal form fields
  //$paypalManager->submitPaypalPost();
}
```    

* Paypal Return

```
public function actionConfirm() {
  if (isset($_GET['q']) && $_GET['q'] == 'success' && (isset($_POST["txn_id"]) && isset($_POST["txn_type"]))) {
      
      /* ToDo: code here after user return from paypal */
      
  } else {
      throw new CHttpException(404, 'The requested page does not exist.');
  }
}
```

* Paypal Notify

```
public function actionNotify() {
  $logCat = 'paypal';
  $paypalManager = Yii::app()->getModule('SimplePaypal')->paypalManager;
  try {
    if ($paypalManager->notify() && $_POST['payment_status'] === 'Completed') {
      $model = new PaymentTransaction;
      $model->user_id = $_POST['custom'];    // need to assign acutal user id
      $model->mc_gross = $_POST['mc_gross'];
      $model->payment_status = $_POST['payment_status'];
      $model->payer_email = $_POST['payer_email'];
      $model->verify_sign = $_POST['verify_sign'];
      $model->txn_id = $_POST['txn_id'];
      $model->payment_type = $_POST['payment_type'];
      $model->receiver_email = $_POST['receiver_email'];
      $model->txn_type = $_POST['txn_type'];
      $model->item_name = $_POST['item_name'];
      $model->ipn_track_id = $_POST['ipn_track_id'];
      $model->save();
      
      /* update user payement status field here */
    
    
      Yii::log('ipn: ' . print_r($_POST, 1), CLogger::LEVEL_ERROR, $logCat);
    } else {
      Yii::log('invalid ipn', CLogger::LEVEL_ERROR, $logCat);
    }
  } catch (Exception $e) {
    Yii::log($e->getMessage(), CLogger::LEVEL_ERROR, $logCat);
  }
}
```

* Paypal Cancel

```
public function actionCancel() {
  * ToDo: code here for paypal cancel */
}
```
