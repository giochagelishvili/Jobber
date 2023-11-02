<template>
  <header>
    <HomeHeader />
  </header>
  <main>
    <p>
      This website has been developed by
      <a href="https://github.com/giochagelishvili/Jobber" target="_blank">Giorgi Chagelishvili</a>
      from scratch. <br />
    </p>
    <p>
      Website design inspiration from - Arya Pradana <br />
      <a href="https://dribbble.com/eluxarya" target="_blank">Dribbble Profile</a>
    </p>
  </main>
  <footer>
    <FooterComponent />
  </footer>
</template>

<script>
import HomeHeader from '../components/headers/HomeHeader.vue'
import FooterComponent from '../components/FooterComponent.vue'

export default {
  name: 'AboutView',
  components: { HomeHeader, FooterComponent }
}
</script>

<style scoped>
main {
  flex: 1;
}

div {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

p {
  text-align: center;
  margin-top: 15px;
}

a {
  color: #3979e7;
  transition: 0.2s;
}

a:hover {
  color: #6ba0fd;
}
</style>
