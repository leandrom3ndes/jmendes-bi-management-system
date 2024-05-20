# OpenAPI\Client\SmartLinksApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**smartLinksConditionsCreate**](SmartLinksApi.md#smartLinksConditionsCreate) | **POST** /smart_links/{id}/conditions/ | 
[**smartLinksConditionsDelete**](SmartLinksApi.md#smartLinksConditionsDelete) | **DELETE** /smart_links/{id}/conditions/{condition_pk}/ | 
[**smartLinksConditionsList**](SmartLinksApi.md#smartLinksConditionsList) | **GET** /smart_links/{id}/conditions/ | 
[**smartLinksConditionsPartialUpdate**](SmartLinksApi.md#smartLinksConditionsPartialUpdate) | **PATCH** /smart_links/{id}/conditions/{condition_pk}/ | 
[**smartLinksConditionsRead**](SmartLinksApi.md#smartLinksConditionsRead) | **GET** /smart_links/{id}/conditions/{condition_pk}/ | 
[**smartLinksConditionsUpdate**](SmartLinksApi.md#smartLinksConditionsUpdate) | **PUT** /smart_links/{id}/conditions/{condition_pk}/ | 
[**smartLinksCreate**](SmartLinksApi.md#smartLinksCreate) | **POST** /smart_links/ | 
[**smartLinksDelete**](SmartLinksApi.md#smartLinksDelete) | **DELETE** /smart_links/{id}/ | 
[**smartLinksList**](SmartLinksApi.md#smartLinksList) | **GET** /smart_links/ | 
[**smartLinksPartialUpdate**](SmartLinksApi.md#smartLinksPartialUpdate) | **PATCH** /smart_links/{id}/ | 
[**smartLinksRead**](SmartLinksApi.md#smartLinksRead) | **GET** /smart_links/{id}/ | 
[**smartLinksUpdate**](SmartLinksApi.md#smartLinksUpdate) | **PUT** /smart_links/{id}/ | 



## smartLinksConditionsCreate

> \OpenAPI\Client\Model\SmartLinkCondition smartLinksConditionsCreate($id, $data)



Create a new smart link condition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\SmartLinkCondition(); // \OpenAPI\Client\Model\SmartLinkCondition | 

try {
    $result = $apiInstance->smartLinksConditionsCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)|  |

### Return type

[**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksConditionsDelete

> smartLinksConditionsDelete($id, $condition_pk)



Delete the selected smart link condition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$condition_pk = 'condition_pk_example'; // string | 

try {
    $apiInstance->smartLinksConditionsDelete($id, $condition_pk);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **condition_pk** | **string**|  |

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


## smartLinksConditionsList

> \OpenAPI\Client\Model\InlineResponse20037 smartLinksConditionsList($id, $page)



Returns a list of all the smart link conditions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->smartLinksConditionsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20037**](../Model/InlineResponse20037.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksConditionsPartialUpdate

> \OpenAPI\Client\Model\SmartLinkCondition smartLinksConditionsPartialUpdate($id, $condition_pk, $data)



Edit the selected smart link condition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$condition_pk = 'condition_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\SmartLinkCondition(); // \OpenAPI\Client\Model\SmartLinkCondition | 

try {
    $result = $apiInstance->smartLinksConditionsPartialUpdate($id, $condition_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **condition_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)|  |

### Return type

[**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksConditionsRead

> \OpenAPI\Client\Model\SmartLinkCondition smartLinksConditionsRead($id, $condition_pk)



Return the details of the selected smart link condition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$condition_pk = 'condition_pk_example'; // string | 

try {
    $result = $apiInstance->smartLinksConditionsRead($id, $condition_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **condition_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksConditionsUpdate

> \OpenAPI\Client\Model\SmartLinkCondition smartLinksConditionsUpdate($id, $condition_pk, $data)



Edit the selected smart link condition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$condition_pk = 'condition_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\SmartLinkCondition(); // \OpenAPI\Client\Model\SmartLinkCondition | 

try {
    $result = $apiInstance->smartLinksConditionsUpdate($id, $condition_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksConditionsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **condition_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)|  |

### Return type

[**\OpenAPI\Client\Model\SmartLinkCondition**](../Model/SmartLinkCondition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksCreate

> \OpenAPI\Client\Model\WritableSmartLink smartLinksCreate($data)



Create a new smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\WritableSmartLink(); // \OpenAPI\Client\Model\WritableSmartLink | 

try {
    $result = $apiInstance->smartLinksCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksDelete

> smartLinksDelete($id)



Delete the selected smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Smart link.

try {
    $apiInstance->smartLinksDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Smart link. |

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


## smartLinksList

> \OpenAPI\Client\Model\InlineResponse20036 smartLinksList($page)



Returns a list of all the smart links.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->smartLinksList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20036**](../Model/InlineResponse20036.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksPartialUpdate

> \OpenAPI\Client\Model\WritableSmartLink smartLinksPartialUpdate($id, $data)



Edit the selected smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Smart link.
$data = new \OpenAPI\Client\Model\WritableSmartLink(); // \OpenAPI\Client\Model\WritableSmartLink | 

try {
    $result = $apiInstance->smartLinksPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Smart link. |
 **data** | [**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksRead

> \OpenAPI\Client\Model\SmartLink smartLinksRead($id)



Return the details of the selected smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Smart link.

try {
    $result = $apiInstance->smartLinksRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Smart link. |

### Return type

[**\OpenAPI\Client\Model\SmartLink**](../Model/SmartLink.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## smartLinksUpdate

> \OpenAPI\Client\Model\WritableSmartLink smartLinksUpdate($id, $data)



Edit the selected smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SmartLinksApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Smart link.
$data = new \OpenAPI\Client\Model\WritableSmartLink(); // \OpenAPI\Client\Model\WritableSmartLink | 

try {
    $result = $apiInstance->smartLinksUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SmartLinksApi->smartLinksUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Smart link. |
 **data** | [**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableSmartLink**](../Model/WritableSmartLink.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

