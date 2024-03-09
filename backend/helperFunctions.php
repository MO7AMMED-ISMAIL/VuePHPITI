<?php

//example for a simple validation function that checks if a key and value are not empty
//this function will be called in every PUT request or POST to validate the data is here
/**
 * @brief Handle PUT request data and store it in an associative array
 *
 * @param null $put_vars
 * @return $put_vars
 */
function handlePutRequestData()
{
    // Handle PUT request data handled as an input stream then stored in an assoc array
    $putfp = fopen('php://input', 'r');
    $putdata = '';
    while ($data = fread($putfp, 1024)) {
        $putdata .= $data;
    }
    fclose($putfp);
    parse_str($putdata, $put_vars);
    return $put_vars;
}

/**
 * @brief Validate if key and value are not empty
 *
 * @param array $userData
 * @return void
 */
function arrayKeyAndValueNotEpmty($userData)
{
    foreach ($userData as $key => $value) {
        if (isset($key) || $value == "") {
            // Display an error message and terminate the script
            die(json_encode(array("Error" => "Error: Please provide a value for $key")));
            exit;
        }
    }
}

/**
 * @brief Set HTTP headers and status
 *
 * @param int $statusCode
 * @param string|null $statusMessage
 * @return void
 */
function setHeaderAndStatus($statusCode, $statusMessage = null)
{
    header('HTTP/1.1 ' . "$statusCode");
    if ($statusMessage !== null) {
        echo json_encode(array("status" => $statusMessage));
    }
}
