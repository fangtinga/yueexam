<?php
/**
 * @Author: Marte
 * @Date:   2018-11-23 14:35:00
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-11-23 14:36:35
 */
namespace app\models;
use yii\db\ActiveRecord;
class Exam extends ActiveRecord{
    public static function tableName(){
        return "student";
    }
}
