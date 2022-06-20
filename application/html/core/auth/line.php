<?php
include '../../../vendor/autoload.php';
use Hybridauth\Hybridauth;
use Hybridauth\HttpClient;

$config = [
    'callback' => HttpClient\Util::getCurrentUrl(),
    'providers' => [
        'Line' => [ 
            'enabled' => true,
            'keys'    => [ 
              'id' => '1656849406', 
              'secret' => '8949ceeaecf671c2263836caea6e95f4' 
            ], 
        ],
    ],
];

try {    
    $hybridauth = new Hybridauth( $config );
    $adapter = $hybridauth->authenticate( 'Line' );
    $tokens = $adapter->getAccessToken();
    $userProfile = $adapter->getUserProfile();
    
    
    $ukey = '';
    $uphoto = '';
    foreach ($userProfile as $key => $value) {
      if($key == 'identifier'){
        $ukey = $value;
      }

      if($key == 'photoURL'){
        $uphoto = $value;
      }
    }
    $adapter->disconnect();
    header('Location: ../../../api/line_login?token='.$ukey.'&photo='.$uphoto);
    
}
catch (\Exception $e) {
    echo $e->getMessage();
    // echo $e;
}