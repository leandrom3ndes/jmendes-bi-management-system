# OpenAPI\Client\CabinetsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**cabinetsCreate**](CabinetsApi.md#cabinetsCreate) | **POST** /cabinets/ | 
[**cabinetsDelete**](CabinetsApi.md#cabinetsDelete) | **DELETE** /cabinets/{id}/ | 
[**cabinetsDocumentsCreate**](CabinetsApi.md#cabinetsDocumentsCreate) | **POST** /cabinets/{id}/documents/ | 
[**cabinetsDocumentsDelete**](CabinetsApi.md#cabinetsDocumentsDelete) | **DELETE** /cabinets/{id}/documents/{document_pk}/ | 
[**cabinetsDocumentsList**](CabinetsApi.md#cabinetsDocumentsList) | **GET** /cabinets/{id}/documents/ | 
[**cabinetsDocumentsRead**](CabinetsApi.md#cabinetsDocumentsRead) | **GET** /cabinets/{id}/documents/{document_pk}/ | 
[**cabinetsList**](CabinetsApi.md#cabinetsList) | **GET** /cabinets/ | 
[**cabinetsPartialUpdate**](CabinetsApi.md#cabinetsPartialUpdate) | **PATCH** /cabinets/{id}/ | 
[**cabinetsRead**](CabinetsApi.md#cabinetsRead) | **GET** /cabinets/{id}/ | 
[**cabinetsUpdate**](CabinetsApi.md#cabinetsUpdate) | **PUT** /cabinets/{id}/ | 



## cabinetsCreate

> \OpenAPI\Client\Model\WritableCabinet cabinetsCreate($data)



Create a new cabinet

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\WritableCabinet(); // \OpenAPI\Client\Model\WritableCabinet | 

try {
    $result = $apiInstance->cabinetsCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsDelete

> cabinetsDelete($id)



Delete the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Cabinet.

try {
    $apiInstance->cabinetsDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Cabinet. |

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


## cabinetsDocumentsCreate

> \OpenAPI\Client\Model\NewCabinetDocument cabinetsDocumentsCreate($id, $data)



Add a document to the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\NewCabinetDocument(); // \OpenAPI\Client\Model\NewCabinetDocument | 

try {
    $result = $apiInstance->cabinetsDocumentsCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsDocumentsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewCabinetDocument**](../Model/NewCabinetDocument.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewCabinetDocument**](../Model/NewCabinetDocument.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsDocumentsDelete

> cabinetsDocumentsDelete($id, $document_pk)



Remove a document from the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$document_pk = 'document_pk_example'; // string | 

try {
    $apiInstance->cabinetsDocumentsDelete($id, $document_pk);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsDocumentsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **document_pk** | **string**|  |

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


## cabinetsDocumentsList

> \OpenAPI\Client\Model\InlineResponse2001 cabinetsDocumentsList($id, $page)



Returns a list of all the documents contained in a particular cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->cabinetsDocumentsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsDocumentsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2001**](../Model/InlineResponse2001.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsDocumentsRead

> \OpenAPI\Client\Model\CabinetDocument cabinetsDocumentsRead($id, $document_pk)



Returns the details of the selected cabinet document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$document_pk = 'document_pk_example'; // string | 

try {
    $result = $apiInstance->cabinetsDocumentsRead($id, $document_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsDocumentsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **document_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\CabinetDocument**](../Model/CabinetDocument.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsList

> \OpenAPI\Client\Model\InlineResponse200 cabinetsList($page)



Returns a list of all the cabinets.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->cabinetsList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse200**](../Model/InlineResponse200.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsPartialUpdate

> \OpenAPI\Client\Model\WritableCabinet cabinetsPartialUpdate($id, $data)



Edit the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Cabinet.
$data = new \OpenAPI\Client\Model\WritableCabinet(); // \OpenAPI\Client\Model\WritableCabinet | 

try {
    $result = $apiInstance->cabinetsPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Cabinet. |
 **data** | [**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsRead

> \OpenAPI\Client\Model\Cabinet cabinetsRead($id)



Returns the details of the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Cabinet.

try {
    $result = $apiInstance->cabinetsRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Cabinet. |

### Return type

[**\OpenAPI\Client\Model\Cabinet**](../Model/Cabinet.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## cabinetsUpdate

> \OpenAPI\Client\Model\WritableCabinet cabinetsUpdate($id, $data)



Edit the selected cabinet.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CabinetsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Cabinet.
$data = new \OpenAPI\Client\Model\WritableCabinet(); // \OpenAPI\Client\Model\WritableCabinet | 

try {
    $result = $apiInstance->cabinetsUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CabinetsApi->cabinetsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Cabinet. |
 **data** | [**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableCabinet**](../Model/WritableCabinet.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

