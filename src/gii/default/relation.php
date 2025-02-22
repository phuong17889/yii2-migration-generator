<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
use phuongdev89\migration\gii\Generator;

/**
 * @var string    $migrationName  the new migration class name
 * @var array     $tableRelations
 * @var Generator $generator
 */

echo "<?php\n";
?>

use yii\db\Schema;
use yii\db\Migration;

class <?= $migrationName ?> extends Migration
{
    public function safeUp()
    {
    <?php if(!empty($tableRelations) && is_array($tableRelations)):?>
    <?php foreach($tableRelations as $table):?>
        <?php foreach($table['fKeys'] as $i=>$rel):?>
    $this->addForeignKey('fk_<?=$table['tableName']?>_<?=$rel['pk']?>', '<?=$table['tableAlias']?>', '<?=$rel['pk']?>', '<?=$rel['ftable']?>', '<?=$rel['fk']?>');
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif?>
    }

    public function safeDown()
    {

<?php if(!empty($tableRelations) && is_array($tableRelations)):?>
    <?php foreach($tableRelations as $table):?>
        <?php foreach($table['fKeys'] as $i=>$rel):?>
   $this->dropForeignKey('fk_<?=$table['tableName']?>_<?=$rel['pk']?>', '<?=$table['tableAlias']?>');
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif?>

    }
}
