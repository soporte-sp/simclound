<?php 

class out {
    function getOut($out){
        $callback = filter_input(INPUT_GET, 'callback', FILTER_DEFAULT);
        if(isset($callback)){
            echo $callback."(".json_encode($out).");";
        }else{
            echo json_encode($out);
        }
    }
    function return($return){
        $this->getOut($return);
    }
}

?>