// Trigger template BiElement
export class BiElement {
    success: boolean;
    data: BiElement[];
    message: string;

    constructor(success: boolean, data: BiElement[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
