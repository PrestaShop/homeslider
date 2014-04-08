<?php

if (!defined('_PS_VERSION_'))
	exit;

function upgrade_module_1_3_2($module)
{
	if (Tools::file_exists_cache($module->getLocalPath().'images'))
		Tools::recurseCopy($module->getLocalPath().'images', $module->getLocalPath().'img', true);

	Tools::clearCache(Context::getContext()->smarty, $module->getTemplatePath('homeslider.tpl'));

	return true;
}