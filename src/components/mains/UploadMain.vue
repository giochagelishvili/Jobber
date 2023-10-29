<template>
  <form method="post">
    <p>
      Please fill out the form. <br />
      All fields are necesarry.
    </p>

    <div>
      <label for="jobTitle">Job Title: </label>
      <input required type="text" name="jobTitle" id="jobTitle" />
    </div>

    <div>
      <label for="jobLocation">Job Location: </label>
      <input
        required
        placeholder="(City, State/Province, Country)"
        type="text"
        name="jobLocation"
        id="jobLocation"
      />
    </div>

    <div>
      <label for="jobType">Job Type: </label>
      <select name="jobType" id="jobType">
        <option value="fullTime">Full-Time</option>
        <option value="partTime">Part-Time</option>
        <option value="contract">Contract</option>
        <option value="internship">Internship</option>
      </select>
    </div>

    <div>
      <label for="jobCategory">Job Category: </label>
      <select name="jobCategory" id="jobCategory">
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
        <option value="hourly">Hourly</option>
        <option value="weekly">Weekly</option>
        <option value="monthly">Monthly</option>
      </select>
    </div>

    <div>
      <label for="salaryAmount">Salary Amount: </label>
      <input type="number" name="salaryAmount" id="salaryAmount" />
    </div>
  </form>
</template>

<script>
export default {
  name: 'UploadMain'
}
</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 30px;

  border: 1px solid #3979e7;
  border-radius: 15px;
  width: 600px;
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
textarea {
  border: 1px solid #d2d2d2;
  border-radius: 5px;

  padding-inline: 10px;
  padding-block: 5px;
  min-width: 230px;
}
</style>
