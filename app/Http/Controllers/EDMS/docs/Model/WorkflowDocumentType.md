# # WorkflowDocumentType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**delete_time_period** | **int** | Amount of time after which documents of this type in the trash will be deleted. | [optional] [readonly] 
**delete_time_unit** | **string** |  | [optional] [readonly] 
**documents_url** | **string** |  | [optional] [readonly] 
**documents_count** | **string** |  | [optional] [readonly] 
**id** | **int** |  | [optional] [readonly] 
**label** | **string** | The name of the document type. | [optional] [readonly] 
**filenames** | [**\OpenAPI\Client\Model\DocumentTypeFilename[]**](DocumentTypeFilename.md) |  | [optional] [readonly] 
**trash_time_period** | **int** | Amount of time after which documents of this type will be moved to the trash. | [optional] [readonly] 
**trash_time_unit** | **string** |  | [optional] [readonly] 
**url** | **string** |  | [optional] [readonly] 
**workflow_document_type_url** | **string** | API URL pointing to a document type in relation to the workflow to which it is attached. This URL is different than the canonical document type URL. | [optional] [readonly] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


