import { Category } from './category';

export class BrandReference {
    id: number;
    title: string;
    description: string;
    manufacturer_id: number;
    category_id: any;
    updated_at: string;
    created_at: string;
    image_url: string;
    thumbnail_small_url: string;
    thumbnail_medium_url: string;
    thumbnail_large_url: string;

    category: Category;
}
