<?php

    /*
    	global $RedirUrl;	$RedirUrl = "window.close();";
		global $RedirTime;	$RedirTime = 120000;
        
		require '../Inclu/AutoWindowClose.php';
		global $Redir;      print ($Redir);

        global $Redir;  global $RedirUrl;   global $RedirUrl;
        $Redir = "<script type='text/javascript'>
                    function redir(){ ".$RedirUrl."
                }
                setTimeout('redir()',".$RedirTime.");
                </script>";
    */

    global $Redir;  global $RedirUrl;   global $RedirUrl;
    $Redir = "<script type='text/javascript'>
                    function redir(){ window.close(); }
                    setTimeout('redir()',12000); /* microsegundos */
                </script>";

?>