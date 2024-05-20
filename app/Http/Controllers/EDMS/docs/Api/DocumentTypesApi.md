# OpenAPI\Client\DocumentTypesApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**documentTypesCreate**](DocumentTypesApi.md#documentTypesCreate) | **POST** /document_types/ | 
[**documentTypesDelete**](DocumentTypesApi.md#documentTypesDelete) | **DELETE** /document_types/{id}/ | 
[**documentTypesDocumentsList**](DocumentTypesApi.md#documentTypesDocumentsList) | **GET** /document_types/{id}/documents/ | 
[**documentTypesList**](DocumentTypesApi.md#documentTypesList) | **GET** /document_types/ | 
[**documentTypesMetadataTypesCreate**](DocumentTypesApi.md#documentTypesMetadataTypesCreate) | **POST** /document_types/{document_type_pk}/metadata_types/ | 
[**documentTypesMetadataTypesDelete**](DocumentTypesApi.md#documentTypesMetadataTypesDelete) | **DELETE** /document_types/{document_type_pk}/metadata_types/{metadata_type_pk}/ | 
[**documentTypesMetadataTypesList**](DocumentTypesApi.md#documentTypesMetadataTypesList) | **GET** /document_types/{document_type_pk}/metadata_types/ | 
[**documentTypesMetadataTypesPartialUpdate**](DocumentTypesApi.md#documentTypesMetadataTypesPartialUpdate) | **PATCH** /document_types/{document_type_pk}/metadata_types/{metadata_type_pk}/ | 
[**documentTypesMetadataTypesRead**](DocumentTypesApi.md#documentTypesMetadataTypesRead) | **GET** /document_types/{document_type_pk}/metadata_types/{metadata_type_pk}/ | 
[**documentTypesMetadataTypesUpdate**](DocumentTypesApi.md#documentTypesMetadataTypesUpdate) | **PUT** /document_types/{document_type_pk}/metadata_types/{metadata_type_pk}/ | 
[**documentTypesOcrSettingsPartialUpdate**](DocumentTypesApi.md#documentTypesOcrSettingsPartialUpdate) | **PATCH** /document_types/{id}/ocr/settings/ | 
[**documentTypesOcrSettingsRead**](DocumentTypesApi.md#documentTypesOcrSettingsRead) | **GET** /document_types/{id}/ocr/settings/ | 
[**documentTypesOcrSettingsUpdate**](DocumentTypesApi.md#documentTypesOcrSettingsUpdate) | **PUT** /document_types/{id}/ocr/settings/ | 
[**documentTypesParsingSettingsPartialUpdate**](DocumentTypesApi.md#documentTypesParsingSettingsPartialUpdate) | **PATCH** /document_types/{id}/parsing/settings/ | 
[**documentTypesParsingSettingsRead**](DocumentTypesApi.md#documentTypesParsingSettingsRead) | **GET** /document_types/{id}/parsing/settings/ | 
[**documentTypesParsingSettingsUpdate**](DocumentTypesApi.md#documentTypesParsingSettingsUpdate) | **PUT** /document_types/{id}/parsing/settings/ | 
[**documentTypesPartialUpdate**](DocumentTypesApi.md#documentTypesPartialUpdate) | **PATCH** /document_types/{id}/ | 
[**documentTypesRead**](DocumentTypesApi.md#documentTypesRead) | **GET** /document_types/{id}/ | 
[**documentTypesUpdate**](DocumentTypesApi.md#documentTypesUpdate) | **PUT** /document_types/{id}/ | 
[**documentTypesWorkflowsList**](DocumentTypesApi.md#documentTypesWorkflowsList) | **GET** /document_types/{id}/workflows/ | 



## documentTypesCreate

> \OpenAPI\Client\Model\WritableDocumentType documentTypesCreate($data)



Create a new document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\WritableDocumentType(); // \OpenAPI\Client\Model\WritableDocumentType | 

try {
    $result = $apiInstance->documentTypesCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesDelete

> documentTypesDelete($id)



Delete the selected document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type.

try {
    $apiInstance->documentTypesDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type. |

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


## documentTypesDocumentsList

> \OpenAPI\Client\Model\InlineResponse2006 documentTypesDocumentsList($id, $page)



Returns a list of all the documents of a particular document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentTypesDocumentsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesDocumentsList: ', $e->getMessage(), PHP_EOL;
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


## documentTypesList

> \OpenAPI\Client\Model\InlineResponse2004 documentTypesList($page)



Returns a list of all the document types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentTypesList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2004**](../Model/InlineResponse2004.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesMetadataTypesCreate

> \OpenAPI\Client\Model\NewDocumentTypeMetadataType documentTypesMetadataTypesCreate($document_type_pk, $data)



Add a metadata type to the selected document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\NewDocumentTypeMetadataType(); // \OpenAPI\Client\Model\NewDocumentTypeMetadataType | 

try {
    $result = $apiInstance->documentTypesMetadataTypesCreate($document_type_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewDocumentTypeMetadataType**](../Model/NewDocumentTypeMetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentTypeMetadataType**](../Model/NewDocumentTypeMetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesMetadataTypesDelete

> documentTypesMetadataTypesDelete($document_type_pk, $metadata_type_pk)



Remove a metadata type from a document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$metadata_type_pk = 'metadata_type_pk_example'; // string | 

try {
    $apiInstance->documentTypesMetadataTypesDelete($document_type_pk, $metadata_type_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
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


## documentTypesMetadataTypesList

> \OpenAPI\Client\Model\InlineResponse2005 documentTypesMetadataTypesList($document_type_pk, $page)



Returns a list of selected document type's metadata types.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentTypesMetadataTypesList($document_type_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2005**](../Model/InlineResponse2005.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesMetadataTypesPartialUpdate

> \OpenAPI\Client\Model\WritableDocumentTypeMetadataType documentTypesMetadataTypesPartialUpdate($document_type_pk, $metadata_type_pk, $data)



Edit the selected document type metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$metadata_type_pk = 'metadata_type_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableDocumentTypeMetadataType(); // \OpenAPI\Client\Model\WritableDocumentTypeMetadataType | 

try {
    $result = $apiInstance->documentTypesMetadataTypesPartialUpdate($document_type_pk, $metadata_type_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
 **metadata_type_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentTypeMetadataType**](../Model/WritableDocumentTypeMetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentTypeMetadataType**](../Model/WritableDocumentTypeMetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesMetadataTypesRead

> \OpenAPI\Client\Model\DocumentTypeMetadataType documentTypesMetadataTypesRead($document_type_pk, $metadata_type_pk)



Retrieve the details of a document type metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$metadata_type_pk = 'metadata_type_pk_example'; // string | 

try {
    $result = $apiInstance->documentTypesMetadataTypesRead($document_type_pk, $metadata_type_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
 **metadata_type_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeMetadataType**](../Model/DocumentTypeMetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesMetadataTypesUpdate

> \OpenAPI\Client\Model\WritableDocumentTypeMetadataType documentTypesMetadataTypesUpdate($document_type_pk, $metadata_type_pk, $data)



Edit the selected document type metadata type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_type_pk = 'document_type_pk_example'; // string | 
$metadata_type_pk = 'metadata_type_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableDocumentTypeMetadataType(); // \OpenAPI\Client\Model\WritableDocumentTypeMetadataType | 

try {
    $result = $apiInstance->documentTypesMetadataTypesUpdate($document_type_pk, $metadata_type_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesMetadataTypesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_type_pk** | **string**|  |
 **metadata_type_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentTypeMetadataType**](../Model/WritableDocumentTypeMetadataType.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentTypeMetadataType**](../Model/WritableDocumentTypeMetadataType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesOcrSettingsPartialUpdate

> \OpenAPI\Client\Model\DocumentTypeOCRSettings documentTypesOcrSettingsPartialUpdate($id, $data)



Set the document type OCR settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.
$data = new \OpenAPI\Client\Model\DocumentTypeOCRSettings(); // \OpenAPI\Client\Model\DocumentTypeOCRSettings | 

try {
    $result = $apiInstance->documentTypesOcrSettingsPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesOcrSettingsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |
 **data** | [**\OpenAPI\Client\Model\DocumentTypeOCRSettings**](../Model/DocumentTypeOCRSettings.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeOCRSettings**](../Model/DocumentTypeOCRSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesOcrSettingsRead

> \OpenAPI\Client\Model\DocumentTypeOCRSettings documentTypesOcrSettingsRead($id)



Return the document type OCR settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.

try {
    $result = $apiInstance->documentTypesOcrSettingsRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesOcrSettingsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeOCRSettings**](../Model/DocumentTypeOCRSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesOcrSettingsUpdate

> \OpenAPI\Client\Model\DocumentTypeOCRSettings documentTypesOcrSettingsUpdate($id, $data)



Set the document type OCR settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.
$data = new \OpenAPI\Client\Model\DocumentTypeOCRSettings(); // \OpenAPI\Client\Model\DocumentTypeOCRSettings | 

try {
    $result = $apiInstance->documentTypesOcrSettingsUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesOcrSettingsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |
 **data** | [**\OpenAPI\Client\Model\DocumentTypeOCRSettings**](../Model/DocumentTypeOCRSettings.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeOCRSettings**](../Model/DocumentTypeOCRSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesParsingSettingsPartialUpdate

> \OpenAPI\Client\Model\DocumentTypeParsingSettings documentTypesParsingSettingsPartialUpdate($id, $data)



Set the document type parsing settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.
$data = new \OpenAPI\Client\Model\DocumentTypeParsingSettings(); // \OpenAPI\Client\Model\DocumentTypeParsingSettings | 

try {
    $result = $apiInstance->documentTypesParsingSettingsPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesParsingSettingsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |
 **data** | [**\OpenAPI\Client\Model\DocumentTypeParsingSettings**](../Model/DocumentTypeParsingSettings.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeParsingSettings**](../Model/DocumentTypeParsingSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesParsingSettingsRead

> \OpenAPI\Client\Model\DocumentTypeParsingSettings documentTypesParsingSettingsRead($id)



Return the document type parsing settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.

try {
    $result = $apiInstance->documentTypesParsingSettingsRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesParsingSettingsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeParsingSettings**](../Model/DocumentTypeParsingSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesParsingSettingsUpdate

> \OpenAPI\Client\Model\DocumentTypeParsingSettings documentTypesParsingSettingsUpdate($id, $data)



Set the document type parsing settings.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type settings.
$data = new \OpenAPI\Client\Model\DocumentTypeParsingSettings(); // \OpenAPI\Client\Model\DocumentTypeParsingSettings | 

try {
    $result = $apiInstance->documentTypesParsingSettingsUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesParsingSettingsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type settings. |
 **data** | [**\OpenAPI\Client\Model\DocumentTypeParsingSettings**](../Model/DocumentTypeParsingSettings.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTypeParsingSettings**](../Model/DocumentTypeParsingSettings.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesPartialUpdate

> \OpenAPI\Client\Model\WritableDocumentType documentTypesPartialUpdate($id, $data)



Edit the properties of the selected document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type.
$data = new \OpenAPI\Client\Model\WritableDocumentType(); // \OpenAPI\Client\Model\WritableDocumentType | 

try {
    $result = $apiInstance->documentTypesPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type. |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesRead

> \OpenAPI\Client\Model\DocumentType documentTypesRead($id)



Return the details of the selected document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type.

try {
    $result = $apiInstance->documentTypesRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type. |

### Return type

[**\OpenAPI\Client\Model\DocumentType**](../Model/DocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesUpdate

> \OpenAPI\Client\Model\WritableDocumentType documentTypesUpdate($id, $data)



Edit the properties of the selected document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document type.
$data = new \OpenAPI\Client\Model\WritableDocumentType(); // \OpenAPI\Client\Model\WritableDocumentType | 

try {
    $result = $apiInstance->documentTypesUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document type. |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentType**](../Model/WritableDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentTypesWorkflowsList

> \OpenAPI\Client\Model\InlineResponse2007 documentTypesWorkflowsList($id, $page)



Returns a list of all the document type workflows.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentTypesApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentTypesWorkflowsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentTypesApi->documentTypesWorkflowsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2007**](../Model/InlineResponse2007.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

