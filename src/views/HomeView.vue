<template>
  <header>
    <HomeHeader />
  </header>
  <main>
    <HomeMain />
  </main>
  <footer>
    <FooterComponent />
  </footer>
</template>

<script>
import HomeHeader from '../components/headers/HomeHeader.vue'
import HomeMain from '../components/mains/HomeMain.vue'
import FooterComponent from '../components/FooterComponent.vue'

export default {
  name: 'HomeView',
  components: { HomeHeader, HomeMain, FooterComponent }
}
</script>
