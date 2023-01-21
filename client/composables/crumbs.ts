import { BreadCrumb } from "@/types/frontend"

const list = ref<BreadCrumb[]>([])
const actions = ref<BreadCrumb[]>([])

export const useCrumbs = () => {

  const set = (crumbs: BreadCrumb[]): void => {
    list.value = crumbs
    actions.value = []
  }

  const action = (action: BreadCrumb): number => actions.value.push(action)

  return { list, actions, set, action }

}
