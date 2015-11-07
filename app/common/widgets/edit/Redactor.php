<?php

//Подключаем пространство имён
namespace common\widgets\edit;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

// Tiny mce
use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;

// popup
use yii\bootstrap\Modal;

// assets
use mihaildev\elfinder\AssetsCallBack;

//Создаём свой класс именем текущего файла
class Redactor extends \yii\bootstrap\Widget{

    public $model = null;
    public $attribute = null;

    // TinyMce Options
    public $options = [];
    public $clientOptions = [];
    public $language = 'ru';

    // elfinder options
    public $filemanager = ['webpath' => '/'];

    /**
     * Инициализация виджета
     */
    public function init(){

        parent::init();

        // Интегрируем elfinder
        $this->clientOptions['file_browser_callback'] = new JsExpression("elFinderBrowser");

        // Опции редактора
        $this->clientOptions['plugins'] = [
            'image',
            'advlist autolink lists link charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste',
        ];

        $this->clientOptions['toolbar'] = "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image";
        
        if (!isset($this->clientOptions['menubar'])) $this->clientOptions['menubar'] = false;
    }

    //Метод который по умолчанию запустит наш виджет, можнео его удалить и всё будет работать
    //так как мы наследуем родной класс виджета
    //А тут мы просто переопределяем метод для запуска run
    public function run()
    {
        // Добавляем callback метод elfinder
        AssetsCallBack::register($this->getView());

        $this->getView()->registerJs(
            "mihaildev.elFinder.register('elFinderInsertImage', function(file, id) {
                  tinymce.activeEditor.windowManager.getParams().setUrl(file.url);
                  tinymce.activeEditor.windowManager.close();
            });

            function elFinderBrowser (field_name, url, type, win) {
              tinymce.activeEditor.windowManager.open({
                file: '/admin/elfinder/manager?callback=elFinderInsertImage&lang=ru&path={$this->filemanager['webpath']}',
                title: 'Менеджер файлов',
                width: 900,
                height: 450,
                resizable: 'yes'
              }, {
                setUrl: function (url) {

                  var reg = /\/[^/]+?\/\.\.\//;
                  //var info = file.name;

                  while(url.match(reg)) {
                    url = url.replace(reg, '/');
                  }

                  win.document.getElementById(field_name).value = url;
                }
              });
              return false;
            }");

        echo TinyMce::widget([
            'attribute' => $this->attribute,
            'model' => $this->model,
            'options'=> $this->options,
            'language' => $this->language,
            'clientOptions' => $this->clientOptions
        ]);

    }


}

?>
