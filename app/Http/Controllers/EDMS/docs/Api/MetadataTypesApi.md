# OpenAPI\Client\MetadataTypesApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**metadataTypesCreate**](MetadataTypesApi.md#metadataTypesCreate) | **POST** /metadata_types/ | 
[**metadataTypesDelete**](MetadataTypesApi.md#metadataTypesDelete) | **DELETE** /metadata_types/{metadata_type_pk}/ | 
[**metadataTypesList**](MetadataTypesApi.md#metadataTypesList) | **GET** /metadata_types/ | 
[**metadataTypesPartialUpdate**](MetadataTypesApi.md#metadataTypesPartialUpdate) | **PATCH** /metadata_types/{metadata_type_pk}/ | 
[**metadataTypesRead**](MetadataTypesApi.md#metadataTypesRead) | **GET** /metadata_types/{metadata_type_pk}/ | 
[**metadataTypesUpdate**](MetadataTypesApi.md#metadataTypesUpdate) | **PUT** /metadata_types/{metadata_type_pk}/ | 



## metadataTypesCreate

> \OpenAPI\Client\Model\MetadataType metadataTypesCreate($data)



Create a new metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\MetadataType(); // \OpenAPI\Client\Model\MetadataType | 

try {
    $result = $apiInstance->metadataTypesCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## metadataTypesDelete

> metadataTypesDelete($metadata_type_pk)



Delete the selected metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$metadata_type_pk = 'metadata_type_pk_example'; // string | 

try {
    $apiInstance->metadataTypesDelete($metadata_type_pk);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **metadata_type_pk** | **string**|  |

### Return type

void (empty response body)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## metadataTypesList

> \OpenAPI\Client\Model\InlineResponse20029 metadataTypesList($page)



Returns a list of all the metadata types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->metadataTypesList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20029**](../Model/InlineResponse20029.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## metadataTypesPartialUpdate

> \OpenAPI\Client\Model\MetadataType metadataTypesPartialUpdate($metadata_type_pk, $data)



Edit the selected metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$metadata_type_pk = 'metadata_type_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\MetadataType(); // \OpenAPI\Client\Model\MetadataType | 

try {
    $result = $apiInstance->metadataTypesPartialUpdate($metadata_type_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **metadata_type_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## metadataTypesRead

> \OpenAPI\Client\Model\MetadataType metadataTypesRead($metadata_type_pk)



Return the details of the selected metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$metadata_type_pk = 'metadata_type_pk_example'; // string | 

try {
    $result = $apiInstance->metadataTypesRead($metadata_type_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **metadata_type_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## metadataTypesUpdate

> \OpenAPI\Client\Model\MetadataType metadataTypesUpdate($metadata_type_pk, $data)



Edit the selected metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MetadataTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$metadata_type_pk = 'metadata_type_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\MetadataType(); // \OpenAPI\Client\Model\MetadataType | 

try {
    $result = $apiInstance->metadataTypesUpdate($metadata_type_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MetadataTypesApi->metadataTypesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **metadata_type_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\MetadataType**](../Model/MetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

