<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location_stage}}`.
 */
class m190710_192221_create_location_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('
            CREATE TABLE `nad_eng_location_stage` (
              `id` int(11) NOT NULL,
              `locationId` int(11) NOT NULL,
              `stageId` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

            --
            -- Indexes for dumped tables
            --

            --
            -- Indexes for table `nad_eng_location_stage`
            --
            ALTER TABLE `nad_eng_location_stage`
              ADD PRIMARY KEY (`id`),
              ADD KEY `locationId` (`locationId`),
              ADD KEY `stageId` (`stageId`);

            --
            -- AUTO_INCREMENT for dumped tables
            --

            --
            -- AUTO_INCREMENT for table `nad_eng_location_stage`
            --
            ALTER TABLE `nad_eng_location_stage`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- Constraints for dumped tables
            --

            --
            -- Constraints for table `nad_eng_location_stage`
            --
            ALTER TABLE `nad_eng_location_stage`
              ADD CONSTRAINT `nad_eng_location_stage_ibfk_1` FOREIGN KEY (`locationId`) REFERENCES `nad_eng_location` (`id`) ON DELETE CASCADE,
              ADD CONSTRAINT `nad_eng_location_stage_ibfk_2` FOREIGN KEY (`stageId`) REFERENCES `nad_eng_stage` (`id`) ON DELETE CASCADE;
            ');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'nad_eng_location_stage_ibfk_1',
            'nad_eng_location_stage'
        );

        $this->dropForeignKey(
            'nad_eng_location_stage_ibfk_2',
            'nad_eng_location_stage'
        );
        $this->dropTable('nad_eng_location_stage');
    }
}
