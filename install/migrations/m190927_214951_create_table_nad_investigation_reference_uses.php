<?php

use yii\db\Migration;

/**
 * Class m190927_214951_create_table_nad_investigation_reference_uses
 */
class m190927_214951_create_table_nad_investigation_reference_uses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
        CREATE TABLE `nad_investigation_reference_uses` (
            `id` int(11) NOT NULL,
            `code` int(11) NOT NULL,
            `referenceId` int(11) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

          --
          -- Indexes for dumped tables
          --

          --
          -- Indexes for table `nad_investigation_reference_uses`
          --
          ALTER TABLE `nad_investigation_reference_uses`
            ADD PRIMARY KEY (`id`),
            ADD KEY `reference_id` (`referenceId`);

          --
          -- AUTO_INCREMENT for dumped tables
          --

          --
          -- AUTO_INCREMENT for table `nad_investigation_reference_uses`
          --
          ALTER TABLE `nad_investigation_reference_uses`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

          --
          -- Constraints for dumped tables
          --

          --
          -- Constraints for table `nad_investigation_reference_uses`
          --
          ALTER TABLE `nad_investigation_reference_uses`
            ADD CONSTRAINT `nad_investigation_reference_uses_ibfk_1` FOREIGN KEY (`referenceId`) REFERENCES `nad_investigation_reference` (`id`) ON DELETE CASCADE;
        ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190927_214951_create_table_nad_investigation_reference_uses cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190927_214951_create_table_nad_investigation_reference_uses cannot be reverted.\n";

        return false;
    }
    */
}
