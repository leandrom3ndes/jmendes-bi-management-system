import {Actor} from './actor.model';

//Trigger template actor
export class Actors {
    success: boolean;
    data: Actor[];
    message: string;

    constructor(success: boolean, data: Actor[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
