// src/store/index.js
import { defineStore } from "pinia";

const user_key = 'store-user';
export const useUserStore = defineStore("user", {
  state: function () {
		return {
			user: {
				name: localStorage.getItem(user_key) == null ? '' : JSON.parse(localStorage.getItem(user_key)).first_name,
				email: localStorage.getItem(user_key) == null ? '' : JSON.parse(localStorage.getItem(user_key)).email,
				role_id: localStorage.getItem(user_key) == null ? '' : JSON.parse(localStorage.getItem(user_key)).username,
				token: localStorage.getItem(user_key) == null ? '' : JSON.parse(localStorage.getItem(user_key)).token,
			},
		}
	},
  actions: {
    setUser(userData) {
      this.user = userData;
      localStorage.setItem(user_key, JSON.stringify(userData));
    },
    logoutUser() {
      localStorage.removeItem(user_key);
      this.user = null;
    },
  },
});
