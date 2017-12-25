<?php

namespace swilson1337\sceditor;

class SCEditorAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@bower/sceditor';
	
	public $js = [
		'minified/jquery.sceditor.bbcode.min.js',
	];
	
	public $css = [
		'minified/themes/default.min.css',
	];
}
