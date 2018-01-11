<?php
namespace frontend\base;

/**
 * rewrite Application 
 */
class Application extends \yii\web\Application
{
    /**
     * @inheritdoc
     */
    public function coreComponents()
    {
        return array_merge(parent::coreComponents(), [
            'request' => ['class' => 'yii\web\Request'],
            'response' => ['class' => 'yii\web\Response'],
            'session' => ['class' => 'yii\web\Session'],
            'user' => ['class' => '\frontend\base\User'],
            'errorHandler' => ['class' => 'yii\web\ErrorHandler'],
        ]);
    }
}
