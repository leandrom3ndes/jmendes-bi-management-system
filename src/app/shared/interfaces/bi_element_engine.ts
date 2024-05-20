// Trigger template BiElement
export class BiElementEng {
    success: boolean;
    data: BiElementEng[];
    message: string;

    constructor(success: boolean, data: BiElementEng[], message: string) {
        this.success = success;
        this.data = data;
        this.message = message;
    }
}
