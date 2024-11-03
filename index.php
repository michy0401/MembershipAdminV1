<?php
require_once "controllers/template.controller.php";
require_once "controllers/user.controller.php";
require_once "controllers/product.controller.php";

require_once "models/user.model.php";
require_once "models/product.model.php";

$template = new TemplateController();
$template -> ctrTemplate();
