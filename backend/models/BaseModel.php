<?php
namespace backend\models;

/**
 * Class BaseModel
 * @package backend\models
 * @property int $create_time
 * @property int $update_time
 */
class BaseModel extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        $attrs = array_keys($this->attributes);
        if (in_array('create_time', $attrs) && $insert) {
            $this->create_time = time();
        }

        if (in_array('update_time', $attrs) && !$insert) {
            $this->update_time = time();
        }
        if (in_array('update_time', $attrs) && !in_array('create_time', $attrs)) {
            $this->update_time = time();
        }
        if (in_array('update_user', $attrs)) {
            $this->update_user = app()->user->uname;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}

?>