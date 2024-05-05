bootui-typeahead
================
The twitter bootstrap typeahead extension for yii 2 framework

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist moonlandsoft/bootui-typeahead "*"
```

or add

```
"moonlandsoft/bootui-typeahead": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \bootui\typeahead\Typeahead::widget([
        		'source' => ['example','bootui','twitter','typeahead','bootstrap'], 
        		'limit' => 10, 
        		'scrollable' => true,
        		'addon' => ['prepend' => 'Autocomplete'],
        ]); ?>

<?= $form->field($model, 'attribute')
       	->widget(Typeahead::className(),[
        		'source' => ['example','bootui','twitter','typeahead','bootstrap'], 
        		'limit' => 10, 
        		'scrollable' => true,
        		'addon' => ['prepend' => 'Autocomplete'],
        ]) ?>
```