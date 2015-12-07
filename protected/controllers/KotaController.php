<?php

class KotaController extends Controller
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
				'actions'=>array('create','update','tampilKota','tampilkan'),
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
	public function actionTampilKota(){
		$model = Yii::app()->db->createCommand()
						   ->select('kota.id,kota.nm_kota,provinsi.provinsi')
						   ->from('kota,provinsi')
						   ->where('kota.provinsi_id=provinsi.id')
						   ->query();
        $this->render('tampilKota',array('model'=>$model));
	}

	public function actionTampilkan(){
		$sql="SELECT kota.provinsi_id, kota.nm_kota, provinsi.provinsi
		       FROM kota, provinsi
		       WHERE kota.provinsi_id=provinsi.id";
		$cmd  = Yii::app()->db->createCommand($sql);
		$model = $cmd->queryAll();
		$this->render('tampilkan',array(
             'model'=>$model,
			));
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Kota;

		 // Uncomment the following line if AJAX validation is needed
	     $this->performAjaxValidation($model);

		if(isset($_POST['Kota']))
		{
			$model->attributes= $_POST['Kota'];
			$prop_id          = $_POST['Kota']['provinsi_id'];
			$nm_kota          = $_POST['Kota']['nm_kota'];

			$sql="INSERT INTO kota(provinsi_id,nm_kota)
			       VALUES (:prop_id,:nm_kota)";

			 $cmd = Yii::app()->db->createCommand($sql);
			 $cmd->bindParam(":prop_id",$prop_id,PDO::PARAM_INT);
			 $cmd->bindParam(":nm_kota",$nm_kota,PDO::PARAM_STR);
			   try {
			   	   $cmd->execute();
			   	   $this->redirect(array('admin'));
			   } catch (Exception $e) {
			   	  Yii::app()->user->setFlash('adaKesalahan',
			   	  	     "Ada Kesalahan : "."{$e->getMessage()}");
			   }
		}

		$this->render('create',array(
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
		$this->performAjaxValidation($model);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kota']))
		{
			$prop_id = $_POST['Kota']['provinsi_id'];
			$nm_kota = $_POST['Kota']['nm_kota'];

			$sql = "UPDATE kota SET provinsi_id=:prop_id, nm_kota=:nm_kota
			        where id=:id";
			$cmd = Yii::app()->db->createCommand($sql);
			$cmd->bindParam(":prop_id",$prop_id,PDO::PARAM_INT);
			$cmd->bindParam(":nm_kota",$nm_kota,PDO::PARAM_STR);
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
		$sql = "DELETE FROM kota WHERE id=:id";
		$cmd = Yii::app()->db->createCommand($sql);
		$cmd->bindParam(":id",$id,PDO::PARAM_INT);
		$cmd->execute();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Kota');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kota('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kota']))
			$model->attributes=$_GET['Kota'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kota the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kota::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kota $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kota-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
