import { Registerfield } from './registerfield';

export interface Store {
    id: number,
    store_name: string,
    mag_store_id: string,
    mag_cat_id: string,
    user_email: string,
    status: string,
    created_at?: string,
    updated_at?: string,
    image_id: string,
    location_id: string,
    cover_url: string
    user?:Object,
    user_id?: string,
    profile_id?: number,
    package_id?: number,
    package_name?: "TopDiTop Store",
    registerfields?: Registerfield[]
}
