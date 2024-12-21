// src/store/index.js
import { defineStore } from 'pinia';

export const useUserStore = defineStore('auth', {
  state: () => ({
    user: null,
  }),
  actions: {
    login(userData) {
      this.user = userData;
    },
    logout() {
      this.user = null;
    },
  },
});
