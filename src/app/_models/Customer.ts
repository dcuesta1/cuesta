import { BaseModel } from "./BaseModel";
import { Invoice } from "./Invoice";
import { Car } from "./Car";

export class Customer extends BaseModel {
    id: number;
    user_id: number;
    first_name: string;
    last_name: string;
    phone: string;
    email: string;
    address_one: string;
    address_two: string;
    city: string;
    invoices: Array<any>;
    cars: Array<Car>;
    state: string;
    created_at: Date;
    updated_at: Date;
    deleted_at: Date;

    constructor(model: any = null) {
        super(model);

        if(this.cars) {
            let i = 0;
            for(let car of this.cars) {
                this.cars[i] = new Car(car);
                i++;
            }
        }
    }

    fullName() :string{
        return this.first_name + ' ' + this.last_name;
    }
}