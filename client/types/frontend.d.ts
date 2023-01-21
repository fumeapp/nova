export interface MenuItem {
  icon?: string
  name: string
  label?: string
  to?: string
  names?: string[]
  items?: SubMenuItem[]
  footer?: boolean
}

export interface BreadCrumb {
  name: string
  to?: RouteLocationRaw
  icon?: string
  image?: string
}

export interface UserLogin {
  token: string
  user: models.User
  provider: string
  error?: string
  action?: LoginAction
}

export interface AuthConfig {
  fetchOptions: FetchOptions<'json'>
  webURL: string
  apiURL: string
  redirect: {
    logout: string
    login: undefined | string
  }
  paymentToast?: ToastProps,
  echoConfig?: EchoConfig,
}

export interface EchoConfig {
  pusherAppKey: string
  pusherAppCluster: string

}

export interface LoginAction {
  action: string
  url: string
}


