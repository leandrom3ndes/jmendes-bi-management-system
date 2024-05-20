# # User

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**first_name** | **string** |  | [optional] 
**date_joined** | [**\DateTime**](\DateTime.md) |  | [optional] [readonly] 
**email** | **string** |  | [optional] 
**groups** | [**\OpenAPI\Client\Model\Group[]**](Group.md) |  | [optional] [readonly] 
**groups_pk_list** | **string** | List of group primary keys to which to add the user. | [optional] 
**id** | **int** |  | [optional] [readonly] 
**is_active** | **bool** | Designates whether this user should be treated as active. Unselect this instead of deleting accounts. | [optional] [readonly] 
**last_login** | [**\DateTime**](\DateTime.md) |  | [optional] [readonly] 
**last_name** | **string** |  | [optional] 
**password** | **string** |  | [optional] 
**url** | **string** |  | [optional] [readonly] 
**username** | **string** | Required. 150 characters or fewer. Letters, digits and @/./+/-/_ only. | 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


