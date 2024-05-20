import {ProcessType} from './processtype.model';

//Trigger template processType
export class ProcessTypes {
    success: boolean;
    data: ProcessType[];
    message: string;

    constructor(success: boolean, data: ProcessType[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
