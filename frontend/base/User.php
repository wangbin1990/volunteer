<?php
namespace frontend\base;

/**
 * rewrite User 
 */
class User extends \yii\web\User
{
    /**
     * @var string the session variable name used to store the value of [[id]].
     */
    public $idParam = '__frontId';
}
