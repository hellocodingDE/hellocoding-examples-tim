<?php


  /**
  * @author Tim Riedl uVulpos <contact@tim-riedl.de>
  * @license MIT
  * @source https://github.com/uvulpos/hellocoding-examples
  * @version 08.2020
  */
  class DownloadFile
  {
    public function __construct() { }

    public function download_file(string $filename, ?string $browserfilename = null) {
      if (is_file($filename) and is_readable($filename)) {
        header('Content-Type: '.$this->get_content_type($filename));
        header('Content-Disposition: attachment; filename="'.basename((!empty($browserfilename)) ? $browserfilename : $filename).'"');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
      }
    }

    public function download_string($content, $browserfilename, $content_type) {
        header('Content-Type: '.$content_type);
        header('Content-Disposition: attachment; filename="'. $browserfilename .'"');
        header('Content-Length: ' . strlen($content)*8);
        file_put_contents("php://output", $content);
    }

    private function get_content_type(string $filename) {
      $finfo = new \finfo(FILEINFO_MIME_TYPE);
      return $finfo->file($filename);
    }

  }

  $test = new DownloadFile();
  $test->download_file('/path/to/index.php', 'test.php');
