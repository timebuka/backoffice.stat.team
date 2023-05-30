<?php
namespace frontend\models\auth;

use Yii;
use yii\mongodb\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $_id
 * @property string $username
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function getDb()
    {
        return Yii::$app->mongodb;
    }

    public static function collectionName()
    {
        return 'users';
    }

    public static function findByUsername($username)
    {
        return User::findOne(["username" => $username]);
    }

    public function attributes()
    {
        return ['_id', 'username', 'password', 'auth_key'];
    }

    public function rules()
    {
        return [
            [['_id', 'username', 'password', 'auth_key'], 'safe']
        ];
    }

    public static function findIdentity($id)
    {
        if ($id === (array) $id && isset($id['$oid'])) $id = $id['$oid'];

        return static::findOne(['_id' => $id]);
    }

    public function getId()
    {
        return $this->_id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password)
    {
        if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }
    
}
