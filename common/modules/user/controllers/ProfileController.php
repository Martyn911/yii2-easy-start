<?php
namespace common\modules\user\controllers;

use dektrium\user\models\User;
use dektrium\user\controllers\ProfileController as Profile;
use yii\web\NotFoundHttpException;

class ProfileController extends Profile
{
    /**
     * Redirects to current user's profile.
     *
     * @return \yii\web\Response
     */
    public function actionIndex()
    {
        return $this->redirect(['show', 'username' => \Yii::$app->user->identity->username]);
    }
    /**
     * Shows user's profile.
     *
     * @param $username
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($username) {
        $user = $this->finder->findUserByUsername($username);
        if (!$user)
            throw new NotFoundHttpException('User not found.');

        return parent::actionShow($user->id);
    }

}