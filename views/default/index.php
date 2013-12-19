<?php
$this->breadcrumbs = array(
    'PayPal Settings',
);

$this->menu = array(
    array('label' => 'PayPal Settings', 'url' => array('index')),
);
?>

<div class="form">

    <h3>PayPal Settings</h3>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'paypal-settings-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="info">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
        <br/>
    <?php endif; ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'business_email'); ?>
        <?php echo $form->textField($model, 'business_email', array('size' => 30, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'business_email'); ?>
    </div> 

    <div class="row">
        <?php echo $form->labelEx($model, 'sandbox'); ?>
        <?php echo $form->dropDownList($model, 'sandbox', array('0' => 'False', '1' => 'True'), array('empty' => '-- Select --')); ?>
        <?php echo $form->error($model, 'sandbox'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'return_url'); ?>
        <?php echo $form->textField($model, 'return_url', array('size' => 30, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'return_url'); ?>
    </div> 

    <div class="row">
        <?php echo $form->labelEx($model, 'cancel_url'); ?>
        <?php echo $form->textField($model, 'cancel_url', array('size' => 30, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'cancel_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'notify_url'); ?>
        <?php echo $form->textField($model, 'notify_url', array('size' => 30, 'maxlength' => 256)); ?>
        <?php echo $form->error($model, 'notify_url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'currency'); ?>
        <?php echo $form->dropDownList($model, 'currency', array('USD' => 'USD'), array('empty' => '-- Select --')); ?>
        <?php echo $form->error($model, 'currency'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Update', array('class' => 'btn')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->