# OpenAPI\Client\SearchModelsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**searchModelsList**](SearchModelsApi.md#searchModelsList) | **GET** /search_models/ | 



## searchModelsList

> \OpenAPI\Client\Model\InlineResponse20035 searchModelsList($page)



Returns a list of all the available search models.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\SearchModelsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->searchModelsList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SearchModelsApi->searchModelsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20035**](../Model/InlineResponse20035.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

