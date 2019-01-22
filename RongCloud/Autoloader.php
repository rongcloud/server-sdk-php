<?php
function __autoload($class){
    if(is_file(RONGCLOUOD_ROOT.'../\\'."$class.php")){
        require(RONGCLOUOD_ROOT.'../\\'."$class".'.'.'php');
    }
}
spl_autoload_register("__autoload");
