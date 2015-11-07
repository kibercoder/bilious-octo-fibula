<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\generators\crud;

use Yii;
use yii\db\ActiveRecord;
use yii\db\BaseActiveRecord;
use yii\db\Schema;
use yii\gii\CodeFile;
use yii\helpers\Inflector;
use yii\web\Controller;

use yii\helpers\ArrayHelper;


/**
 * Generates CRUD
 *
 * @property array $columnNames Model column names. This property is read-only.
 * @property string $controllerID The controller ID (without the module ID prefix). This property is
 * read-only.
 * @property array $searchAttributes Searchable attributes. This property is read-only.
 * @property boolean|\yii\db\TableSchema $tableSchema This property is read-only.
 * @property string $viewPath The action view file path. This property is read-only.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Generator extends \yii\gii\generators\crud\Generator
{
    public $modelClass;
    public $moduleID;
    public $controllerClass;
    public $baseControllerClass = 'yii\web\Controller';
    public $indexWidgetType = 'grid';
    public $searchModelClass = '';
    public $attrs = array();        

    public $db = 'db';
    
    protected $tableNames;
    protected $classNames;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Upmc CRUD Generator';
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return 'This generator generates a controller and views that implement CRUD (Create, Read, Update, Delete)
            operations for the specified data model.';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['moduleID', 'controllerClass', 'modelClass', 'searchModelClass', 'baseControllerClass'], 'filter', 'filter' => 'trim'],
            [['modelClass', 'controllerClass', 'baseControllerClass', 'indexWidgetType'], 'required'],
            [['searchModelClass'], 'compare', 'compareAttribute' => 'modelClass', 'operator' => '!==', 'message' => 'Search Model Class must not be equal to Model Class.'],
            [['modelClass', 'controllerClass', 'baseControllerClass', 'searchModelClass'], 'match', 'pattern' => '/^[\w\\\\]*$/', 'message' => 'Only word characters and backslashes are allowed.'],

            [['modelClass'], 'validateClass', 'params' => ['extends' => BaseActiveRecord::className()]],
            [['baseControllerClass'], 'validateClass', 'params' => ['extends' => Controller::className()]],

            [['controllerClass'], 'match', 'pattern' => '/Controller$/', 'message' => 'Controller class name must be suffixed with "Controller".'],
            [['controllerClass'], 'match', 'pattern' => '/(^|\\\\)[A-Z][^\\\\]+Controller$/', 'message' => 'Controller class name must start with an uppercase letter.'],
            [['controllerClass', 'searchModelClass'], 'validateNewClass'],
            [['indexWidgetType'], 'in', 'range' => ['grid', 'list']],
            [['modelClass'], 'validateModelClass'],
            [['moduleID'], 'validateModuleID'],
            [['enableI18N'], 'boolean'],
            [['messageCategory'], 'validateMessageCategory', 'skipOnEmpty' => false],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'modelClass' => 'Model Class',
            'moduleID' => 'Module ID',
            'controllerClass' => 'Controller Class',
            'baseControllerClass' => 'Base Controller Class',
            'indexWidgetType' => 'Widget Used in Index Page',
            'searchModelClass' => 'Search Model Class',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function hints()
    {
        return array_merge(parent::hints(), [

            'modelClass' => 'Название модели, все модели нужно создавать в директории common/models, таким образом в данном поле мы указываем значение <code>common\models\Modelname</code>.',

            'controllerClass' => 'Здесь мы указываем адрес класса создаваемого контроллера, нужно не забыть указать также группу контроллера (post, user, feedback и т.д.), например <code>app\controllers\post\PostController</code>.',
            'baseControllerClass' => 'This is the class that the new CRUD controller class will extend from.
                You should provide a fully qualified class name, e.g., <code>yii\web\Controller</code>.',
            'moduleID' => 'This is the ID of the module that the generated controller will belong to.
                If not set, it means the controller will belong to the application.',
            'indexWidgetType' => 'This is the widget type to be used in the index page to display list of the models.
                You may choose either <code>GridView</code> or <code>ListView</code>',
            'searchModelClass' => 'This is the name of the search model class to be generated. You should provide a fully
                qualified namespaced class name, e.g., <code>app\models\PostSearch</code>.',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return ['controller.php'];
    }

    /**
     * @inheritdoc
     */
    public function stickyAttributes()
    {
        return array_merge(parent::stickyAttributes(), ['baseControllerClass', 'moduleID', 'indexWidgetType']);
    }

    /**
     * Checks if model class is valid
     */
    public function validateModelClass()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        $pk = $class::primaryKey();
        if (empty($pk)) {
            $this->addError('modelClass', "The table associated with $class must have primary key(s).");
        }
    }

    /**
     * Checks if model ID is valid
     */
    public function validateModuleID()
    {
        if (!empty($this->moduleID)) {
            $module = Yii::$app->getModule($this->moduleID);
            if ($module === null) {
                $this->addError('moduleID', "Module '{$this->moduleID}' does not exist.");
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        $controllerFile = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->controllerClass, '\\')) . '.php');

        $files = [
            new CodeFile($controllerFile, $this->render('controller.php')),
        ];

        if (!empty($this->searchModelClass)) {
            $searchModel = Yii::getAlias('@' . str_replace('\\', '/', ltrim($this->searchModelClass, '\\') . '.php'));
            $files[] = new CodeFile($searchModel, $this->render('search.php'));
        }

        $viewPath = $this->getViewPath();

        $templatePath = $this->getTemplatePath() . '/views';

        foreach (scandir($templatePath) as $file) {
            if (empty($this->searchModelClass) && $file === '_search.php') {
                continue;
            }
            if (is_file($templatePath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $files[] = new CodeFile("$viewPath/$file", $this->render("views/$file"));
            }
        }

        return $files;
    }

    /**
     * @return string the controller ID (without the module ID prefix)
     */
    public function getControllerID()
    {
        $pos = strrpos($this->controllerClass, '\\');
        $class = substr(substr($this->controllerClass, $pos + 1), 0, -10);

        return Inflector::camel2id($class);
    }

    /**
     * @return string the action view file path
     */
    public function getViewPath()
    {
        $module = empty($this->moduleID) ? Yii::$app : Yii::$app->getModule($this->moduleID);

        // Remove backend\controllers
        $parts = explode( 'controllers\\', $this->controllerClass);
        $str = end( $parts );

        // Remove Controller postfix
        $str = preg_replace('~Controller$~', '', $str);

        // Rebuild

        // first\FirstSecond => first\-first-second
        $controller = Inflector::camel2id($str);

        // first\-first-second => first\first-second
        $controller = str_replace('\\-','\\', $controller);

        // first\first-second => first/first-second
        $controller = str_replace('\\','/', $controller);

        return $module->getViewPath() . '/' . $controller ;
    }

    public function getNameAttribute()
    {
        foreach ($this->getColumnNames() as $name) {
            if (!strcasecmp($name, 'name') || !strcasecmp($name, 'title')) {
                return $name;
            }
        }
        /** @var \yii\db\ActiveRecord $class */
        $class = $this->modelClass;
        $pk = $class::primaryKey();

        return $pk[0];
    }

    /**
     * @return Connection the DB connection as specified by [[db]].
     */
    protected function getDbConnection()
    {
        return Yii::$app->get($this->db, false);
    }


    /**
     * Generates code for active field
     * @param string $attribute
     * @return string
     */
    public function generateActiveField($attribute, $searchField = false)
    {
        $model = new $this->modelClass();
        $attributeLabels = $model->attributeLabels();
        $tableSchema = $this->getTableSchema();
        $tableName = $model::tableName();

        // Генерим виджет m2m т.е. выподнающий список для множественной выборки
        if ( !in_array($attribute, $this->attrs) && substr($attribute, -5, 5) == '_list' ){

            //в ПОИСКЕ НЕ УЧАВСТВУЕТ
            if( $searchField ){
                return null;
            }
            
            //Вырезаем _list
            $prefClass = substr($attribute, 0, -5);                   

            $db = $this->getDbConnection();
            
            if (($pos = strpos($tableName, '.')) !== false) {
                $schemaName = substr($tableName, 0, $pos);
            } else {
                $schemaName = '';
            }
            //В этом цикле нам нужно получить имя класса той модели с которой у нас связь m2m
            foreach ($db->getSchema()->getTableSchemas($schemaName) as $table) {
                //Тут мы просто обходим все таблицы и ищем нужную нам m2m таблицу
                //checkPivotTable - проверяет есть ли 2 первичных ключа (из них состоят таблицы m2m)
                if (stripos($table->name,"{$tableName}_has_")!==false
                  AND $this->checkPivotTable($table) !== false){
                    
                    //Берём всю схему ДЛЯ НАШЕЙ ТАБЛИЦЫ в виде массива
                    $tSchema = (array)$db->getTableSchema($table->name);
                    
                    //Из неё выбираем только foreignKeys
                    foreach($tSchema['foreignKeys'] as $k=>$v){
                        if ($v[0]!= $tableName) {
                            //Тут выбираем ключ второго значения массива
                            //Так как массива ассаотивный то по ключу значение не найти
                            //Поэтому используем array_keys(array_slice())
                            $linkToPk = array_keys(array_slice($tSchema['foreignKeys'][0],1));
                            
                            //Генерим имя класс из имени таблицы
                            $className = $this->generateClassName($tableName);
                            
                            //Тут получаем строку которая отвечает за префикс для работы с типами _list
                            $prefClass2 = lcfirst($this->generateRelationName(array(),$className, $db->getTableSchema($tableName), $linkToPk[0], true));
                            
                            //Если префикс равен исходному префиксу из модели $prefClass
                            if ($prefClass==$prefClass2) {
                              
                              $linkedClass = '\common\models\\'.$this->generateClassName($v[0]);
                              break;
                            
                            }
                            
                        }
                    }
                    
                    
                }
            }
            
                                
            $linkedModel = new $linkedClass();
            $linkedAttrs = $linkedModel->attributes();

            $nameField = 'id';
            $nameField = in_array('title', $linkedAttrs) ? 'title' : $nameField;
            $nameField = in_array('name', $linkedAttrs) ? 'name' : $nameField;
            
            if ($nameField=='id') {
              foreach($linkedAttrs as $f){
                if($f!='id') {
                  $nameField = $f; break;
                }
              }
            }

            $this->attrs[] = $attribute;

            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( ".$linkedClass."::find()->all(), 'id', '".$nameField."'),
                    'options' => ['placeholder' => 'Выбрать...', 'multiple' => true,],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10,
                    ],
                ],
            ],";

        } else if (substr($attribute, -5, 5) == '_list') {
            return null;
        }

        if ($tableSchema === false || !isset($tableSchema->columns[$attribute])) {
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $attribute)) {

                if( $searchField ){
                    return null;
                }

                return "'$attribute'=>['type'=> TabularForm::INPUT_PASSWORD,'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...']],";
                //return "\$form->field(\$model, '$attribute')->passwordInput()";
            } else {
                return "'$attribute'=>['type'=> TabularForm::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...']],";
                //return "\$form->field(\$model, '$attribute')";
            }
        }

        $column = $tableSchema->columns[$attribute];

        // checkbox
        if ( substr($column->name, -5,5) == '_flag') {

            return "'$attribute'=>['type'=> Form::INPUT_CHECKBOX, 'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...']],";
        }

        if ( $column->name == 'phone' || substr($column->name, -6,6) == '_phone' ) {
            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => yii\widgets\MaskedInput::className(),
                'options' => [
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...'
                    ],
                    'mask' => '+7(999)999-99-99',
                    'clientOptions' => [
                        'clearIncomplete' => " . ( $searchField ? 'false' : 'true' ) . ",
                    ]
                ]
            ],";
        }
        elseif ( substr($column->name, -6,6) == '_index') {

            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => (new " . $this->modelClass . ")->get" . Inflector::id2camel($column->name, '_') . "List(),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],";

        }
        elseif ( substr($column->name, -5, 5) == '_file') {

            if ( $searchField ){
                return false;
            }

            /* Old way generate files fields
            return "'$attribute'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  //'accept' => 'image/*',
                  'allowedFileExtensions' => ['doc', 'docx', 'pdf', 'xls', 'xlsx'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => \$model->getUploadUrl('$attribute')
                      ? \$model->getUploadUrl('$attribute')
                      : false,
                  'maxFileCount' => 1
              ]
          ]
      ],";*/

            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => InputFile::className(),
                'options' => [
                    'language'      => 'ru',
                    'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                    'filter'        => ['text', 'application'],    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                    'options'       => ['class' => 'form-control'],
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'multiple'      => false,       // возможность выбора нескольких файлов
                    'path'          => 'docs',
                    'show_preview'   => false
                ],
            ],";

        }
        elseif ( substr($column->name, -6, 6) == '_image') {

            if ( $searchField ){
                return false;
            }

            /*Old way generate image fields
            return "'$attribute'=>[
          'type'=> Form::INPUT_WIDGET,
          'widgetClass' => kartik\widgets\FileInput::className(),
          'options' => [
              'pluginOptions' => [
                  'accept' => 'image/*',
                  'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                  'showRemove' => false,
                  'showUpload' => false,
                  'initialPreview' => \$model->getUploadUrl('$attribute')
                      ? Html::img(\$model->getUploadUrl('$attribute'), ['class' => 'file-preview-image'])
                      : false,
                  'maxFileCount' => 1
              ]
          ]
      ],";*/

          return "'$attribute'=>[
                    'type'=> Form::INPUT_WIDGET,
                    'widgetClass' => InputFile::className(),
                    'options' => [
                        'language'      => 'ru',
                        'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
                        'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
                        'options'       => ['class' => 'form-control'],
                        'buttonOptions' => ['class' => 'btn btn-default'],
                        'multiple'      => false,       // возможность выбора нескольких файлов
                        'path'          => 'image',
                    ]
          ],";

        }
        elseif ( $column->name == 'body' || $column->type === 'text' ){

            if ( $searchField ){
                return false;
            }

            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass'=>Redactor::className(),
                'options' => [
                    'filemanager' => ['webpath' => '/'],
                    'options'=>['placeholder'=>yii::t('app', 'Enter').' Полное описание...','rows'=> 6],
                ],
            ],";

        }
        elseif ( $column->name == 'user_id') {
            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( common\models\User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],";
        }
        elseif ( substr($column->name, -3, 3) == '_id') {

            $modelName = $this->modelClass;
            $object = new $modelName;

            $foreignName = ucfirst( Inflector::id2camel(substr($column->name, 0, -3), '_') );
            $method = 'get' . $foreignName;

            // Если метода извлечения внешнего объекта не существует - делаем текстовым полем
            if( !method_exists( $object, $method ) ){
                return "'$attribute'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...', 'maxlength'=>".$column->size."]],";
            }

            $foreignClass = $object->$method()->modelClass;
            $foreignModel = new $foreignClass();
            $foreignAttrs = $foreignModel->attributes();

            $nameField = 'id';
            $nameField = in_array('title', $foreignAttrs) ? 'title' : $nameField;
            $nameField = in_array('name', $foreignAttrs) ? 'name' : $nameField;

            return "'$attribute'=>[
                'type'=> Form::INPUT_WIDGET,
                'widgetClass' => kartik\widgets\Select2::className(),
                'options' => [
                    'data' => ArrayHelper::map( ".$foreignClass."::find()->all(), 'id', '". $nameField."'),
                    'options' => ['placeholder' => 'Выбрать...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],";
        }
        elseif ($column->phpType === 'boolean') {

            //return "\$form->field(\$model, '$attribute')->checkbox()";
            return "'$attribute'=>['type'=> Form::INPUT_CHECKBOX, 'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...']],";

/*
        } elseif ($column->type === 'text') {

            //return "\$form->field(\$model, '$attribute')->textarea(['rows' => 6])";
            return "'$attribute'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter').' ".$attributeLabels[$attribute]."...','rows'=> 6]],";
*/

        } elseif( substr($column->name, -5,5) == '_date'){

            $prefix = $searchField ? '//' : '';

            return $prefix."'$attribute'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]],";

        } elseif( substr($column->name, -9,9) == '_datetime'){

            $prefix = $searchField ? '//' : '';

            return $prefix . "'$attribute'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]],";

        } elseif( substr($column->name, -5,5) == '_time' ){

            $prefix = $searchField ? '//' : '';

            return $prefix."'$attribute'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_TIME]],";

/*
        } elseif($column->type === 'datetime' || $column->type === 'timestamp'){

            return "'$attribute'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATETIME]],";

*/

        }else{
            if (preg_match('/^(password|pass|passwd|passcode)$/i', $column->name)) {
                $input = 'INPUT_PASSWORD';
            } else {
                $input = 'INPUT_TEXT';
            }

            if($column->name != 'title' && $column->name != 'tag' && $column->name != 'author' ){
              $prefix = $searchField ? '//' : '';
            } else {
              $prefix = '';
            }

            if ($column->phpType !== 'string' || $column->size === null) {
                //return "\$form->field(\$model, '$attribute')->$input()";

                return $prefix."'$attribute'=>['type'=> Form::".$input.", 'options'=>['placeholder'=> yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...']],";
                
            } else {
                //return "\$form->field(\$model, '$attribute')->$input(['maxlength' => $column->size])";
                return $prefix."'$attribute'=>['type'=> Form::".$input.", 'options'=>['placeholder'=>yii::t('app', 'Enter').' ".$attributeLabels[$attribute]."...', 'maxlength'=>".$column->size."]],";
            }
        }

    }

    /**
     * Generates code for active search field
     * @param string $attribute
     * @return string
     */
    public function generateActiveSearchField($attribute)
    {

        return $this->generateActiveField($attribute, true);

        /*
        $tableSchema = $this->getTableSchema();
        if ($tableSchema === false) {
            return "\$form->field(\$model, '$attribute')";
        }
        $column = $tableSchema->columns[$attribute];
        if ($column->phpType === 'boolean') {
            return "\$form->field(\$model, '$attribute')->checkbox()";
        } else {
            return "\$form->field(\$model, '$attribute')";
        }*/
    }

    /**
     * Generates column format
     * @param \yii\db\ColumnSchema $column
     * @return string
     */
    public function generateColumnFormat($column)
    {
        if ($column->phpType === 'boolean') {
            return 'boolean';
        } elseif ($column->type === 'text') {
            return 'ntext';
        } elseif (stripos($column->name, 'time') !== false && $column->phpType === 'integer') {
            return 'datetime';
        } elseif (stripos($column->name, 'email') !== false) {
            return 'email';
        } elseif (stripos($column->name, 'url') !== false) {
            return 'url';
        } else {
            return 'text';
        }
    }

    /**
     * Generates validation rules for the search model.
     * @return array the generated validation rules
     */
    public function generateSearchRules()
    {
        if (($table = $this->getTableSchema()) === false) {
            return ["[['" . implode("', '", $this->getColumnNames()) . "'], 'safe']"];
        }
        $types = [];
        foreach ($table->columns as $column) {
            switch ($column->type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                    $types['integer'][] = $column->name;
                    break;
                case Schema::TYPE_BOOLEAN:
                    $types['boolean'][] = $column->name;
                    break;
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                    $types['number'][] = $column->name;
                    break;
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                default:
                    $types['safe'][] = $column->name;
                    break;
            }
        }

        $rules = [];
        foreach ($types as $type => $columns) {
            $rules[] = "[['" . implode("', '", $columns) . "'], '$type']";
        }

        return $rules;
    }

    /**
     * @return array searchable attributes
     */
    public function getSearchAttributes()
    {
        return $this->getColumnNames();
    }

    /**
     * Generates the attribute labels for the search model.
     * @return array the generated attribute labels (name => label)
     */
    public function generateSearchLabels()
    {
        /** @var \yii\base\Model $model */
        $model = new $this->modelClass();
        $attributeLabels = $model->attributeLabels();
        $labels = [];
        foreach ($this->getColumnNames() as $name) {
            if (isset($attributeLabels[$name])) {
                $labels[$name] = $attributeLabels[$name];
            } else {
                if (!strcasecmp($name, 'id')) {
                    $labels[$name] = 'ID';
                } else {
                    $label = Inflector::camel2words($name);
                    if (strcasecmp(substr($label, -3), ' id') === 0) {
                        $label = substr($label, 0, -3) . ' ID';
                    }
                    $labels[$name] = $label;
                }
            }
        }

        return $labels;
    }

    /**
     * Generates search conditions
     * @return array
     */
    public function generateSearchConditions()
    {
        $columns = [];
        if (($table = $this->getTableSchema()) === false) {
            $class = $this->modelClass;
            /** @var \yii\base\Model $model */
            $model = new $class();
            foreach ($model->attributes() as $attribute) {
                $columns[$attribute] = 'unknown';
            }
        } else {
            foreach ($table->columns as $column) {
                $columns[$column->name] = $column->type;
            }
        }

        $likeConditions = [];
        $hashConditions = [];
        foreach ($columns as $column => $type) {
            switch ($type) {
                case Schema::TYPE_SMALLINT:
                case Schema::TYPE_INTEGER:
                case Schema::TYPE_BIGINT:
                case Schema::TYPE_BOOLEAN:
                case Schema::TYPE_FLOAT:
                case Schema::TYPE_DECIMAL:
                case Schema::TYPE_MONEY:
                case Schema::TYPE_DATE:
                case Schema::TYPE_TIME:
                case Schema::TYPE_DATETIME:
                case Schema::TYPE_TIMESTAMP:
                    $hashConditions[] = "'{$column}' => \$this->{$column},";
                    break;
                default:
                    $likeConditions[] = "->andFilterWhere(['like', '{$column}', \$this->{$column}])";
                    break;
            }
        }

        $conditions = [];
        if (!empty($hashConditions)) {
            $conditions[] = "\$query->andFilterWhere([\n"
                . str_repeat(' ', 12) . implode("\n" . str_repeat(' ', 12), $hashConditions)
                . "\n" . str_repeat(' ', 8) . "]);\n";
        }
        if (!empty($likeConditions)) {
            $conditions[] = "\$query" . implode("\n" . str_repeat(' ', 12), $likeConditions) . ";\n";
        }

        return $conditions;
    }

    /**
     * Generates URL parameters
     * @return string
     */
    public function generateUrlParams()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        $pks = $class::primaryKey();
        if (count($pks) === 1) {
            if (is_subclass_of($class, 'yii\mongodb\ActiveRecord')) {
                return "'id' => (string)\$model->{$pks[0]}";
            } else {
                return "'id' => \$model->{$pks[0]}";
            }
        } else {
            $params = [];
            foreach ($pks as $pk) {
                if (is_subclass_of($class, 'yii\mongodb\ActiveRecord')) {
                    $params[] = "'$pk' => (string)\$model->$pk";
                } else {
                    $params[] = "'$pk' => \$model->$pk";
                }
            }

            return implode(', ', $params);
        }
    }

    /**
     * Generates action parameters
     * @return string
     */
    public function generateActionParams()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        $pks = $class::primaryKey();
        if (count($pks) === 1) {
            return '$id';
        } else {
            return '$' . implode(', $', $pks);
        }
    }

    /**
     * Generates parameter tags for phpdoc
     * @return array parameter tags for phpdoc
     */
    public function generateActionParamComments()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        $pks = $class::primaryKey();
        if (($table = $this->getTableSchema()) === false) {
            $params = [];
            foreach ($pks as $pk) {
                $params[] = '@param ' . (substr(strtolower($pk), -2) == 'id' ? 'integer' : 'string') . ' $' . $pk;
            }

            return $params;
        }
        if (count($pks) === 1) {
            return ['@param ' . $table->columns[$pks[0]]->phpType . ' $id'];
        } else {
            $params = [];
            foreach ($pks as $pk) {
                $params[] = '@param ' . $table->columns[$pk]->phpType . ' $' . $pk;
            }

            return $params;
        }
    }

    /**
     * Returns table schema for current model class or false if it is not an active record
     * @return boolean|\yii\db\TableSchema
     */
    public function getTableSchema()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        if (is_subclass_of($class, 'yii\db\ActiveRecord')) {
            return $class::getTableSchema();
        } else {
            return false;
        }
    }

    /**
     * @return array model column names
     */
    public function getColumnNames()
    {
        /** @var ActiveRecord $class */
        $class = $this->modelClass;
        if (is_subclass_of($class, 'yii\db\ActiveRecord')) {
            return $class::getTableSchema()->getColumnNames();
        } else {
            /** @var \yii\base\Model $model */
            $model = new $class();

            return $model->attributes();
        }
    }
    
    
    /**
     * Checks if the given table is a junction table.
     * For simplicity, this method only deals with the case where the pivot contains two PK columns,
     * each referencing a column in a different table.
     * @param \yii\db\TableSchema the table being checked
     * @return array|boolean the relevant foreign key constraint information if the table is a junction table,
     * or false if the table is not a junction table.
     */
    protected function checkPivotTable($table)
    {
        $pk = $table->primaryKey;

        if (count($pk) !== 2) {
            return false;
        }

        $fks = [];
        foreach ($table->foreignKeys as $refs) {
            if (count($refs) === 2) {
                if (isset($refs[$pk[0]])) {
                    $fks[$pk[0]] = [$refs[0], $refs[$pk[0]]];
                } elseif (isset($refs[$pk[1]])) {
                    $fks[$pk[1]] = [$refs[0], $refs[$pk[1]]];
                }
            }
        }

        //print_r($fks);die;

        if (count($fks) === 2 && $fks[$pk[0]][0] !== $fks[$pk[1]][0]) {
            return $fks;
        } else {
            return false;
        }
    }
    
    /**
     * Generates a class name from the specified table name.
     * @param string $tableName the table name (which may contain schema prefix)
     * @return string the generated class name
     */
    protected function generateClassName($tableName)
    {
        if (isset($this->classNames[$tableName])) {
            return $this->classNames[$tableName];
        }
      
        if (($pos = strrpos($tableName, '.')) !== false) {
            $tableName = substr($tableName, $pos + 1);
        }

        $db = $this->getDbConnection();
        $patterns = [];
        $patterns[] = "/^{$db->tablePrefix}(.*?)$/";
        $patterns[] = "/^(.*?){$db->tablePrefix}$/";
        if (strpos($tableName, '*') !== false) {
            $pattern = $tableName;
            if (($pos = strrpos($pattern, '.')) !== false) {
                $pattern = substr($pattern, $pos + 1);
            }
            $patterns[] = '/^' . str_replace('*', '(\w+)', $pattern) . '$/';
        }
        
        $className = $tableName;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $tableName, $matches)) {
                $className = $matches[1];
                break;
            }
        }

        return $this->classNames[$tableName] = Inflector::id2camel($className, '_');
    }
    
    /**
     * Generate a relation name for the specified table and a base name.
     * @param array $relations the relations being generated currently.
     * @param string $className the class name that will contain the relation declarations
     * @param \yii\db\TableSchema $table the table schema
     * @param string $key a base name that the relation name may be generated from
     * @param boolean $multiple whether this is a has-many relation
     * @return string the relation name
     */
    protected function generateRelationName($relations, $className, $table, $key, $multiple)
    {
        if (!empty($key) && substr_compare($key, 'id', -2, 2, true) === 0 && strcasecmp($key, 'id')) {
            $key = rtrim(substr($key, 0, -2), '_');
        }
        if ($multiple) {
            $key = Inflector::pluralize($key);
        }
        $name = $rawName = Inflector::id2camel($key, '_');
        $i = 0;
        while (isset($table->columns[lcfirst($name)])) {
            $name = $rawName . ($i++);
        }
        while (isset($relations[$className][lcfirst($name)])) {
            $name = $rawName . ($i++);
        }

        return $name;
    }
    
    
}
