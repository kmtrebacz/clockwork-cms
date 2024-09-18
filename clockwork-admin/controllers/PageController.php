<?php

require_once __DIR__ . '/BaseController.php';

class PagesController extends BaseController {
     private $dir_path = __DIR__ . "/../../clockwork-website/";

     public function __construct() {
          parent::__construct();
     }

     private function getFiles(): array {
          $files = [];
          $dir = opendir($this->dir_path);
          
          while (($fileName = readdir($dir)) !== false) {
               if ($fileName !== '.' && $fileName !== '..') {
                    $filePath = $this->dir_path . $fileName;

                    $resultFileExsist = $this->db->query("SELECT COUNT(*) as count FROM pages WHERE name = ?;", [$fileName]);
                    
                    if ($resultFileExsist[0]['count'] == 0) {
                         $this->db->query("INSERT INTO pages VALUES (?, ?, ?, ?, datetime())", [$fileName, $filePath, null, $_SESSION["user_id"]]);
                    }

                    $resultPageInfo = $this->db->query("SELECT pages.path, pages.url, pages.last_changes, users.username FROM pages JOIN users ON users.rowid = pages.author WHERE pages.name = ?", [$fileName], True);

                    array_push($files, [
                         "name" => $fileName,
                         "path" => $filePath,
                         "url" => $resultPageInfo["path"],
                         "author" => $resultPageInfo["username"],
                         "last_changes" => $resultPageInfo["last_changes"],
                    ]);
               }
          }
          closedir($dir);

          return $files;
     }

     public function render(): void {
          $this->renderTemplate('/pages/pages.twig', [
               'activeNavItem' => 'Pages',
               'pages' => $this->getFiles(),
          ]);
     }
}
