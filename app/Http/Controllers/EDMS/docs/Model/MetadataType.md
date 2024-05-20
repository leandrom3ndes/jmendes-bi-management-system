# # MetadataType

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**default** | **string** | Enter a template to render. Use Django&#39;s default templating language (https://docs.djangoproject.com/en/1.11/ref/templates/builtins/) | [optional] 
**id** | **int** |  | [optional] [readonly] 
**label** | **string** | Short description of this metadata type. | 
**lookup** | **string** | Enter a template to render. Must result in a comma delimited string. Use Django&#39;s default templating language (https://docs.djangoproject.com/en/1.11/ref/templates/builtins/). | [optional] 
**name** | **string** | Name used by other apps to reference this metadata type. Do not use python reserved words, or spaces. | 
**parser** | **string** | The parser will reformat the value entered to conform to the expected format. | [optional] 
**url** | **string** |  | [optional] [readonly] 
**validation** | **string** | The validator will reject data entry if the value entered does not conform to the expected format. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


