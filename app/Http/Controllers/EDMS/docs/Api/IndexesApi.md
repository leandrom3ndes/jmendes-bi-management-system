# OpenAPI\Client\IndexesApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**indexesCreate**](IndexesApi.md#indexesCreate) | **POST** /indexes/ | 
[**indexesDelete**](IndexesApi.md#indexesDelete) | **DELETE** /indexes/{id}/ | 
[**indexesList**](IndexesApi.md#indexesList) | **GET** /indexes/ | 
[**indexesNodeDocumentsList**](IndexesApi.md#indexesNodeDocumentsList) | **GET** /indexes/node/{id}/documents/ | 
[**indexesPartialUpdate**](IndexesApi.md#indexesPartialUpdate) | **PATCH** /indexes/{id}/ | 
[**indexesRead**](IndexesApi.md#indexesRead) | **GET** /indexes/{id}/ | 
[**indexesTemplateDelete**](IndexesApi.md#indexesTemplateDelete) | **DELETE** /indexes/template/{id}/ | 
[**indexesTemplateList**](IndexesApi.md#indexesTemplateList) | **GET** /indexes/{id}/template/ | 
[**indexesTemplatePartialUpdate**](IndexesApi.md#indexesTemplatePartialUpdate) | **PATCH** /indexes/template/{id}/ | 
[**indexesTemplateRead**](IndexesApi.md#indexesTemplateRead) | **GET** /indexes/template/{id}/ | 
[**indexesTemplateUpdate**](IndexesApi.md#indexesTemplateUpdate) | **PUT** /indexes/template/{id}/ | 
[**indexesUpdate**](IndexesApi.md#indexesUpdate) | **PUT** /indexes/{id}/ | 



## indexesCreate

> \OpenAPI\Client\Model\Index indexesCreate($data)



Create a new index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\Index(); // \OpenAPI\Client\Model\Index | 

try {
    $result = $apiInstance->indexesCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\Index**](../Model/Index.md)|  |

### Return type

[**\OpenAPI\Client\Model\Index**](../Model/Index.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesDelete

> indexesDelete($id)



Delete the selected index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index.

try {
    $apiInstance->indexesDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index. |

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


## indexesList

> \OpenAPI\Client\Model\InlineResponse20025 indexesList($page)



Returns a list of all the defined indexes.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->indexesList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20025**](../Model/InlineResponse20025.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesNodeDocumentsList

> \OpenAPI\Client\Model\InlineResponse2006 indexesNodeDocumentsList($id, $page)



Returns a list of all the documents contained by a particular index node instance.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->indexesNodeDocumentsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesNodeDocumentsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2006**](../Model/InlineResponse2006.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesPartialUpdate

> \OpenAPI\Client\Model\Index indexesPartialUpdate($id, $data)



Partially edit an index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index.
$data = new \OpenAPI\Client\Model\Index(); // \OpenAPI\Client\Model\Index | 

try {
    $result = $apiInstance->indexesPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index. |
 **data** | [**\OpenAPI\Client\Model\Index**](../Model/Index.md)|  |

### Return type

[**\OpenAPI\Client\Model\Index**](../Model/Index.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesRead

> \OpenAPI\Client\Model\Index indexesRead($id)



Returns the details of the selected index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index.

try {
    $result = $apiInstance->indexesRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index. |

### Return type

[**\OpenAPI\Client\Model\Index**](../Model/Index.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesTemplateDelete

> indexesTemplateDelete($id)



Delete the selected index template node.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index node template.

try {
    $apiInstance->indexesTemplateDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesTemplateDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index node template. |

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


## indexesTemplateList

> \OpenAPI\Client\Model\InlineResponse20026 indexesTemplateList($id, $page)



Returns a list of all the template nodes for the selected index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->indexesTemplateList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesTemplateList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20026**](../Model/InlineResponse20026.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesTemplatePartialUpdate

> \OpenAPI\Client\Model\IndexTemplateNode indexesTemplatePartialUpdate($id, $data)



Partially edit an index template node.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index node template.
$data = new \OpenAPI\Client\Model\IndexTemplateNode(); // \OpenAPI\Client\Model\IndexTemplateNode | 

try {
    $result = $apiInstance->indexesTemplatePartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesTemplatePartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index node template. |
 **data** | [**\OpenAPI\Client\Model\IndexTemplateNode**](../Model/IndexTemplateNode.md)|  |

### Return type

[**\OpenAPI\Client\Model\IndexTemplateNode**](../Model/IndexTemplateNode.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesTemplateRead

> \OpenAPI\Client\Model\IndexTemplateNode indexesTemplateRead($id)



Returns the details of the selected index template node.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index node template.

try {
    $result = $apiInstance->indexesTemplateRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesTemplateRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index node template. |

### Return type

[**\OpenAPI\Client\Model\IndexTemplateNode**](../Model/IndexTemplateNode.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesTemplateUpdate

> \OpenAPI\Client\Model\IndexTemplateNode indexesTemplateUpdate($id, $data)



Edit an index template node.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index node template.
$data = new \OpenAPI\Client\Model\IndexTemplateNode(); // \OpenAPI\Client\Model\IndexTemplateNode | 

try {
    $result = $apiInstance->indexesTemplateUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesTemplateUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index node template. |
 **data** | [**\OpenAPI\Client\Model\IndexTemplateNode**](../Model/IndexTemplateNode.md)|  |

### Return type

[**\OpenAPI\Client\Model\IndexTemplateNode**](../Model/IndexTemplateNode.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## indexesUpdate

> \OpenAPI\Client\Model\Index indexesUpdate($id, $data)



Edit an index.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\IndexesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Index.
$data = new \OpenAPI\Client\Model\Index(); // \OpenAPI\Client\Model\Index | 

try {
    $result = $apiInstance->indexesUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling IndexesApi->indexesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Index. |
 **data** | [**\OpenAPI\Client\Model\Index**](../Model/Index.md)|  |

### Return type

[**\OpenAPI\Client\Model\Index**](../Model/Index.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

