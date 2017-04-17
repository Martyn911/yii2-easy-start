<?php
namespace console\controllers;
/*
* Резервная копия базы данных
* Автор Сергей Мартыненко
* martyn911@i.ua
*/
use Yii;
use yii\console\Controller;
use yii\helpers\FileHelper;

Class DbController extends Controller{

    public function actionImport($path = null) {
        if(!$path) {
            $path = Yii::getAlias('@runtime/dump.sql');
        }
        if (file_exists($path)) {
            $db = Yii::$app->getDb();
            if (!$db) {
                echo 'Нет подключения к базе данных.' . "\n";
                return false;
            }
            //Экранируем скобку которая есть в пароле
            $db->password = str_replace("(","\(",$db->password);
            exec('mysql --host=' . $this->getDsnAttribute('host', $db->dsn) . ' --user=' . $db->username . ' --password=' . $db->password . ' ' . $this->getDsnAttribute('dbname', $db->dsn) . ' < ' . $path);
            echo 'Дамп ' . $path . ' успешно импортирован.' . "\n";
        } else {
            echo 'Указанный путь не существует.' . "\n";
        }
    }

    public function actionExport($path = null) {
        if(!$path) {
            $path = $path = Yii::getAlias('@runtime');
        }
        $path = FileHelper::normalizePath(Yii::getAlias($path));
        if (!file_exists($path)) {
            if(!mkdir($path, 0777)){
                echo 'Не удалось создать директорию: ' . $path . "\n";
                return false;
            }
        }
        if (is_dir($path)) {
            if (!is_writable($path)) {
                echo 'Дирректория не доступна для записи.' . "\n";
                return false;
            }
            $fileName = 'dump.sql';
            $filePath = $path . DIRECTORY_SEPARATOR . $fileName;
            $db = Yii::$app->getDb();
            if (!$db) {
                echo 'Нет подключения к базе данных.' . "\n";
                return false;
            }
            //Экранируем скобку которая есть в пароле
            $db->password = str_replace("(","\(",$db->password);
            exec('mysqldump --host=' . $this->getDsnAttribute('host', $db->dsn) . ' --user=' . $db->username . ' --password=' . $db->password . ' ' . $this->getDsnAttribute('dbname', $db->dsn) . ' --skip-add-locks > ' . $filePath);
            echo 'Экспорт успешно завершен. Файл "'.$fileName.'" в папке ' . $path . "\n";
        } else {
            echo 'Путь должен быть папкой.' . "\n";
        }

    }

    //Возвращает название хоста (например localhost)
    private function getDsnAttribute($name, $dsn) {
        if (preg_match('/' . $name . '=([^;]*)/', $dsn, $match)) {
            return $match[1];
        } else {
            return null;
        }
    }
    public function delete($path) {
        if (file_exists($path)) {
            $path = \yii\helpers\Html::encode($path);
            unlink($path);
            echo 'Дамп БД удален.' . "\n";
        } else {
            echo 'Указанный путь не существует.' . "\n";
        }
    }

}

