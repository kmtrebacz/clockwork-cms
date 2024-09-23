<?php

class PagesServices {
     public function renameFile($post): void {
          rename($post["fileName"], $post["newFileName"]);
     }
}
