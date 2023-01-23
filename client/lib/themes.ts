import { PushButtonTheme } from 'tailvue'

export const ThemeRounded: PushButtonTheme = {
  primary: 'font-medium rounded-full text-white bg-logo-a ring-offset-white',
  dark: 'dark:hover:bg-white dark:hover:text-black dark:ring-offset-gray-900',
  active: 'hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-logo-a focus:shadow-outline-indigo',
  disabled: '',
}

export const ThemeRoundedWhite: PushButtonTheme = {
  primary: 'font-medium rounded-full text-logo-a bg-white ring-offset-white',
  active: 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-logo-b',
  disabled: '',
}

export const ThemeRoundedWhiteLeft: PushButtonTheme = {
  primary: 'font-medium rounded-l-full text-logo-a bg-white ring-offset-white',
  active: 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-logo-b',
  disabled: '',
}

export const ThemeRoundedWhiteRight: PushButtonTheme = {
  primary: 'font-medium rounded-full  lg:rounded-none lg:rounded-r-full text-logo-a bg-logo-a text-white lg:bg-white lg:text-logo-a ring-offset-white',
  active: 'focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-logo-b',
  disabled: '',
}
export const ThemeGradient: PushButtonTheme = {
  primary: 'font-medium rounded text-white bg-gradient-to-br from-swatch5 to-swatch4',
  active: 'hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 ring-offset-indigo-100 focus:ring-green-600 focus:shadow-outline-green active:bg-green-700',
  dark: 'dark:ring-offset-indigo-800',
}
