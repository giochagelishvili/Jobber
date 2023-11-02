<template>
  <header>
    <HomeHeader />
  </header>
  <main>
    <div v-if="this.job.length > 0" class="job-container">
      <h1>{{ this.job[0].job_title }} / {{ this.job[0].job_type }}</h1>
      <hr />
      <h1 class="location">
        <span class="material-symbols-outlined"> location_on </span>{{ this.job[0].job_location }}
      </h1>
      <p>
        {{ this.job[0].job_description }}
      </p>
      <p>{{ this.job[0].job_requirements }}</p>
      <h1 style="text-align: right; margin-top: 20px">
        ${{ this.job[0].salary_amount }} / {{ this.job[0].salary_type }}
      </h1>
      <div class="btn-container">
        <ButtonComponent text="Upload CV" />
        <ButtonComponent text="Add to Favorites" />
      </div>
    </div>
    <h1 v-else>Couldn't find this job.</h1>
    <div class="hero-container">
      <img src="@/assets/jobViewHero.svg" />
    </div>
  </main>
  <footer>
    <FooterComponent />
  </footer>
</template>

<script>
import axios from 'axios'
import HomeHeader from '../components/headers/HomeHeader.vue'
import FooterComponent from '../components/FooterComponent.vue'
import ButtonComponent from '../components/ButtonComponent.vue'

export default {
  name: 'JobView',
  components: { HomeHeader, FooterComponent, ButtonComponent },
  data() {
    return {
      job: []
    }
  },
  methods: {
    async getJob() {
      let jobId = this.$route.query.id

      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'getJob',
          jobId: jobId
        })

        this.job = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    }
  },
  created() {
    this.getJob()
  }
}
</script>

<style scoped>
main {
  display: grid;
  grid-template-columns: 1fr 1fr;
  place-items: center;
  gap: 50px;

  background: #a5dce3;
  flex: 1;
}

.hero-container {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
}

.job-container {
  display: flex;
  flex-direction: column;
  gap: 10px;
  background: #fff;
  padding: 15px;
  height: 100%;

  box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
  -webkit-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
  -moz-box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, 0.75);
}

.job-container h1 {
  font-size: 22px;
}

.location {
  display: flex;
  align-items: center;
  font-size: 16px !important;
  color: #2d68ce;
}

.btn-container {
  display: flex;
  align-items: center;
  gap: 20px;

  margin-top: 20px;
  padding-inline-start: 20px;
}

.btn-container button {
  background: #2d68ce;
  color: #fff;
  font-weight: 600;
  padding-inline: 10px;
}
</style>
