# # WorkflowInstance

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**current_state** | [**\OpenAPI\Client\Model\WorkflowState**](WorkflowState.md) |  | [optional] 
**document_workflow_url** | **string** | API URL pointing to a workflow in relation to the document to which it is attached. This URL is different than the canonical workflow URL. | [optional] [readonly] 
**last_log_entry** | [**\OpenAPI\Client\Model\WorkflowInstanceLogEntry**](WorkflowInstanceLogEntry.md) |  | [optional] 
**log_entries_url** | **string** | A link to the entire history of this workflow. | [optional] [readonly] 
**transition_choices** | [**\OpenAPI\Client\Model\WorkflowTransition[]**](WorkflowTransition.md) |  | [optional] [readonly] 
**workflow** | [**\OpenAPI\Client\Model\Workflow**](Workflow.md) |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)


