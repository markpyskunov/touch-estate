import { defineStore } from 'pinia'

interface Store {
    isLoading: boolean;
    loadingMessage: null|string;
}
export const useLoadingStore = defineStore('loading', {
  state: (): Store => ({
    isLoading: false,
    loadingMessage: '...',
  }),
  actions: {
    show(message: string = 'Loading...') {
      this.isLoading = true
      this.loadingMessage = message
    },
    hide() {
      this.isLoading = false
      this.loadingMessage = '...'
    }
  }
})
