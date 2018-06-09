<?php
/**
 * Description of Dirlinks
 *
 * @author mark weisser <mark at whizbangdevelopers.com>
 */
class Dirlinks {
	function show($path) {
		$dir_iterator = new RecursiveDirectoryIterator($path,
			RecursiveDirectoryIterator::SKIP_DOTS);
		$directory_count = 0;
		$not = ['dirlinks', 'nbproject', 'local', 'lost+found', '.Trash-0', '.Trash-1000'];
		$ext = ['com', 'info', 'net', 'dev', 'local'];
		$ds = DIRECTORY_SEPARATOR;

		foreach ($dir_iterator as $directories) {
			if ($directories->isDir() === TRUE and in_array($directories->getExtension(), $ext) and !in_array($directories->getFilename(), $not) and !$directories->isLink()) {
				$directoryin = end(explode($ds, $directories));
				$dirArray[] = $directoryin;
			}
		}
		sort($dirArray);
		foreach ($dirArray as $directory) {
			$directory_count = $directory_count + 1;
			if ($directory_count == 1) {
				echo '<div class="container"><div class="column-a">';
			}
			echo "<li><a href=http://$directory target=\"_blank\">$directory</a></li>";
			if ($directory_count == 12) {
				echo '</div><div class="column-b">';
			}
			if ($directory_count == 24) {
				echo "</div></div>";
				$directory_count = 0;
			}
		}
		echo "</div></div>";
	}

	function header($path, $host) {
		echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><title>'
		. ucfirst(end(explode(DIRECTORY_SEPARATOR, $path)))
		. ' Index</title><meta name="description" content="" /><meta name="author" content="Mark"><meta name="viewport" content="width=device-width; initial-scale=1.0"><link rel="stylesheet" type="text/css" href="'
		//. $host
		 . 'src/css/style.css"><link rel="shortcut icon" href="'
		// . $host
		 . 'src/img/favicon.png"></head><body><div id="wrap"><div id="header"><h1>'
		. ucfirst(end(explode(DIRECTORY_SEPARATOR, $path)))
			. ' sub domains by name</h1></div><div id="main"><div id="content"><ul class="pagination">';
	}

	function footer($host) {
		echo '</ul></div><div style="clear:both;"><div id="footer"><p>&copy; Copyright  by Mark</p></div></div></div></div>'
		. '<script src="'
		//. $host
		 . 'src/js/jquery-2.0.3.min.js"></script><script src="'
		//. $host
		 . 'src/js/jquery.quick.pagination.min.js"></script><script type="text/javascript">$(document).ready(function (){ $("ul.pagination").quickPagination({pageSize: "1"});});</script>'
			. '</body></html>';
	}
}