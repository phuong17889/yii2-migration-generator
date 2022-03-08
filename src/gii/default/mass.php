<?php
/**
 * This view is used by console/controllers/MigrateController.php
 * The following variables are available in this view:
 */
use phuong17889\migration\gii\Generator;

/** @var $migrationName string the new migration class name
 * @var array     $tableList
 * @var array     $tableRelations
 * @var Generator $generator
 * @var array     $tableData
 *
 */
echo "<?php\n";
?>

use yii\db\Schema;
use yii\db\Migration;

class <?= $migrationName ?> extends Migration {
	public function safeUp() {
		$tableOptions = '<?= $generator->tableOptions ?>';
		<?php foreach ($tableList as $tableData): ?>
			$this->createTable('<?= ($generator->usePrefix) ? $tableData['alias'] : $tableData['name'] ?>',
			[
			<?php foreach ($tableData['columns'] as $name => $data): ?>
				'<?= $name ?>'=> <?= $data; ?>,
			<?php endforeach; ?>
			], $tableOptions);

			<?php if (!empty($tableData['indexes']) && is_array($tableData['indexes'])): ?>
				<?php foreach ($tableData['indexes'] as $name => $data): ?>
					<?php if ($name != 'PRIMARY'): ?>
						$this->createIndex('<?= $name ?>', '<?= $tableData['alias'] ?>','<?= implode(",", array_values($data['cols'])) ?>',<?= $data['isuniq'] ?>);
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif ?>
		<?php endforeach; ?>
		<?php if (!empty($tableRelations) && is_array($tableRelations)): ?>
			<?php foreach ($tableRelations as $table): ?>
				<?php foreach ($table['fKeys'] as $i => $rel): ?>
					$this->addForeignKey('fk_<?= $table['tableName'] ?>_<?= $rel['pk'] ?>', '<?= $table['tableAlias'] ?>', '<?= $rel['pk'] ?>', '<?= $rel['ftable'] ?>', '<?= $rel['fk'] ?>');
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endif ?>
		<?php if ($generator->generateData): ?>
			<?= $generator->getTableData(($generator->usePrefix) ? $tableData['alias'] : $tableData['name']) ?>
		<?php endif; ?>
	}

	public function safeDown() {
		<?php if (!empty($tableRelations) && is_array($tableRelations)): ?>
			<?php foreach ($tableRelations as $table): ?>
				<?php foreach ($table['fKeys'] as $i => $rel): ?>
					$this->dropForeignKey('fk_<?= $table['tableName'] ?>_<?= $rel['pk'] ?>', '<?= $table['tableAlias'] ?>');
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endif ?>
		<?php foreach ($tableList as $tableData): ?>
			$this->dropTable('<?= ($generator->usePrefix) ? $tableData['alias'] : $tableData['name'] ?>');
		<?php endforeach; ?>
	}
}
