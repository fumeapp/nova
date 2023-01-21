import { MenuItem } from '@/types/frontend'
import fullMenu from '@/lib/menu'
const isMenuOn = ref(false)
import Api from '@/lib/api'

export const useMenu = (api: Api | undefined) => {

  const route = useRoute()
  const router = useRouter()
  const mainMenu: MenuItem[] = [
    {
      name: 'Dashboard',
      label: 'Overview of all your tokens, activity, and updates',
      icon: 'mdi-view-dashboard',
      to: '/home',
      names: ['home'],
    },
    {
      name: 'Inventory',
      label: 'Household Goods',
      icon: 'mdi:archive',
      to: '/inventory',
      names: ['inventory', 'inventory-item'],
    },
  ]

  const employeeMenu: MenuItem[] = [
  ]

  const isEmployee = computed(() => false)

  const isCurrent = (item: MenuItem): boolean =>
    typeof route?.name === 'string' && item.names !== undefined && item.names.includes(route?.name)

  const profile = computed(() => [
    [
      {
        icon: 'gg:browser',
        name: 'Public Site',
        action: () => router.push('/'),
      },
    ],
    [
      {
        icon: 'heroicons-outline:logout',
        name: 'Logout',
        action: async () => await api?.logout(router),
      },
    ],
  ])

  const menuOn = () => (isMenuOn.value = true)
  const menuOff = () => (isMenuOn.value = false)
  const menuToggle = () => (isMenuOn.value = !isMenuOn.value)

  return {
    menuOn,
    menuOff,
    menuToggle,
    isMenuOn,
    fullMenu,
    employeeMenu,
    isEmployee,
    profile,
    isCurrent,
    mainMenu,
  }
}
