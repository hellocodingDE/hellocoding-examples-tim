<?php
spl_autoload_register(function ($module_name) {
    try {
      $module_parts = explode("\\", $module_name);
      if (count($module_parts) >= 1) {
      	if (is_file(__DIR__ . "/" . end($module_parts). '/main.php')) {
      	    include_once __DIR__ . "/" . end($module_parts) . '/main.php';
      	}
      } else {
        throw new Exception("Invalid module name", 1); return;
      }
    } catch (Exception $e) {
      throw new Exception("Something went wrong while import ".$module_name, 1);
      return;
    }
});
