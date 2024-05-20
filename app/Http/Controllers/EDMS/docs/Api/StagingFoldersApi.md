# OpenAPI\Client\StagingFoldersApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**stagingFoldersCreate**](StagingFoldersApi.md#stagingFoldersCreate) | **POST** /staging_folders/ | 
[**stagingFoldersDelete**](StagingFoldersApi.md#stagingFoldersDelete) | **DELETE** /staging_folders/{id}/ | 
[**stagingFoldersFileDelete**](StagingFoldersApi.md#stagingFoldersFileDelete) | **DELETE** /staging_folders/file/{staging_folder_pk}/{encoded_filename}/ | 
[**stagingFoldersFileImageRead**](StagingFoldersApi.md#stagingFoldersFileImageRead) | **GET** /staging_folders/file/{staging_folder_pk}/{encoded_filename}/image/ | 
[**stagingFoldersFileRead**](StagingFoldersApi.md#stagingFoldersFileRead) | **GET** /staging_folders/file/{staging_folder_pk}/{encoded_filename}/ | 
[**stagingFoldersFileUploadCreate**](StagingFoldersApi.md#stagingFoldersFileUploadCreate) | **POST** /staging_folders/file/{staging_folder_pk}/{encoded_filename}/upload/ | 
[**stagingFoldersList**](StagingFoldersApi.md#stagingFoldersList) | **GET** /staging_folders/ | 
[**stagingFoldersPartialUpdate**](StagingFoldersApi.md#stagingFoldersPartialUpdate) | **PATCH** /staging_folders/{id}/ | 
[**stagingFoldersRead**](StagingFoldersApi.md#stagingFoldersRead) | **GET** /staging_folders/{id}/ | 
[**stagingFoldersUpdate**](StagingFoldersApi.md#stagingFoldersUpdate) | **PUT** /staging_folders/{id}/ | 



## stagingFoldersCreate

> \OpenAPI\Client\Model\StagingFolder stagingFoldersCreate($data)



Create a new staging folders.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\StagingFolder(); // \OpenAPI\Client\Model\StagingFolder | 

try {
    $result = $apiInstance->stagingFoldersCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)|  |

### Return type

[**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersDelete

> stagingFoldersDelete($id)



Delete the selected staging folders.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Staging folder.

try {
    $apiInstance->stagingFoldersDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Staging folder. |

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


## stagingFoldersFileDelete

> stagingFoldersFileDelete($staging_folder_pk, $encoded_filename)



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$staging_folder_pk = 'staging_folder_pk_example'; // string | 
$encoded_filename = 'encoded_filename_example'; // string | 

try {
    $apiInstance->stagingFoldersFileDelete($staging_folder_pk, $encoded_filename);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersFileDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **staging_folder_pk** | **string**|  |
 **encoded_filename** | **string**|  |

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


## stagingFoldersFileImageRead

> stagingFoldersFileImageRead($staging_folder_pk, $encoded_filename)



Returns an image representation of the selected staging folder file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$staging_folder_pk = 'staging_folder_pk_example'; // string | 
$encoded_filename = 'encoded_filename_example'; // string | 

try {
    $apiInstance->stagingFoldersFileImageRead($staging_folder_pk, $encoded_filename);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersFileImageRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **staging_folder_pk** | **string**|  |
 **encoded_filename** | **string**|  |

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


## stagingFoldersFileRead

> \OpenAPI\Client\Model\StagingFolderFile stagingFoldersFileRead($staging_folder_pk, $encoded_filename)



Details of the selected staging file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$staging_folder_pk = 'staging_folder_pk_example'; // string | 
$encoded_filename = 'encoded_filename_example'; // string | 

try {
    $result = $apiInstance->stagingFoldersFileRead($staging_folder_pk, $encoded_filename);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersFileRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **staging_folder_pk** | **string**|  |
 **encoded_filename** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\StagingFolderFile**](../Model/StagingFolderFile.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersFileUploadCreate

> \OpenAPI\Client\Model\StagingFolderFileUpload stagingFoldersFileUploadCreate($staging_folder_pk, $encoded_filename, $data)



Upload the selected staging folder file.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$staging_folder_pk = 'staging_folder_pk_example'; // string | 
$encoded_filename = 'encoded_filename_example'; // string | 
$data = new \OpenAPI\Client\Model\StagingFolderFileUpload(); // \OpenAPI\Client\Model\StagingFolderFileUpload | 

try {
    $result = $apiInstance->stagingFoldersFileUploadCreate($staging_folder_pk, $encoded_filename, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersFileUploadCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **staging_folder_pk** | **string**|  |
 **encoded_filename** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\StagingFolderFileUpload**](../Model/StagingFolderFileUpload.md)|  |

### Return type

[**\OpenAPI\Client\Model\StagingFolderFileUpload**](../Model/StagingFolderFileUpload.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersList

> \OpenAPI\Client\Model\InlineResponse20038 stagingFoldersList($page)



Returns a list of all the staging folders and the files they contain.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->stagingFoldersList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20038**](../Model/InlineResponse20038.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersPartialUpdate

> \OpenAPI\Client\Model\StagingFolder stagingFoldersPartialUpdate($id, $data)



Edit the selected staging folders.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Staging folder.
$data = new \OpenAPI\Client\Model\StagingFolder(); // \OpenAPI\Client\Model\StagingFolder | 

try {
    $result = $apiInstance->stagingFoldersPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Staging folder. |
 **data** | [**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)|  |

### Return type

[**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersRead

> \OpenAPI\Client\Model\StagingFolder stagingFoldersRead($id)



Details of the selected staging folders and the files it contains.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Staging folder.

try {
    $result = $apiInstance->stagingFoldersRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Staging folder. |

### Return type

[**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## stagingFoldersUpdate

> \OpenAPI\Client\Model\StagingFolder stagingFoldersUpdate($id, $data)



Edit the selected staging folders.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\StagingFoldersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Staging folder.
$data = new \OpenAPI\Client\Model\StagingFolder(); // \OpenAPI\Client\Model\StagingFolder | 

try {
    $result = $apiInstance->stagingFoldersUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling StagingFoldersApi->stagingFoldersUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Staging folder. |
 **data** | [**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)|  |

### Return type

[**\OpenAPI\Client\Model\StagingFolder**](../Model/StagingFolder.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

