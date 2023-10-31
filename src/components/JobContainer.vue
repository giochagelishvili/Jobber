<template>
  <div>
    <h1 class="charcoal">{{ title }}</h1>
    <h1>{{ location }}</h1>
    <h1 class="charcoal">{{ type }}</h1>
    <h1>{{ category }}</h1>
    <h1 class="charcoal">${{ salary }}/{{ salary_type }}</h1>
  </div>
</template>

<script>
export default {
  name: 'JobContainer',
  props: ['id', 'title', 'location', 'type', 'category', 'salary', 'salary_type']
}
</script>

<style scoped>
div {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  transition: 0.2s;
}

h1 {
  font-size: 18px;
  font-weight: 400;
  text-align: center;
  padding: 10px;
  width: 100%;
  border-right: 1px solid #000;
  border-bottom: 1px solid #000;
}

.charcoal {
  background: #e9e9e9;
}

div:hover {
  transform: scale(1.02);
}
</style>
