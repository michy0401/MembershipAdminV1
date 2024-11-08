<?php
require_once "controllers/template.controller.php";
require_once "controllers/user.controller.php";
require_once "controllers/customer.controller.php";
require_once "controllers/paymentRecord.controller.php";

require_once "models/user.model.php";
require_once "models/customer.model.php";
require_once "models/paymentRecord.model.php";

$template = new TemplateController();
$template -> ctrTemplate();
