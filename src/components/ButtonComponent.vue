<template>
  <button>{{ text }}</button>
</template>

<script>
export default {
  name: 'ButtonComponent',
  props: ['text', 'background']
}
</script>

<style scoped>
button {
  font-size: 18px;
  background: none;

  padding-block: 8px;
  min-width: 120px;

  color: rgb(30, 30, 30);
  border: 2px solid #1e55b3;

  cursor: pointer;
  transition: 0.2s;
}

button:hover {
  background: #1e55b3;
  color: #ffffff;
}
</style>
