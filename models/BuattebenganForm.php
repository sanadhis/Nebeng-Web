<?php

namespace app\models;

use Yii;
use yii\base\Model;

class BuattebenganForm extends Model
{
    public $asal;
    public $tujuan;
    public $kapasitas;
    public $jamBerangkat;
    public $keterangan;

    const PERMISSIONS_PRIVATE = 10;
    const PERMISSIONS_PUBLIC = 20;

    public function rules()
    {
        return [
        	[['asal','tujuan','kapasitas','jamBerangkat','keterangan'], 'required', 'message' => 'Please fill the required field'],
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
