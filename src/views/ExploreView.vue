<template>
  <header>
    <HomeHeader />
  </header>
  <main>
    <ExploreMain />
  </main>
</template>

<script>
import HomeHeader from '../components/headers/HomeHeader.vue'
import ExploreMain from '../components/mains/ExploreMain.vue'

export default {
  name: 'ExploreView',
  components: { HomeHeader, ExploreMain }
}
</script>

<style scoped>
main {
  padding: 0;
}
</style>
