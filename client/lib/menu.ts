import { RouteLocationNormalizedLoaded, Router } from 'vue-router'
import { DropdownGroup } from '@/components/dropdown/DropdownGroup.vue'
import Api from '@/lib/api'
import { MenuItem } from '@/types/frontend'

export default class {

  constructor(
    private route: RouteLocationNormalizedLoaded,
    private router: Router,
    private api: Api,
  ) { }

  public profileGroup: DropdownGroup = [
    [
      {
        icon: 'carbon:user-profile',
        name: 'Your Profile',
        action: () => this.router.push('/profile'),
      },
      {
        icon: 'mdi-devices',
        name: 'Your Devices',
        action: () => this.router.push('/sessions'),
      },
    ],
    [
      {
        icon: 'heroicons-outline:logout',
        name: 'Logout',
        action: async () => await this.logout(),
      },
    ],
  ]

  private async logout() {
    await this.api.logout(this.router)
  }
}
