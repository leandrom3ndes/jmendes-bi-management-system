# OpenAPI\Client\WorkflowsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**workflowsCreate**](WorkflowsApi.md#workflowsCreate) | **POST** /workflows/ | 
[**workflowsDelete**](WorkflowsApi.md#workflowsDelete) | **DELETE** /workflows/{id}/ | 
[**workflowsDocumentTypesCreate**](WorkflowsApi.md#workflowsDocumentTypesCreate) | **POST** /workflows/{id}/document_types/ | 
[**workflowsDocumentTypesDelete**](WorkflowsApi.md#workflowsDocumentTypesDelete) | **DELETE** /workflows/{id}/document_types/{document_type_pk}/ | 
[**workflowsDocumentTypesList**](WorkflowsApi.md#workflowsDocumentTypesList) | **GET** /workflows/{id}/document_types/ | 
[**workflowsDocumentTypesRead**](WorkflowsApi.md#workflowsDocumentTypesRead) | **GET** /workflows/{id}/document_types/{document_type_pk}/ | 
[**workflowsImageRead**](WorkflowsApi.md#workflowsImageRead) | **GET** /workflows/{id}/image/ | 
[**workflowsList**](WorkflowsApi.md#workflowsList) | **GET** /workflows/ | 
[**workflowsPartialUpdate**](WorkflowsApi.md#workflowsPartialUpdate) | **PATCH** /workflows/{id}/ | 
[**workflowsRead**](WorkflowsApi.md#workflowsRead) | **GET** /workflows/{id}/ | 
[**workflowsStatesCreate**](WorkflowsApi.md#workflowsStatesCreate) | **POST** /workflows/{id}/states/ | 
[**workflowsStatesDelete**](WorkflowsApi.md#workflowsStatesDelete) | **DELETE** /workflows/{id}/states/{state_pk}/ | 
[**workflowsStatesList**](WorkflowsApi.md#workflowsStatesList) | **GET** /workflows/{id}/states/ | 
[**workflowsStatesPartialUpdate**](WorkflowsApi.md#workflowsStatesPartialUpdate) | **PATCH** /workflows/{id}/states/{state_pk}/ | 
[**workflowsStatesRead**](WorkflowsApi.md#workflowsStatesRead) | **GET** /workflows/{id}/states/{state_pk}/ | 
[**workflowsStatesUpdate**](WorkflowsApi.md#workflowsStatesUpdate) | **PUT** /workflows/{id}/states/{state_pk}/ | 
[**workflowsTransitionsCreate**](WorkflowsApi.md#workflowsTransitionsCreate) | **POST** /workflows/{id}/transitions/ | 
[**workflowsTransitionsDelete**](WorkflowsApi.md#workflowsTransitionsDelete) | **DELETE** /workflows/{id}/transitions/{transition_pk}/ | 
[**workflowsTransitionsList**](WorkflowsApi.md#workflowsTransitionsList) | **GET** /workflows/{id}/transitions/ | 
[**workflowsTransitionsPartialUpdate**](WorkflowsApi.md#workflowsTransitionsPartialUpdate) | **PATCH** /workflows/{id}/transitions/{transition_pk}/ | 
[**workflowsTransitionsRead**](WorkflowsApi.md#workflowsTransitionsRead) | **GET** /workflows/{id}/transitions/{transition_pk}/ | 
[**workflowsTransitionsUpdate**](WorkflowsApi.md#workflowsTransitionsUpdate) | **PUT** /workflows/{id}/transitions/{transition_pk}/ | 
[**workflowsUpdate**](WorkflowsApi.md#workflowsUpdate) | **PUT** /workflows/{id}/ | 



## workflowsCreate

> \OpenAPI\Client\Model\WritableWorkflow workflowsCreate($data)



Create a new workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\WritableWorkflow(); // \OpenAPI\Client\Model\WritableWorkflow | 

try {
    $result = $apiInstance->workflowsCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsDelete

> workflowsDelete($id)



Delete the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Workflow.

try {
    $apiInstance->workflowsDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Workflow. |

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


## workflowsDocumentTypesCreate

> \OpenAPI\Client\Model\NewWorkflowDocumentType workflowsDocumentTypesCreate($id, $data)



Attach a document type to a specified workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\NewWorkflowDocumentType(); // \OpenAPI\Client\Model\NewWorkflowDocumentType | 

try {
    $result = $apiInstance->workflowsDocumentTypesCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsDocumentTypesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\NewWorkflowDocumentType**](../Model/NewWorkflowDocumentType.md)|  |

### Return type

[**\OpenAPI\Client\Model\NewWorkflowDocumentType**](../Model/NewWorkflowDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsDocumentTypesDelete

> workflowsDocumentTypesDelete($id, $document_type_pk)



Remove a document type from the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$document_type_pk = 'document_type_pk_example'; // string | 

try {
    $apiInstance->workflowsDocumentTypesDelete($id, $document_type_pk);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsDocumentTypesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **document_type_pk** | **string**|  |

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


## workflowsDocumentTypesList

> \OpenAPI\Client\Model\InlineResponse20043 workflowsDocumentTypesList($id, $page)



Returns a list of all the document types attached to a workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->workflowsDocumentTypesList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsDocumentTypesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20043**](../Model/InlineResponse20043.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsDocumentTypesRead

> \OpenAPI\Client\Model\WorkflowDocumentType workflowsDocumentTypesRead($id, $document_type_pk)



Returns the details of the selected workflow document type.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$document_type_pk = 'document_type_pk_example'; // string | 

try {
    $result = $apiInstance->workflowsDocumentTypesRead($id, $document_type_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsDocumentTypesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **document_type_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowDocumentType**](../Model/WorkflowDocumentType.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsImageRead

> workflowsImageRead($id)



Returns an image representation of the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Workflow.

try {
    $apiInstance->workflowsImageRead($id);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsImageRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Workflow. |

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


## workflowsList

> \OpenAPI\Client\Model\InlineResponse2007 workflowsList($page)



Returns a list of all the workflows.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->workflowsList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
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


## workflowsPartialUpdate

> \OpenAPI\Client\Model\WritableWorkflow workflowsPartialUpdate($id, $data)



Edit the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Workflow.
$data = new \OpenAPI\Client\Model\WritableWorkflow(); // \OpenAPI\Client\Model\WritableWorkflow | 

try {
    $result = $apiInstance->workflowsPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Workflow. |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsRead

> \OpenAPI\Client\Model\Workflow workflowsRead($id)



Return the details of the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Workflow.

try {
    $result = $apiInstance->workflowsRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Workflow. |

### Return type

[**\OpenAPI\Client\Model\Workflow**](../Model/Workflow.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsStatesCreate

> \OpenAPI\Client\Model\WorkflowState workflowsStatesCreate($id, $data)



Create a new workflow state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\WorkflowState(); // \OpenAPI\Client\Model\WorkflowState | 

try {
    $result = $apiInstance->workflowsStatesCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsStatesDelete

> workflowsStatesDelete($id, $state_pk)



Delete the selected workflow state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$state_pk = 'state_pk_example'; // string | 

try {
    $apiInstance->workflowsStatesDelete($id, $state_pk);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **state_pk** | **string**|  |

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


## workflowsStatesList

> \OpenAPI\Client\Model\InlineResponse20044 workflowsStatesList($id, $page)



Returns a list of all the workflow states.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->workflowsStatesList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20044**](../Model/InlineResponse20044.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsStatesPartialUpdate

> \OpenAPI\Client\Model\WorkflowState workflowsStatesPartialUpdate($id, $state_pk, $data)



Edit the selected workflow state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$state_pk = 'state_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WorkflowState(); // \OpenAPI\Client\Model\WorkflowState | 

try {
    $result = $apiInstance->workflowsStatesPartialUpdate($id, $state_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **state_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsStatesRead

> \OpenAPI\Client\Model\WorkflowState workflowsStatesRead($id, $state_pk)



Return the details of the selected workflow state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$state_pk = 'state_pk_example'; // string | 

try {
    $result = $apiInstance->workflowsStatesRead($id, $state_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **state_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsStatesUpdate

> \OpenAPI\Client\Model\WorkflowState workflowsStatesUpdate($id, $state_pk, $data)



Edit the selected workflow state.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$state_pk = 'state_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WorkflowState(); // \OpenAPI\Client\Model\WorkflowState | 

try {
    $result = $apiInstance->workflowsStatesUpdate($id, $state_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsStatesUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **state_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowState**](../Model/WorkflowState.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsTransitionsCreate

> \OpenAPI\Client\Model\WritableWorkflowTransition workflowsTransitionsCreate($id, $data)



Create a new workflow transition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableWorkflowTransition(); // \OpenAPI\Client\Model\WritableWorkflowTransition | 

try {
    $result = $apiInstance->workflowsTransitionsCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsTransitionsDelete

> workflowsTransitionsDelete($id, $transition_pk)



Delete the selected workflow transition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$transition_pk = 'transition_pk_example'; // string | 

try {
    $apiInstance->workflowsTransitionsDelete($id, $transition_pk);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **transition_pk** | **string**|  |

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


## workflowsTransitionsList

> \OpenAPI\Client\Model\InlineResponse20045 workflowsTransitionsList($id, $page)



Returns a list of all the workflow transitions.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->workflowsTransitionsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20045**](../Model/InlineResponse20045.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsTransitionsPartialUpdate

> \OpenAPI\Client\Model\WritableWorkflowTransition workflowsTransitionsPartialUpdate($id, $transition_pk, $data)



Edit the selected workflow transition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$transition_pk = 'transition_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableWorkflowTransition(); // \OpenAPI\Client\Model\WritableWorkflowTransition | 

try {
    $result = $apiInstance->workflowsTransitionsPartialUpdate($id, $transition_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **transition_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsTransitionsRead

> \OpenAPI\Client\Model\WorkflowTransition workflowsTransitionsRead($id, $transition_pk)



Return the details of the selected workflow transition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$transition_pk = 'transition_pk_example'; // string | 

try {
    $result = $apiInstance->workflowsTransitionsRead($id, $transition_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **transition_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\WorkflowTransition**](../Model/WorkflowTransition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsTransitionsUpdate

> \OpenAPI\Client\Model\WritableWorkflowTransition workflowsTransitionsUpdate($id, $transition_pk, $data)



Edit the selected workflow transition.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$transition_pk = 'transition_pk_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableWorkflowTransition(); // \OpenAPI\Client\Model\WritableWorkflowTransition | 

try {
    $result = $apiInstance->workflowsTransitionsUpdate($id, $transition_pk, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsTransitionsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **transition_pk** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflowTransition**](../Model/WritableWorkflowTransition.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## workflowsUpdate

> \OpenAPI\Client\Model\WritableWorkflow workflowsUpdate($id, $data)



Edit the selected workflow.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\WorkflowsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this Workflow.
$data = new \OpenAPI\Client\Model\WritableWorkflow(); // \OpenAPI\Client\Model\WritableWorkflow | 

try {
    $result = $apiInstance->workflowsUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling WorkflowsApi->workflowsUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this Workflow. |
 **data** | [**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableWorkflow**](../Model/WritableWorkflow.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

