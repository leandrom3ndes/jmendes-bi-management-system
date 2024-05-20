<?php

namespace OpenAPI\Client;


class AuthenticationEDMS
{

    //Set authentication headers based on what's present in Configuration variable
    public static function setAuthenticationHeaders($apiClient, &$headers)
    {
        // this endpoint requires HTTP basic authentication
        if (!empty($apiClient->getConfig()->getUsername()) || !(empty($apiClient->getConfig()->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($apiClient->getConfig()->getUsername() . ":" . $apiClient->getConfig()->getPassword());
        }

        //DISME - Added for access token
        if ($apiClient->getConfig()->getAccessToken()) {
            $headers['Authorization'] = $apiClient->getConfig()->getAccessToken();
        }
    }

}
