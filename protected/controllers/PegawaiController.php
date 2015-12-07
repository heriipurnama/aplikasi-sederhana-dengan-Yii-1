<?php

class PegawaiController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','tampilkan'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pegawai']))
		{
			$model->attributes=$_POST['Pegawai'];
			$nama_peg=$_POST['Pegawai']['pegawai'];
			$cmd = Yii::app()->db->createCommand();
			$cmd->view('pegawai',
				              array('pegawai'=>$nama_peg),
				              'id=:id',array(':id'=>$id));
			$this->redirect(array('admin'));
		}

		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pegawai;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);


		if(isset($_POST['Pegawai']))
		{
			$model->attributes=$_POST['Pegawai'];
			
			$nip      = $_POST['Pegawai']['nip'];
			$nama_peg = $_POST['Pegawai']['nama'];
			$alamat   = $_POST['Pegawai']['alamat'];
			$ttl      = $_POST['Pegawai']['tanggal_lahir'];
			$agama    = $_POST['Pegawai']['agama'];

            $sql = "INSERT INTO pegawai(nip, nama, alamat, tanggal_lahir, agama)
                      VALUES(:nip,:nama_peg,:alamat,:ttl,:agama)";

            $cmd = Yii::app()->db->createCommand($sql);
            $cmd->bindParam(":nip",$nip,PDO::PARAM_INT);
            $cmd->bindParam(":nama_peg",$nama_peg,PDO::PARAM_STR);
            $cmd->bindParam(":alamat",$alamat,PDO::PARAM_STR);
            $cmd->bindParam("ttl",$ttl,PDO::PARAM_INT);
            $cmd->bindParam("agama",$agama,PDO::PARAM_STR);
            try {
            	$cmd->execute();
            	$this->redirect(array('admin'));
            } catch (Exception $e) {
            	Yii:app()->user->setFlash('adaKesalahan',
            		"Ada Kesalahan :"."{$e->getMessage()}");
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

    public function actionTampilkan(){
		$sql="SELECT nip,nama,alamat,tanggal_lahir,agama
		       FROM pegawai
		       WHERE pegawai.id";
		$cmd  = Yii::app()->db->createCommand($sql);
		$model = $cmd->queryAll();
		$this->render('tampilkan',array(
             'model'=>$model,
			));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
       
           
		if(isset($_POST['Pegawai'])){
			
			$nip      = $_POST['Pegawai']['nip'];
			$nama_peg = $_POST['Pegawai']['nama'];
			$alamat   = $_POST['Pegawai']['alamat'];
			$ttl      = $_POST['Pegawai']['tanggal_lahir'];
			$agama    = $_POST['Pegawai']['agama'];

			$sql = "UPDATE pegawai SET nip=:nip, nama=:nama_peg, alamat=:alamat, tanggal_lahir=:ttl, agama=:agama
			        WHERE id=:id";
			$cmd = Yii::app()->db->createCommand($sql);
			//deklarasi untuk variabel yang dibuat ke simpan dalam databases
			$cmd->bindParam(":nip",$nip,PDO::PARAM_INT);
			$cmd->bindParam(":nama_peg",$nama_peg,PDO::PARAM_STR);
			$cmd->bindParam(":alamat",$alamat,PDO::PARAM_STR);
			$cmd->bindParam(":ttl",$ttl,PDO::PARAM_INT);
			$cmd->bindParam(":agama",$agama,PDO::PARAM_STR);
			$cmd->bindParam(":id",$id,PDO::PARAM_INT);
			try {
				$cmd->execute();
				$this->redirect(array('admin'));
			} catch (Exception $e) {
				Yii::app()->user->setFlash('adaKesalahan',
					"Anda Kesalahan : "."{$e->getMessage()}");
			}
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	

	public function actionDelete($id)
	{
	   $sql = "DELETE FROM pegawai WHERE id=:id";
		$cmd = Yii::app()->db->createCommand($sql);
		$cmd->bindParam(":id",$id,PDO::PARAM_INT);
		$cmd->execute();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? 
				$_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pegawai');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pegawai('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pegawai']))
			$model->attributes=$_GET['Pegawai'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Pegawai the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Pegawai::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Pegawai $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pegawai-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
