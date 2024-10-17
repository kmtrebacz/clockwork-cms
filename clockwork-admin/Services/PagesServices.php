<?php

namespace Admin\Services;

require_once __DIR__ . "/BaseService.php";

use Admin\Services\BaseService;

class PagesServices extends BaseService
{
    public function __construct() {
        parent::__construct();
    }

    private function trimAfterLastSlash($input) {
        return substr($input, 0, strrpos($input, '/'));
    }

    public function renameFile(): void {
        if ($_POST["newFileName"] == "") {
            throw new \Exception("New file name is empty!");
        }
        $newFilePath = $this->trimAfterLastSlash($_POST["filePath"]) . "/" . $_POST["newFileName"] . ".html";
        rename($_POST["filePath"], $newFilePath);
        header("Location: /clockwork-admin/pages");
    }
}