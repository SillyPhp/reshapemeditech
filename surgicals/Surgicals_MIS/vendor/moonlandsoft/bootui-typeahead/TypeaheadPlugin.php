<?php
namespace bootui\typeahead;

use yii\web\AssetBundle;
/**
 * Bootstrap Asset Bundle
 * @author Moh Khoirul Anam <moh.khoirul.anaam@gmail.com>
 * @copyright moonlandsoft 2014
 * @since 1
 */
class TypeaheadPlugin extends AssetBundle
{
	public $sourcePath = '@bootui/typeahead/assets';

	public $css = [
			'css/typeahead.css',
	];

	public $js = [
			'js/typeahead.js',
	];

	public $depends = [
			'yii\web\JqueryAsset',
	];
}