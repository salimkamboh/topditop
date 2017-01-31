export interface Image {
    id: number,
    name: string,
    url: string,
    title: string,
    created_at?: string,
    updated_at?: string,
    pivot?: {
      reference_id: string,
      image_id: string,
      created_at?: string,
      updated_at?: string
    }
}