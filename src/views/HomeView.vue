<template>
  <header>
    <HomeHeader />
  </header>
  <main>
    <HomeMain />
  </main>
</template>

<script>
import HomeHeader from '../components/headers/HomeHeader.vue'
import HomeMain from '../components/mains/HomeMain.vue'

export default {
  name: 'HomeView',
  components: { HomeHeader, HomeMain }
}
</script>
