<?php

namespace johnitvn\rbacplus\models;

use Yii;
use yii\data\ArrayDataProvider;

/**
 * Description of RuleSearch
 *
 * @author John Martin <john.itvn@gmail.com>
 * @since 1.0.0
 */
class RuleSearch extends Rule {

    public $name;

    public function rules() {
        return [
            [['name'], 'safe']
        ];
    }

    /**
     * Search authitem
     * @param array $params
     * @return \yii\data\ActiveDataProvider|\yii\data\ArrayDataProvider
     */
    public function search($params) {
        /* @var \yii\rbac\Manager $authManager */
        $authManager = Yii::$app->authManager;
        $models = [];
        foreach ($authManager->getRules() as $name => $item) {
            $models[$name] = new Rule($item);
        }

        return new ArrayDataProvider([
            'allModels' => $models,
        ]);
    }

}
