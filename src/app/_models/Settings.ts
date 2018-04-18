import { BaseModel } from './BaseModel';

export class Settings extends BaseModel {
  static readonly FREE_PLAN;
  static readonly BASIC_PLAN;
  static readonly PREMIUM_PLAN;

  public id: number;
  public business_name: string;
  public business_email: string;
  public business_phone: string;
  public fee: number;
  public tax: number;
  public plan: 0;
  public expiration: Date;
}
