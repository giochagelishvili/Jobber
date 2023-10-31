<template>
  <div class="grid-container">
    <form id="uploadForm" ref="uploadForm" method="post" @submit.prevent="uploadJob">
      <p>
        Please fill out the form. <br />
        All fields are necesarry.
      </p>

      <div>
        <label for="jobTitle">Job Title: </label>
        <input placeholder="e.g. Junior PHP Developer" type="text" name="jobTitle" id="jobTitle" />
      </div>

      <div>
        <label for="jobLocation">Job Location: </label>
        <input
          placeholder="(City, State/Province, Country)"
          type="text"
          name="jobLocation"
          id="jobLocation"
        />
      </div>

      <div>
        <label for="jobType">Job Type: </label>
        <select name="jobType" id="jobType">
          <option selected disabled>Select</option>
          <option value="Full-Time">Full-Time</option>
          <option value="Part-Time">Part-Time</option>
          <option value="Contract">Contract</option>
          <option value="Internship">Internship</option>
        </select>
      </div>

      <div>
        <label for="jobCategory">Job Category: </label>
        <select name="jobCategory" id="jobCategory">
          <option selected disabled>Select</option>
          <option
            v-for="category in jobCategories"
            :key="category.category_id"
            :value="category.job_category"
          >
            {{ category.job_category }}
          </option>
        </select>
      </div>

      <div>
        <label for="jobDescription">Job Description: </label>
        <textarea
          placeholder="Job responsibilities, advantages/disadvantages etc."
          name="jobDescription"
          id="jobDescription"
          cols="30"
          rows="10"
        ></textarea>
      </div>

      <div>
        <label for="jobRequirements">Job Requirements: </label>
        <textarea
          placeholder="Qualifications, skills, cerfitications etc."
          name="jobRequirements"
          id="jobRequirements"
          cols="30"
          rows="10"
        ></textarea>
      </div>

      <div>
        <label for="salaryType">Salary Type: </label>
        <select name="salaryType" id="salaryType">
          <option selected disabled>Select</option>
          <option value="Hourly">Hourly</option>
          <option value="Weekly">Weekly</option>
          <option value="Monthly">Monthly</option>
        </select>
      </div>

      <div>
        <label for="salaryAmount">Salary Amount($): </label>
        <input placeholder="e.g. 1500" type="number" name="salaryAmount" id="salaryAmount" />
      </div>

      <ul v-if="errors.length != 0" ref="errorList">
        <li v-for="error in errors" :key="error">{{ error }}</li>
      </ul>
    </form>
    <img width="500" src="@/assets/illustration.svg" />
  </div>
</template>

<script>
import axios, { formToJSON } from 'axios'

export default {
  name: 'UploadMain',
  data() {
    return {
      jobCategories: [],
      errors: []
    }
  },
  methods: {
    async uploadJob(event) {
      const formData = formToJSON(event.target)
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'uploadJob',
          formData: formData
        })

        if (Array.isArray(response.data) === true) {
          this.errors = response.data
          this.$nextTick(() => {
            this.scrollToErrorList()
          })
        } else {
          this.$refs.uploadForm.reset()
          this.$router.push('/')
        }

        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    },
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
    },
    scrollToErrorList() {
      const errorList = this.$refs.errorList

      if (errorList) {
        errorList.scrollIntoView({
          behavior: 'smooth' // You can use 'auto' for immediate scrolling
        })
      }
    }
  },
  mounted() {
    this.getJobCategories()
  }
}
</script>

<style scoped>
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  place-items: center;
  align-items: start;
}

img {
  display: none;
}

form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 30px;

  border: 1px solid #3979e7;
  border-radius: 15px;
  width: 600px;

  box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
}

form p {
  font-size: 14px;
  color: #a3a2a2;
  margin-bottom: 10px;
}

div {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}

label {
  width: 140px;
}

input,
textarea,
select {
  border: 1px solid #d2d2d2;
  border-radius: 5px;

  padding-inline: 10px;
  padding-block: 5px;
  min-width: 230px;
}

ul {
  display: flex;
  flex-direction: column;
  gap: 10px;

  border-radius: 15px;

  color: #fff;
  background: red;

  padding-block: 15px;
  padding-inline-start: 45px;

  box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
  -webkit-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.15);
}

@media screen and (min-width: 1280px) {
  img {
    display: block;
  }
}
</style>
