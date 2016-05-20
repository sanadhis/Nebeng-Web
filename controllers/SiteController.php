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
                'actions' => [
                    'logout' => ['post'],
                ],
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

    public function actionIndex()
    {
        return $this->render('login');
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

    public function actionBuattumpangan()
    {
        $this->checkUser();

        $model = new BuattebenganForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            if($this->checkStatusTumpangan()){
                $infoTitle = "Anda Sudah Membuat Tumpangan";
                $subInfoTitle = "Anda harus menunggu masa tumpangan anda habis";
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
        return $this->render('profil',['data'=>$userData]);
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
                
            $infoTitle = "Sukses Memperbaharui Informasi Kontak";
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

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            $user_id = NebengUser::find()
                    ->where(['username' => Yii::$app->session->get('user.nebUsername')])
                    ->one()
                    ->id;

            Yii::$app->session->set('user.nebId',$user_id);      

            return $this->redirect(array('site/gotohome'));
        }
        return $this->render('login', [
            'model' => $model,
        ]);
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
            return $this->goHome();
        }
    }

    public function checkStatusMenumpang(){
        $checkStatusMenumpang = Nebeng::find()
                                ->select('*')
                                ->join('INNER JOIN','nebeng_beri_tebengan','nebeng_beri_tebengan.id_tebengan = nebeng_nebeng.id_tebengan')
                                ->where(['nebeng_nebeng.id_penebeng' => Yii::$app->session->get('user.nebId')])
                                ->andWhere(['>=', 'nebeng_beri_tebengan.detail_waktu_kadaluarsa', $this->getDate()])
                                ->one();
        if($checkStatusMenumpang){
            return "Sedang Menumpang";
        }
    }

    public function checkStatusTumpangan(){
        $checkStatusTumpangan = BeriTebengan::find()
                                ->where(['user_id' => Yii::$app->session->get('user.nebId')])
                                ->andWhere(['>=', 'detail_waktu_kadaluarsa', $this->getDate()])
                                ->one();
        if($checkStatusTumpangan){
            return true;
        }
    }

    public function getDate(){
        return date('Y-m-d H:i:s');
    }

}
