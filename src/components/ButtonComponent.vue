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

  box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.2);
}

button:hover {
  background: #1e55b3;
  color: #ffffff;
}
</style>
