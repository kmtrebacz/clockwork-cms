<?php

class PagesServices {
     private function trimAfterLastSlash($input) {
          return substr($input, 0, strrpos($input, '/'));
     }

     public function renameFile(): void {
          $newFilePath = $this->trimAfterLastSlash($_POST["filePath"]) . "/" . $_POST["newFileName"] . ".html";
          rename($_POST["filePath"], $newFilePath);
          header("Location: /clockwork-admin/pages");
     }
}
