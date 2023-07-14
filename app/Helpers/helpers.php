 <?php
function responsee($data,$message,$success){
        header( 'Content-Type:application/json');
        echo json_encode(array(
            "data" => $data,
            "message" => $message,
            "success" => $success,
        ));
        die();
} 