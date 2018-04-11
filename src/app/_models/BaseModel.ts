export class BaseModel {
    constructor(model :any = null) {
        if(model) {
            for (let key of Object.keys(model)) {  
                this[key] = model[key];
            }
        }
    }
}