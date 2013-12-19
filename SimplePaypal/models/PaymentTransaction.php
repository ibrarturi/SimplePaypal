<?php

/**
 * This is the model class for table "payment_transaction".
 *
 * The followings are the available columns in table 'payment_transaction':
 * @property integer $id
 * @property integer $user_id
 * @property string $mc_gross
 * @property string $payment_status
 * @property string $payer_email
 * @property string $verify_sign
 * @property string $txn_id
 * @property string $payment_type
 * @property string $receiver_email
 * @property string $txn_type
 * @property string $item_name
 * @property string $ipn_track_id
 * @property string $created_at
 * @property string $updated_at
 */
class PaymentTransaction extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PaymentTransaction the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'payment_transaction';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('mc_gross, payment_status, payer_email, verify_sign, txn_id, payment_type, receiver_email, txn_type, item_name, ipn_track_id', 'length', 'max' => 256),
            array('created_at, updated_at', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, user_id, mc_gross, payment_status, payer_email, verify_sign, txn_id, payment_type, receiver_email, txn_type, item_name, ipn_track_id, created_at, updated_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'mc_gross' => 'Mc Gross',
            'payment_status' => 'Payment Status',
            'payer_email' => 'Payer Email',
            'verify_sign' => 'Verify Sign',
            'txn_id' => 'Txn',
            'payment_type' => 'Payment Type',
            'receiver_email' => 'Receiver Email',
            'txn_type' => 'Txn Type',
            'item_name' => 'Item Name',
            'ipn_track_id' => 'IPN Track Id',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('mc_gross', $this->mc_gross, true);
        $criteria->compare('payment_status', $this->payment_status, true);
        $criteria->compare('payer_email', $this->payer_email, true);
        $criteria->compare('verify_sign', $this->verify_sign, true);
        $criteria->compare('txn_id', $this->txn_id, true);
        $criteria->compare('payment_type', $this->payment_type, true);
        $criteria->compare('receiver_email', $this->receiver_email, true);
        $criteria->compare('txn_type', $this->txn_type, true);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('ipn_track_id', $this->ipn_track_id, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    protected function beforeSave() {
        parent::beforeSave();
        
        if($this->isNewRecord) {
            $this->created_at = time();
        }
        $this->updated_at = time();

        return true;
    }

}