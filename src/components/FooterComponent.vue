<template>
  <div>
    <p>Website design inspiration from - Arya Pradana</p>
    <a href="https://dribbble.com/eluxarya" target="_blank">Dribbble Profile</a>
  </div>
</template>

<script>
export default {
  name: 'FooterComponent'
}
</script>

<style scoped>
div {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

p {
  color: #fff;
}

a {
  color: #3979e7;
  transition: 0.2s;
}

a:hover {
  color: #6ba0fd;
}
</style>
