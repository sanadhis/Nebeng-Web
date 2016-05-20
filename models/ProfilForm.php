<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ProfilForm extends Model
{
    public $email;
    public $noHP;

    const PERMISSIONS_PRIVATE = 10;
    const PERMISSIONS_PUBLIC = 20;

    public function rules()
    {
        return [
        	[['email','noHP'], 'required', 'message' => 'Tolong isi data dengan benar'],
    	];
    }

    public function getPermissions() {
      return array (self::PERMISSIONS_PRIVATE=>'Private',self::PERMISSIONS_PUBLIC=>'Public');
    }
     
    public function getPermissionsLabel($permissions) {
      if ($permissions==self::PERMISSIONS_PUBLIC) {
        return 'Public';
      } else {
        return 'Private';        
      }
    }
}
