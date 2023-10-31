<template>
  <section class="filter-section">
    <div>
      <select name="categoryFilter" id="categoryFilter">
        <option selected disabled>Category</option>
        <option
          v-for="jobCategory in jobCategories"
          :key="jobCategory.category_id"
          :value="jobCategory.job_category"
        >
          {{ jobCategory.job_category }}
        </option>
      </select>
      <select name="typeFilter" id="typeFilter">
        <option selected disabled>Job Type</option>
        <option value="Full-Time">Full-Time</option>
        <option value="Part-Time">Part-Time</option>
        <option value="Contract">Contract</option>
        <option value="Internship">Internship</option>
      </select>
      <select name="salaryTypeFilter" id="salaryTypeFilt">
        <option selected disabled>Salary Type</option>
        <option value="Hourly">Hourly</option>
        <option value="Weekly">Weekly</option>
        <option value="Monthly">Monthly</option>
      </select>
      <div class="search-bar-div">
        <input placeholder="'e.g. Marketing'" type="text" name="jobSearch" id="jobSearch" />
        <span class="material-symbols-outlined"> search </span>
      </div>
    </div>
  </section>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ExploreMain',
  data() {
    return {
      jobCategories: []
    }
  },
  methods: {
    async getJobCategories() {
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'getJobCategories'
        })
        this.jobCategories = response.data
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    }
  },
  mounted() {
    this.getJobCategories()
  }
}
</script>

<style scoped>
.filter-section {
  width: 100%;
  padding-block: 25px;
  background: #3976de;
}

.filter-section div {
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
