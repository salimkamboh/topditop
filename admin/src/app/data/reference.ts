import { Store } from './store';

export interface Reference {
  id: null,
  title: string,
  status: string,
  description: string,
  video: string,
  created_at?: string,
  updated_at?: string,
  store_id: string,
  views: string,
  html: string,
  store: Store
}