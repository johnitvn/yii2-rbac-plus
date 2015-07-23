<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** Get all roles */
$authManager = Yii::$app->authManager;
?>
<div class="user-assignment-form">
<?php $form = ActiveForm::begin(); ?>
    <?= Html::activeHiddenInput($formModel, 'userId')?>
    <label class="control-label"><?=$formModel->attributeLabels()['roles']?></label>
    <input type="hidden" name="AssignmentForm[roles]" value="">
    <table class="table table-striped table-bordered detail-view">
        <thead>
            <tr>
                <th style="width:1px"></th>
                <th style="width:150px">Name</th>
                <th>Description</th>
            </tr>
        <tbody>            
            <?php foreach ($authManager->getRoles() as $role): ?>
                <tr>
                    <?php
                        $checked = true;
                        if($formModel->roles==null||!is_array($formModel->roles)||count($formModel->roles)==0){
                            $checked = false;
                        }else if(!in_array($role->name, $formModel->roles) ){
                            $checked = false;
                        }                        
                    ?>
                    <td><input <?= $checked? "checked":"" ?>  type="checkbox" name="AssignmentForm[roles][]" value="<?= $role->name?>"></td>
                    <td><?= $role->name ?></td>
                    <td><?= $role->description ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if (!Yii::$app->request->isAjax) { ?>
    <div class="form-group">
    <?= Html::submitButton(Yii::t('rbac', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php } ?>
<?php ActiveForm::end(); ?>
</div>

