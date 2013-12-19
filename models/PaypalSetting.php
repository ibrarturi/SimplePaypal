 <?php

/**
 * This is the model class for table "paypal_setting".
 *
 * The followings are the available columns in table 'paypal_setting':
 * @property integer $id
 * @property string $business_email
 * @property string $sandbox
 * @property string $return_url
 * @property string $cancel_url
 * @property string $notify_url
 * @property string $currency
 * @property string $updated_at
 */
class PaypalSetting extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PaypalSetting the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'paypal_setting';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('business_email, sandbox, return_url, cancel_url, notify_url, currency', 'required'),
            array('business_email', 'email'),
            array('business_email, currency, updated_at', 'length', 'max'=>128),
            array('sandbox', 'length', 'max'=>1),
            array('return_url, cancel_url, notify_url', 'length', 'max'=>256),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, business_email, sandbox, return_url, cancel_url, notify_url, currency, updated_at', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'business_email' => 'Business Email',
            'sandbox' => 'Sandbox',
            'return_url' => 'Return Url',
            'cancel_url' => 'Cancel Url',
            'notify_url' => 'Notify Url',
            'currency' => 'Currency',
            'updated_at' => 'Updated At',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('business_email',$this->business_email,true);
        $criteria->compare('sandbox',$this->sandbox,true);
        $criteria->compare('return_url',$this->return_url,true);
        $criteria->compare('cancel_url',$this->cancel_url,true);
        $criteria->compare('notify_url',$this->notify_url,true);
        $criteria->compare('currency',$this->currency,true);
        $criteria->compare('updated_at',$this->updated_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    protected function beforeSave() {
        parent::beforeSave();

        $this->updated_at = time();

        return true;
    }
}