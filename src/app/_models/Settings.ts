import { BaseModel } from './BaseModel';

export class Settings extends BaseModel {
    public id: number;
    public business_name: string;
    public business_email: string;
    public business_phone: string;
    public fee: number;
    public tax: number;
    public plan: number;
    public expiration: Date;
}
