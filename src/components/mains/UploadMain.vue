<template>
  <div class="grid-container">
    <form id="uploadForm" method="post" @submit.prevent="uploadJob">
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
          <option value="fullTime">Full-Time</option>
          <option value="partTime">Part-Time</option>
          <option value="contract">Contract</option>
          <option value="internship">Internship</option>
        </select>
      </div>

      <div>
        <label for="jobCategory">Job Category: </label>
        <select name="jobCategory" id="jobCategory">
          <option selected disabled>Select</option>
          <option value="IT">IT</option>
          <option value="sales">Sales</option>
          <option value="marketing">Marketing</option>
          <option value="healthcare">Healthcare</option>
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
          <option value="hourly">Hourly</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
        </select>
      </div>

      <div>
        <label for="salaryAmount">Salary Amount($): </label>
        <input placeholder="e.g. 1500" type="number" name="salaryAmount" id="salaryAmount" />
      </div>
    </form>
    <img width="500" src="@/assets/illustration.svg" />
  </div>
</template>

<script>
import axios, { formToJSON } from 'axios'

export default {
  name: 'UploadMain',
  methods: {
    async uploadJob(event) {
      const formData = formToJSON(event.target)
      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'uploadJob',
          formData: formData
        })

        console.log(response.data)

        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    }
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

@media screen and (min-width: 1280px) {
  img {
    display: block;
  }
}
</style>
