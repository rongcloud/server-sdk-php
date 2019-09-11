<?php
function autoload($class){
    if(is_file(str_replace("\\", "/", RONGCLOUOD_ROOT.'../'."$class".'.'.'php'))){
        require(str_replace("\\", "/", RONGCLOUOD_ROOT.'../'."$class".'.'.'php'));
    }
}
spl_autoload_register("autoload");
