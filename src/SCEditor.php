<?php

namespace swilson1337\sceditor;

use yii\helpers\Html;
use yii\helpers\Json;
use swilson1337\sceditor\SCEditorAsset;
use yii\helpers\ArrayHelper;

class SCEditor extends \yii\widgets\InputWidget
{
	public $clientOptions = [];
	
	private static $_defaultClientOptions = [
		'width' => '100%',
		'plugins' => [
			'bbcode',
		],
	];
	
	public function init()
	{
		$this->clientOptions = ArrayHelper::merge(static::$_defaultClientOptions, $this->clientOptions);
		
		parent::init();
	}
	
	public function run()
	{
		if ($this->hasModel())
		{
			echo Html::activeTextarea($this->model, $this->attribute, $this->options);
		}
		else
		{
			echo Html::textarea($this->name, $this->value, $this->options);
		}
		
		$this->registerClientScript();
	}
	
	protected function registerClientScript()
	{
		$assetBundle = SCEditorAsset::register($this->view);
		
		if (empty($this->clientOptions['emoticonsRoot']))
		{
			$this->clientOptions['emoticonsRoot'] = $assetBundle->baseUrl.'/';
		}
		
		if (empty($this->clientOptions['style']))
		{
			$this->clientOptions['style'] = $assetBundle->baseUrl.'/minified/jquery.sceditor.default.min.css';
		}
		
		$this->view->registerJs('$("#'.$this->options['id'].'").sceditor('.Json::encode($this->clientOptions).');');
	}
}
