import { Location } from '@/types/api'
export {}
declare global {
  export namespace models {

    export interface Image {
      // columns
      id: number
      user_id: number
      item_id: number|null
      url: string
      created_at: Date|null
      updated_at: Date|null
      // relations
      user: User
      item: Item
      labels: Labels
    }
    export type Images = Image[]
    export interface ImageResults extends api.MetApiResults { data: Images }
    export interface ImageResult extends api.MetApiResults { data: Image }
    export interface ImageMetApiData extends api.MetApiData { data: Image }
    export interface ImageResponse extends api.MetApiResponse { data: ImageMetApiData }

    export interface Item {
      // columns
      id: number
      user_id: number
      title: string
      description: string
      location: Location|null
      created_at: Date|null
      updated_at: Date|null
      // relations
      user: User
      images: Images
      tags: Tags
    }
    export type Items = Item[]
    export interface ItemResults extends api.MetApiResults { data: Items }
    export interface ItemResult extends api.MetApiResults { data: Item }
    export interface ItemMetApiData extends api.MetApiData { data: Item }
    export interface ItemResponse extends api.MetApiResponse { data: ItemMetApiData }

    export interface Label {
      // columns
      id: number
      image_id: number
      name: string
      confidence: number
      categories: string[]
      // relations
      image: Image
    }
    export type Labels = Label[]
    export interface LabelResults extends api.MetApiResults { data: Labels }
    export interface LabelResult extends api.MetApiResults { data: Label }
    export interface LabelMetApiData extends api.MetApiData { data: Label }
    export interface LabelResponse extends api.MetApiResponse { data: LabelMetApiData }

    export interface Provider {
      // columns
      id: number
      user_id: number
      avatar: string|null
      name: string
      payload: string[]
      created_at: Date|null
      updated_at: Date|null
    }
    export type Providers = Provider[]
    export interface ProviderResults extends api.MetApiResults { data: Providers }
    export interface ProviderResult extends api.MetApiResults { data: Provider }
    export interface ProviderMetApiData extends api.MetApiData { data: Provider }
    export interface ProviderResponse extends api.MetApiResponse { data: ProviderMetApiData }

    export interface Tag {
      // columns
      id: number
      name: string
      created_at: Date|null
      updated_at: Date|null
      // relations
      items: Items
    }
    export type Tags = Tag[]
    export interface TagResults extends api.MetApiResults { data: Tags }
    export interface TagResult extends api.MetApiResults { data: Tag }
    export interface TagMetApiData extends api.MetApiData { data: Tag }
    export interface TagResponse extends api.MetApiResponse { data: TagMetApiData }

    export interface User {
      // columns
      id: number
      email: string
      name: string|null
      avatar: string|null
      payload: string[]
      created_at: Date|null
      updated_at: Date|null
      // mutators
      first_name: string
      has_active_session: bool
      session: Session
      location: array
      // overrides
      location: unknown
      session: unknown
      sessions: unknown
      // relations
      providers: Providers
      images: Images
      sessions: Sessions
      notifications: DatabaseNotifications
    }
    export type Users = User[]
    export interface UserResults extends api.MetApiResults { data: Users }
    export interface UserResult extends api.MetApiResults { data: User }
    export interface UserMetApiData extends api.MetApiData { data: User }
    export interface UserResponse extends api.MetApiResponse { data: UserMetApiData }

  }
}
