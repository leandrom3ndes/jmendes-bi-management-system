# OpenAPI\Client\MessagesApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**messagesCreate**](MessagesApi.md#messagesCreate) | **POST** /messages/ | 
[**messagesDelete**](MessagesApi.md#messagesDelete) | **DELETE** /messages/{id}/ | 
[**messagesList**](MessagesApi.md#messagesList) | **GET** /messages/ | 
[**messagesPartialUpdate**](MessagesApi.md#messagesPartialUpdate) | **PATCH** /messages/{id}/ | 
[**messagesRead**](MessagesApi.md#messagesRead) | **GET** /messages/{id}/ | 
[**messagesUpdate**](MessagesApi.md#messagesUpdate) | **PUT** /messages/{id}/ | 



## messagesCreate

> \OpenAPI\Client\Model\Message messagesCreate($data)



Create a new message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\Message(); // \OpenAPI\Client\Model\Message | 

try {
    $result = $apiInstance->messagesCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\Message**](../Model/Message.md)|  |

### Return type

[**\OpenAPI\Client\Model\Message**](../Model/Message.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## messagesDelete

> messagesDelete($id)



Delete the selected message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Message.

try {
    $apiInstance->messagesDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Message. |

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


## messagesList

> \OpenAPI\Client\Model\InlineResponse20028 messagesList($page)



Returns a list of all the messages.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->messagesList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20028**](../Model/InlineResponse20028.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## messagesPartialUpdate

> \OpenAPI\Client\Model\Message messagesPartialUpdate($id, $data)



Edit the selected message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Message.
$data = new \OpenAPI\Client\Model\Message(); // \OpenAPI\Client\Model\Message | 

try {
    $result = $apiInstance->messagesPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Message. |
 **data** | [**\OpenAPI\Client\Model\Message**](../Model/Message.md)|  |

### Return type

[**\OpenAPI\Client\Model\Message**](../Model/Message.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## messagesRead

> \OpenAPI\Client\Model\Message messagesRead($id)



Return the details of the selected message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Message.

try {
    $result = $apiInstance->messagesRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Message. |

### Return type

[**\OpenAPI\Client\Model\Message**](../Model/Message.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## messagesUpdate

> \OpenAPI\Client\Model\Message messagesUpdate($id, $data)



Edit the selected message.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\MessagesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Message.
$data = new \OpenAPI\Client\Model\Message(); // \OpenAPI\Client\Model\Message | 

try {
    $result = $apiInstance->messagesUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MessagesApi->messagesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Message. |
 **data** | [**\OpenAPI\Client\Model\Message**](../Model/Message.md)|  |

### Return type

[**\OpenAPI\Client\Model\Message**](../Model/Message.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

