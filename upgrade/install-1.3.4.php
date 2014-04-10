<?php

if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_1_3_4($module)
{
	if (Tools::file_exists_cache($module->getLocalPath() . 'img'))
		recurseCopy($module->getLocalPath() . 'img', $module->getLocalPath() . 'images', true);

	Tools::clearCache(Context::getContext()->smarty, $module->getTemplatePath('homeslider.tpl'));

	return true;
}

if (!function_exists('recurseCopy'))
{
	function recurseCopy($src, $dst, $del = false)
	{
		$dir = opendir($src);

		if (!Tools::file_exists_cache($dst))
			mkdir($dst);
		while (false !== ($file = readdir($dir))) {
			if (($file != '.') && ($file != '..')) {
				if (is_dir($src . DIRECTORY_SEPARATOR . $file))
					recurseCopy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file, $del);
				else {
					copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
					if ($del && is_writable($src . DIRECTORY_SEPARATOR . $file))
						unlink($src . DIRECTORY_SEPARATOR . $file);
				}
			}
		}
		closedir($dir);
		if ($del && is_writable($src))
			rmdir($src);
	}
}