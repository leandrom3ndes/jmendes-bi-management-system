// Trigger template BiElementType
export class BiElementType {
    success: boolean;
    data: BiElementType[];
    message: string;

    constructor(success: boolean, data: BiElementType[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
