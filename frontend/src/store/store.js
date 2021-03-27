import { computed, reactive, ref } from 'vue'

export const channels = ref([])
export const categories = ref([])
export const vTubers = ref([])
export const categoryTree = ref([])
export let isLoading = ref(false)
export let error = ref('')

export const filteredChannels = computed(() => {
  let filteredChannels = channels.value

  if (!_.isEmpty(filters.name)) {
    filteredChannels = _.filter(filteredChannels, c => c.name.match(new RegExp(filters.name, 'i')))
  }

  if (filters.tier !== 'all') {
    filteredChannels = _.filter(filteredChannels, { tier: filters.tier })
  }

  if (filters.subscribers !== 'all') {
    filteredChannels = _.reject(filteredChannels, ['subscribersCount', null])
    filteredChannels = _.filter(filteredChannels,
      channel => filters.subscribers(channel.subscribersCount))
  }

  if (filters.mainFocus !== 'all') {
    // Todo
  }

  if (filters.greatEditor) {
    filteredChannels = _.filter(filteredChannels, ['goodEditor', true])
  }

  switch (filters.sorting) {
    case 'alphabetically':
      filteredChannels = _.sortBy(filteredChannels, [c => _.lowerCase(c.name)])
      break
    case 'subscribers':
      filteredChannels = _.sortBy(filteredChannels, ['subscribersCount'])
      break
    case 'mainFocus':
      // Todo
      break
  }

  return filteredChannels
})

export const filters = reactive({
  name: '',
  tier: 'all',
  subscribers: 'all',
  mainFocus: 'all',
  greatEditor: false,
  sorting: 'alphabetically'
})

export const tieredChannels = {}
tieredChannels['S'] = computed(() => _.filter(filteredChannels.value, ['tier', 'S']))
tieredChannels['A'] = computed(() => _.filter(filteredChannels.value, ['tier', 'A']))
tieredChannels['B'] = computed(() => _.filter(filteredChannels.value, ['tier', 'B']))
tieredChannels['C'] = computed(() => _.filter(filteredChannels.value, ['tier', 'C']))
tieredChannels['U'] = computed(() => _.filter(filteredChannels.value, ['tier', 'U']))

export async function initializeStore () {
  try {
    isLoading.value = true
    const [channelsResponse, categoriesResponse, categoryTreeResponse, vTubersResponse] = await Promise.all([
      axios.get(import.meta.env.VITE_TTL_BASE_URL + '/api/translation-channels'),
      axios.get(import.meta.env.VITE_TTL_BASE_URL + '/api/categories'),
      axios.get(import.meta.env.VITE_TTL_BASE_URL + '/api/categories/tree'),
      axios.get(import.meta.env.VITE_TTL_BASE_URL + '/api/vtubers')
    ])
    channels.value = channelsResponse.data.data
    categories.value = categoriesResponse.data.data
    categoryTree.value = categoryTreeResponse.data.data
    vTubers.value = vTubersResponse.data.data
  } catch (e) {
    console.error(e)
    error.value = 'Sorry, something went wrong. Please try again later.'
  } finally {
    isLoading.value = false
  }
}
