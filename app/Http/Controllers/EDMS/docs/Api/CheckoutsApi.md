# OpenAPI\Client\CheckoutsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**checkoutsCheckoutInfoDelete**](CheckoutsApi.md#checkoutsCheckoutInfoDelete) | **DELETE** /checkouts/{id}/checkout_info/ | 
[**checkoutsCheckoutInfoRead**](CheckoutsApi.md#checkoutsCheckoutInfoRead) | **GET** /checkouts/{id}/checkout_info/ | 
[**checkoutsCreate**](CheckoutsApi.md#checkoutsCreate) | **POST** /checkouts/ | 
[**checkoutsList**](CheckoutsApi.md#checkoutsList) | **GET** /checkouts/ | 



## checkoutsCheckoutInfoDelete

> checkoutsCheckoutInfoDelete($id)



Checkin a document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CheckoutsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 

try {
    $apiInstance->checkoutsCheckoutInfoDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsCheckoutInfoDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |

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


## checkoutsCheckoutInfoRead

> \OpenAPI\Client\Model\DocumentCheckout checkoutsCheckoutInfoRead($id)



Retrieve the details of the selected checked out document entry.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CheckoutsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 

try {
    $result = $apiInstance->checkoutsCheckoutInfoRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsCheckoutInfoRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentCheckout**](../Model/DocumentCheckout.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## checkoutsCreate

> \OpenAPI\Client\Model\NewDocumentCheckout checkoutsCreate($data)



Checkout a document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CheckoutsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\NewDocumentCheckout(); // \OpenAPI\Client\Model\NewDocumentCheckout | 

try {
    $result = $apiInstance->checkoutsCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\NewDocumentCheckout**](../Model/NewDocumentCheckout.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentCheckout**](../Model/NewDocumentCheckout.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## checkoutsList

> \OpenAPI\Client\Model\InlineResponse2002 checkoutsList($page)



Returns a list of all the documents that are currently checked out.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\CheckoutsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->checkoutsList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling CheckoutsApi->checkoutsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2002**](../Model/InlineResponse2002.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

