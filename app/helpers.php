<?php
/**
 * Created by PhpStorm.
 * User: huangyaokui
 * Date: 16/1/25
 * Time: 上午11:55
 */

if (! function_exists('configPath')){

	function configPath($path = '')
	{
		return app()->basePath() . '/config' . ($path ? '/'.$path: $path);
	}
}