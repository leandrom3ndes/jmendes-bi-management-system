import {ProcessTypeState} from './processtypestate.model';


export class ProcessTypeStates {
    success: boolean;
    data: ProcessTypeState[];
    message: string;

    constructor(success: boolean, data: ProcessTypeState[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
