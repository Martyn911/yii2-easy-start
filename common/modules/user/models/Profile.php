<?php

namespace common\modules\user\models;

class Profile extends \dektrium\user\models\Profile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['localeValidation'] = ['locale', 'string', 'max' => 2];
        $rules['localeValidation'] = ['locale', 'in', 'range' => array_keys(\Yii::$app->params['availableLocales']) ];
        $rules['subscriptionValidation'] = ['subscription', 'integer'];
        return $rules;
    }

    /*
    * @inheritdoc
    */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['locale'] = \Yii::t('exuser', 'Locale');
        $labels['subscription'] = \Yii::t('exuser', 'Subscription');
        return $labels;
    }
}