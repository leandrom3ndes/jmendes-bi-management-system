# OpenAPI\Client\DocumentsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**documentsCabinetsList**](DocumentsApi.md#documentsCabinetsList) | **GET** /documents/{id}/cabinets/ | 
[**documentsCommentsCreate**](DocumentsApi.md#documentsCommentsCreate) | **POST** /documents/{document_pk}/comments/ | 
[**documentsCommentsDelete**](DocumentsApi.md#documentsCommentsDelete) | **DELETE** /documents/{document_pk}/comments/{comment_pk}/ | 
[**documentsCommentsList**](DocumentsApi.md#documentsCommentsList) | **GET** /documents/{document_pk}/comments/ | 
[**documentsCommentsPartialUpdate**](DocumentsApi.md#documentsCommentsPartialUpdate) | **PATCH** /documents/{document_pk}/comments/{comment_pk}/ | 
[**documentsCommentsRead**](DocumentsApi.md#documentsCommentsRead) | **GET** /documents/{document_pk}/comments/{comment_pk}/ | 
[**documentsCommentsUpdate**](DocumentsApi.md#documentsCommentsUpdate) | **PUT** /documents/{document_pk}/comments/{comment_pk}/ | 
[**documentsCreate**](DocumentsApi.md#documentsCreate) | **POST** /documents/ | 
[**documentsDelete**](DocumentsApi.md#documentsDelete) | **DELETE** /documents/{id}/ | 
[**documentsDownloadRead**](DocumentsApi.md#documentsDownloadRead) | **GET** /documents/{id}/download/ | 
[**documentsIndexesList**](DocumentsApi.md#documentsIndexesList) | **GET** /documents/{id}/indexes/ | 
[**documentsList**](DocumentsApi.md#documentsList) | **GET** /documents/ | 
[**documentsMetadataCreate**](DocumentsApi.md#documentsMetadataCreate) | **POST** /documents/{document_pk}/metadata/ | 
[**documentsMetadataDelete**](DocumentsApi.md#documentsMetadataDelete) | **DELETE** /documents/{document_pk}/metadata/{metadata_pk}/ | 
[**documentsMetadataList**](DocumentsApi.md#documentsMetadataList) | **GET** /documents/{document_pk}/metadata/ | 
[**documentsMetadataPartialUpdate**](DocumentsApi.md#documentsMetadataPartialUpdate) | **PATCH** /documents/{document_pk}/metadata/{metadata_pk}/ | 
[**documentsMetadataRead**](DocumentsApi.md#documentsMetadataRead) | **GET** /documents/{document_pk}/metadata/{metadata_pk}/ | 
[**documentsMetadataUpdate**](DocumentsApi.md#documentsMetadataUpdate) | **PUT** /documents/{document_pk}/metadata/{metadata_pk}/ | 
[**documentsOcrSubmitCreate**](DocumentsApi.md#documentsOcrSubmitCreate) | **POST** /documents/{id}/ocr/submit/ | 
[**documentsPartialUpdate**](DocumentsApi.md#documentsPartialUpdate) | **PATCH** /documents/{id}/ | 
[**documentsRead**](DocumentsApi.md#documentsRead) | **GET** /documents/{id}/ | 
[**documentsRecentList**](DocumentsApi.md#documentsRecentList) | **GET** /documents/recent/ | 
[**documentsResolvedSmartLinksDocumentsList**](DocumentsApi.md#documentsResolvedSmartLinksDocumentsList) | **GET** /documents/{id}/resolved_smart_links/{smart_link_pk}/documents/ | 
[**documentsResolvedSmartLinksList**](DocumentsApi.md#documentsResolvedSmartLinksList) | **GET** /documents/{id}/resolved_smart_links/ | 
[**documentsResolvedSmartLinksRead**](DocumentsApi.md#documentsResolvedSmartLinksRead) | **GET** /documents/{id}/resolved_smart_links/{smart_link_pk}/ | 
[**documentsTagsCreate**](DocumentsApi.md#documentsTagsCreate) | **POST** /documents/{document_pk}/tags/ | 
[**documentsTagsDelete**](DocumentsApi.md#documentsTagsDelete) | **DELETE** /documents/{document_pk}/tags/{id}/ | 
[**documentsTagsList**](DocumentsApi.md#documentsTagsList) | **GET** /documents/{document_pk}/tags/ | 
[**documentsTagsRead**](DocumentsApi.md#documentsTagsRead) | **GET** /documents/{document_pk}/tags/{id}/ | 
[**documentsTypeChangeCreate**](DocumentsApi.md#documentsTypeChangeCreate) | **POST** /documents/{id}/type/change/ | 
[**documentsUpdate**](DocumentsApi.md#documentsUpdate) | **PUT** /documents/{id}/ | 
[**documentsVersionsCreate**](DocumentsApi.md#documentsVersionsCreate) | **POST** /documents/{id}/versions/ | 
[**documentsVersionsDelete**](DocumentsApi.md#documentsVersionsDelete) | **DELETE** /documents/{id}/versions/{version_pk}/ | 
[**documentsVersionsDownloadRead**](DocumentsApi.md#documentsVersionsDownloadRead) | **GET** /documents/{id}/versions/{version_pk}/download/ | 
[**documentsVersionsList**](DocumentsApi.md#documentsVersionsList) | **GET** /documents/{id}/versions/ | 
[**documentsVersionsOcrCreate**](DocumentsApi.md#documentsVersionsOcrCreate) | **POST** /documents/{document_pk}/versions/{version_pk}/ocr/ | 
[**documentsVersionsPagesContentRead**](DocumentsApi.md#documentsVersionsPagesContentRead) | **GET** /documents/{document_pk}/versions/{version_pk}/pages/{page_pk}/content/ | 
[**documentsVersionsPagesImageRead**](DocumentsApi.md#documentsVersionsPagesImageRead) | **GET** /documents/{id}/versions/{version_pk}/pages/{page_pk}/image/ | 
[**documentsVersionsPagesList**](DocumentsApi.md#documentsVersionsPagesList) | **GET** /documents/{id}/versions/{version_pk}/pages/ | 
[**documentsVersionsPagesOcrRead**](DocumentsApi.md#documentsVersionsPagesOcrRead) | **GET** /documents/{document_pk}/versions/{version_pk}/pages/{page_pk}/ocr/ | 
[**documentsVersionsPagesPartialUpdate**](DocumentsApi.md#documentsVersionsPagesPartialUpdate) | **PATCH** /documents/{id}/versions/{version_pk}/pages/{page_pk} | 
[**documentsVersionsPagesRead**](DocumentsApi.md#documentsVersionsPagesRead) | **GET** /documents/{id}/versions/{version_pk}/pages/{page_pk} | 
[**documentsVersionsPagesUpdate**](DocumentsApi.md#documentsVersionsPagesUpdate) | **PUT** /documents/{id}/versions/{version_pk}/pages/{page_pk} | 
[**documentsVersionsPartialUpdate**](DocumentsApi.md#documentsVersionsPartialUpdate) | **PATCH** /documents/{id}/versions/{version_pk}/ | 
[**documentsVersionsRead**](DocumentsApi.md#documentsVersionsRead) | **GET** /documents/{id}/versions/{version_pk}/ | 
[**documentsVersionsSignaturesDetachedCreate**](DocumentsApi.md#documentsVersionsSignaturesDetachedCreate) | **POST** /documents/{document_id}/versions/{document_version_id}/signatures/detached/ | 
[**documentsVersionsSignaturesDetachedDelete**](DocumentsApi.md#documentsVersionsSignaturesDetachedDelete) | **DELETE** /documents/{document_id}/versions/{document_version_id}/signatures/detached/{detached_signature_id}/ | 
[**documentsVersionsSignaturesDetachedList**](DocumentsApi.md#documentsVersionsSignaturesDetachedList) | **GET** /documents/{document_id}/versions/{document_version_id}/signatures/detached/ | 
[**documentsVersionsSignaturesDetachedRead**](DocumentsApi.md#documentsVersionsSignaturesDetachedRead) | **GET** /documents/{document_id}/versions/{document_version_id}/signatures/detached/{detached_signature_id}/ | 
[**documentsVersionsSignaturesDetachedSignCreate**](DocumentsApi.md#documentsVersionsSignaturesDetachedSignCreate) | **POST** /documents/{document_id}/versions/{document_version_id}/signatures/detached/sign/ | 
[**documentsVersionsSignaturesEmbeddedList**](DocumentsApi.md#documentsVersionsSignaturesEmbeddedList) | **GET** /documents/{document_id}/versions/{document_version_id}/signatures/embedded/ | 
[**documentsVersionsSignaturesEmbeddedRead**](DocumentsApi.md#documentsVersionsSignaturesEmbeddedRead) | **GET** /documents/{document_id}/versions/{document_version_id}/signatures/embedded/{embedded_signature_id}/ | 
[**documentsVersionsSignaturesEmbeddedSignCreate**](DocumentsApi.md#documentsVersionsSignaturesEmbeddedSignCreate) | **POST** /documents/{document_id}/versions/{document_version_id}/signatures/embedded/sign/ | 
[**documentsVersionsUpdate**](DocumentsApi.md#documentsVersionsUpdate) | **PUT** /documents/{id}/versions/{version_pk}/ | 
[**documentsWorkflowsList**](DocumentsApi.md#documentsWorkflowsList) | **GET** /documents/{id}/workflows/ | 
[**documentsWorkflowsLogEntriesCreate**](DocumentsApi.md#documentsWorkflowsLogEntriesCreate) | **POST** /documents/{id}/workflows/{workflow_pk}/log_entries/ | 
[**documentsWorkflowsLogEntriesList**](DocumentsApi.md#documentsWorkflowsLogEntriesList) | **GET** /documents/{id}/workflows/{workflow_pk}/log_entries/ | 
[**documentsWorkflowsRead**](DocumentsApi.md#documentsWorkflowsRead) | **GET** /documents/{id}/workflows/{workflow_pk}/ | 



## documentsCabinetsList

> \OpenAPI\Client\Model\InlineResponse200 documentsCabinetsList($id, $page)



Returns a list of all the cabinets to which a document belongs.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsCabinetsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCabinetsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
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


## documentsCommentsCreate

> \OpenAPI\Client\Model\WritableComment documentsCommentsCreate($document_pk, $data)



Create a new document comment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableComment(); // \OpenAPI\Client\Model\WritableComment | 

try {
    $result = $apiInstance->documentsCommentsCreate($document_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableComment**](../Model/WritableComment.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableComment**](../Model/WritableComment.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsCommentsDelete

> documentsCommentsDelete($document_pk, $comment_pk)



Delete the selected document comment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$comment_pk = 'comment_pk_example'; // string | 

try {
    $apiInstance->documentsCommentsDelete($document_pk, $comment_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **comment_pk** | **string**|  |

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


## documentsCommentsList

> \OpenAPI\Client\Model\InlineResponse20011 documentsCommentsList($document_pk, $page)



Returns a list of all the document comments.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsCommentsList($document_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20011**](../Model/InlineResponse20011.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsCommentsPartialUpdate

> \OpenAPI\Client\Model\Comment documentsCommentsPartialUpdate($document_pk, $comment_pk, $data)



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$comment_pk = 'comment_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\Comment(); // \OpenAPI\Client\Model\Comment | 

try {
    $result = $apiInstance->documentsCommentsPartialUpdate($document_pk, $comment_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **comment_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\Comment**](../Model/Comment.md)|  |

### Return type

[**\OpenAPI\Client\Model\Comment**](../Model/Comment.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsCommentsRead

> \OpenAPI\Client\Model\Comment documentsCommentsRead($document_pk, $comment_pk)



Returns the details of the selected document comment.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$comment_pk = 'comment_pk_example'; // string | 

try {
    $result = $apiInstance->documentsCommentsRead($document_pk, $comment_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **comment_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\Comment**](../Model/Comment.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsCommentsUpdate

> \OpenAPI\Client\Model\Comment documentsCommentsUpdate($document_pk, $comment_pk, $data)



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$comment_pk = 'comment_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\Comment(); // \OpenAPI\Client\Model\Comment | 

try {
    $result = $apiInstance->documentsCommentsUpdate($document_pk, $comment_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCommentsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **comment_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\Comment**](../Model/Comment.md)|  |

### Return type

[**\OpenAPI\Client\Model\Comment**](../Model/Comment.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsCreate

> \OpenAPI\Client\Model\NewDocument documentsCreate($data)



Create a new document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\NewDocument(); // \OpenAPI\Client\Model\NewDocument | 

try {
    $result = $apiInstance->documentsCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\NewDocument**](../Model/NewDocument.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocument**](../Model/NewDocument.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsDelete

> documentsDelete($id)



Move the selected document to the thrash.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.

try {
    $apiInstance->documentsDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |

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


## documentsDownloadRead

> documentsDownloadRead($id)



Download the latest version of a document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.

try {
    $apiInstance->documentsDownloadRead($id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsDownloadRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |

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


## documentsIndexesList

> \OpenAPI\Client\Model\InlineResponse20014 documentsIndexesList($id, $page)



Returns a list of all the indexes to which a document belongs.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsIndexesList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsIndexesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20014**](../Model/InlineResponse20014.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsList

> \OpenAPI\Client\Model\InlineResponse2006 documentsList($page)



Returns a list of all the documents.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
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


## documentsMetadataCreate

> \OpenAPI\Client\Model\NewDocumentMetadata documentsMetadataCreate($document_pk, $data)



Add an existing metadata type and value to the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\NewDocumentMetadata(); // \OpenAPI\Client\Model\NewDocumentMetadata | 

try {
    $result = $apiInstance->documentsMetadataCreate($document_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewDocumentMetadata**](../Model/NewDocumentMetadata.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentMetadata**](../Model/NewDocumentMetadata.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsMetadataDelete

> documentsMetadataDelete($document_pk, $metadata_pk)



Remove this metadata entry from the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$metadata_pk = 'metadata_pk_example'; // string | 

try {
    $apiInstance->documentsMetadataDelete($document_pk, $metadata_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **metadata_pk** | **string**|  |

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


## documentsMetadataList

> \OpenAPI\Client\Model\InlineResponse20012 documentsMetadataList($document_pk, $page)



Returns a list of selected document's metadata types and values.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsMetadataList($document_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20012**](../Model/InlineResponse20012.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsMetadataPartialUpdate

> \OpenAPI\Client\Model\DocumentMetadata documentsMetadataPartialUpdate($document_pk, $metadata_pk, $data)



Edit the selected document metadata type and value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$metadata_pk = 'metadata_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\DocumentMetadata(); // \OpenAPI\Client\Model\DocumentMetadata | 

try {
    $result = $apiInstance->documentsMetadataPartialUpdate($document_pk, $metadata_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **metadata_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\DocumentMetadata**](../Model/DocumentMetadata.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentMetadata**](../Model/DocumentMetadata.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsMetadataRead

> \OpenAPI\Client\Model\DocumentMetadata documentsMetadataRead($document_pk, $metadata_pk)



Return the details of the selected document metadata type and value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$metadata_pk = 'metadata_pk_example'; // string | 

try {
    $result = $apiInstance->documentsMetadataRead($document_pk, $metadata_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **metadata_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentMetadata**](../Model/DocumentMetadata.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsMetadataUpdate

> \OpenAPI\Client\Model\DocumentMetadata documentsMetadataUpdate($document_pk, $metadata_pk, $data)



Edit the selected document metadata type and value.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$metadata_pk = 'metadata_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\DocumentMetadata(); // \OpenAPI\Client\Model\DocumentMetadata | 

try {
    $result = $apiInstance->documentsMetadataUpdate($document_pk, $metadata_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsMetadataUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **metadata_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\DocumentMetadata**](../Model/DocumentMetadata.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentMetadata**](../Model/DocumentMetadata.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsOcrSubmitCreate

> documentsOcrSubmitCreate($id)



Submit a document for OCR.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.

try {
    $apiInstance->documentsOcrSubmitCreate($id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsOcrSubmitCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |

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


## documentsPartialUpdate

> \OpenAPI\Client\Model\WritableDocument documentsPartialUpdate($id, $data)



Edit the properties of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.
$data = new \OpenAPI\Client\Model\WritableDocument(); // \OpenAPI\Client\Model\WritableDocument | 

try {
    $result = $apiInstance->documentsPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |
 **data** | [**\OpenAPI\Client\Model\WritableDocument**](../Model/WritableDocument.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocument**](../Model/WritableDocument.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsRead

> \OpenAPI\Client\Model\Document documentsRead($id)



Return the details of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.

try {
    $result = $apiInstance->documentsRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |

### Return type

[**\OpenAPI\Client\Model\Document**](../Model/Document.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsRecentList

> \OpenAPI\Client\Model\InlineResponse2008 documentsRecentList($page)



Return a list of the recent documents for the current user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsRecentList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsRecentList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2008**](../Model/InlineResponse2008.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsResolvedSmartLinksDocumentsList

> \OpenAPI\Client\Model\InlineResponse20016 documentsResolvedSmartLinksDocumentsList($id, $smart_link_pk, $page)



Returns a list of the smart link documents that apply to the document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$smart_link_pk = 'smart_link_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsResolvedSmartLinksDocumentsList($id, $smart_link_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsResolvedSmartLinksDocumentsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **smart_link_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20016**](../Model/InlineResponse20016.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsResolvedSmartLinksList

> \OpenAPI\Client\Model\InlineResponse20015 documentsResolvedSmartLinksList($id, $page)



Returns a list of the smart links that apply to the document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsResolvedSmartLinksList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsResolvedSmartLinksList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20015**](../Model/InlineResponse20015.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsResolvedSmartLinksRead

> \OpenAPI\Client\Model\ResolvedSmartLink documentsResolvedSmartLinksRead($id, $smart_link_pk)



Return the details of the selected resolved smart link.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$smart_link_pk = 'smart_link_pk_example'; // string | 

try {
    $result = $apiInstance->documentsResolvedSmartLinksRead($id, $smart_link_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsResolvedSmartLinksRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **smart_link_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\ResolvedSmartLink**](../Model/ResolvedSmartLink.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsTagsCreate

> \OpenAPI\Client\Model\NewDocumentTag documentsTagsCreate($document_pk, $data)



Attach a tag to a document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\NewDocumentTag(); // \OpenAPI\Client\Model\NewDocumentTag | 

try {
    $result = $apiInstance->documentsTagsCreate($document_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsTagsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewDocumentTag**](../Model/NewDocumentTag.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentTag**](../Model/NewDocumentTag.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsTagsDelete

> documentsTagsDelete($document_pk, $id)



Remove a tag from the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$id = 'id_example'; // string | 

try {
    $apiInstance->documentsTagsDelete($document_pk, $id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsTagsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
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


## documentsTagsList

> \OpenAPI\Client\Model\InlineResponse20013 documentsTagsList($document_pk, $page)



Returns a list of all the tags attached to a document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsTagsList($document_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsTagsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20013**](../Model/InlineResponse20013.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsTagsRead

> \OpenAPI\Client\Model\DocumentTag documentsTagsRead($document_pk, $id)



Returns the details of the selected document tag.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$id = 'id_example'; // string | 

try {
    $result = $apiInstance->documentsTagsRead($document_pk, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsTagsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentTag**](../Model/DocumentTag.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsTypeChangeCreate

> \OpenAPI\Client\Model\NewDocumentDocumentType documentsTypeChangeCreate($id, $data)



Change the type of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.
$data = new \OpenAPI\Client\Model\NewDocumentDocumentType(); // \OpenAPI\Client\Model\NewDocumentDocumentType | 

try {
    $result = $apiInstance->documentsTypeChangeCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsTypeChangeCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |
 **data** | [**\OpenAPI\Client\Model\NewDocumentDocumentType**](../Model/NewDocumentDocumentType.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentDocumentType**](../Model/NewDocumentDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsUpdate

> \OpenAPI\Client\Model\WritableDocument documentsUpdate($id, $data)



Edit the properties of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Document.
$data = new \OpenAPI\Client\Model\WritableDocument(); // \OpenAPI\Client\Model\WritableDocument | 

try {
    $result = $apiInstance->documentsUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Document. |
 **data** | [**\OpenAPI\Client\Model\WritableDocument**](../Model/WritableDocument.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocument**](../Model/WritableDocument.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsCreate

> \OpenAPI\Client\Model\NewDocumentVersion documentsVersionsCreate($id, $data)



Create a new document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\NewDocumentVersion(); // \OpenAPI\Client\Model\NewDocumentVersion | 

try {
    $result = $apiInstance->documentsVersionsCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewDocumentVersion**](../Model/NewDocumentVersion.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewDocumentVersion**](../Model/NewDocumentVersion.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsDelete

> documentsVersionsDelete($id, $version_pk)



Delete the selected document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 

try {
    $apiInstance->documentsVersionsDelete($id, $version_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |

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


## documentsVersionsDownloadRead

> documentsVersionsDownloadRead($id, $version_pk)



Download a document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 

try {
    $apiInstance->documentsVersionsDownloadRead($id, $version_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsDownloadRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |

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


## documentsVersionsList

> \OpenAPI\Client\Model\InlineResponse20017 documentsVersionsList($id, $page)



Return a list of the selected document's versions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsVersionsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20017**](../Model/InlineResponse20017.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsOcrCreate

> documentsVersionsOcrCreate($document_pk, $version_pk)



Submit a document version for OCR.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$version_pk = 'version_pk_example'; // string | 

try {
    $apiInstance->documentsVersionsOcrCreate($document_pk, $version_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsOcrCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **version_pk** | **string**|  |

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


## documentsVersionsPagesContentRead

> \OpenAPI\Client\Model\DocumentPageContent documentsVersionsPagesContentRead($document_pk, $version_pk, $page_pk)



Returns the content of the selected document page.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsPagesContentRead($document_pk, $version_pk, $page_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesContentRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentPageContent**](../Model/DocumentPageContent.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPagesImageRead

> documentsVersionsPagesImageRead($id, $version_pk, $page_pk)



Returns an image representation of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 

try {
    $apiInstance->documentsVersionsPagesImageRead($id, $version_pk, $page_pk);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesImageRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |

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


## documentsVersionsPagesList

> \OpenAPI\Client\Model\InlineResponse20018 documentsVersionsPagesList($id, $version_pk, $page)



### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsVersionsPagesList($id, $version_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20018**](../Model/InlineResponse20018.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPagesOcrRead

> \OpenAPI\Client\Model\DocumentPageOCRContent documentsVersionsPagesOcrRead($document_pk, $version_pk, $page_pk)



Returns the OCR content of the selected document page.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_pk = 'document_pk_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsPagesOcrRead($document_pk, $version_pk, $page_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesOcrRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_pk** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentPageOCRContent**](../Model/DocumentPageOCRContent.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPagesPartialUpdate

> \OpenAPI\Client\Model\DocumentPage documentsVersionsPagesPartialUpdate($id, $version_pk, $page_pk, $data)



Edit the selected document page.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\DocumentPage(); // \OpenAPI\Client\Model\DocumentPage | 

try {
    $result = $apiInstance->documentsVersionsPagesPartialUpdate($id, $version_pk, $page_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\DocumentPage**](../Model/DocumentPage.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentPage**](../Model/DocumentPage.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPagesRead

> \OpenAPI\Client\Model\DocumentPage documentsVersionsPagesRead($id, $version_pk, $page_pk)



Returns the selected document page details.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsPagesRead($id, $version_pk, $page_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentPage**](../Model/DocumentPage.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPagesUpdate

> \OpenAPI\Client\Model\DocumentPage documentsVersionsPagesUpdate($id, $version_pk, $page_pk, $data)



Edit the selected document page.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$page_pk = 'page_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\DocumentPage(); // \OpenAPI\Client\Model\DocumentPage | 

try {
    $result = $apiInstance->documentsVersionsPagesUpdate($id, $version_pk, $page_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPagesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **page_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\DocumentPage**](../Model/DocumentPage.md)|  |

### Return type

[**\OpenAPI\Client\Model\DocumentPage**](../Model/DocumentPage.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsPartialUpdate

> \OpenAPI\Client\Model\WritableDocumentVersion documentsVersionsPartialUpdate($id, $version_pk, $data)



Edit the selected document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableDocumentVersion(); // \OpenAPI\Client\Model\WritableDocumentVersion | 

try {
    $result = $apiInstance->documentsVersionsPartialUpdate($id, $version_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentVersion**](../Model/WritableDocumentVersion.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentVersion**](../Model/WritableDocumentVersion.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsRead

> \OpenAPI\Client\Model\DocumentVersion documentsVersionsRead($id, $version_pk)



Returns the selected document version details.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsRead($id, $version_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DocumentVersion**](../Model/DocumentVersion.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesDetachedCreate

> \OpenAPI\Client\Model\DetachedSignature documentsVersionsSignaturesDetachedCreate($document_id, $document_version_id, $data)



Create an detached signature for a document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$data = new \OpenAPI\Client\Model\DetachedSignature(); // \OpenAPI\Client\Model\DetachedSignature | 

try {
    $result = $apiInstance->documentsVersionsSignaturesDetachedCreate($document_id, $document_version_id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesDetachedCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\DetachedSignature**](../Model/DetachedSignature.md)|  |

### Return type

[**\OpenAPI\Client\Model\DetachedSignature**](../Model/DetachedSignature.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesDetachedDelete

> documentsVersionsSignaturesDetachedDelete($document_id, $document_version_id, $detached_signature_id)



Delete an detached signature of the selected document.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$detached_signature_id = 'detached_signature_id_example'; // string | 

try {
    $apiInstance->documentsVersionsSignaturesDetachedDelete($document_id, $document_version_id, $detached_signature_id);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesDetachedDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **detached_signature_id** | **string**|  |

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


## documentsVersionsSignaturesDetachedList

> \OpenAPI\Client\Model\InlineResponse2009 documentsVersionsSignaturesDetachedList($document_id, $document_version_id, $page)



Returns a list of all the detached signatures of a document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsVersionsSignaturesDetachedList($document_id, $document_version_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesDetachedList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse2009**](../Model/InlineResponse2009.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesDetachedRead

> \OpenAPI\Client\Model\DetachedSignature documentsVersionsSignaturesDetachedRead($document_id, $document_version_id, $detached_signature_id)



Returns the details of the selected detached signature.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$detached_signature_id = 'detached_signature_id_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsSignaturesDetachedRead($document_id, $document_version_id, $detached_signature_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesDetachedRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **detached_signature_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\DetachedSignature**](../Model/DetachedSignature.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesDetachedSignCreate

> \OpenAPI\Client\Model\SignDetached documentsVersionsSignaturesDetachedSignCreate($document_id, $document_version_id, $data)



Sign a document version with a detached signature.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$data = new \OpenAPI\Client\Model\SignDetached(); // \OpenAPI\Client\Model\SignDetached | 

try {
    $result = $apiInstance->documentsVersionsSignaturesDetachedSignCreate($document_id, $document_version_id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesDetachedSignCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\SignDetached**](../Model/SignDetached.md)|  |

### Return type

[**\OpenAPI\Client\Model\SignDetached**](../Model/SignDetached.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesEmbeddedList

> \OpenAPI\Client\Model\InlineResponse20010 documentsVersionsSignaturesEmbeddedList($document_id, $document_version_id, $page)



Returns a list of all the embedded signatures of a document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsVersionsSignaturesEmbeddedList($document_id, $document_version_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesEmbeddedList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20010**](../Model/InlineResponse20010.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesEmbeddedRead

> \OpenAPI\Client\Model\EmbeddedSignature documentsVersionsSignaturesEmbeddedRead($document_id, $document_version_id, $embedded_signature_id)



Returns the details of the selected embedded signature.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$embedded_signature_id = 'embedded_signature_id_example'; // string | 

try {
    $result = $apiInstance->documentsVersionsSignaturesEmbeddedRead($document_id, $document_version_id, $embedded_signature_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesEmbeddedRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **embedded_signature_id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\EmbeddedSignature**](../Model/EmbeddedSignature.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsSignaturesEmbeddedSignCreate

> \OpenAPI\Client\Model\SignEmbedded documentsVersionsSignaturesEmbeddedSignCreate($document_id, $document_version_id, $data)



Sign a document version with an embedded signature.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$document_id = 'document_id_example'; // string | 
$document_version_id = 'document_version_id_example'; // string | 
$data = new \OpenAPI\Client\Model\SignEmbedded(); // \OpenAPI\Client\Model\SignEmbedded | 

try {
    $result = $apiInstance->documentsVersionsSignaturesEmbeddedSignCreate($document_id, $document_version_id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsSignaturesEmbeddedSignCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **document_id** | **string**|  |
 **document_version_id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\SignEmbedded**](../Model/SignEmbedded.md)|  |

### Return type

[**\OpenAPI\Client\Model\SignEmbedded**](../Model/SignEmbedded.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsVersionsUpdate

> \OpenAPI\Client\Model\WritableDocumentVersion documentsVersionsUpdate($id, $version_pk, $data)



Edit the selected document version.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$version_pk = 'version_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableDocumentVersion(); // \OpenAPI\Client\Model\WritableDocumentVersion | 

try {
    $result = $apiInstance->documentsVersionsUpdate($id, $version_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsVersionsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **version_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableDocumentVersion**](../Model/WritableDocumentVersion.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableDocumentVersion**](../Model/WritableDocumentVersion.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsWorkflowsList

> \OpenAPI\Client\Model\InlineResponse20019 documentsWorkflowsList($id, $page)



Returns a list of all the document workflows.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsWorkflowsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsWorkflowsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20019**](../Model/InlineResponse20019.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsWorkflowsLogEntriesCreate

> \OpenAPI\Client\Model\WritableWorkflowInstanceLogEntry documentsWorkflowsLogEntriesCreate($id, $workflow_pk, $data)



Transition a document workflow by creating a new document workflow log entry.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$workflow_pk = 'workflow_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableWorkflowInstanceLogEntry(); // \OpenAPI\Client\Model\WritableWorkflowInstanceLogEntry | 

try {
    $result = $apiInstance->documentsWorkflowsLogEntriesCreate($id, $workflow_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsWorkflowsLogEntriesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **workflow_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflowInstanceLogEntry**](../Model/WritableWorkflowInstanceLogEntry.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflowInstanceLogEntry**](../Model/WritableWorkflowInstanceLogEntry.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsWorkflowsLogEntriesList

> \OpenAPI\Client\Model\InlineResponse20020 documentsWorkflowsLogEntriesList($id, $workflow_pk, $page)



Returns a list of all the document workflows log entries.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$workflow_pk = 'workflow_pk_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->documentsWorkflowsLogEntriesList($id, $workflow_pk, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsWorkflowsLogEntriesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **workflow_pk** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20020**](../Model/InlineResponse20020.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## documentsWorkflowsRead

> \OpenAPI\Client\Model\WorkflowInstance documentsWorkflowsRead($id, $workflow_pk)



Return the details of the selected document workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\DocumentsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$workflow_pk = 'workflow_pk_example'; // string | 

try {
    $result = $apiInstance->documentsWorkflowsRead($id, $workflow_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DocumentsApi->documentsWorkflowsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **workflow_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowInstance**](../Model/WorkflowInstance.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

