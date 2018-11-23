<?php
/**
 * @Author: Marte
 * @Date:   2018-11-23 14:11:43
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-11-23 15:04:02
 */
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use  \yii\data\Pagination;
use app\models\Exam;
class ExamController extends Controller{
    public $enableCsrfValidation = false;
    public function actionAdd(){
        return $this -> render('add');//展示添加页面
    }
    public function actionDoadd(){//添加方法
        $request = Yii::$app->request;
        $s_name = $request->post('s_name');
        $age = $request->post('age');//接到值进行添加入库
        $s_class = $request->post('s_class');
        $res = Yii::$app->db->createCommand()->insert('student',['s_name'=>$s_name,'age'=>$age,'s_class'=>$s_class])->execute();//执行添加语句
        if($res){//判断是否成功
            echo 1;
        }else{
            echo 2;
        }
    }
    public function actionShow(){//展示页面
        $request = Yii::$app->request;
        // $res = Yii::$app->db->createCommand("select * from student")->queryAll();
        // return $this -> render('show',['res'=>$res]);
        $s_serch = $request->get('s_serch');
        $c_serch = $request->get('c_serch');
        if($s_serch != "" && $c_serch != ""){
            $where = ['like','s_name',$s_serch];
            $where1 = ['=','s_class',$c_serch];
            $query = Exam::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->where($where)->andwhere($where1)->count(),'pagesize'=>1]);
            $models = $query->offset($pages->offset)->where($where)
                ->limit($pages->limit)
                ->all();
            return $this->render('show', [
                 'models' => $models,
                 'pages' => $pages,
            ]);
        }
        // 分页
        $query = Exam::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pagesize'=>2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('show', [
             'models' => $models,
             'pages' => $pages,
        ]);

    }
    //即点即改
    public function actionUpd(){
        $request = Yii::$app->request;
        $name = $request->post('name');
        $id = $request->post('id');
        $res = Yii::$app->db->createCommand()->update('student',['s_name'=>$name],"id='$id'")->execute();
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function actionDel(){
        $request = Yii::$app->request;
        $id = $request->post('id');
        Yii::$app->db->createCommand("delete from student where id = '$id'")->execute();
    }
}