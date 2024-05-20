// Trigger template BiElement
export class BiEngine {
    success: boolean;
    data: BiEngine[];
    message: string;

    constructor(success: boolean, data: BiEngine[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
