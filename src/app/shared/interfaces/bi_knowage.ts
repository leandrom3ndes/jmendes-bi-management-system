// Trigger template BiElement
export class BiKnowage {
    success: boolean;
    data: BiKnowage[];
    message: string;

    constructor(success: boolean, data: BiKnowage[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
