<?php
/**
 * @var View       $this
 * @var ActiveForm $form
 * @var Generator  $generator
 */
use yii\gii\generators\form\Generator;
use yii\web\View;
use yii\widgets\ActiveForm;
echo $form->field($generator, 'tableName');
echo $form->field($generator, 'tableIgnore');
echo $form->field($generator, 'db');
echo $form->field($generator, 'migrationPath');
echo $form->field($generator, 'usePrefix')->checkbox();
echo $form->field($generator, 'generateData')->checkbox();
echo $form->field($generator, 'tableOptions');
echo $form->field($generator, 'genMode')->dropDownList([
	'single' => 'One file per table',
	'mass'   => 'All in one file',
]);
