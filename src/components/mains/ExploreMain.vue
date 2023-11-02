<template>
  <section id="filter-section">
    <form @submit.prevent="search" id="filterForm">
      <select @change="applyFilter" name="categoryFilter" id="categoryFilter" ref="categoryFilter">
        <option selected disabled>Category</option>
        <option value="All">All</option>
        <option
          v-for="jobCategory in jobCategories"
          :key="jobCategory.category_id"
          :value="jobCategory.job_category"
        >
          {{ jobCategory.job_category }}
        </option>
      </select>

      <select name="typeFilter" id="typeFilter" ref="typeFilter" @change="applyFilter">
        <option selected disabled>Job Type</option>
        <option value="All">All</option>
        <option value="Full-Time">Full-Time</option>
        <option value="Part-Time">Part-Time</option>
        <option value="Contract">Contract</option>
        <option value="Internship">Internship</option>
      </select>

      <select
        name="salaryTypeFilter"
        id="salaryTypeFilter"
        ref="salaryTypeFilter"
        @change="applyFilter"
      >
        <option selected disabled>Salary Type</option>
        <option value="All">All</option>
        <option value="Hourly">Hourly</option>
        <option value="Weekly">Weekly</option>
        <option value="Monthly">Monthly</option>
      </select>

      <div class="search-bar-div">
        <input
          placeholder="'e.g. Marketing'"
          type="text"
          name="jobSearch"
          id="jobSearch"
          v-model="keyword"
        />
        <span @click="search" class="material-symbols-outlined"> search </span>
      </div>
    </form>
  </section>
  <section id="job-list-section">
    <div v-if="jobs.length > 0">
      <RouterLink v-for="job in jobs" :key="job.job_id" :to="`/job?id=${job.job_id}`">
        <JobContainer
          :title="job.job_title"
          :location="job.job_location"
          :type="job.job_type"
          :category="job.job_category"
          :salary="job.salary_amount"
          :salary_type="job.salary_type"
        />
      </RouterLink>
    </div>
    <h1 v-else>No jobs</h1>
  </section>
</template>

<script>
import axios, { formToJSON } from 'axios'
import JobContainer from '../JobContainer.vue'

export default {
  name: 'ExploreMain',
  components: { JobContainer },
  data() {
    return {
      jobCategories: [],
      jobs: [],
      keyword: ''
    }
  },
  methods: {
    // Send post request to controller, passing 'getJobCategories' action
    // Controller selects everything from 'job_categories' table
    async getJobCategories() {
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'getJobCategories'
        })

        // Assign received data to 'jobCategories' array
        this.jobCategories = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    },

    // Send post request to controller, passing 'getAllJobs' action
    // Controller selects everything from "jobs" table
    async getAllJobs() {
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'getAllJobs'
        })

        // Assign received data to 'jobs' array
        this.jobs = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    },

    // Send post request to controller, passing 'applyFilters' action and applied filters
    // Controller selects jobs according to selected filters
    async applyFilter() {
      // Transform filter form to JSON object
      let form = document.getElementById('filterForm')
      let formData = formToJSON(form)

      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'applyFilters',
          formData: formData
        })

        // Assign filtered jobs to 'jobs' array
        this.jobs = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    },

    // Send post request to controller, passing 'search' action and keyword
    // Controller selects job(s) which 'job_title' includes passed keyword
    async search() {
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'search',
          keyword: this.keyword
        })

        // Assign filtered jobs to 'jobs' array
        this.jobs = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    }
  },
  mounted() {
    this.getJobCategories()
    this.getAllJobs()

    // Keyword is provided in URL if user ran search event from 'HomeMain' component
    if (this.$route.query.keyword) {
      const search = window.location.search.substring(1)
      const params = new URLSearchParams(search)
      const keywordValue = decodeURIComponent(params.get('keyword'))
      this.keyword = keywordValue
      this.search()
    }
  }
}
</script>

<style scoped>
#filter-section {
  width: 100%;
  padding-block: 25px;
  background: #3976de;
}

#filter-section form,
#filter-section div {
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}

.search-bar-div {
  justify-content: space-between !important;
  gap: 10px;

  background: #fff;

  width: 280px;
  padding-inline-start: 15px;
  border-radius: 15px;
  overflow: hidden;
}

.search-bar-div input {
  font-size: 16px;
  width: 100%;
  padding-block: 8px;
  border: none;
}

.search-bar-div span {
  display: flex;
  align-items: center;
  justify-content: center;

  background: #3976de;
  color: #fff;

  height: 35px;
  width: 70px;

  cursor: pointer;
  transition: 0.2s;
}

.search-bar-div span:hover {
  background: #10bc10;
}

select {
  font-size: 16px;

  border: none;
  border-radius: 15px;

  padding-inline: 15px;
  padding-block: 8px;

  width: 200px;
}

input:focus,
select:focus {
  outline: none;
}
</style>
