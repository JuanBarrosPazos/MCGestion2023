<?php

    /*
    	global $RedirUrl;	$RedirUrl = "ClienteVer.php";
		global $RedirTime;	$RedirTime = 6000;
		require '../Inclu/AutoRedirUrl.php';
        
		global $Redir;      print ($Redir);
        global $Redir;  global $RedirUrl;   global $RedirUrl;
        $Redir = "<script type='text/javascript'>
                        function redir(){ window.location.href='".$RedirUrl."';  }
                    setTimeout('redir()',".$RedirTime.");
                </script>";
    */

    global $Redir;  global $RedirUrl;   global $RedirUrl;
    $Redir = "<script type='text/javascript'>
                    function redir(){ window.location.href='".$RedirUrl."';  }
                setTimeout('redir()',".$RedirTime."); /* microsegundos */
            </script>";

?>