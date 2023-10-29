<template>
  <img src="@/assets/logo.svg" width="120" />

  <nav>
    <ul>
      <RouterLink to="/">
        <li>Home</li>
      </RouterLink>

      <RouterLink to="/explore">
        <li>Explore</li>
      </RouterLink>

      <RouterLink to="/about">
        <li>About Us</li>
      </RouterLink>
    </ul>
  </nav>

  <div>
    <RouterLink to="/upload">
      <ButtonComponent text="Upload" />
    </RouterLink>
  </div>
</template>

<script>
import ButtonComponent from '../ButtonComponent.vue'

export default {
  name: 'HeaderComponent',
  components: { ButtonComponent }
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
  letter-spacing: 1.5px;
  color: rgb(108, 108, 108);

  cursor: pointer;
  transition: 0.2s;
}

li:hover {
  color: #2d68ce;
}

div {
  display: flex;
  align-items: center;
  gap: 15px;
}
</style>
