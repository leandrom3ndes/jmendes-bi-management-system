# OpenAPI\Client\EventTypesApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**eventTypesList**](EventTypesApi.md#eventTypesList) | **GET** /event_types/ | 



## eventTypesList

> \OpenAPI\Client\Model\InlineResponse20022 eventTypesList($page)



Returns a list of all the available event types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\EventTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->eventTypesList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling EventTypesApi->eventTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20022**](../Model/InlineResponse20022.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

