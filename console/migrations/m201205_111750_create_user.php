<?php

use yii\db\Migration;

/**
 * Class m201205_111750_create_user
 */
class m201205_111750_create_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->comment('主键ID'),
            'username' => $this->string()->notNull()->unique()->comment('用户名'),
            'password_hash' => $this->string()->notNull()->comment('密码经过hash后的字符串'),
            'password_reset_token' => $this->string()->unique()->comment('重置密码时需要的token'),
            'verification_token' => $this->string()->defaultValue(null)->comment('邮箱认证时需要的token'),
            'email' => $this->string()->notNull()->unique()->comment('邮箱'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('用户状态'),
            'created_at' =>$this->dateTime()->notNull()->comment('创建时间'),
            'updated_at' =>$this->dateTime()->notNull()->comment('修改时间')
        ], $tableOptions . ' COMMENT="用户主表"');
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
