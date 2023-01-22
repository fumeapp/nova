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
    }
    export type Images = Image[]
    export interface ImageResults extends api.MetApiResults { data: Images }
    export interface ImageMetApiData extends api.MetApiData { data: Image }
    export interface ImageResponse extends MetApiResponse { data: ImageMetApiData }

    export interface Item {
      // columns
      id: number
      user_id: number
      name: string
      description: string
      created_at: Date|null
      updated_at: Date|null
    }
    export type Items = Item[]
    export interface ItemResults extends api.MetApiResults { data: Items }
    export interface ItemMetApiData extends api.MetApiData { data: Item }
    export interface ItemResponse extends MetApiResponse { data: ItemMetApiData }

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
    export interface ProviderMetApiData extends api.MetApiData { data: Provider }
    export interface ProviderResponse extends MetApiResponse { data: ProviderMetApiData }

    export interface Tag {
      // columns
      id: number
      name: string
      created_at: Date|null
      updated_at: Date|null
    }
    export type Tags = Tag[]
    export interface TagResults extends api.MetApiResults { data: Tags }
    export interface TagMetApiData extends api.MetApiData { data: Tag }
    export interface TagResponse extends MetApiResponse { data: TagMetApiData }

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
      sessions: Sessions
      notifications: DatabaseNotifications
    }
    export type Users = User[]
    export interface UserResults extends api.MetApiResults { data: Users }
    export interface UserMetApiData extends api.MetApiData { data: User }
    export interface UserResponse extends MetApiResponse { data: UserMetApiData }

  }
}
