# OpenAPI\Client\UsersApi

All URIs are relative to *http://localhost:1234/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**usersCreate**](UsersApi.md#usersCreate) | **POST** /users/ | 
[**usersCurrentDelete**](UsersApi.md#usersCurrentDelete) | **DELETE** /users/current/ | 
[**usersCurrentPartialUpdate**](UsersApi.md#usersCurrentPartialUpdate) | **PATCH** /users/current/ | 
[**usersCurrentRead**](UsersApi.md#usersCurrentRead) | **GET** /users/current/ | 
[**usersCurrentUpdate**](UsersApi.md#usersCurrentUpdate) | **PUT** /users/current/ | 
[**usersDelete**](UsersApi.md#usersDelete) | **DELETE** /users/{id}/ | 
[**usersGroupsCreate**](UsersApi.md#usersGroupsCreate) | **POST** /users/{id}/groups/ | 
[**usersGroupsList**](UsersApi.md#usersGroupsList) | **GET** /users/{id}/groups/ | 
[**usersList**](UsersApi.md#usersList) | **GET** /users/ | 
[**usersPartialUpdate**](UsersApi.md#usersPartialUpdate) | **PATCH** /users/{id}/ | 
[**usersRead**](UsersApi.md#usersRead) | **GET** /users/{id}/ | 
[**usersUpdate**](UsersApi.md#usersUpdate) | **PUT** /users/{id}/ | 



## usersCreate

> \OpenAPI\Client\Model\User usersCreate($data)



Create a new user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | 

try {
    $result = $apiInstance->usersCreate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\User**](../Model/User.md)|  |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersCurrentDelete

> usersCurrentDelete()



Delete the current user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $apiInstance->usersCurrentDelete();
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersCurrentDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

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


## usersCurrentPartialUpdate

> \OpenAPI\Client\Model\User usersCurrentPartialUpdate($data)



Partially edit the current user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | 

try {
    $result = $apiInstance->usersCurrentPartialUpdate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersCurrentPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\User**](../Model/User.md)|  |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersCurrentRead

> \OpenAPI\Client\Model\User usersCurrentRead()



Return the details of the current user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->usersCurrentRead();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersCurrentRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersCurrentUpdate

> \OpenAPI\Client\Model\User usersCurrentUpdate($data)



Edit the current user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$data = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | 

try {
    $result = $apiInstance->usersCurrentUpdate($data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersCurrentUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **data** | [**\OpenAPI\Client\Model\User**](../Model/User.md)|  |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersDelete

> usersDelete($id)



Delete the selected user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this User.

try {
    $apiInstance->usersDelete($id);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersDelete: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this User. |

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


## usersGroupsCreate

> \OpenAPI\Client\Model\UserGroupList usersGroupsCreate($id, $data)



Add a user to a list of groups.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$data = new \OpenAPI\Client\Model\UserGroupList(); // \OpenAPI\Client\Model\UserGroupList | 

try {
    $result = $apiInstance->usersGroupsCreate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersGroupsCreate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **data** | [**\OpenAPI\Client\Model\UserGroupList**](../Model/UserGroupList.md)|  |

### Return type

[**\OpenAPI\Client\Model\UserGroupList**](../Model/UserGroupList.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersGroupsList

> \OpenAPI\Client\Model\InlineResponse20024 usersGroupsList($id, $page)



Returns a list of all the groups to which a user belongs.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 'id_example'; // string | 
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->usersGroupsList($id, $page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersGroupsList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **string**|  |
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20024**](../Model/InlineResponse20024.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersList

> \OpenAPI\Client\Model\InlineResponse20042 usersList($page)



Returns a list of all the users.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$page = 56; // int | A page number within the paginated result set.

try {
    $result = $apiInstance->usersList($page);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **page** | **int**| A page number within the paginated result set. | [optional]

### Return type

[**\OpenAPI\Client\Model\InlineResponse20042**](../Model/InlineResponse20042.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersPartialUpdate

> \OpenAPI\Client\Model\User usersPartialUpdate($id, $data)



Partially edit the selected user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this User.
$data = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | 

try {
    $result = $apiInstance->usersPartialUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersPartialUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this User. |
 **data** | [**\OpenAPI\Client\Model\User**](../Model/User.md)|  |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersRead

> \OpenAPI\Client\Model\User usersRead($id)



Return the details of the selected user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this User.

try {
    $result = $apiInstance->usersRead($id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersRead: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this User. |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)


## usersUpdate

> \OpenAPI\Client\Model\User usersUpdate($id, $data)



Edit the selected user.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: basic
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new OpenAPI\Client\Api\UsersApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$id = 56; // int | A unique integer value identifying this User.
$data = new \OpenAPI\Client\Model\User(); // \OpenAPI\Client\Model\User | 

try {
    $result = $apiInstance->usersUpdate($id, $data);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UsersApi->usersUpdate: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters


Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **id** | **int**| A unique integer value identifying this User. |
 **data** | [**\OpenAPI\Client\Model\User**](../Model/User.md)|  |

### Return type

[**\OpenAPI\Client\Model\User**](../Model/User.md)

### Authorization

[basic](../../README.md#basic)

### HTTP request headers

- **Content-Type**: application/json
- **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints)
[[Back to Model list]](../../README.md#documentation-for-models)
[[Back to README]](../../README.md)

