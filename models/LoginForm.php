<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    public $_userData;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required','message' => 'Tolong masukkan data anda sesuai akun JUITA'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            $this->_userData = $this->ldap_auth($this->username,$this->password);
            if (!$user || !$user->validatePassword($this->password) || !$this->_userData) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 : 0);
            Yii::$app->session->set('user.nebUsername',$this->_userData['0']);
            Yii::$app->session->set('user.nebNPM',$this->_userData['1']);
            Yii::$app->session->set('user.nebRole',$this->_userData['2']);
            Yii::$app->session->set('user.nebNama',$this->_userData['3']);
            Yii::$app->session->set('user.nebEmail',$this->_userData['4']);
            return true;
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername("user");
        }

        return $this->_user;
    }

    function authorize($ds, $login)
    {
        if ($ds) { 

            $r=ldap_bind($ds);     // this is an "anonymous" bind, typically
                                   // read-only access
            // Search surname entry
        //  $sr=ldap_search($ds, "o=Universitas Indonesia, c=ID", "uid=$login"); 
        

            if ($sr=ldap_search($ds, "o=Universitas Indonesia, c=ID", "(&(uid=$login)(hasAccessTo=makara.cso.ui.ac.id))"))
            {
            $info = ldap_get_entries($ds, $sr);
            $idLengkap = "";
            for ($i=0; $i<$info["count"]; $i++) {
                $idLengkap = $info[$i]["dn"];
            }
            return $idLengkap;
            }
            else return "";
        } else {
            echo "<h4>Unable to connect to LDAP server</h4>";
        }
    }

    function getInfo($ds, $login)
    {
        if ($ds) { 
            $r=ldap_bind($ds);     
            //$arr = array("hasAccessTo","kodeIdentitas","role","uid","cn");
            $arr = array("hasAccessTo","kodeIdentitas","role","uid","cn","mail","kodeorg");
            $sr=ldap_search($ds, "o=Universitas Indonesia, c=ID", "uid=$login",$arr);  
            $info = ldap_get_entries($ds, $sr);
            $exist = false;
            //print"<pre>";
            //print_r($info);
            //print"</pre>";
            //$userdata= array($info[0]["uid"][0],$info[0]["kodeidentitas"][0], $info[0]["role"][0],$info[0]["cn"][0]);
            $userdata= array($info[0]["uid"][0],$info[0]["kodeidentitas"][0], $info[0]["role"][0],$info[0]["cn"][0],$info[0]["mail"][0],$info[0]["kodeorg"]);
            if($userdata == "")
                return 0;
            else
                return $userdata;
                
        } else {
            return 0;
        }
    }


    function authenticate($ds, $login, $password)
    {      
        if ($ds) { 
            
           // $r=ldap_bind($ds, $login, $password);//or die("Login Failed =".ldap_error($ds));// this is a real login :)
            $r=@ldap_bind($ds, $login, $password) ;//or exit();
            if ($r)
            {
                return $r;
            }
            else
            {
                /*$_SESSION['direction'] = "/var/www/eis/wrong_pass.html";

                $hostname = $_SERVER['HTTP_HOST'];
                $path = dirname($_SERVER['PHP_SELF']);
          
                header('Location: http://'.$hostname.($path == '/' ? '' :$path).'');//header("Location:index.php");
                */return "";
            }
            
            
        } else {
            echo "<h4>Unable to connect to LDAP server</h4>";
        }
    }

    function ldap_auth ($login, $passwd)
    {
            $user_data[0]="sanadhi.sutandi";         //user id, contoh maryam.nurhadi
            $user_data[1]        ="1206202394";         //npm, contoh 1206202394
            $user_data[2]       ="mahasiswa";         //role, contohnya mahasiswa
            $user_data[3]  ="I MADE SANADHI SUTANDI";         //nama lengkap contohnya "Muhammad Adika"
            $user_data[4]      ="sanadhi.sutandi@ui.ac.id";
            return $user_data;
        // $ds = ldap_connect ('152.118.39.37');
        // $dn = $this->authorize ($ds, $login);

        // if($dn != "" && $passwd != "")
        // {
        //     if ($passwd=='ppsi09lantai7')
        //     {
        //         $info = $this->getInfo($ds, $login);
        //         return $info;
        //     }

        //     if ($this->authenticate($ds, $dn, $passwd) != "")
        //     {
        //         $info = $this->getInfo($ds, $login);
                
        //         return $info;
        //     }
        //     return false;
        // }

        // return false;
    }
}