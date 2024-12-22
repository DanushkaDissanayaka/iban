<template>
  <el-menu class="el-menu-demo" mode="horizontal" @select="handleSelect">
    <el-menu-item :index="logout_index"><font-awesome-icon icon="sign-out" class="sing-out" /> Sign-out</el-menu-item>
  </el-menu>
</template>

<script>
import { mapState } from "pinia";
import { useUserStore } from '@/store/user'
import { ElNotification } from 'element-plus'

export default {
  data: function () {
    return {
      logout_index: "logout"
    }
  },
  computed: {
    ...mapState(useUserStore, ['logoutUser']),
  },
  methods: {
    handleSelect: function (key, keyPath) {
      if (key === this.logout_index) {
        this.logout();
      }
    },

    logout: function () {
      this.$http.post(`/logout`, {}).then(response => {
        this.$router.push('/login');
        this.logoutUser();
        ElNotification({
          title: 'Success',
          message: response.data.message,
          type: 'success',
        })
      }).catch(error => {
        console.log(error);
      });
    },
  }
};

</script>

<style scoped>
.sing-out {
  padding-right: 5px;
}
</style>