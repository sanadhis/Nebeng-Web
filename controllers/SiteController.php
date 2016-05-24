<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\BeriTebengan;
use app\models\NebengUser;
use app\models\BuattebenganForm;
use app\models\ProfilForm;
use app\models\Nebeng;
date_default_timezone_set("Asia/Jakarta");

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionErrorhandler(){
        if(!Yii::$app->user->identity){
            return Yii::$app->runAction('site/login');
        }
        return Yii::$app->runAction('site/index');
    }

    public function actionIndex()
    {
        $this->checkUser();
        return $this->render('index');
    }

    public function actionGotohome()
    {
        $this->checkUser();
        return $this->render('index');
    }

    public function actionCaritumpangan()
    {
        $this->checkUser();

        $rows = BeriTebengan::find()
                ->select('*')
                ->join('INNER JOIN','nebeng_user','nebeng_beri_tebengan.user_id = nebeng_user.id')
                ->where(['>=', 'nebeng_beri_tebengan.detail_waktu_kadaluarsa', $this->getDate()])
                ->orderBy('waktu_berangkat','jam_berangkat')
                ->asArray()->all();
        return $this->render('cariTumpangan',['data'=>$rows]);
    }

    public function actionNumpang($id)
    {
        $this->checkUser();

        if($this->checkStatusTumpangan()){
                $infoTitle = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Anda Sedang Memberi Tumpangan";
                $subInfoTitle = "Anda tidak bisa menumpang apabila sedang memberi tumpangan";
                $callout = "callout-danger";
                return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
        }
        else if($this->checkStatusMenumpang()){
                $infoTitle = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Anda Sudah Menumpang";
                $subInfoTitle = "Anda tidak dapat menumpang tumpangan lain";
                $callout = "callout-danger";
                return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
        }
        else{
            $nebeng = new Nebeng();
            $nebeng->id_penebeng = Yii::$app->session->get('user.nebId');
            $nebeng->id_tebengan = $id;
            $nebeng->waktu_konfirmasi = $this->getDate();

            $beriTebengan = BeriTebengan::find()
                        ->where(['id_tebengan' => $id])
                        ->orderBy('detail_waktu_kadaluarsa DESC')
                        ->one();
            $beriTebengan->sisa_kapasitas -= 1;

            if($nebeng->save() && $beriTebengan->update() ){
                    $infoTitle = "<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Anda Sukses Menumpang";
                    $subInfoTitle = "Selama menumpang anda tidak bisa membuat tumpangan ataupun menumpang ke yang lain";
                    $callout = "callout-success";
                    return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
            }
        }
    }

    public function actionBuattumpangan()
    {
        $this->checkUser();

        $model = new BuattebenganForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($this->checkStatusTumpangan()){
                $infoTitle = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Anda Sudah Membuat Tumpangan";
                $subInfoTitle = "Anda harus menunggu masa tumpangan anda habis";
                $callout = "callout-danger";
                return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
            }
            else if($this->checkStatusMenumpang()){
                $infoTitle = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i> Anda Sedang Menumpang Tumpangan Lain";
                $subInfoTitle = "Anda tidak dapat <b>memberi tumpangan</b> ketika sedang menumpang";
                $callout = "callout-danger";
                return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
            }
            else{
                $waktuKadaluarsa = $this->getKadaluarsa($model->jamBerangkat);

                $modelTebengan                  = new BeriTebengan();
                $modelTebengan->asal            = $model->asal;
                $modelTebengan->tujuan          = $model->tujuan;
                $modelTebengan->kapasitas       = $model->kapasitas;
                $modelTebengan->jam_berangkat   = str_replace('.', ':', $model->jamBerangkat);
                $modelTebengan->keterangan      = $model->keterangan;
                $modelTebengan->sisa_kapasitas  = $model->kapasitas;
                $modelTebengan->waktu_berangkat = date("Y-m-d");
                $modelTebengan->jam_kadaluarsa  = explode(" ",$waktuKadaluarsa)[1];
                $modelTebengan->detail_waktu_kadaluarsa = $waktuKadaluarsa;
                $modelTebengan->user_id = "1";

                $modelTebengan->save();
                return Yii::$app->runAction('site/caritumpangan');
            }

            
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('buatTumpangan', ['model' => $model]);
        }
    }

    public function actionProfil()
    {
        $this->checkUser();

        $userData = NebengUser::find()
                ->where(['username' => Yii::$app->session->get('user.nebUsername')])
                ->one();
        $tumpangan = $this->checkStatusTumpangan();
        $menumpang = $this->checkStatusMenumpang();
        if($tumpangan){
            $penumpang = $this->getTumpangan();
            // var_dump($penumpang);
            if(!$penumpang){
                $penumpang ='';
            }
            $infoTitle = "Detail tumpangan yang saat ini anda sediakan";
            return $this->render('profil', ['data'=>$userData, 'title' => $infoTitle, 'infoTumpangan' => $tumpangan, 'penumpang' => $penumpang]);
        }
        else if($menumpang){
            $infoTitle = "Detail tumpangan yang saat ini sedang anda tumpangi";
            return $this->render('profil', ['data'=>$userData, 'title' => $infoTitle, 'infoTumpangan' => $menumpang]);
        }
        else{
            $infoTitle = "Anda sedang tidak menumpang ataupun membuat tumpangan";
            return $this->render('profil',['data'=>$userData, 'title' => $infoTitle]);
        }
    }

    public function actionEditprofil()
    {
        $this->checkUser();

        $model = new ProfilForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $user = NebengUser::find()
                        ->where(['username' => Yii::$app->session->get('user.nebUsername')])
                        ->one();
            $user->email = $model->email;
            $user->no_handphone = $model->noHP;
            $user->update();            
                
            $infoTitle = "<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Sukses Memperbaharui Informasi Kontak";
            $subInfoTitle = "Gunakan menu untuk berpindah ke halaman lain";
            $callout = "callout-success";
            return $this->render('information', ['title' => $infoTitle, 'subTitle' => $subInfoTitle, 'callout' => $callout]);
            
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('editProfil', ['model' => $model]);
        }
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        else{
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                
                $user = NebengUser::find()
                        ->where(['username' => Yii::$app->session->get('user.nebUsername')])
                        ->one();

                if(!$user || empty($user)){
                    $usernew = new NebengUser();
                    $usernew->npm       = Yii::$app->session->get('user.nebNPM');
                    $usernew->username  = Yii::$app->session->get('user.nebUsername');
                    $usernew->nama      = Yii::$app->session->get('user.nebNama');
                    $usernew->role      = Yii::$app->session->get('user.nebRole');
                    $usernew->email     = Yii::$app->session->get('user.nebEmail');
                    $usernew->save();
                    $user_id = $usernew->id;
                }
                else{
                    $user_id = $user->id;
                }        

                Yii::$app->session->set('user.nebId',$user_id);      

                return Yii::$app->runAction('site/index');

            }
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        $this->checkUser();
        
        return $this->render('about');
    }

    public function getKadaluarsa($jam_berangkat){
        //buat waktu kadaluarsa
        //olah data waktu untuk insert ke database
        $jam_berangkat      = str_replace('.', ':', $jam_berangkat); //beda format waktu 23.59 -> 23:59
        $date_expired       = date(('Y-m-d '.$jam_berangkat), strtotime('+1 hours'));

        $date_expired       = new \DateTime($date_expired);
        $date_expired       ->modify('+1 hour');         //set jam kadaluarsa = +1 jam dari waktu yang disediakan
        $date_expired       = $date_expired->format('Y-m-d H:i:s'); //jam kadaluarsa
        return $date_expired;
    }

    public function checkUser(){
        if(!Yii::$app->user->identity){
            return $this->redirect(array('site/login'));
        }
    }

    public function checkStatusMenumpang(){
        try{
            $checkStatusMenumpang = BeriTebengan::find()
                                ->select('*')
                                ->join('INNER JOIN','nebeng_nebeng','nebeng_beri_tebengan.id_tebengan = nebeng_nebeng.id_tebengan')
                                ->join('INNER JOIN','nebeng_user','nebeng_beri_tebengan.user_id = nebeng_user.id')
                                ->where(['nebeng_nebeng.id_penebeng' => Yii::$app->session->get('user.nebId')])
                                ->andWhere(['>=', 'nebeng_beri_tebengan.detail_waktu_kadaluarsa', $this->getDate()])
                                ->asArray()
                                ->all();
            if($checkStatusMenumpang){
                return $checkStatusMenumpang;
            }
            else{
                return false;
            }
        }   
        catch(Exception $e){
            return false; 
        }
        
    }

    public function checkStatusTumpangan(){
        try{
            $checkStatusTumpangan = BeriTebengan::find()
                                    ->select('*')
                                    ->join('INNER JOIN','nebeng_user','nebeng_beri_tebengan.user_id = nebeng_user.id')
                                    ->where(['nebeng_beri_tebengan.user_id' => Yii::$app->session->get('user.nebId')])
                                    ->andWhere(['>=', 'nebeng_beri_tebengan.detail_waktu_kadaluarsa', $this->getDate()])
                                    ->asArray()
                                    ->all();
            if($checkStatusTumpangan){
                return $checkStatusTumpangan;
            }
            else{
                return false;
            }
        }
        catch(Exception $e){
            return false; 
        }
    }

    public function getTumpangan(){
        try{
            //this one fails, dont know why -_-
            // $getTumpangan = BeriTebengan::find()
            //                     ->select('*')
            //                     ->join('INNER JOIN','nebeng_nebeng','nebeng_beri_tebengan.id_tebengan = nebeng_nebeng.id_tebengan')
            //                     ->join('INNER JOIN','nebeng_user','nebeng_nebeng.id_penebeng = nebeng_user.id')
            //                     ->where(['nebeng_beri_tebengan.user_id' => Yii::$app->session->get('user.nebId')])
            //                     ->andWhere(['>=', 'nebeng_beri_tebengan.detail_waktu_kadaluarsa', $this->getDate()])
            //                     ->asArray()
            //                     ->all();
            $nowDate = $this->getDate();
            $getTumpangan = BeriTebengan::findBySQL("select * from nebeng_beri_tebengan inner join nebeng_nebeng on 
                                                    nebeng_beri_tebengan.id_tebengan = nebeng_nebeng.id_tebengan 
                                                    inner join nebeng_user on nebeng_nebeng.id_penebeng=nebeng_user.id where nebeng_beri_tebengan.user_id=1
                                                    and nebeng_beri_tebengan.detail_waktu_kadaluarsa >= '$nowDate';")
                            ->asArray()->all();
            if($getTumpangan){
                return $getTumpangan;
            }
            else{
                return false;
            }
        }   
        catch(Exception $e){
            return false; 
        }
        
    }

    public function getDate(){
        return date('Y-m-d H:i:s');
    }

}
