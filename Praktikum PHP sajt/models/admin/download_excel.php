<?php

include "export_excel.php";

ob_clean();
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=download.xlsx");

readfile(ABSOLUTE_PATH."/models/admin/Products.xlsx");