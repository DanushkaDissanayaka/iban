<template>
  <!-- <div>
    <ul>
      <li>
        <router-link :to="{ name: 'home' }">
          Home
        </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'about' }">About</router-link>
      </li>

    </ul>

  </div> -->
  <router-view></router-view>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}

.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}

.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
