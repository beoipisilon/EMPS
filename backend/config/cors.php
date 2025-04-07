<?php
function handleCORS() {
    header('Access-Control-Allow-Origin: *');
    
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With, Accept, Origin');
    
    header('Access-Control-Allow-Credentials: true');
    
    header('Access-Control-Expose-Headers: Content-Length, Content-Range');
    
    header('Access-Control-Max-Age: 1728000');
    
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }
} 