<template>
  <h1>
    Find and become a <br />
    <span>professional</span> with passion
  </h1>
  <p>
    Job search platform worldwide. We connect freelancers and
    <br />
    startups in an easy way and good collaboration.
  </p>

  <div class="container">
    <div class="keyword-div">
      <ButtonComponent text="front-end" />
      <ButtonComponent text="ui designer" />
      <ButtonComponent text="3d illustrator" />
      <ButtonComponent text="product manager" />
      <ButtonComponent text="ux designer" />
      <ButtonComponent text="marketing" />
      <ButtonComponent text="back-end" />
      <ButtonComponent text="hiring manager" />
    </div>
  </div>

  <div>
    <form class="search-bar-form">
      <span class="material-symbols-outlined"> work </span>
      <input placeholder="Job Title" type="text" name="job" id="job" />
      <button type="submit">
        <span class="material-symbols-outlined"> search </span>
      </button>
    </form>
  </div>

  <div>
    <RouterLink to="/explore">
      <ButtonComponent
        text="See All Jobs"
        style="
          margin-top: 20px;
          background: #3979e7;
          color: #fff;
          border-color: #3979e7;
          padding-inline: 20px;
        "
      />
    </RouterLink>
  </div>
</template>

<script>
import { RouterLink } from 'vue-router'
import ButtonComponent from '../ButtonComponent.vue'

export default {
  name: 'HomeMain',
  components: { ButtonComponent, RouterLink }
}
</script>

<style scoped>
h1 {
  font-size: 56px;
  text-align: center;

  color: #323232;
}

span {
  color: #3979e7;
}

p {
  text-align: center;
  color: #7a7a7a;
  margin-top: 25px;
  padding-inline: 100px;
}

div,
form {
  display: flex;
  align-items: center;
  justify-content: center;
}

.keyword-div {
  flex-wrap: wrap;
  gap: 20px;
  width: 50%;
}

.container {
  width: 100%;
  margin-top: 25px;
}

.search-bar-form {
  padding-inline-start: 15px;
  margin-top: 25px;

  justify-content: flex-start;

  border: 1px solid #cbcbcb;
  border-radius: 15px;

  background: #f9f9f9;
  width: 350px;

  overflow: hidden;
}

.search-bar-form span {
  color: #adadad;
}

.search-bar-form input {
  font-size: 16px;

  padding-inline: 5px;
  padding-block: 10px;
  margin-left: 5px;

  background: none;
  border: none;

  width: 100%;
}

.search-bar-form input:focus {
  outline: none;
}

.search-bar-form button {
  display: flex;
  align-items: center;
  justify-content: center;

  height: 40px;
  border: none;
  cursor: pointer;

  background: #3979e7;

  transition: 0.2s;
}

.search-bar-form button:hover {
  background: #4787f7;
}

.search-bar-form button span {
  font-size: 28px;
  color: #fff;
}

button {
  padding-inline: 15px;
}

@media screen and (min-width: 1280px) {
  h1 {
    font-size: 96px;
  }

  p {
    font-size: 22px;
  }
}
</style>
