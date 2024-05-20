# OpenAPI\Client\ObjectsApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**objectsAclsCreate**](ObjectsApi.md#objectsAclsCreate) | **POST** /objects/{app_label}/{model_name}/{object_id}/acls/ | 
[**objectsAclsDelete**](ObjectsApi.md#objectsAclsDelete) | **DELETE** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/ | 
[**objectsAclsList**](ObjectsApi.md#objectsAclsList) | **GET** /objects/{app_label}/{model_name}/{object_id}/acls/ | 
[**objectsAclsPermissionsCreate**](ObjectsApi.md#objectsAclsPermissionsCreate) | **POST** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/permissions/ | 
[**objectsAclsPermissionsDelete**](ObjectsApi.md#objectsAclsPermissionsDelete) | **DELETE** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/permissions/{permission_pk}/ | 
[**objectsAclsPermissionsList**](ObjectsApi.md#objectsAclsPermissionsList) | **GET** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/permissions/ | 
[**objectsAclsPermissionsRead**](ObjectsApi.md#objectsAclsPermissionsRead) | **GET** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/permissions/{permission_pk}/ | 
[**objectsAclsRead**](ObjectsApi.md#objectsAclsRead) | **GET** /objects/{app_label}/{model_name}/{object_id}/acls/{id}/ | 
[**objectsEventsList**](ObjectsApi.md#objectsEventsList) | **GET** /objects/{app_label}/{model}/{object_id}/events/ | 



## objectsAclsCreate

> \OpenAPI\Client\Model\WritableAccessControlList objectsAclsCreate($app_label, $model_name, $object_id, $data)



Create a new access control list for the selected object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableAccessControlList(); // \OpenAPI\Client\Model\WritableAccessControlList | 

try {
    $result = $apiInstance->objectsAclsCreate($app_label, $model_name, $object_id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableAccessControlList**](../Model/WritableAccessControlList.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableAccessControlList**](../Model/WritableAccessControlList.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsAclsDelete

> objectsAclsDelete($app_label, $model_name, $object_id, $id)



Delete the selected access control list.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 

try {
    $apiInstance->objectsAclsDelete($app_label, $model_name, $object_id, $id);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
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


## objectsAclsList

> \OpenAPI\Client\Model\InlineResponse20031 objectsAclsList($app_label, $model_name, $object_id, $page)



Returns a list of all the object's access control lists

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->objectsAclsList($app_label, $model_name, $object_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20031**](../Model/InlineResponse20031.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsAclsPermissionsCreate

> \OpenAPI\Client\Model\WritableAccessControlListPermission objectsAclsPermissionsCreate($app_label, $model_name, $object_id, $id, $data)



Add a new permission to the selected access control list.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\WritableAccessControlListPermission(); // \OpenAPI\Client\Model\WritableAccessControlListPermission | 

try {
    $result = $apiInstance->objectsAclsPermissionsCreate($app_label, $model_name, $object_id, $id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsPermissionsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\WritableAccessControlListPermission**](../Model/WritableAccessControlListPermission.md)|  |

### Return type

[**\OpenAPI\Client\Model\WritableAccessControlListPermission**](../Model/WritableAccessControlListPermission.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsAclsPermissionsDelete

> objectsAclsPermissionsDelete($app_label, $model_name, $object_id, $id, $permission_pk)



Remove the permission from the selected access control list.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 
$permission_pk = 'permission_pk_example'; // string | 

try {
    $apiInstance->objectsAclsPermissionsDelete($app_label, $model_name, $object_id, $id, $permission_pk);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsPermissionsDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **id** | **string**|  |
 **permission_pk** | **string**|  |

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


## objectsAclsPermissionsList

> \OpenAPI\Client\Model\InlineResponse20032 objectsAclsPermissionsList($app_label, $model_name, $object_id, $id, $page)



Returns the access control list permission list.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->objectsAclsPermissionsList($app_label, $model_name, $object_id, $id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsPermissionsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20032**](../Model/InlineResponse20032.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsAclsPermissionsRead

> \OpenAPI\Client\Model\AccessControlListPermission objectsAclsPermissionsRead($app_label, $model_name, $object_id, $id, $permission_pk)



Returns the details of the selected access control list permission.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 
$permission_pk = 'permission_pk_example'; // string | 

try {
    $result = $apiInstance->objectsAclsPermissionsRead($app_label, $model_name, $object_id, $id, $permission_pk);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsPermissionsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **id** | **string**|  |
 **permission_pk** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\AccessControlListPermission**](../Model/AccessControlListPermission.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsAclsRead

> \OpenAPI\Client\Model\AccessControlList objectsAclsRead($app_label, $model_name, $object_id, $id)



Returns the details of the selected access control list.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model_name = 'model_name_example'; // string | 
$object_id = 'object_id_example'; // string | 
$id = 'id_example'; // string | 

try {
    $result = $apiInstance->objectsAclsRead($app_label, $model_name, $object_id, $id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsAclsRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model_name** | **string**|  |
 **object_id** | **string**|  |
 **id** | **string**|  |

### Return type

[**\OpenAPI\Client\Model\AccessControlList**](../Model/AccessControlList.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## objectsEventsList

> \OpenAPI\Client\Model\InlineResponse20023 objectsEventsList($app_label, $model, $object_id, $page)



Return a list of events for the specified object.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\ObjectsApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$app_label = 'app_label_example'; // string | 
$model = 'model_example'; // string | 
$object_id = 'object_id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->objectsEventsList($app_label, $model, $object_id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ObjectsApi->objectsEventsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **app_label** | **string**|  |
 **model** | **string**|  |
 **object_id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20023**](../Model/InlineResponse20023.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

