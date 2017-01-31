import { Field } from './field';

export interface Fieldgroup {
    id: number,
    created_at?: string,
    updated_at?: string,
    cssclass: string,
    active: string,
    tableorder: string,
    name: string;
    fields: Field[]
}