<?php

use yii\db\Migration;

/**
 * Class m200517_205221_create_rla_tables
 */
class m200517_205221_create_rla_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
        CREATE TABLE `row_level_access`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `seq_access_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL,
            `access_type` int(11) NOT NULL,
            `expire_date` int(11) NULL DEFAULT NULL,
            PRIMARY KEY (`id`) USING BTREE
          ) ENGINE = InnoDB AUTO_INCREMENT = 86 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

          CREATE TABLE `row_level_access_preview`  (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `item_type` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
            PRIMARY KEY (`id`) USING BTREE
          ) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200517_205221_create_rla_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200517_205221_create_rla_tables cannot be reverted.\n";

        return false;
    }
    */
}
