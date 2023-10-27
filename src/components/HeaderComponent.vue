<template>
  <img src="@/assets/logo.svg" width="120" />

  <nav>
    <ul>
      <li>Home</li>
      <li>Explore</li>
      <li>About Us</li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'HeaderComponent'
}
</script>

<style scoped>
ul {
  display: flex;
  align-items: center;
  gap: 30px;

  list-style: none;
}

li {
  font-size: 18px;
  letter-spacing: 2px;
}
</style>
