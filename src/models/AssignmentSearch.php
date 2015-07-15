<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * Description of AssignmentSearch
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 * @property \johnitvn\rbacplus\Module $rbacModule
 */
class AssignmentSearch extends \yii\base\Model {

    protected $rbacModule;
    public $id;
    public $login;

    public function init() {
        parent::init();
        $this->rbacModule = Yii::$app->getModule('rbac');
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'login'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('rbac', 'ID'),
            'login' => $this->rbacModule->userModelLoginFieldLabel,
        ];
    }

    /**
     * Create data provider for Assignment model.    
     */
    public function search() {
        $query = call_user_func($this->rbacModule->userModelClassName."::find");
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $params = Yii::$app->request->getQueryParams();
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', $this->rbacModule->userModelIdField, $this->login]);

        return $dataProvider;
    }

}
