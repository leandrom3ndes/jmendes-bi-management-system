import {ActorState} from './actor_state.model';

//Trigger template actor
export class ActorStates {
    success: boolean;
    data: ActorState[];
    message: string;

    constructor(success: boolean, data: ActorState[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
